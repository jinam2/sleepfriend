<?php

define('_GNUBOARD_', true);

error_reporting( E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_ERROR | E_WARNING | E_PARSE | E_USER_ERROR | E_USER_WARNING );
ini_set('display_errors', '1');

include_once dirname(__DIR__) . "/custom_db_config.php";
include_once dirname(__DIR__) . "/lib/SimpleDB.php";
include_once dirname(__DIR__) . "/lib/MediSync.php";

$db_host = G5_MYSQL_HOST;
$db_user = G5_MYSQL_USER;
$db_password = G5_MYSQL_PASSWORD;
$db_name = G5_MYSQL_DB;

$pdo_db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"));
$pdo_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo_db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

if (!isset($pdo_db)) {
    die('DB connection error!');
}

$db = new SimpleDB($pdo_db);

function get_address_location($address) {

    if(!trim($address)) {
        return ['lat' => 0, 'lng' => 0];
    }

    $url = "https://dapi.kakao.com/v2/local/search/address.json?query=".urlencode($address);

    $ch=curl_init();
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url); // url 연결
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER,
        array("Accept: application/json", "Content-Type: application/json",
            "Authorization: KakaoAK ba62878fcdd83ac622f32226148b657e"));
    curl_setopt($ch, CURLOPT_VERBOSE, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $response = curl_exec($ch);
    $result = (array) json_decode($response, true);

    if($result["documents"][0]['road_address']['x']){
        $lat = $result["documents"][0]['road_address']['y'];
        $lon = $result["documents"][0]['road_address']['x'];
        $zone_no = $result["documents"][0]['road_address']['zone_no'];
        $address = $result["documents"][0]['road_address']['address_name'];
    }else{
        $lat = $result["documents"][0]['address']['y'];
        $lon = $result["documents"][0]['address']['x'];
        $address = $result["documents"][0]['address']['address_name'];
    }

    $sido = $result["documents"][0]['address']['region_1depth_name'];
    $sigungu = $result["documents"][0]['address']['region_2depth_name'];
    $h_code = $result["documents"][0]['address']['h_code'];
    $b_code = $result["documents"][0]['address']['b_code'];
    $address_type = $result["documents"][0]['address_type'];

    //	echo "<xmp>";
    //	print_r($result);
    //	print_r(['lat' => $lat, 'lng' => $lng]);
    //	echo "</xmp>";
    return ['b_code' => $b_code, 'sido' => $sido, 'sigungu' => $sigungu,  'lat' => $lat, 'lon' => $lon, 'zone_no' => $zone_no, 'address' => $address];

}

$sql = "select * from sleep_place where category='hospital' and (address_bcode is null or address_bcode = '')  limit 100 ";

$rows = $db->query($sql);

foreach($rows as $row) {
    //print_r($row);

    //ft_smfw_zipcode, ft_smfw_latitude, ft_smfw_longitude

    //tel..
    //$ft_smfw_business_name =  $wpdb->get_row("select * from $wpdb->postmeta where post_id={$row['ID']} and meta_key ='ft_smfw_business_name' ", ARRAY_A);

    $param = [
        'seq' => $row['seq'],
        'address3' => $row['address3'],
    ];

    if($param['address3'] ) {
        $loc = get_address_location($param['address3']);
        $param['address_lat'] = $loc['lat'];
        $param['address_lon'] = $loc['lon'];
        $param['address_bcode'] = $loc['b_code'];
        $param['address'] = $loc['address'];
        $param['zipcode'] = $loc['zone_no'];
        $param['sido'] = $loc['sido'];
        $param['sigungu'] = $loc['sigungu'];


        echo "<xmp>";
        print_r($param);
        echo "</xmp>";

        $sql = "update sleep_place SET
                    sido            = '{$param['sido']}',
                    sigungu         = '{$param['sigungu']}',
                    address_bcode   = '{$param['address_bcode']}',
                    address1        = '{$param['address']}',
                    zipcode         = '{$param['zipcode']}',
                    address_lat     = '{$param['address_lat']}',
                    address_lon     = '{$param['address_lon']}'
                where seq = {$param['seq']}    
            ";

        $db->query($sql);
    }

}