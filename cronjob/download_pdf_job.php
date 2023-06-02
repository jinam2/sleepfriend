<?php

$document_dir = dirname(__DIR__);
chdir($document_dir);

define('_GNUBOARD_', true);
date_default_timezone_set("Asia/Seoul");


error_reporting( E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_ERROR | E_WARNING | E_PARSE | E_USER_ERROR | E_USER_WARNING );
ini_set('display_errors', '1');

include_once dirname(__DIR__) . "/custom_db_config.php";
include_once dirname(__DIR__) . "/lib/SimpleDB.php";
include_once dirname(__DIR__) . "/lib/MediSync.php";
include_once dirname(__DIR__) . "/lib/SalesForceSync.php";


$db_host = G5_MYSQL_HOST;
$db_user = G5_MYSQL_USER;
$db_password = G5_MYSQL_PASSWORD;
$db_name = G5_MYSQL_DB;

$pdo_db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"));
$pdo_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo_db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

if (!isset($pdo_db)) {
    die('DB connection error!');
}

if(!isset($cookie_file)) {
    $cookie_file = dirname(__DIR__) . "/data/medi_cookie.txt";
}

$options = [
    'cookie_file' => $cookie_file,
];

if(!isset($download_dir)) {
    $download_dir = __DIR__ . "/../download";
}


$db = new SimpleDB($pdo_db);

$salesforce_sync = new SalesForceSync($pdo_db);

$sync = new MediSync($pdo_db, $options);

$sync->getJSESSIONID();
$sync->login();
$sync->getPatient();


/* resmed 쪽 데이타를 가져오는 기준
 *  0. 같은 일자에는 두번 생성 하지 않음.
       - 데이타 크롤링(파싱)시 어떤 케이스로 생성하는지 기록(처방만료일 30일전, 병문방문)
       - 처방 아이디를 파싱 로그에 기록
    1. 세일즈포스 사용자의 유효환 최근 계약정보의 처방정보를 사용함(처방만료일, 다음 병원 방문일자)
    2. 다음방문일자가 우선적으로 적용되어야함.
      2-1. 병원방문일자 당일에 데이타를 생성
      2-2. 데이타 추출 기준은 처방시작일 ~ 병문방문일 당일 00시
    3. 방문일자가 없는 경우
      3-1. 처방 만료일 기준으로 30일전에 생성
      3-2.

    9. 상태 비교 분석dat
      - 검색시, 분석기간내 생성한 날짜로 출력
 */

$today = date("Y-m-d", time());
$yesterday =  date("Y-m-d", strtotime("-1 days")); //어제
$prescription_end_date = date("Y-m-d", strtotime("+30 days")); //처방만료일 30일전 기준
$users = $sync->getPatientsVisitSchedule($today);

$target_users = [];
foreach($users as $user) {

    //이미 생성한 경우 패스 처리
    if($user['schedule_report_id']) {
        continue;
    }

    //방문일정이 지난 경우도 패스
    if(time() > strtotime($user['next_doctor_datetime'])) {
        continue;
    }
    unset($user['PRESCRIPTION_PDF']);
    $filename = sprintf("Compliance_report_%s_%s.pdf", date("mdY"), date("His"));

    $options = [
      'from_date' => $user['START_DATE'],
      'to_date' => $yesterday,
    ];
    $is_download = $sync->downloadComplianceReport($user['easy_care_number'], $download_dir, $filename, 30, $options);
    echo "is_download = $is_download filename={$filename} \n";
    if($is_download) {
       $history_id =  $sync->insertComplianceReport($user['resmed_patient_id'], $user['easy_care_number'], $filename, 30, $user['ID'], 'SCHEDULE' );
        $sql = "update SF_PRESCRIPTION set schedule_report_id = '{$history_id}' where ID='{$user['ID']}' ";
        $db->query($sql);
    }
    sleep(2);
}

$users2 = $sync->getPatientsPrescriptionEndDate($prescription_end_date);
foreach($users2 as $user) {

    //이미 방문일정으로 생성한 경우 패스 처리
    if($user['schedule_report_id']) {
        continue;
    }

    //이미 처방만료 일정으로 생성한 경우 패스 처리
    if($user['end_report_id']) {
        continue;
    }

    print_r($user);

    $filename = sprintf("Compliance_report_%s_%s.pdf", date("mdY"), date("His"));

    $options = [
        'from_date' => $user['START_DATE'],
        'to_date' => $yesterday,
    ];

    $is_download = $sync->downloadComplianceReport($user['easy_care_number'], $download_dir, $filename, 30, $options);
    if($is_download) {
       $history_id = $sync->insertComplianceReport($user['resmed_patient_id'], $user['easy_care_number'], $filename, $user['ID'], 'END');
       $sql = "update SF_PRESCRIPTION set end_report_id = '{$history_id}' where ID='{$user['ID']}' ";
       $db->query($sql);
    }
    sleep(2);
}

$history = $sync->getNotParsingPatientReportHistory();

function onlyHanAlpha($subject) {
    $pattern = '/([\xEA-\xED][\x80-\xBF]{2}|[\x20-\x7e])+/';
    preg_match_all($pattern, $subject, $match);
    return implode('', $match[0]);
}

if(!isset($download_dir)) {
    $download_dir = __DIR__ . "/../downloads";
}

$jar_pathname = dirname(__DIR__)."/lib/pdf_data_extrator-1.0-SNAPSHOT-all.jar";

foreach($history as $row) {
    print_r($row);
    $pdf_text = "";

    //$cmd = "ls -al ";
    $pdf_file_pathname = $download_dir."/".$row['pdf_filename'];
    //$cmd = "java -jar pdf_data_extrator-1.0-SNAPSHOT-all.jar downloads/Compliance_report_07122022_163357.pdf";

    $cmd = sprintf("java -jar -Dfile.encoding=UTF-8 %s %s",$jar_pathname, $pdf_file_pathname);

    $output = "";
    echo "cmd : ".$cmd."\n";
    exec($cmd, $output, $ret_code);
    echo "ret_code: " . $ret_code . "\n";
    //print_r($output);
    $ret_message = "";
    $pdf_text = "";

    if($ret_code == 0) { //정상 실행된 경우
        $ret_message = "정상 실행됨";
        for($i = 0; $i < count($output); $i++) {
            $pdf_text .= onlyHanAlpha($output[$i])."\n";
        }

        //$pdf_text = mb_convert_encoding($pdf_text, 'UTF-8', 'ISO-8859-1');
        //$pdf_text = iconv('euc-kr', 'utf-8//IGNORE',$pdf_text);
        //$pdf_text = mb_convert_encoding($pdf_text, 'ISO-8859-1', 'UTF-8');
    } else {
        $ret_message = "정상 실행되지 않음 - ".implode("\n", $output);
    }

    $sync->updatePatientReportParsingResult($row['seq'], $pdf_text, $ret_code, $ret_message);

    $prescription = $db->row("select ID, PATIENT_ID from SF_PRESCRIPTION where ID='{$row['salesforce_prescription_id']}' ");
    if($ret_code == 0 && $prescription['PATIENT_ID']) { //처방 정보에 맞춰 정상 실행된 경우

        $pdf_values = MediUtil::extractComplianceValues($pdf_text);

        try {
            $low_mid_high_time = MediUtil::getStatusByUseTime($pdf_values['total_avg_used_minute'], "low_mid_high");
            $salesforce_sync->set_usage_data($prescription['PATIENT_ID'], date("Y-m-d"), $row['from_date'], $row['to_date'], $low_mid_high_time, $pdf_values['ahi_median'], $pdf_values['total_avg_used_minute']);
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
}

