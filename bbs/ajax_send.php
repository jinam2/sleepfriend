<?php
include_once('../common.php');
include_once(G5_LIB_PATH.'/register.lib.php');

$json_result = ['code' => 200, 'memssage' => ''];

try {
    $time = time();
    $recv_number = trim($_POST['mb_hp']);

    $valid_msg = valid_mb_hp($_POST['mb_hp']);
    if($valid_msg) {
        throw  new Exception($valid_msg, 400);
    }

    /*
    if(true) {
        throw new Exception("인증 문자 발송-테스트", 200);
    }
    */

    $recv_number = str_replace("-", "", $recv_number);

    $check_time = time() - 60 * 10; //10분전
    $sql = "select count(*) as cnt from sms_auth where a_hp='{$recv_number}' and a_auth > {$check_time} "; // 현재 10분 입니다. 추후 10을 변경하시면 됩니다.
    $row = sql_fetch($sql);
    if ($row['cnt'] > 5) { //제한 횟수
        throw new Exception("단시간에 너무 많은 요청을 하셨습니다.\n\n잠시후 이용 부탁드립니다.", 400);
    }

    if ($config['cf_sms_use'] == 'icode') {
        include_once(G5_LIB_PATH . '/icode.sms.lib.php');

        $a_num = rand(10000, 99999);

        $sms_content = str_replace("%code%", $a_num, $config['cf_auth_hp_message']);
        $send_number = preg_replace('/[^0-9]/', '', $sms5['cf_phone']);

        if ($recv_number) {
            sql_query("insert into sms_auth set a_auth='{$time}', a_num='{$a_num}', a_hp='{$recv_number}', a_regdate=now(),  a_ip='{$_SERVER['REMOTE_ADDR']}' ");
            $SMS = new SMS; // SMS 연결
            $SMS->SMS_con($config['cf_icode_server_ip'], $config['cf_icode_id'], $config['cf_icode_pw'], $config['cf_icode_server_port']);
            $SMS->Add($recv_number, $send_number, $config['cf_icode_id'], iconv("utf-8", "euc-kr", stripslashes($sms_content)), "");
            $SMS->Send();
        }

        $json_result['hp_auth_token'] = $time; //time값을 토큰으로 사용
        $json_result['message'] = "요청하신 휴대폰으로 '인증번호'가 발송되었습니다.";

    } else {
        throw new Exception("인증 문자발송 오류. 관리자에게 문의하세요.", 400);
    }

} catch (Exception $e) {
    if($e->getCode() >= 200  && $e->getCode() <= 500) {
        $json_result['code'] = $e->getCode();
        $json_result['message'] = $e->getMessage();
    } else {
        $json_result['code'] =  500;
        $json_result['message'] = "서비스 오류. 관리자에게 문의하세요.";
    }
}

echo json_encode($json_result, JSON_UNESCAPED_UNICODE);