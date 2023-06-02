<?php
/**
 * core file : /eyoom/core/mypage/contract.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 회원체크
 */
if (!$is_member) alert('회원만 접근하실 수 있습니다.',G5_URL);



/**
 * 활동기록 정보
 */
$page = (int)$_GET['page'];
if (!$page) $page = 1;
if (!$page_rows) $page_rows = 20;
$from_record = ($page - 1) * $page_rows; // 시작 열을 구함

$sql_common = " from `{$g5['g5_shop_item_use_table']}` a join `{$g5['g5_shop_item_table']}` b on (a.it_id=b.it_id) ";
$sql_search = " where a.mb_id='{$member['mb_id']}' and a.is_confirm = '1' ";


if (!$sst) {
    $sst  = "a.is_id";
    $sod = "desc";
}
$sql_order = " order by $sst $sod ";

$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
$result = sql_query($sql);

$list = [];
while($row = sql_fetch_array($result)) {
    $row['item_url'] = G5_SHOP_URL."/item.php?it_id=".$row['it_id'];
    $row['subject'] = conv_content($row['is_subject'], 0);
    $row['content'] = conv_content($row['is_content'], 0);
    $list[] = $row;
}


/**
 * 페이징
 */
$paging = $eb->set_paging('/mypage/review', '', $qstr);



/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/mypage/review.php');

/**
 * HTML 출력
 */
include_once($eyoom_skin_path['mypage'].'/review.skin.html.php');