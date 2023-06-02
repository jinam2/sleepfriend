<?php
define('_EYOOM_MYPAGE_',true);

$g5['title'] = '계약정보';
$mpid = 'activity';

include_once('./_common.php');

if (!$is_member) alert_close('회원만 접근하실 수 있습니다.');

$ID  = filter_input(INPUT_GET, 'ID', FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/[A-Za-z0-9_]/')));


$contract = sql_fetch("select * from SF_CONTRACT where PATIENT_ID = '{$member['salesforce_id']}' AND ID = '{$ID}' ");

if(!$contract) {
    alert_close("조회할 계약 정보가 없습니다.");
}

if(!$contract['CONTRACT_PDF']) {
    alert_close("PDF 파일 조회 불가");
}

$pdf_file = G5_DATA_PATH."/downloads/".$contract['ID'].".pdf";

$decoded = base64_decode($contract['CONTRACT_PDF']);
$file = $contract['ID'].".pdf";

file_put_contents($pdf_file, $decoded);

if (file_exists($pdf_file)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($file) . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($pdf_file));
    readfile($pdf_file);

    unlink($pdf_file);

    exit;
}

