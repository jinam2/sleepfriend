<?php
/**
 * core file : /eyoom/core/mypage/contract.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 회원체크
 */
if (!$is_member) alert('회원만 접근하실 수 있습니다.',G5_URL);

ini_set('display_errors', 1);
$qaconfig = get_qa_config();
$content = '';

$token = _token();
set_session('ss_qa_delete_token', $token);
set_session('ss_qa_write_token', $token);

$iq_id = isset($_REQUEST['iq_id']) ? (int) $_REQUEST['iq_id'] : 0;


$sql = " select * from {$g5['g5_shop_item_qa_table']} where iq_id = '$iq_id' ";
if(!$is_admin) {
    $sql .= " and mb_id = '{$member['mb_id']}' ";
}

$view = sql_fetch($sql);
if (!$view) {
    alert("상품 문의글이 없습니다.");
}
$view['subject'] = conv_subject($view['iq_subject'], 100, '…');
$view['content'] = conv_content($view['iq_question'], 0);
$view['answer'] = conv_content($view['iq_answer'], 0);
$view['name'] = get_text($view['iq_name']);
$view['datetime'] = $view['iq_time'];
$view['email'] = get_text(get_email_address($view['iq_email']));
$view['hp'] = $view['iq_hp'];


$update_href = '';
$delete_href = '';
$write_href = G5_URL.'/mypage/inquiry_write.php';
if(!trim($view['iq_answer'])) { //답변이 없는 경우, 수정/삭제 가능
    $hash = md5($view['iq_id'].$view['iq_time'].$view['iq_ip']);

    $update_href = G5_URL.'/mypage/inquiry_write.php?w=u&amp;iq_id='.$view['iq_id'];
    $delete_href = G5_SHOP_URL.'/itemqaformupdate.php?w=d&amp;iq_id='.$view['iq_id']."&amp;hash=".$hash;
}
$list_href = G5_URL.'/mypage/inquiry.php'.preg_replace('/^&amp;/', '?', $qstr);

@include_once(EYOOM_USER_PATH.'/mypage/inquiry_view.php');

/**
 * HTML 출력
 */
include_once($eyoom_skin_path['mypage'].'/inquiry_view.skin.html.php');