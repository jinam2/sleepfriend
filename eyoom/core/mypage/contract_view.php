<?php
/**
 * core file : /eyoom/core/mypage/contract.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 회원체크
 */
if (!$is_member) alert('회원만 접근하실 수 있습니다.',G5_URL);

$ID  = filter_input(INPUT_GET, 'ID', FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/[A-Za-z0-9_]/')));

$contract = sql_fetch("select * from SF_CONTRACT where PATIENT_ID = '{$member['salesforce_id']}' AND ID = '{$ID}' ");

if(!$contract) {
    alert("조회할 계약 정보가 없습니다.");
}

if($contract['CONTRACT_PDF']) {
    $contract['pdf_link']  = "<a href='/mypage/contract_pdf.php?ID={$contract['ID']}' target='_blank'>보기</a>";

} else {
    $contract['pdf_link'] = "<a href=\"javascript:;\" class=\"view\">조회불가</a>";
}

//결제정보
$contract['payment'] = sql_fetch("select * from SF_PAYMENT where ID='{$contract['PAYMENT_METHOD']}' LIMIT 1");

//최근 청구 정보
$contract['invoice'] = sql_fetch("select * from SF_INVOICE where CONTRACT_ID='{$contract['ID']}' order by  LIMIT 1");

//  230526 - jinam23 edited sort
//업로드된 처방전 정보
$contract['prescription_files']  = sql_fetch_all("SELECT * FROM sf_prescription_files WHERE contract_id='{$contract['ID']}' ORDER BY bf_datetime DESC");

$contract['link_prescription'] = sql_fetch("select * from SF_PRESCRIPTION where ID='{$contract['LINKED_PRESCRIPTION']}' ");

//  230526 - jinam23 edited sort
//처방 정보 조회
$sql = "SELECT * FROM SF_PRESCRIPTION WHERE CONTRACT_ID='{$contract['ID']}' ORDER BY ISSUE_DATE DESC";

$res = sql_query($sql);
while($row = sql_fetch_array($res)) {
    if($row['PRESCRIPTION_PDF']) {
        $row['pdf_link']  = "<a href='/mypage/prescription_png.php?ID={$row['ID']}' target='_blank'>보기</a>";
    } else {
        $row['pdf_link'] = "";
    }
    $contract['PRESCRIPTION'][] = $row;
}

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/mypage/contract_view.php');

/**
 * HTML 출력
 */
include_once($eyoom_skin_path['mypage'].'/contract_view.skin.html.php');