<?php
include_once('./_common.php');

include_once G5_LIB_PATH.'/OneSignalPush.php';

header("Content-type: application/json; charset=utf-8");

$json_result = ['code' => 200, 'memssage' => ''];
$mode = $_REQUEST['mode'];

try {
    if(!$member['mb_id']) {
        throw new Exception("회원만 렌탈 신청 가능합니다.", 403);
    }
    //todo 렌탈 등록 처리
    $s_cart_id = get_session('ss_cart_id');
    $tmp_od_id = get_uniqid();
    $it_id = filter_input(INPUT_POST, 'it_id', FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/[A-Za-z0-9_]/')));
    $rental_type = filter_input(INPUT_POST, 'rental_type', FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/[A-Za-z0-9_]/')));

    $chars_array = array_merge(range(0,9), range('a','z'), range('A','Z'));

    //입력값 검증. 텍스트를 입력받고, 받은값을 관리자가 확인하기 때문에 sql_injection, xss 등을 필터링 하여야 함.

    $item= get_shop_item($it_id);

    @mkdir(G5_DATA_PATH.'/item/rental', G5_DIR_PERMISSION);
    @chmod(G5_DATA_PATH.'/item/rental', G5_DIR_PERMISSION);

    $upload_dir = '/item/rental/'.date('Ymd');

    @mkdir(G5_DATA_PATH."/".$upload_dir, G5_DIR_PERMISSION);
    @chmod(G5_DATA_PATH."/".$upload_dir, G5_DIR_PERMISSION);

    $upload = [];

    $valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt', 'ai', 'psd', 'svg', 'zip', 'alz', '7z', 'hwp', 'xls'); // valid

    $od_name = $item['it_id'];

    for($i = 1; $i <= 4; $i++) { //1:신분증, 2:처방전, 3:등록신청서, 4:수면다원검사결과지
        $_FILE = $_FILES["file{$i}"];
        if(!$_FILE) {
            if($i == 1) {
                throw new Exception("신분증을 업로드 하세요.", 400);
            }
            continue;
        }
        $filename = $_FILE['name'];
        $filename  = get_safe_filename($filename);
        $tmp_file = $_FILE['tmp_name'];
        $filesize  = $_FILE['size'];

        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        $filename = preg_replace("/\.(php|pht|phtm|htm|cgi|pl|exe|jsp|asp|inc|phar)/i", "$0-x", $filename);
        shuffle($chars_array);
        $shuffle = implode('', $chars_array);

        $upload[$i]['file'] = md5(sha1($_SERVER['REMOTE_ADDR'])).'_'.substr($shuffle,0,8).'_'.replace_filename($filename);
        $dest_file = G5_DATA_PATH."/".$upload_dir.'/'.$upload[$i]['file'];

        $upload[$i]['upload_url'] = G5_DATA_URL.'/'.trim($upload_dir,"/").'/'.$upload['file'];
        $upload[$i]['upload_filename'] = $filename;

        if(is_uploaded_file($tmp_file)) {
            $upload[$i]['file_name']  = $filename;
            $upload[$i]['file_src']  = $upload_dir."/".$upload[$i]['file'];
            $upload[$i]['file_size'] = intval($filesize);
            $upload[$i]['file_ext'] = $ext;;

            $is_move = move_uploaded_file($tmp_file, $dest_file);
            if (!$is_move) {
                throw new Exception('업로드 실패', 500);
            }
            // 올라간 파일의 퍼미션을 변경합니다.
            chmod($dest_file, G5_FILE_PERMISSION);
        }
    }

    $sql = "insert into g5_shop_rental SET
                  od_id = '{$tmp_od_id}',
                  mb_id = '{$member['mb_id']}',
                  od_it_id = '{$it_id}',
                  od_rental_type = '{$rental_type}',
                  od_status = '접수',
                  od_file1 = '{$upload[1]['file_src']}',
                  od_file2 = '{$upload[2]['file_src']}',
                  od_file3 = '{$upload[3]['file_src']}',
                  od_file4 = '{$upload[4]['file_src']}',
                  od_filename1 = '{$upload[1]['file_name']}',
                  od_filename2 = '{$upload[2]['file_name']}',
                  od_filename3 = '{$upload[3]['file_name']}',
                  od_filename4 = '{$upload[4]['file_name']}',
                  od_datetime = now()
    ";

    sql_query($sql);

    // 답변 알림 메세지
    $push = new OneSignalPush();
    $push_message = "상품의 렌탈 신청이 완료되었습니다.";
    $target_url = G5_URL."/mypage/contract.php";
    $push->sendGoodsRentalNotification($member['mb_id'], $push_message, $target_url);

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
