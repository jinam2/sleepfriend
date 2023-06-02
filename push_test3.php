<?PHP


define('_GNUBOARD_', true);

error_reporting(E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_ERROR | E_WARNING | E_PARSE | E_USER_ERROR | E_USER_WARNING);
ini_set('display_errors', '1');

include_once __DIR__ . "/lib/OneSignalPush.php";


$push = new OneSignalPush();


$user_id = "apitester";
$message = "테스트 메시지 입니다.3";
$res = $push->sendUserNotification($user_id, $message);

print_r($res);