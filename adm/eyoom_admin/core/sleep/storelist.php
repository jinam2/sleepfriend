<?php
/**
 * @file    /adm/eyoom_admin/core/sleep/storelist.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;


$sub_menu = "600900";

$action_url1 = G5_ADMIN_URL . '/?dir=sleep&amp;pid=storelist_update&amp;smode=1';


auth_check_menu($auth, $sub_menu, "r");

$where = array();

$doc = isset($_GET['doc']) ? clean_xss_tags($_GET['doc'], 1, 1) : '';
$sort1 = (isset($_GET['sort1']) && in_array($_GET['sort1'], array('id', 'id', 'id', 'id', 'id', 'id'))) ? $_GET['sort1'] : '';
$sort2 = (isset($_GET['sort2']) && in_array($_GET['sort2'], array('desc', 'asc'))) ? $_GET['sort2'] : 'desc';
$sel_field = (isset($_GET['sel_field']) && in_array($_GET['sel_field'], array('mb_name', 'mb_id','mb_hp', 'ID', 'patient_id')) ) ? $_GET['sel_field'] : '';
$search = isset($_GET['search']) ? get_search_string($_GET['search']) : '';


$sql_search = "";
$where[]  = "category='store' ";
if ($sel_field != "") {
    // 상품명 검색
    if ($sel_field == 'store_name') {
        $where[] = " T1.store_name like  '%{$search}%' ";
    }
    if ($save_search != $search) {
        $page = 1;
    }
}

if ($where) {
    $sql_search = ' where '.implode(' and ', $where);
}

if ($sel_field == "")  $sel_field = "seq";
if ($sort1 == "") $sort1 = "seq";
if ($sort2 == "") $sort2 = "desc";

$sql_common = " from sleep_place T1 $sql_search ";

$sql = " select count(*) as cnt " . $sql_common;
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql  = " select *
           $sql_common
           order by $sort1 $sort2
           limit $from_record, $rows ";

$result = sql_query($sql);


$qstr = "sort1=$sort1&amp;sort2=$sort2&amp;category=$category&amp;page=$page";

$k=0;
$list = array();
for ($i=0; $row=sql_fetch_array($result); $i++) {

    $bg = 'bg'.($i%2);
    $td_color = 0;
    $list[$i] = $row;
}

sql_free_result($result);

/**
 * 페이징
 */
$paging = $eb->set_paging('admin', $dir, $pid, $qstr);

/**
 * 검색버튼
 */
$frm_submit  = ' <div class="text-center margin-top-10 margin-bottom-10"> ';
$frm_submit .= ' <input type="submit" value="검색" class="btn-e btn-e-lg btn-e-dark" accesskey="s">' ;
$frm_submit .= '</div>';