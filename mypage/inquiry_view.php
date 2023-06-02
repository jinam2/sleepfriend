<?php
define('_EYOOM_MYPAGE_',true);

$g5['title'] = '계약정보';
$mpid = 'activity';

include_once('./_common.php');
include_once(G5_EDITOR_LIB);


if (!$is_member) alert('회원만 접근하실 수 있습니다.', G5_URL);

$qaconfig = get_qa_config();


include_once('../_head.php');
include_once($mypage_skin_path.'/inquiry_view.php');
include_once('../_tail.php');