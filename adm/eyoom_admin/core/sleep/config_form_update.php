<?php
/**
 * @file    /adm/eyoom_admin/core/sleep/config_form_update.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "600020";

check_demo();

auth_check_menu($auth, $sub_menu, 'w');

if ($is_admin != 'super') {
    alert('최고관리자만 접근 가능합니다.');
}

$posts = array();

$mb = get_member($cf_admin);


check_admin_token();


$check_keys = array(
    'resmed_username' => 'char',
    'resmed_password' => 'char',
);

foreach ($check_keys as $k => $v) {
    if ($v === 'int') {
        $posts[$key] = $_POST[$k] = isset($_POST[$k]) ? (int) $_POST[$k] : 0;
    } else {
        if (in_array($k, array('cf_analytics', 'cf_add_meta', 'cf_add_script', 'cf_stipulation', 'cf_privacy'))) {
            $posts[$key] = $_POST[$k] = isset($_POST[$k]) ? $_POST[$k] : '';
        } else {
            $posts[$key] = $_POST[$k] = isset($_POST[$k]) ? strip_tags(clean_xss_attributes($_POST[$k])) : '';
        }
    }
}

$sql = " update sleep_config
            set resmed_username = '{$_POST['resmed_username']}',
                resmed_password = '{$_POST['resmed_password']}',
                update_datetime = now()
         WHERE 1=1 LIMIT 1";
sql_query($sql);


alert('설정정보를 정상적으로 적용하였습니다.', G5_ADMIN_URL . '/?dir=sleep&amp;pid=config_form', false);