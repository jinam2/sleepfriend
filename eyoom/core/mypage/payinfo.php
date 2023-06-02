<?php
/**
 * core file : /eyoom/core/mypage/contract.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 회원체크
 */
if (!$is_member) alert('회원만 접근하실 수 있습니다.',G5_URL);



$sql = "select P.* 
        from SF_PAYMENT P INNER JOIN SF_CONTRACT C on(P.CONTRACT_ID = C.ID)
        where P.PATIENT_ID = '{$member['salesforce_id']}' 
        order by  C.REAL_START_DATE DESC
        LIMIT 1";

$payment = sql_fetch($sql);

if($payment['METHOD'] == "카드" && $payment['BANKCARD_NUMBER']) {
    $payment['BANKCARD_NUMBER'] = str_replace("-", "",  $payment['BANKCARD_NUMBER']);
    $payment['MASK_CARD_NUMBER'] =  strlen($payment['BANKCARD_NUMBER']) == 16 ? masking_number_format($payment['BANKCARD_NUMBER'], "####-****-****-####") : "";
}

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/mypage/payinfo.php');

/**
 * HTML 출력
 */
include_once($eyoom_skin_path['mypage'].'/payinfo.skin.html.php');