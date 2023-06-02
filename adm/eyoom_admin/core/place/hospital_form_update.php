<?php
/**
 * @file    /adm/eyoom_admin/core/place/store_form_update.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "700100";


if ($is_admin != 'super') {
    alert('최고관리자만 접근 가능합니다.');
}

auth_check_menu($auth, $sub_menu, 'w');


$posts = array();
$check_keys = [
    'category',
    'store_name',
    'tel',
    'sido',
    'gugun',
    'sigungu',
    'address_bcode',
    'address1',
    'address2',
    'address3',
    'address_jibeon',
    'zipcode',
    'address_lat',
    'address_lon',
    'homepage',
];

foreach ($check_keys as $key) {
    $posts[$key] = isset($_POST[$key]) ? clean_xss_tags($_POST[$key], 1, 1) : '';
}

if(!$seq) {
    $sql = "
            insert into sleep_place
                set 
               category = '{$posts['category']}',
                store_name = '{$posts['store_name']}',
                tel = '{$posts['tel']}',
                sido = '{$posts['sido']}',
                sigungu = '{$posts['sigungu']}',
                address_bcode = '{$posts['address_bcode']}',
                address1 = '{$posts['address1']}',
                address2 = '{$posts['address2']}',
                address3 = '{$posts['address3']}',
                address_jibeon = '{$posts['address_jibeon']}',
                zipcode = '{$posts['zipcode']}',
                address_lat = '{$posts['address_lat']}',
                address_lon = '{$posts['address_lon']}',    
                homepage = '{$posts['homepage']}'    
    ";
    sql_query($sql);

    $seq = sql_insert_id();
} else {
    $sql = intval($seq);
    $sql = "
            update sleep_place
                set 
                category = '{$posts['category']}',
                store_name = '{$posts['store_name']}',
                tel = '{$posts['tel']}',
                sido = '{$posts['sido']}',
                sigungu = '{$posts['sigungu']}',
                address_bcode = '{$posts['address_bcode']}',
                address1 = '{$posts['address1']}',
                address2 = '{$posts['address2']}',
                address3 = '{$posts['address3']}',
                address_jibeon = '{$posts['address_jibeon']}',
                zipcode = '{$posts['zipcode']}',
                address_lat = '{$posts['address_lat']}',
                address_lon = '{$posts['address_lon']}',
                homepage = '{$posts['homepage']}'   
            where seq = '{$seq}'
    ";

    sql_query($sql);
}


$image_regex = "/(\.(gif|jpe?g|png))$/i";
if($del_main_img) {
    $row = sql_fetch("select main_image_file from sleep_place where seq = '{$seq}'");

    $del_target_file ==  G5_DATA_PATH."/place/".$row['main_image_file'];
    if(file_exists($del_target_file)) {
        @unlink($del_target_file);

        $imageExt = pathinfo($row['main_image_file'], PATHINFO_EXTENSION);
        array_map('unlink', glob(G5_DATA_PATH."/place/place_{$seq}"));
    }

    sql_query("update sleep_place set main_image_file = null, update_datetime=now() where seq = '{$seq}'");
}
if (isset($_FILES['main_img_file']) && is_uploaded_file($_FILES['main_img_file']['tmp_name'])) {

    $imageExt = pathinfo($_FILES['main_img_file']['name'], PATHINFO_EXTENSION);
    $imageName = pathinfo($_FILES['main_img_file']['name'], PATHINFO_FILENAME);

    if (preg_match($image_regex, $_FILES['main_img_file']['name'])) {
        $upload_dir = G5_DATA_PATH."/place/";

        if(!file_exists($upload_dir)) {
            @mkdir($upload_dir, G5_DIR_PERMISSION);
            @chmod($upload_dir, G5_DIR_PERMISSION);
        }

        $dest_filename = "place_".$seq."_main.".$imageExt;
        $dest_path = $upload_dir.'/'.$dest_filename;
        move_uploaded_file($_FILES['main_img_file']['tmp_name'], $dest_path);
        chmod($dest_path, G5_FILE_PERMISSION);
    }

    sql_query("update sleep_place set main_image_file = '{$dest_filename}', update_datetime=now() where seq = '{$seq}'");
}



$qstr .= $wmode ? '&amp;wmode=1': '';


goto_url(G5_ADMIN_URL . '/?dir=place&amp;pid=hospital_form&amp;'.$qstr.'&amp;w=u&amp;seq='.$seq, false);