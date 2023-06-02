<?PHP
function sendMessage(){
    $content = array(
        "en" => '안녕하세요.테스트 알림 메세지 입니다.'
    );

    $fields = array(
        'app_id' => "32749154-3ce9-474e-aa62-35d954f93687",
        'include_external_user_ids' => array("apitester"),
        'channel_for_external_user_ids' => 'push',
        'data' => array("foo" => "bar"),
        'contents' => $content
    );

    $fields = json_encode($fields);
    //print("\nJSON sent:\n");
    //print($fields);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
        'Authorization: Basic OWQ0Mjg3N2EtNTc3Ny00MDJmLWI5NmUtMmFjNTNhODIzNDg3'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}

$response = sendMessage();
$return["allresponses"] = $response;
$return = json_encode( $return);

print("\n\nJSON received:\n");
print($return);
print("\n");
?>