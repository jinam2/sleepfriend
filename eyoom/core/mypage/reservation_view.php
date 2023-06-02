<?php
/**
 * core file : /eyoom/core/mypage/reservation_view.php
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

$qa_id = isset($_REQUEST['qa_id']) ? (int) $_REQUEST['qa_id'] : 0;


$sql = " select * from {$g5['qa_content_table']} where qa_type = 0 and qa_id = '$qa_id' ";
if(!$is_admin) {
    $sql .= " and mb_id = '{$member['mb_id']}' ";
}

$view = sql_fetch($sql);


if(!(isset($view['qa_id']) && $view['qa_id'])) {
    alert('문의글이 존재하지 않습니다.\\n삭제되었거나 자신의 글이 아닌 경우입니다.');
}

$subject_len = G5_IS_MOBILE ? $qaconfig['qa_mobile_subject_len'] : $qaconfig['qa_subject_len'];

$view['category'] = get_text($view['qa_category']);
$view['group'] = get_text($view['qa_group']);
$view['subject'] = conv_subject($view['qa_subject'], $subject_len, '…');
$view['content'] = conv_content($view['qa_content'], $view['qa_html']);
$view['name'] = get_text($view['qa_name']);
$view['datetime'] = $view['qa_datetime'];
$view['email'] = get_text(get_email_address($view['qa_email']));
$view['hp'] = $view['qa_hp'];


$update_href = '';
$delete_href = '';
$write_href = G5_URL.'/mypage/reservation_write.php';
$rewrite_href = G5_URL.'/mypage/reservation_write.php?w=r&amp;qa_id='.$view['qa_id'];
$list_href = G5_URL.'/mypage/reservation.php'.preg_replace('/^&amp;/', '?', $qstr);

if(($view['qa_type'] && $is_admin) || (!$view['qa_type'] && $view['qa_status'] == 0)) {
    $update_href = G5_URL.'/mypage/reservation_write.php?w=u&amp;qa_id='.$view['qa_id'].$qstr;
    $delete_href = G5_URL.'/mypage/reservation_delete.php?qa_id='.$view['qa_id'].'&amp;token='.$token.$qstr;
}

// 질문글이고 등록된 답변이 있다면
$answer = array();
$answer_update_href = '';
$answer_delete_href = '';
if(!$view['qa_type'] && $view['qa_status']) {
    $sql = " select *
                    from {$g5['qa_content_table']}
                    where qa_type = '1'
                      and qa_parent = '{$view['qa_id']}' ";
    $answer = sql_fetch($sql);

    $answer['subject'] = conv_subject($answer['qa_subject'], $subject_len, '…');
    $answer['content'] = conv_content($answer['qa_content'], $answer['qa_html']);


    if($is_admin) {
        $answer_update_href = G5_URL.'/mypage/reservation_write.php?w=u&amp;qa_id='.$answer['qa_id'].$qstr;
        $answer_delete_href = G5_URL.'/mypage/reservation_delete.php?qa_id='.$answer['qa_id'].'&amp;token='.$token.$qstr;
    }
}

$is_dhtml_editor = false;
// 모바일에서는 DHTML 에디터 사용불가
if ($config['cf_editor'] && $qaconfig['qa_use_editor'] && !G5_IS_MOBILE) {
    $is_dhtml_editor = true;
}
$editor_html = editor_html('qa_content', $content, $is_dhtml_editor);
$editor_js = '';
$editor_js .= get_editor_js('qa_content', $is_dhtml_editor);
$editor_js .= chk_editor_js('qa_content', $is_dhtml_editor);

$ss_name = 'ss_qa_view_'.$qa_id;
if(!get_session($ss_name))
    set_session($ss_name, TRUE);

// 첨부파일
$view['img_file'] = array();
$view['download_href'] = array();
$view['download_source'] = array();
$view['img_count'] = 0;
$view['download_count'] = 0;

$html_value = '';
$html_checked = '';
if (isset($view['qa_html']) && $view['qa_html']) {
    $html_checked = 'checked';
    $html_value = $view['qa_html'];

    if($view['qa_html'] == 1 && !$is_dhtml_editor)
        $html_value = 2;
}

@include_once(EYOOM_USER_PATH.'/mypage/reservation_view.php');

/**
 * HTML 출력
 */
include_once($eyoom_skin_path['mypage'].'/reservation_view.skin.html.php');