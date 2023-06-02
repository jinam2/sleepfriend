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
    'address_bcode',
    'address1',
    'address2',
    'address_jibeon',
    'zipcode',
    'address_lat',
    'address_lon',
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
                address_bcode = '{$posts['address_bcode']}',
                address1 = '{$posts['address1']}',
                address2 = '{$posts['address2']}',
                address_jibeon = '{$posts['address_jibeon']}',
                zipcode = '{$posts['zipcode']}',
                address_lat = '{$posts['address_lat']}',
                address_lon = '{$posts['address_lon']}'    
    ";
    sql_query($sql);

    $seq = sql_insert_id();
} else {
    $sql = "
            update sleep_place
                set 
                category = '{$posts['category']}',
                store_name = '{$posts['store_name']}',
                tel = '{$posts['tel']}',
                sido = '{$posts['sido']}',
                address_bcode = '{$posts['address_bcode']}',
                address1 = '{$posts['address1']}',
                address2 = '{$posts['address2']}',
                address_jibeon = '{$posts['address_jibeon']}',
                zipcode = '{$posts['zipcode']}',
                address_lat = '{$posts['address_lat']}',
                address_lon = '{$posts['address_lon']}' 
            where seq = '{$seq}'
    ";

    sql_query($sql);
}


$qstr .= $wmode ? '&amp;wmode=1': '';


goto_url(G5_ADMIN_URL . '/?dir=place&amp;pid=hospital_form&amp;'.$qstr.'&amp;w=u&amp;seq='.$seq, false);