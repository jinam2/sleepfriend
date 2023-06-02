<?php
define('_EYOOM_MYPAGE_',true);

$g5['title'] = '계약정보';
$mpid = 'activity';

include_once('./_common.php');
include_once(G5_EDITOR_LIB);

$qaconfig = get_qa_config();

if (!$is_member) alert('회원만 접근하실 수 있습니다.');

include_once('../_head.php');
include_once($mypage_skin_path.'/reservation_write.php');
include_once('../_tail.php');