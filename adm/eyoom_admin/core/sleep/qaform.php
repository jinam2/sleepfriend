<?php
/**
 * @file    /adm/eyoom_admin/core/board/contentform.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "600910";

$action_url1 = G5_BBS_URL."/qawrite_update.php";

require_once G5_EDITOR_LIB;

auth_check_menu($auth, $sub_menu, "w");

$co_id = isset($_REQUEST['co_id']) ? preg_replace('/[^a-z0-9_]/i', '', $_REQUEST['co_id']) : '';

$html_title = "예약 문의 ";
$g5['title'] = $html_title.' 관리';
$readonly = '';

$html_title .= " 답변";


$sql = " select * from {$g5['qa_content_table']} where qa_id = '$qa_id' ";
$write = sql_fetch($sql);
if (!$write['qa_id']) {
    alert('1:1 문의글이 없습니다.');
}

$qa_id = $write['qa_id'];
$w = "u";
$submit_text = "답변등록";
// 질문글이고 등록된 답변이 있다면
$answer = array();
if(!$write['qa_type'] && $write['qa_status']) {
    $sql = " select *
                    from {$g5['qa_content_table']}
                    where qa_type = '1'
                      and qa_parent = '{$write['qa_id']}' ";
    $answer = sql_fetch($sql);

    if($answer) {
        $w = "u";
        $submit_text = "답변수정";
        $qa_id = $answer['qa_id'];
    }
}

/**
 * 버튼
 */
$frm_submit  = ' <div class="text-center margin-top-30 margin-bottom-30"> ';
$frm_submit .= ' <input type="submit" value="'.$submit_text.'" class="btn-e btn-e-lg btn-e-red" accesskey="s">' ;
$frm_submit .= ' <a href="' . G5_ADMIN_URL . '/?dir=sleep&amp;pid=qalist&amp;'.$qstr.'" class="btn-e btn-e-lg btn-e-dark">목록</a> ';
$frm_submit .= '</div>';