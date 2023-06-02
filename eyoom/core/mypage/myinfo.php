<?php
/**
 * core file : /eyoom/core/mypage/contract.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 회원체크
 */
if (!$is_member) alert('회원만 접근하실 수 있습니다.',G5_URL);



$contract = sql_fetch("select * from SF_CONTRACT where PATIENT_ID = '{$member['salesforce_id']}' order by REAL_START_DATE DESC LIMIT 1 ");

if($contract) {
    $rental_period = $contract['REAL_START_DATE']." ~ ".$contract['REAL_EXPIRE_DATE'];
}

$it_id_list = [];

//$sql = "select t2.it_id, od_time  from g5_shop_order t1 left join g5_shop_item t2 on(t1.od_id = t2.od_id)  where t1.mb_id='{$member['mb_id']}' ";
//
//$rows = sql_fetch_all($sql);
//foreach($rows as $row) {
//    $it_id_list[$row['it_id']] = $it_id_list[$row['it_id']] ?  $it_id_list[$row['it_id']] : strtotime($row['od_time']);
//}

$sql = "select od_it_id it_id, od_datetime from g5_shop_rental  where mb_id='{$member['mb_id']}'";
$rows = sql_fetch_all($sql);
foreach($rows as $row) {
    $it_id_list[$row['it_id']] = $it_id_list[$row['it_id']] ?  $it_id_list[$row['it_id']] : strtotime($row['od_datetime']);
}


arsort($it_id_list); //주문시간을 기준으로 최근순으로 정렬


$list = [];

foreach($it_id_list as $it_id => $od_time) {

    if(count($list) >= 7) break;
    $row = sql_fetch("select it_id, it_name from g5_shop_item where it_id = {$it_id}");
    $thumb = get_it_image($it_id, 132, 132);
    $list[] = ['it_id' => $row['it_id'], 'it_name' => $row['it_name'], 'thumb' => $thumb];
}


/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/mypage/myinfo.php');

/**
 * HTML 출력
 */
include_once($eyoom_skin_path['mypage'].'/myinfo.skin.html.php');