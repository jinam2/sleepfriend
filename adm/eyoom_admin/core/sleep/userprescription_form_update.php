<?php
/**
 * @file    /adm/eyoom_admin/core/place/userprescription_form_update.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "600900";


if ($is_admin != 'super') {
    alert('최고관리자만 접근 가능합니다.');
}

auth_check_menu($auth, $sub_menu, 'w');

$posts = array();

foreach($check_keys as $key){
    $posts[$key] = (isset($_POST[$key]) && isset($_POST[$key][$i])) ? $_POST[$key][$i] : '';
}

$sql = "
        update sf_prescription_files
            set 
            bf_status = '{$_POST['bf_status']}'
        where fid = '{$fid}'
";

sql_query($sql);

$qstr .= $wmode ? '&amp;wmode=1': '';

goto_url(G5_ADMIN_URL . '/?dir=sleep&amp;pid=userprescription_form&amp;'.$qstr.'&amp;w=u&amp;fid='.$fid, false);