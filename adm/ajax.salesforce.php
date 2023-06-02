<?php
require_once './_common.php';


$json_result = ['code' => 200, 'memssage' => ''];


error_reporting( E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_ERROR | E_WARNING | E_PARSE | E_USER_ERROR | E_USER_WARNING );
ini_set('display_errors', '1');

include_once G5_PATH . "/custom_db_config.php";
include_once G5_PATH . "/lib/SimpleDB.php";
include_once G5_PATH . "/lib/SalesForceSync.php";
include_once G5_PATH . "/lib/MediSync.php";

if ($is_admin != 'super') {
    $json_result['code'] = 403;
    $json_result['memssage'] = "최고관리자만 접근 가능합니다.";
    die(json_encode($json_result, JSON_UNESCAPED_UNICODE));
}

$db_host = G5_MYSQL_HOST;
$db_user = G5_MYSQL_USER;
$db_password = G5_MYSQL_PASSWORD;
$db_name = G5_MYSQL_DB;


$pdo_db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"));
$pdo_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo_db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

unset($db_host);
unset($db_user);
unset($db_password);
unset($db_name);

$db = new SimpleDB($pdo_db);

$salesforce_sync = new SalesForceSync($pdo_db);

$before = 1;
$from = date("Ymd", strtotime("-{$before} day", time()));
$to = date(date("Ymd"));

$users = $db->query("select mb_id, salesforce_id from g5_member where salesforce_id is not null ");

$cmd = filter_input(INPUT_POST, 'action');

