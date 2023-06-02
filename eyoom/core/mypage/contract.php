<?php
/**
 * core file : /eyoom/core/mypage/contract.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 회원체크 ;   jinam23 - 230524, url 하드코딩 처리
 */
if (!$is_member) alert('회원만 접근하실 수 있습니다.','https://www.sleepfriend.co.kr/');

$rental_list = [];
//렌탈 신청 정보
$sql = "select R.*, I.it_name, I.it_brand, I.ca_id
         from g5_shop_rental R inner join g5_shop_item I on(R.od_it_id = I.it_id)
         where R.mb_id = '{$member['mb_id']}' 
         and R.od_status in('접수', '신청','해피콜', '대기') order by R.od_datetime desc ";

$result = sql_query($sql);

while($row = sql_fetch_array($result)) {
    $cate = sql_fetch("select * from g5_shop_category where ca_id = '{$row['ca_id']}' ");
    $row['product_family'] = $cate['ca_name'];
    $rental_list[] = $row;
}

/**
 * 세일즈포스 계약 정보
 */
$page = (int)$_GET['page'];
if (!$page) $page = 1;
if (!$page_rows) $page_rows = 20;
$from_record = ($page - 1) * $page_rows; // 시작 열을 구함

$sql = "select * from SF_CONTRACT where PATIENT = '{$member['salesforce_id']}' order by create_datetime desc";
$res = sql_query($sql, false);
$list = array();

$css_class_names = [
    "해피콜 예정" => "status01",
    "보험렌탈" => "status02",
    "렌탈종료" => "status03",
    "렌탈연장" => "status04",
    "비보험렌탈" => "status05",
];
while($row = sql_fetch_array($res)) {

    $row['css_class'] = "";
    $row['type_name'] = "";
    $today_end_time = strtotime(date("Y-m-d")."23:59:59");
    if(strtotime($row['REAL_EXPIRE_DATE']) < $today_end_time ) {
        $row['type_name'] = "렌탈종료";
    } else if($row['TYPE_OF_INSURANCE'] == "비보험-렌탈") {
        $row['type_name'] = "비보험렌탈";
    } else if(strtotime($row['REAL_EXPIRE_DATE']) + 86400 * 3 < $today_end_time ) {
        //todo 렌탈 연장으로 표시하는 조건 확인 필요
        $row['type_name'] = "렌탈연장";
    } else {
        $row['type_name'] = "보험렌탈";
    }

    $row['css_class'] = $css_class_names[$row['type_name']];

    $list[] = $row;
}
$count = count($list);


//청구 정보
$before_7day = date("Y-m-d", strtotime("-7 day", time()));
$today = date("Y-m-d");
$year_mon = date("Y")."년 ".date("m")."월";
//  jinam23 edited ORDER BY 
$sql = "SELECT ifnull(sum(PATIENT_PAYABLE), 0) PATIENT_PAYABLE FROM SF_INVOICE WHERE PATIENT_ID = '{$member['salesforce_id']}' AND '{$today}' BETWEEN START_DATE and END_DATE ORDER BY update_datetime DESC";
$invoice = sql_fetch($sql);

$invoice_link = G5_URL."/mypage/invoice.php?fr_date={$before_7day}&to_date={$today}&period=30";

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/mypage/contract.php');

/**
 * HTML 출력
 */
include_once($eyoom_skin_path['mypage'].'/contract.skin.html.php');