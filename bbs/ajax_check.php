<?php
include_once('../common.php');

$auth_token      = filter_input(INPUT_POST, 'hp_auth_token', FILTER_VALIDATE_INT);
$auth_num      = filter_input(INPUT_POST, 'auth_num', FILTER_VALIDATE_INT);
$recv_number = trim($_POST['mb_hp']);

$recv_number = str_replace("-", "", $recv_number);

include_once('../common.php');

$json_result = ['code' => 200, 'memssage' => ''];

if(isset($_SESSION['ss_cert_hp'])) unset($_SESSION['ss_cert_hp']);

try {
    $sql = "select * from sms_auth where a_hp='{$recv_number}' and a_auth='{$auth_token}' order by a_auth desc limit 1";
    $row = sql_fetch($sql);
    if ($row['a_num'] == $auth_num) {
        //tdo 인증시간 만료 확인
        $diff_second = time() - strtotime($row['a_regdate']);
        if($diff_second > 185) {
            throw new Exception("입력 유효시간이 만료되었습니다.", 400);
        }
        $json_result['memssage'] = "인증되었습니다.";
        set_session("ss_cert_hp",   $recv_number);
    } else {
        throw new Exception("입력하신 인증번호가 일치하지 않습니다.", 400);
    }
} catch (Exception $e) {
    if ($e->getCode() >= 200 && $e->getCode() <= 500) {
        $json_result['code'] = $e->getCode();
        $json_result['message'] = $e->getMessage();
    } else {
        $json_result['code'] = 500;
        $json_result['message'] = "서비스 오류. 관리자에게 문의하세요.";
    }
}

echo json_encode($json_result, JSON_UNESCAPED_UNICODE);
