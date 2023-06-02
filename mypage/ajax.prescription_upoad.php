<?php
include_once('./_common.php');

header("Content-type: application/json; charset=utf-8");

$json_result = ['code' => 200, 'memssage' => ''];
$mode = $_REQUEST['mode'];

try {

    //contract_id
    $ID  = filter_input(INPUT_GET, 'ID', FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/[A-Za-z0-9_]/')));


    $contract = sql_fetch("select * from SF_CONTRACT where PATIENT_ID = '{$member['salesforce_id']}' AND ID = '{$ID}' ");

    if(!$contract) {
        throw new Exception("조회할 계약 정보가 없습니다.");
    }

    $chars_array = array_merge(range(0,9), range('a','z'), range('A','Z'));

    //입력값 검증. 텍스트를 입력받고, 받은값을 관리자가 확인하기 때문에 sql_injection, xss 등을 필터링 하여야 함.
    $index = filter_input(INPUT_POST, 'index', FILTER_VALIDATE_INT);
    $ct_id = filter_input(INPUT_POST, 'ct_id', FILTER_VALIDATE_INT);

    $sql = "select * from {$g5['g5_shop_cart_table']} where ct_id = '{$ct_id}' ";
    $cart_item = sql_fetch($sql);


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
                        bf_content = 0,
                        bf_fileurl = '{$bf_fileurl}',
                        bf_filesize = '{$bf_filesize}',
                        bf_ext = '{$bf_ext}',
                        bf_status = '접수',
                        bf_datetime = now()
         ";

        sql_query($sql);

    } else {
        throw new Exception('업로드 실패', 500);
    }
} catch (Exception $e) {
    if ($ex->getCode() >= 200 && $ex->getCode() <= 500) {
        $result['message'] = $ex->getMessage();
        $result['code'] = $ex->getCode();
    } else {
        $result['message'] = "server error!!";
        $result['code'] = 500;
    }
}

die(json_encode($result));
