<?php
/**
 * core file : /eyoom/core/mypage/contract.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 회원체크
 */
if (!$is_member) alert('회원만 접근하실 수 있습니다.',G5_URL);


$before_7day = date("Y-m-d", strtotime("-7 day", time()));
$today = date("Y-m-d");

$status_names = [
    "1" => "대기",
    "2" => "접수",
    "3" => "반려",
    "4" => "완료",
    "5" => "발송",
    "6" => "수정",
    "7" => "작성",
];

$css_class_names = [
    "대기" => "status01",
    "접수" => "status02",
    "반려" => "status03",
    "완료" => "status04",
    "발송" => "status01",
    "수정" => "status01",
    "작성" => "status01",
];

$sql_common = " from SF_INVOICE ";

$sql_search = " where PATIENT_ID = '{$member['salesforce_id']}' ";

if ($_GET['status'] && $status_names["{$_GET['status']}"]) {
    $sql_search .= " AND STATUS = '".$status_names["{$_GET['status']}"]."' ";
}

$fr_date = isset($_REQUEST['fr_date']) ? preg_replace('/[^0-9 :\-]/i', '', $_REQUEST['fr_date']) : '';
$to_date = isset($_REQUEST['to_date']) ? preg_replace('/[^0-9 :\-]/i', '', $_REQUEST['to_date']) : '';

if ($fr_date && $to_date) {
    $sql_search .= " and (START_DATE between '$fr_date' and '$to_date' OR END_DATE between '$fr_date' and '$to_date') ";
    $qstr .= "&amp;fr_date={$fr_date}&amp;to_date={$to_date}";
}

$sql = " select count(*) as cnt
            {$sql_common}
            {$sql_search} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

/**
 * 결제 내역
 */
$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$list = [];

$sql = " select *
            {$sql_common}
            {$sql_search}
            order by START_DATE desc
            limit {$from_record}, {$rows} ";

$result = sql_query($sql);

$res = sql_query($sql);
while($row = sql_fetch_array($res)) {
    $row['CONTRACT'] = sql_fetch("select * from SF_CONTRACT where ID='{$row['CONTRACT_ID']}' LIMIT 1 ");
    $list[] = $row;
}

/**
 * 페이징
 */
$paging = $eb->set_paging('/mypage/invoice', '', $qstr);

include_once(G5_PLUGIN_PATH.'/jquery-ui/datepicker.php');
/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/mypage/invoice.php');

/**
 * HTML 출력
 */
include_once($eyoom_skin_path['mypage'].'/invoice.skin.html.php');