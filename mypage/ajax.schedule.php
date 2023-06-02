<?php
include_once('./_common.php');
include_once G5_LIB_PATH.'/OneSignalPush.php';

header("Content-type: application/json; charset=utf-8");



include_once G5_PATH . "/custom_db_config.php";
include_once G5_PATH. "/lib/SimpleDB.php";
include_once G5_PATH . "/lib/SalesForceSync.php";

$db_host = G5_MYSQL_HOST;
$db_user = G5_MYSQL_USER;
$db_password = G5_MYSQL_PASSWORD;
$db_name = G5_MYSQL_DB;

$pdo_db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"));
$pdo_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo_db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);


if(!isset($cookie_file)) {
    $cookie_file = G5_PATH . "/data/medi_cookie.txt";
}

$options = [
    'cookie_file' => $cookie_file,
];

$salesforce_sync = new SalesForceSync($pdo_db);

$json_result = ['code' => 200, 'memssage' => ''];
$action = $_REQUEST['action'];

try {

    switch($action) {

        case "update_schedule" :
            //처방 아이디
            $ID = filter_input(INPUT_POST, 'ID', FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/[A-Za-z0-9_]/')));
            $schedule_date = filter_input(INPUT_POST, 'schedule_date');
            $schedule_hour = filter_input(INPUT_POST, 'schedule_hour');
            $schedule_minute = filter_input(INPUT_POST, 'schedule_minute');

            $prescription = sql_fetch("select * from SF_PRESCRIPTION where PATIENT_ID = '{$member['salesforce_id']}' AND ID = '{$ID}' ");

            if (!$prescription) {
                throw new Exception("선택된 처방 정보가 없습니다.", 404);
            }

            if(date("Ymd") >= date("Ymd", strtotime($schedule_date))) {
                throw new Exception("당일 또는 이전날짜는 예약할수 없습니다.", 400);
            }

            $schedule_memo = filter_input(INPUT_POST, 'schedule_memo');
            $schedule_memo = clean_xss_tags(strip_tags($schedule_memo));

            $next_doctor_datetime = $schdule_date = "";

            $next_doctor_datetime = sprintf("%s %02d:%02d:00", $schedule_date, $schedule_hour, $schedule_minute);
            $next_doctor_datetime = date("Y-m-d H:i:s", strtotime($next_doctor_datetime));

            $sql = "UPDATE SF_PRESCRIPTION 
                        SET
                          next_doctor_datetime = '{$next_doctor_datetime}', 
                        schedule_memo = '{$schedule_memo}',
                        update_datetime = now()

                    WHERE ID = '{$ID}'
             ";

            sql_query($sql);

            $dt = new DateTime($next_doctor_datetime, new DateTimeZone('Asia/Seoul'));
            $dt->setTimezone(new DateTimeZone('UTC'));
            $utc_time_tz =  $dt->format('Y-m-d\TH:i:s').".000Z";
            //2022-11-20T07:47:00.000Z         (-9시간 하여 전송요청) //timezone으로 처리
            $res = $salesforce_sync->set_prescription_schedule($ID, $utc_time_tz );

            // 예약 알림 메세지
            $push = new OneSignalPush();
            $push_message = "병원예약일 등록이 완료되었습니다.";
            $target_url = G5_URL."/mypage/schedule.php";
            $push->sendHospitalReservationNotification($member['mb_id'], $push_message, $target_url);

            break;

        default:
            break;
    }
} catch (Exception $ex) {
    if ($ex->getCode() >= 200 && $ex->getCode() <= 500) {
        $json_result['message'] = $ex->getMessage();
        $json_result['code'] = $ex->getCode();
    } else {
        $json_result['message'] = "server error!!";
        $json_result['code'] = 500;
    }
}

die(json_encode($json_result));
