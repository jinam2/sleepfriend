<?php
/**
 * core file : /eyoom/core/mypage/schedule_write.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 회원체크
 */
if (!$is_member) alert('회원만 접근하실 수 있습니다.',G5_URL);

include_once(G5_PLUGIN_PATH.'/jquery-ui/datepicker.php');

/**
 * 활동기록 정보
 */

$today = date("Y-m-d");
$sql = "select P.*, C.REAL_START_DATE, C.REAL_EXPIRE_DATE,
          C.PRODUCT_FAMILY, C.TYPE_OF_INSURANCE, C.DEVICE_MODEL_NAME
        from SF_PRESCRIPTION P
            inner join SF_CONTRACT C on(P.CONTRACT_ID = C.ID)
        where P.PATIENT_ID = '{$member['salesforce_id']}'        
          and C.REAL_EXPIRE_DATE >= '{$today}'
        order by C.REAL_EXPIRE_DATE DESC 
        limit 1 
";

$result = sql_query($sql);
$contract_list = [];

while($row = sql_fetch_array($result)) {
    $contract_list["{$row['ID']}"] = $row;
}

$ID  = filter_input(INPUT_GET, 'ID', FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/[A-Za-z0-9_]/')));

if(!$ID && count($contract_list) > 0) {
    $ID = key($contract_list);
}


if($ID) {
    $sql = "select P.*, C.PRODUCT_FAMILY, C.TYPE_OF_INSURANCE, C.DEVICE_MODEL_NAME
        from SF_PRESCRIPTION P
            inner join SF_CONTRACT C on(P.CONTRACT_ID = C.ID)
        where P.PATIENT_ID = '{$member['salesforce_id']}'
          and P.ID = '{$ID}'    ";

    $schedule = sql_fetch($sql);

    $schedule['schedule_date'] = $schedule['next_doctor_datetime'] ? substr($schedule['next_doctor_datetime'], 0, 10) : "";
    $schedule['schedule_time'] = $schedule['next_doctor_datetime'] ? date("H:i A", strtotime($schedule['next_doctor_datetime'])) : "";
    $schedule['schedule_time']  = str_replace(['AM', 'PM'], ['오전', '오후'], $schedule['schedule_time'] );
}

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/mypage/schedule_write.php');

/**
 * HTML 출력
 */
include_once($eyoom_skin_path['mypage'].'/schedule_write.skin.html.php');