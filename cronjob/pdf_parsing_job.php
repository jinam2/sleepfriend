<?php


define('_GNUBOARD_', true);

error_reporting( E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_ERROR | E_WARNING | E_PARSE | E_USER_ERROR | E_USER_WARNING );
ini_set('display_errors', '1');

include_once dirname(__DIR__) . "/custom_db_config.php";
include_once dirname(__DIR__) . "/lib/SimpleDB.php";
include_once dirname(__DIR__) . "/lib/MediSync.php";


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

$sync = new MediSync($pdo_db, $options);

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
}
