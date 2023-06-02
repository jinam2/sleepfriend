<?php
/**
 * @file    /adm/eyoom_admin/core/sleep/userprescriptionlist.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

require_once G5_LIB_PATH . "/MediUtil.php";

$sub_menu = "600900";


$action_url1 = G5_ADMIN_URL . '/?dir=sleep&amp;pid=userprescriptionlist_update&amp;smode=1';


auth_check_menu($auth, $sub_menu, "r");

$where = array();

$doc = isset($_GET['doc']) ? clean_xss_tags($_GET['doc'], 1, 1) : '';
$sort1 = (isset($_GET['sort1']) && in_array($_GET['sort1'], array('id', 'id', 'id', 'id', 'id', 'id'))) ? $_GET['sort1'] : '';
$sort2 = (isset($_GET['sort2']) && in_array($_GET['sort2'], array('desc', 'asc'))) ? $_GET['sort2'] : 'desc';
$sel_field = (isset($_GET['sel_field']) && in_array($_GET['sel_field'], array('mb_name', 'mb_id','mb_hp', 'ID', 'patient_id')) ) ? $_GET['sel_field'] : '';
$od_status = isset($_GET['od_status']) ? get_search_string($_GET['od_status']) : '';
$search = isset($_GET['search']) ? get_search_string($_GET['search']) : '';


$fr_date = (isset($_GET['fr_date']) && preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $_GET['fr_date'])) ? $_GET['fr_date'] : '';
$to_date = (isset($_GET['to_date']) && preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $_GET['to_date'])) ? $_GET['to_date'] : '';

$sql_search = "";

if ($sel_field != "") {
    // 상품명 검색
    if ($sel_field == 'mb_name') {
        $where[] = " T2.PATIENT_ID IN(select salesforce_id from g5_member where mb_name like '%{$search}%') ";
    } else if ($sel_field == 'mb_hp') {
        $where[] = " T2.PATIENT_ID IN(select salesforce_id from g5_member where mb_hp like '%{$search}%') ";

    } else {
        $where[] = " T1.{$sel_field} like '%$search%' ";
    }

    if ($save_search != $search) {
        $page = 1;
    }
}


if ($fr_date && $to_date) {
    $where[] = " (T1.START_DATE between '$fr_date' and '$to_date' OR T1.EXPIRE_DATE between '$fr_date' and '$to_date') ";
}

if ($where) {
    $sql_search = ' where '.implode(' and ', $where);
}

if ($sel_field == "")  $sel_field = "id";
if ($sort1 == "") $sort1 = "id";
if ($sort2 == "") $sort2 = "desc";

$sql_common = " from sf_prescription_files T1 INNER JOIN SF_CONTRACT T2 ON (T1.contract_id = T2.ID) $sql_search ";

$sql = " select count(*) as cnt " . $sql_common;
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql  = " select T1.*, T2.PATIENT_ID
           $sql_common
           order by $sort1 $sort2
           limit $from_record, $rows ";

$result = sql_query($sql);


$qstr1 = "fr_date=$fr_date&amp;to_date=$to_date&amp;sel_field=$sel_field&amp;search=$search&amp;save_search=$search";

$qstr = "$qstr1&amp;sort1=$sort1&amp;sort2=$sort2&amp;page=$page";

$k=0;
$list = array();
for ($i=0; $row=sql_fetch_array($result); $i++)
{
    $mem = sql_fetch(" select * from {$g5['member_table']} where salesforce_id = '{$row['PATIENT_ID']}' ");

    $row['mb_name'] = $mem['mb_name'];
    $row['mb_id'] = $mem['mb_id'];

    $file = G5_DATA_PATH.$row['bf_file'];
    $file_url = G5_DATA_URL.$row['bf_file'];
    if(is_file($file)) {
        $row['file_link'] = "<a href='{$file_url}'>보기</a>";
    } else {
        $row['file_link'] = "";
    }

    $bg = 'bg'.($i%2);
    $td_color = 0;

    $list[$i] = $row;

}

sql_free_result($result);


$dlcomp = explode(")", str_replace("(", "", G5_DELIVERY_COMPANY));
$delivery_comp = array();
for ($i=0; $i<count($dlcomp); $i++) {
    if (trim($dlcomp[$i])=="") continue;
    list($value, $url, $tel) = explode("^", $dlcomp[$i]);
    $delivery_comp[$i] = $value;
}

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