try {
    //contract
    if ($cmd == "contract") {
        foreach ($users as $user) {
            $response = $salesforce_sync->get_contract($user['salesforce_id']);
            $jsonData = json_decode($response, true);

            if (!is_array($jsonData)) { //정상응답
                continue;
            }

            if ($jsonData['STATUS_CODE'] != 'Success') {
                continue;
            }

            foreach ($jsonData['CONTRACT_LIST'] as $row) {
                //print_r($row);
                $salesforce_sync->insertOrUpdateContract($user['salesforce_id'], $row);
                //print_r($row);
            }
        }
    }

    if ($cmd == "order") {
        //order
        foreach ($users as $user) {
            $response = $salesforce_sync->get_order($user['salesforce_id']);
            $jsonData = json_decode($response, true);

            if (!is_array($jsonData)) { //정상응답
                continue;
            }

            if ($jsonData['STATUS_CODE'] != 'Success') {
                continue;
            }

            foreach ($jsonData['ORDER_LIST'] as $row) {
                $salesforce_sync->insertOrUpdateOrder($user['salesforce_id'], $row);
                //print_r($row);
            }
        }
    }

    if ($cmd == "invoice") { //청구 조회
        //invoice
        foreach ($users as $user) {
            $response = $salesforce_sync->get_invoice($user['salesforce_id']);
            $jsonData = json_decode($response, true);

            if (!is_array($jsonData)) { //정상응답
                continue;
            }

            if ($jsonData['STATUS_CODE'] != 'Success') {
                continue;
            }

            foreach ($jsonData['INVOICE_LIST'] as $row) {
                $salesforce_sync->insertOrUpdateInvoice($user['salesforce_id'], $row);
                //print_r($row);
            }
        }
    }

    if ($cmd == "payment") {

        //invoice
        foreach ($users as $user) {
            $response = $salesforce_sync->get_payment($user['salesforce_id']);
            $jsonData = json_decode($response, true);

            if (!is_array($jsonData)) { //정상응답
                continue;
            }

            if ($jsonData['STATUS_CODE'] != 'Success') {
                continue;
            }

            foreach ($jsonData['PAYMENT_LIST'] as $row) {
                //print_r($row);
                $salesforce_sync->insertOrUpdatePayment($user['salesforce_id'], $row);
            }
        }
    }


    if ($cmd == "prescription") { //처방정보
        //todo 계약 정보가 유효한 건만 조회하여 호출하도록 한다.
        $contracts = $db->query("select * from SF_CONTRACT ");

        foreach ($contracts as $contract) {
            $response = $salesforce_sync->get_prescription($contract['ID']);
            $jsonData = json_decode($response, true);

            if (!is_array($jsonData)) { //정상응답
                continue;
            }

            if ($jsonData['STATUS_CODE'] != 'Success') {
                continue;
            }

            foreach ($jsonData['PRESCRIPTION_LIST'] as $row) {
                $row['PRESCRIPTION_VALUE'] = $row['VALUE']; //파라메타명 보정
                unset($row['VALUE']);
                //fprint_r($row);
                $salesforce_sync->insertOrUpdatePrescription($contract['ID'], $row);
                //print_r($row);
            }
        }
    }

    if($cmd == "delete_report") {
        $seq = filter_input(INPUT_POST, 'seq', FILTER_VALIDATE_INT);
        $download_dir = G5_DATA_PATH. "/downloads";

        $report = sql_fetch("select * from patient_report_history where seq='{$seq}' ");

        if(!$report) {
            throw new Exception("삭제할 순응도 보고서 정보가 없습니다.", 404);
        }

        $pdf_file_pathname = $download_dir."/".$row['pdf_filename'];

        if(file_exists($pdf_file_pathname) && is_file($pdf_file_pathname)) {
            @unlink($pdf_file_pathname);
        }

        $sql = "delete from patient_report_history where seq = '{$report['seq']}' ";
        sql_query($sql);

    }

    if($cmd == "crawling_airview") {

        $ID = filter_input(INPUT_POST, 'ID', FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/[A-Za-z0-9_]/')));
        $from_date = filter_input(INPUT_POST, 'from_date');
        $to_date = filter_input(INPUT_POST, 'to_date');

        if(!$from_date || !$to_date) {
            throw new Exception("사용량을 조회할 날짜 범위를 선택하세요.", 400);
        }
        $prescription = sql_fetch("select * from SF_PRESCRIPTION where ID = '{$ID}' ");
        if (!$prescription) {
            throw new Exception("선택된 처방 정보가 없습니다.", 404);
        }

        $patient = sql_fetch("select * from patients where salesforce_id = '{$prescription['PATIENT_ID']}' LIMIT 1");

        if (!$patient) {
            throw new Exception("airview 수면 데이타 사용자가 없습니다.", 404);
        }

        if(!isset($download_dir)) {
            $download_dir = G5_DATA_PATH. "/downloads";
        }
        $jar_pathname = G5_PATH."/lib/pdf_data_extrator-1.0-SNAPSHOT-all.jar";

        $cookie_file = G5_DATA_PATH . "/medi_cookie.txt";

        $options = [
            'cookie_file' => $cookie_file,
        ];

        $sync = new MediSync($pdo_db, $options);
        $sync->getJSESSIONID();
        $sync->login();


        $filename = sprintf("Compliance_report_%s_%s.pdf", date("mdY"), date("His"));

        $download_file = "";
        $options = [
            'from_date' => $from_date,
            'to_date' => $to_date,
        ];
        $is_download = $sync->downloadComplianceReport($patient['easy_care_number'], $download_dir, $filename, 30, $options);
        if($is_download) {
            $insert_id = $sync->insertComplianceReport($patient['id'], $patient['easy_care_number'], $filename, 30, $prescription['ID'], 'ADMIN');
            $json_result['message'] = "{$filename} 파일다운로드 OK";

            $row = sql_fetch("select * from patient_report_history where seq = '{$insert_id}' ");

            $pdf_text = "";

            //$cmd = "ls -al ";
            $pdf_file_pathname = $download_dir."/".$row['pdf_filename'];
            //$cmd = "java -jar pdf_data_extrator-1.0-SNAPSHOT-all.jar downloads/Compliance_report_07122022_163357.pdf";

            $cmd = sprintf("java -jar -Dfile.encoding=UTF-8 %s %s",$jar_pathname, $pdf_file_pathname);

            $output = "";
            $json_result["cmd"] = $cmd;
            exec($cmd, $output, $ret_code);
            $json_result["ret_code"] =  $ret_code;
            //print_r($output);
            $ret_message = "";
            $pdf_text = "";

            if($ret_code == 0) { //정상 실행된 경우
                $ret_message = "정상 실행됨";
                for($i = 0; $i < count($output); $i++) {
                    $pdf_text .= $sync->onlyHanAlpha($output[$i])."\n";
                }

                //$pdf_text = mb_convert_encoding($pdf_text, 'UTF-8', 'ISO-8859-1');
                //$pdf_text = iconv('euc-kr', 'utf-8//IGNORE',$pdf_text);
                //$pdf_text = mb_convert_encoding($pdf_text, 'ISO-8859-1', 'UTF-8');
            } else {
                $ret_message = "정상 실행되지 않음 - ".implode("\n", $output);
                $json_result["ret_message"] = $ret_message;
            }

            $sync->updatePatientReportParsingResult($row['seq'], $pdf_text, $ret_code, $ret_message);

            if($ret_code != 0) {
                throw new Exception($json_result['memssage']."\n수면 데이타가 파싱이 정상적으로 수행되지 않았습니다.\n수면 데이타를 확인하세요.", 500);
            }

            $pdf_values = MediUtil::extractComplianceValues($pdf_text);

            $json_result['memssage']."\n수면 데이타 파싱 OK ";

            try {

                $low_mid_high_time = MediUtil::getStatusByUseTime($pdf_values['total_avg_used_minute'], "low_mid_high");

                $salesforce_sync->set_usage_data(
                    $prescription['PATIENT_ID'],
                    date("Y-m-d"),
                    $from_date,
                    $to_date,
                    $low_mid_high_time,
                    $pdf_values['ahi_median'],
                    $pdf_values['total_avg_used_minute']
                );

            } catch(Exception $ex) {

            }

        } else {
            throw new Exception("수면 보고서 pdf 파일 다운로드 오류!! ", 500);
        }
    }

    if($cmd == "sync_airview") {
        $mb_id = filter_input(INPUT_POST, 'mb_id');
        $salesforce_id = filter_input(INPUT_POST, 'salesforce_id');

        if(!$salesforce_id) {
            throw new Exception("ResMed 에 등록된 세일즈포스 환자 아이디를 입력하세요.", 400);
        }
        $mb = sql_fetch("select * from g5_member where salesforce_id = '{$salesforce_id}' ");
        if (!$mb) {
            throw new Exception("회원정보에 세일즈포스 환자 아이디를 입력하세요..", 404);
        }

        $patient = sql_fetch("select * from patients where salesforce_id = '$salesforce_id' LIMIT 1");

        $cookie_file = G5_DATA_PATH . "/medi_cookie.txt";

        $options = [
            'cookie_file' => $cookie_file,
        ];

        $sync = new MediSync($pdo_db, $options);
        $sync->getJSESSIONID();
        $sync->login();

        $count = $sync->getPatient($salesforce_id);

        if($count) {
            $patient = sql_fetch("select id, easy_care_number, username from patients where salesforce_id = '{$salesforce_id}' LIMIT 1");
            $json_result['patient'] = $patient;

        } else {
            throw new Exception("ResMed 에 해당 환자 정보가 없습니다. ", 500);
        }
    }

    if($cmd == "disconenct_airview") {
        $mb_id = filter_input(INPUT_POST, 'mb_id');
        $salesforce_id = filter_input(INPUT_POST, 'salesforce_id');

        if(!$salesforce_id) {
            throw new Exception("ResMed 에 등록된 세일즈포스 환자 아이디를 입력하세요.", 400);
        }
        $mb = sql_fetch("select * from g5_member where salesforce_id = '{$salesforce_id}' ");
        if (!$mb) {
            throw new Exception("회원정보에 세일즈포스 환자 아이디를 입력하세요..", 404);
        }

        $patient = sql_fetch("select * from patients where salesforce_id = '$salesforce_id' LIMIT 1");
        
        if(!$patient) {
            throw new Exception("연동된 ResMed 정보가 없습니다.", 404);
        }

        sql_query("delete from patients where salesforce_id = '{$salesforce_id}' ");

    }


    if($cmd == "update_schedule") {
        //처방 아이디
        $ID = filter_input(INPUT_POST, 'ID', FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/[A-Za-z0-9_]/')));
        $schedule_date = filter_input(INPUT_POST, 'schedule_date');
        $schedule_hour = filter_input(INPUT_POST, 'schedule_hour');
        $schedule_minute = filter_input(INPUT_POST, 'schedule_minute');

        $prescription = sql_fetch("select * from SF_PRESCRIPTION where  ID = '{$ID}' ");

        if (!$prescription) {
            throw new Exception("선택된 처방 정보가 없습니다.", 404);
        }

        $next_doctor_datetime = $schdule_date = "";

        $next_doctor_datetime = sprintf("%s %02d:%02d:00", $schedule_date, $schedule_hour, $schedule_minute);
        $next_doctor_datetime = date("Y-m-d H:i:s", strtotime($next_doctor_datetime));

        $sql = "UPDATE SF_PRESCRIPTION 
                            SET
                       next_doctor_datetime = '{$next_doctor_datetime}',
                       update_datetime = now()
                WHERE ID = '{$ID}'
             ";
        sql_query($sql);

        $dt = new DateTime($next_doctor_datetime, new DateTimeZone('Asia/Seoul'));
        $dt->setTimezone(new DateTimeZone('UTC'));
        $utc_time_tz =  $dt->format('Y-m-d\TH:i:s').".000Z";
        //2022-11-20T07:47:00.000Z         (-9시간 하여 전송요청) //timezone으로 처리
        $res = $salesforce_sync->set_prescription_schedule($ID, $utc_time_tz );
    }
} catch (Exception $e) {

    if($e->getCode() >= 200  && $e->getCode() <= 500) {
        $json_result['code'] = $e->getCode();
        $json_result['message'] = $e->getMessage();
    } else {
        $json_result['code'] =  500;
        $json_result['message'] = $e->getMessage();
    }

}

echo json_encode($json_result, JSON_UNESCAPED_UNICODE);
