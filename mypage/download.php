<?php
include_once('./_common.php');

// clean the output buffer
ob_end_clean();

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/[A-Za-z0-9_]/')));
$type = $_GET['type'];
$filenum = $_GET['filenum'];

if($type == "rental") {
    $row = sql_fetch("select * from g5_shop_rental where od_id='{$id}' and mb_id='{$member['mb_id']}'");
    $file =  $row["od_file{$filenum}"];
    $original = $row["od_filename{$filenum}"];
}

if(!$row) {
    alert('잘못된 접근입니다.');
}

if(!$file || !$original) {
    alert('파일 정보가 존재하지 않습니다.');
}

$filepath = G5_DATA_PATH.$file;
$filepath = addslashes($filepath);
$file_exist_check = (!is_file($filepath) || !file_exists($filepath)) ? false : true;

$original = rawurlencode($original);

if(preg_match("/msie/i", $_SERVER['HTTP_USER_AGENT']) && preg_match("/5\.5/", $_SERVER['HTTP_USER_AGENT'])) {
    header("content-type: doesn/matter");
    header("content-length: ".filesize($filepath));
    header("content-disposition: attachment; filename=\"$original\"");
    header("content-transfer-encoding: binary");
} else if (preg_match("/Firefox/i", $_SERVER['HTTP_USER_AGENT'])){
    header("content-type: file/unknown");
    header("content-length: ".filesize($filepath));
    //header("content-disposition: attachment; filename=\"".basename($file['bf_source'])."\"");
    header("content-disposition: attachment; filename=\"".$original."\"");
    header("content-description: php generated data");
} else {
    header("content-type: file/unknown");
    header("content-length: ".filesize($filepath));
    header("content-disposition: attachment; filename=\"$original\"");
    header("content-description: php generated data");
}
header("pragma: no-cache");
header("expires: 0");
flush();

$fp = fopen($filepath, 'rb');

$download_rate = 10;

while(!feof($fp)) {
    //echo fread($fp, 100*1024);
    /*
    echo fread($fp, 100*1024);
    flush();
    */

    print fread($fp, round($download_rate * 1024));
    flush();
    usleep(1000);
}
fclose ($fp);
flush();