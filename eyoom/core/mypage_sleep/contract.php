<?php
/**
 * core file : /eyoom/core/mypage_sleep/contract.php
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

print_r2($member);
$sql = "select * from contract";

exit;

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/mypage/contract.php');

/**
 * HTML 출력
 */
include_once($eyoom_skin_path['mypage'].'/contract.skin.html.php');