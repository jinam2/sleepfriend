<?php
include_once('./_common.php');

include_once G5_LIB_PATH.'/OneSignalPush.php';

header("Content-type: application/json; charset=utf-8");

$json_result = ['code' => 200, 'memssage' => ''];
$mode = $_REQUEST['mode'];

try {

    //contract_id
    $ID  = filter_input(INPUT_POST, 'ID', FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/[A-Za-z0-9_]/')));

    $contract = sql_fetch("select * from SF_CONTRACT where PATIENT_ID = '{$member['salesforce_id']}' AND ID = '{$ID}' ");

    if(!$contract) {
        throw new Exception("조회할 계약 정보가 없습니다.", 404);
    }

    $chars_array = array_merge(range(0,9), range('a','z'), range('A','Z'));


    @mkdir(G5_DATA_PATH.'/prescription', G5_DIR_PERMISSION);
    @chmod(G5_DATA_PATH.'/prescription', G5_DIR_PERMISSION);

    @mkdir(G5_DATA_PATH."/prescription/{$ID}", G5_DIR_PERMISSION);
    @chmod(G5_DATA_PATH."/prescription/{$ID}", G5_DIR_PERMISSION);


    $upload_dir = '/prescription/'.$ID;

    @mkdir(G5_DATA_PATH."/".$upload_dir, G5_DIR_PERMISSION);
    @chmod(G5_DATA_PATH."/".$upload_dir, G5_DIR_PERMISSION);

    $upload = [];

    $valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt', 'ai', 'psd', 'svg'); // valid

    $filename = $_FILES['file']['name'];
    $filename  = get_safe_filename($filename);
    $tmp_file = $_FILES['file']['tmp_name'];
    $filesize  = $_FILES['file']['size'];

    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    $filename = preg_replace("/\.(php|pht|phtm|htm|cgi|pl|exe|jsp|asp|inc|phar)/i", "$0-x", $filename);
    shuffle($chars_array);
    $shuffle = implode('', $chars_array);

    $upload['file'] = md5(sha1($_SERVER['REMOTE_ADDR'])).'_'.substr($shuffle,0,8).'_'.replace_filename($filename);
    $dest_file = G5_DATA_PATH."/".$upload_dir.'/'.$upload['file'];

    $result['upload_url'] = G5_DATA_URL.'/'.trim($upload_dir,"/").'/'.$upload['file'];
    $result['upload_filename'] = $filename;

    if(is_uploaded_file($tmp_file)) {
        $is_move = move_uploaded_file($tmp_file, $dest_file) ;
        if(!$is_move) {
            throw new Exception('업로드 실패', 500);
        }
        // 올라간 파일의 퍼미션을 변경합니다.
        chmod($dest_file, G5_FILE_PERMISSION);

        $bf_source = $filename;
        $bf_file = $upload_dir."/".$upload['file'];
        $bf_fileurl = G5_DATA_URL.'/'.trim($upload_dir,"/").'/'.$upload['file'];;
        $bf_filesize = intval($filesize);
        $bf_ext = $ext;
        $sql = "INSERT INTO sf_prescription_files
                    SET contract_id = '{$ID}',
                        bf_no = 0,
                        bf_source = '{$bf_source}',
                        bf_file = '{$bf_file}',
                        bf_fileurl = '{$bf_fileurl}',
                        bf_filesize = '{$bf_filesize}',
                        bf_ext = '{$bf_ext}',
                        bf_status = '접수',
                        bf_datetime = now()
         ";

        sql_query($sql);


        // 처방전 등록 알림 메세지
        $push = new OneSignalPush();
        $push_message = "처방 등록이 완료되었습니다.";
        $target_url = G5_URL."/mypage/contract_view.php?ID=".$ID;
        $push->sendPrescriptionScheduleNotification($member['mb_id'], $push_message, $target_url);


    } else {
        throw new Exception('업로드 실패. 파일을 선택하세요.', 500);
    }
} catch (Exception $ex) {
    if ($ex->getCode() >= 200 && $ex->getCode() <= 500) {
        $json_result['message'] = $ex->getMessage();
        $json_result['code'] = $ex->getCode();
    } else {
        $json_result['message'] = "server error!!";
        $json_result['code'] = 500;
    }
}

die(json_encode($json_result));
