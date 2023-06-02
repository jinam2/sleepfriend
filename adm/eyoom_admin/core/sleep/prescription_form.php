<?php
/**
 * @file    /adm/eyoom_admin/core/place/prescription_form.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

require_once G5_LIB_PATH . "/MediUtil.php";

$sub_menu = "600500";

/**
 * 폼 action URL
 */
$action_url1 = G5_ADMIN_URL . "/?dir=sleep&amp;pid=prescription_form_update&amp;smode=1";

auth_check_menu($auth, $sub_menu, 'r');


$html_title = '처방전';

$prescription = array('id' => '',);

$ID = filter_input(INPUT_GET, 'ID', FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/[A-Za-z0-9_]/')));

if ($w == 'u') {
    $html_title .= '수정';
    $readonly = ' readonly';
    $sql = "select * from SF_PRESCRIPTION where ID = '{$ID}' ";
    $prescription = sql_fetch($sql);
    if (!$prescription['ID']) {
        alert('등록된 자료가 없습니다.');
    }
    $contract = sql_fetch("select * from SF_CONTRACT WHERE ID='{$prescription['CONTRACT_ID']}'");
    $mem = sql_fetch("select mb_name from g5_member where salesforce_id='{$prescription['PATIENT_ID']}' ");

    //순응도 보고서 내역
    $report_list = sql_fetch_all("select * from patient_report_history where salesforce_prescription_id = '{$prescription['ID']}' order by seq asc");
} else {
    $html_title .= '입력';
}

$g5['title'] = $html_title;

/**
 * 버튼
 */
$frm_submit  = ' <div class="text-center margin-top-30 margin-bottom-30"> ';
$frm_submit .= !$wmode ? ' <a href="' . G5_ADMIN_URL . '/?dir=sleep&amp;pid=prescriptionlist&amp;'.$qstr.'" class="btn-e btn-e-lg btn-e-dark">목록</a> ': '';
$frm_submit .= '</div>';