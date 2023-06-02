<?php
define('_MYINDEX_',true);
define('_EYOOM_MYPAGE_',true);

$g5['title'] = '마이페이지';
$mpid = 'mypage';

include_once('./_common.php');

if (!$is_member) alert('회원만 접근하실 수 있습니다.', G5_URL."/bbs/login.php");

header("Location: ./contract.php");
exit;
include_once('../_head.php');
include_once($mypage_skin_path.'/mypage.php');
include_once('../_tail.php');