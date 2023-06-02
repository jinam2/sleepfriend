<?php
/**
 * @file    /adm/eyoom_admin/core/place/storelist_update.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "700200";


check_demo();

$post_count_chk = (isset($_POST['chk']) && is_array($_POST['chk'])) ? count($_POST['chk']) : 0;
$chk            = (isset($_POST['chk']) && is_array($_POST['chk'])) ? $_POST['chk'] : array();
$act_button     = isset($_POST['act_button']) ? strip_tags($_POST['act_button']) : '';
$seq    = (isset($_POST['seq']) && is_array($_POST['seq'])) ? $_POST['seq'] : array();

if (!$post_count_chk) {
    alert($act_button . " 하실 항목을 하나 이상 체크하세요.");
}

check_admin_token();

if ($act_button == "선택삭제") {
    if ($is_admin != 'super') {
        alert('삭제는 최고관리자만 가능합니다.');
    }

    auth_check_menu($auth, $sub_menu, 'd');

    for ($i=0; $i<$post_count_chk; $i++) {
        // 실제 번호를 넘김
        $k = isset($_POST['chk'][$i]) ? (int) $_POST['chk'][$i] : 0;

        // include 전에 $bo_table 값을 반드시 넘겨야 함
        $tmp_seq = isset($_POST['seq'][$k]) ? trim(clean_xss_tags($_POST['seq'][$k], 1, 1)) : '';

        if (preg_match("/^[A-Za-z0-9_]+$/", $tmp_seq)) {
            // 확장필드 정보 삭제
            sql_query("delete from sleep_place where seq = '{$tmp_seq}' ");
        }
    }
    $msg = "선택한 매장을 삭제하였습니다.";
} else if ($act_button == "선택수정") {
    auth_check_menu($auth, $sub_menu, 'w');
    //표시 순서를 변경
    for ($i=0; $i<count((array)$_POST['chk']); $i++) {
        // 실제 번호를 넘김
        $k = isset($_POST['chk'][$i]) ? (int) $_POST['chk'][$i] : 0;

        $order = (isset($_POST['display_order']) && is_array($_POST['display_order'])) ? strip_tags($_POST['display_order'][$k]) : '';

        // include 전에 $bo_table 값을 반드시 넘겨야 함
        $tmp_seq = isset($_POST['seq'][$k]) ? trim(clean_xss_tags($_POST['seq'][$k], 1, 1)) : '';

        if (preg_match("/^[A-Za-z0-9_]+$/", $tmp_seq)) {
            sql_query("update sleep_place set display_order='{$order}' where seq = '{$tmp_seq}' ");
        }
    }
    $msg = "선택한 매장정보를 수정하였습니다.";
}
// query string
$qstr .= $grid ? '&amp;grid='.$grid: '';
$qstr .= $wmode ? '&amp;wmode=1': '';

alert($msg, G5_ADMIN_URL . '/?dir=place&amp;pid=storelist&amp;' . $qstr);