<?php
/**
 * @file    /adm/eyoom_admin/core/sleep/rental_form_update.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "600100";

if ($is_admin != 'super') {
    alert('최고관리자만 접근 가능합니다.');
}

auth_check_menu($auth, $sub_menu, 'w');

$posts = array();
$check_keys = [
    'od_status',
    'store_name',
];

foreach ($check_keys as $key) {
    $posts[$key] = isset($_POST[$key]) ? clean_xss_tags($_POST[$key], 1, 1) : '';
}

 $sql = "update g5_shop_rental
                set 
                od_status = '{$posts['od_status']}'
            where od_id = '{$od_id}'
    ";

 sql_query($sql);


$qstr .= $wmode ? '&amp;wmode=1': '';


goto_url(G5_ADMIN_URL . '/?dir=sleep&amp;pid=rental_form&amp;'.$qstr.'&amp;w=u&amp;od_id='.$od_id, false);