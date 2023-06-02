<?PHP
function sendMessage(){
    $content = array(
        "en" => 'English Message'
    );

    $fields = array(
        'app_id' => "32749154-3ce9-474e-aa62-35d954f93687",
        'include_player_ids' => array("3bcf1b0a-12e8-41fe-b7d4-1133e562cc6a"),
        'data' => array("foo" => "bar"),
        'contents' => $content
    );

    $fields = json_encode($fields);
    print("\nJSON sent:\n");
    print($fields);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8'));
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