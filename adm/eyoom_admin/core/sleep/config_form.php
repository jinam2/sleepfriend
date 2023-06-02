<?php
/**
 * @file    /adm/eyoom_admin/sleep/config/config_form.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "600020";

/**
 * 폼 action URL
 */
$action_url1 = G5_ADMIN_URL . "/?dir=sleep&pid=config_form_update&smode=1";

auth_check_menu($auth, $sub_menu, 'r');

if ($is_admin != 'super') {
    alert('최고관리자만 접근 가능합니다.');
}


$sleep_config = sql_fetch("select * from sleep_config limit 1");

/**
 * 탭메뉴
 */
$pg_anchor = array(
    'anc_cf_basic' => 'AirView',
);

/**
 * 이윰 관리자모드 테마
 */
$cf_eyoom_admin_theme = get_skin_dir('theme', EYOOM_ADMIN_PATH);

/**
 * 위지윅 에디터
 */
$cf_editor  = get_skin_dir('', G5_EDITOR_PATH);



/**
 * 버튼
 */
$frm_submit_fixed = ' <input type="submit" value="확인" class="admin-fixed-submit-btn btn-e btn-e-red" accesskey="s">' ;

$frm_submit  = ' <div class="text-center margin-top-30 margin-bottom-30"> ';
$frm_submit .= ' <input type="submit" value="확인" class="btn-e btn-e-lg btn-e-red" accesskey="s">' ;
$frm_submit .= ' <a href="' . G5_URL . '" class="btn-e btn-e-lg btn-e-dark">메인으로</a> ';
$frm_submit .= '</div>';