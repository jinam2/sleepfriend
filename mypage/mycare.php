<?php
define('_EYOOM_MYPAGE_',true);

$g5['title'] = '활동기록';
$mpid = 'activity';

include_once('./_common.php');

if (!$is_member) alert('회원만 접근하실 수 있습니다.');

include_once('../_head.php');
include_once($mypage_skin_path.'/mycare.php');
include_once('../_tail.php');