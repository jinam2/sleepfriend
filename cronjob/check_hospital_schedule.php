<?php

ini_set('memory_limit','256M');

$cmd = $argv && count($argv) > 1 ? $argv[1] : "";


echo "cmd : {$cmd} \n";

$document_dir = dirname(__DIR__);
chdir($document_dir);

define('_GNUBOARD_', true);

error_reporting( E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_ERROR | E_WARNING | E_PARSE | E_USER_ERROR | E_USER_WARNING );
ini_set('display_errors', '1');

include_once dirname(__DIR__) . "/custom_db_config.php";
include_once dirname(__DIR__) . "/lib/SimpleDB.php";
include_once dirname(__DIR__) . "/lib/OneSignalPush.php";

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


$before = 1;
$to = date("Y-m-d", strtotime("+1 day", time()));
$today = date("Y-m-d");

$push = new OneSignalPush();

//내일 예약이 있는 사용자 조회
$sql = "select PATIENT_ID, next_doctor_datetime from SF_PRESCRIPTION where date(next_doctor_datetime) = '{$to}'";

$rows = $db->query($sql);

foreach($rows as $row) {
    $mb = $db->row("select mb_id, mb_hp from g5_member where salesforce_id = '{$row['PATIENT_ID']}' ");

    if(!$mb) {
        continue;
    }

    // 병원 예약 하루전 알림 메세지
    $push = new OneSignalPush();
    $push_message = "등록하신 병원예약일 하루 전입니다.";
    $target_url = "https://sleepfriend.co.kr/mypage/schedule.php";
    $push->sendGoodsRentalNotification($mb['mb_id'], $push_message, $target_url);

}

