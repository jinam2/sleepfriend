<?php
/**
 * 마이페이지 1:1 문의 처리용
 */

$g5_path = '../../..';
include_once($g5_path.'/common.php');

if (!$is_member) exit;


require_once G5_LIB_PATH . "/SimpleDB.php";
include_once G5_LIB_PATH . "/ShopData.php";

$pdo_db = getPDOConnection();
$db = new SimpleDB($pdo_db);

ini_set('display_errors', 1);

$json_result = ['code' => 200, 'memssage' => ''];
$mode = $_REQUEST['mode'];

$normalize_targets = [
    "target_id" => [
        "filter_type" => "text",
        "before_filter" => function($value) {

        },
        "after_filter" => function($value) {

        },
    ]
];

$normalize_fns  = [
    "shop_goods" => function($value) { //사용제품
        return  trim(get_text(strip_tags(stripslashes($value)), 0));
    },
    "icon_service" => function($value) use($MACANCE) { //가능한 서비스 콤마(,) 로 구분해서 들어옴
        $temp = [];
        $arr = explode(",", $value);
        foreach($arr as $service) {
            if(in_array($service, $MACANCE['icon'])) { //글로벌 설정에 지정된 값이 입력
                array_push($temp, $service);
            }
        }

        return serialize($temp); //db 에 serialize하여 저장함.

    },
    "text" => function($value) {
        return  trim(get_text(strip_tags(stripslashes($value)), 0));
    },

    "hour_min" => function($value, $default = "") {
        $regex = "/^([0-9]|0[0-9]|1[0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?/";
        if(preg_match($regex, $value, $matches)) {
            return $value;
        } else {
            return $default;
        }
    }

];


try {

    if(!$is_member) {
        throw  new Exception("회원만 이용 가능합니다.", 403);
    }

    $action = filter_input(INPUT_POST, 'action', FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/[A-Za-z0-9_]/')));



    switch ($action) {

        case 'write' :
            $category = filter_input(INPUT_POST, "category", FILTER_VALIDATE_INT);
            $group = filter_input(INPUT_POST, "group");
            $subject = filter_input(INPUT_POST, "subject");
            $content = filter_input(INPUT_POST, "content");

            $category = call_user_func($normalize_fns["text"], $category);
            $group = call_user_func($normalize_fns["text"], $group);
            $subject = call_user_func($normalize_fns["text"], $subject);
            $content = call_user_func($normalize_fns["text"], $content);

            if(!$category) {
                throw new Exception("유형을 선택하세요.", 400);
            }
            if(!$group) {
                throw new Exception("분류를 선택하세요.", 400);
            }
            if(!$subject) {
                throw new Exception("제목을 입력하세요.", 400);
            }
            if(!$content) {
                throw new Exception("내용을 입력하세요.", 400);
            }

            $row = sql_fetch(" select MIN(qa_num) as min_qa_num from {$g5['qa_content_table']} ");
            $qa_num = $row['min_qa_num'] - 1;




            //글등록
            $sql = "";

            break;
        case 'modify' :
            $qa_id = filter_input(INPUT_POST, "qa_id", FILTER_VALIDATE_INT);

            break;
        default :
            throw new Exception("잘못된 요청입니다.", 400);
    }

} catch (Exception $e) {
    $json_result['code'] = $e->getCode() >= 200 && $e->getCode() <= 500 ? $e->getCode() : 500;
    $json_result['message'] = $e->getCode() >= 200 && $e->getCode() <= 500 ? $e->getMessage() : "Server Error";
}

echo json_encode($json_result);

/**
 * 소셜 기능이 설정되어 있는지 체크
 */
switch($action) {
    /**
     * 글쓰기
     */
    case 'write_update':
        /**
         * 이미 팔로우했는지 체크
         */
        if (!$eb->follow_check($mb_id)) {
            /**
             * 맞팔친구 체크
             */
            $friends_check = sql_fetch("select count(*) as cnt from {$g5['eyoom_follow']} where fo_my_id = '{$mb_id}' and fo_mb_id = '{$member['mb_id']}' ");
            $is_friends = $friends_check['cnt'] ? 'y': 'n';

            if ($is_friends) {
                sql_query("update {$g5['eyoom_follow']} set fo_friends = 'y' where fo_my_id = '{$mb_id}' and fo_mb_id = '{$member['mb_id']}' ");
            }

            /**
             * 팔로우 추가
             */
            sql_query("insert into {$g5['eyoom_follow']} set fo_my_id = '{$member['mb_id']}', fo_mb_id = '{$mb_id}', fo_friends = '{$is_friends}', fo_datetime = '".G5_TIME_YMDHIS."' ");

            /**
             * 팔로우 경험치
             */
            $eb->level_point($levelset['following'],$mb_id,$levelset['follower']);

            /**
             * 푸시등록
             */
            if ($user['onoff_push_social'] == 'on') $eb->set_push("follow", $member['mb_id'], $mb_id, $member['mb_nick']);

            /**
             * 팔로우 정상처리
             */
            $token = 'yes';
        } else {
            $token = 'no';
        }
        break;


    /**
     * 팔로우 끊기
     */
    case 'delete':
        /**
         * 이미 팔로우했는지 체크
         */
        if ($eb->follow_check($mb_id)) {
            /**
             * 팔로우 제거
             */
            $sql = "delete from {$g5['eyoom_follow']} where fo_my_id = '{$member['mb_id']}' and fo_mb_id = '{$mb_id}'";
            sql_query($sql, false);

            /**
             * 맞팔친구 해제
             */
            sql_query("update {$g5['eyoom_follow']} set fo_friends = 'n' where fo_my_id = '{$mb_id}' and fo_mb_id = '{$member['mb_id']}' ");

            /**
             * 푸시등록
             */
            //if ($user['onoff_push_social'] == 'on') $eb->set_push("unfollow", $member['mb_id'], $mb_id, $member['mb_nick']);

            /**
             * 팔로우 정상처리
             */
            $token = 'yes';
        } else {
            $token = 'no';
        }
        break;
}



if ($token) {
    $_value_array = array();
    $_value_array['result'] = $token;

    include_once EYOOM_CLASS_PATH.'/json.class.php';

    $json = new Services_JSON();
    $output = $json->encode($_value_array);

    echo $output;
}
exit;