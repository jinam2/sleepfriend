<?php
/**
 * @file    /adm/eyoom_admin/core/sleep/contractlist.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "600400";

auth_check_menu($auth, $sub_menu, "r");

$where = array();

$doc = isset($_GET['doc']) ? clean_xss_tags($_GET['doc'], 1, 1) : '';
$sort1 = (isset($_GET['sort1']) && in_array($_GET['sort1'], array('ID', 'ID', 'ID', 'ID', 'ID', 'ID'))) ? $_GET['sort1'] : '';
$sort2 = (isset($_GET['sort2']) && in_array($_GET['sort2'], array('desc', 'asc'))) ? $_GET['sort2'] : 'desc';
$sel_field = (isset($_GET['sel_field']) && in_array($_GET['sel_field'], array('mb_name', 'mb_id','mb_hp', 'ID')) ) ? $_GET['sel_field'] : '';
$od_status = isset($_GET['od_status']) ? get_search_string($_GET['od_status']) : '';
$search = isset($_GET['search']) ? get_search_string($_GET['search']) : '';

$type_of_insurance = isset($_GET['type_of_insurance']) ? get_search_string($_GET['type_of_insurance']) : '';

$fr_date = (isset($_GET['fr_date']) && preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $_GET['fr_date'])) ? $_GET['fr_date'] : '';
$to_date = (isset($_GET['to_date']) && preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $_GET['to_date'])) ? $_GET['to_date'] : '';

$sql_search = "";

if ($sel_field != "") {
    // 상품명 검색
    if ($sel_field == 'mb_name') {

        $where[] = " T1.PATIENT IN(select salesforce_id from g5_member where mb_name like '%{$search}%') ";

    } else if ($sel_field == 'mb_hp') {
        $where[] = " T1.PATIENT IN(select salesforce_id from g5_member where mb_hp like '%{$search}%') ";

    } else {
        $where[] = " T1.{$sel_field} like '%$search%' ";
    }

    if ($save_search != $search) {
        $page = 1;
    }
}

if($type_of_insurance) {
    $where[] = " T1.TYPE_OF_INSURANCE = '{$type_of_insurance}' ";
}

if ($fr_date && $to_date) {
    $where[] = " (T1.START_DATE between '$fr_date' and '$to_date' OR T1.EXPIRE_DATE between '$fr_date' and '$to_date') ";
}

if ($where) {
    $sql_search = ' where '.implode(' and ', $where);
}

if ($sel_field == "")  $sel_field = "ID";
if ($sort1 == "") $sort1 = "ID";
if ($sort2 == "") $sort2 = "desc";

$sql_common = " from SF_PAYMENT T1 $sql_search ";

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

$qstr1 = "type_of_insurance=".urlencode($type_of_insurance)."&amp;od_settle_case=".urlencode($od_settle_case)."&amp;od_misu=$od_misu&amp;od_cancel_price=$od_cancel_price&amp;od_refund_price=$od_refund_price&amp;od_receipt_point=$od_receipt_point&amp;od_coupon=$od_coupon&amp;fr_date=$fr_date&amp;to_date=$to_date&amp;sel_field=$sel_field&amp;search=$search&amp;save_search=$search";

$qstr = "$qstr1&amp;sort1=$sort1&amp;sort2=$sort2&amp;page=$page";

$k=0;
$list = array();
for ($i=0; $row=sql_fetch_array($result); $i++)
{
    $mem = sql_fetch(" select * from {$g5['member_table']} where salesforce_id = '{$row['PATIENT_ID']}' ");

    $row['mb_name'] = $mem['mb_name'];
    $row['mb_id'] = $mem['mb_id'];

    $bg = 'bg'.($i%2);
    $td_color = 0;

    $row['BANKCARD_NUMBER'] =  str_pad(substr( $row['BANKCARD_NUMBER'] , -4), strlen( $row['BANKCARD_NUMBER'] ), '*', STR_PAD_LEFT);

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