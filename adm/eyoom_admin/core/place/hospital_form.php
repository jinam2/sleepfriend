<?php
/**
 * @file    /adm/eyoom_admin/core/place/hospital_form.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "700100";

/**
 * 폼 action URL
 */
$action_url1 = G5_ADMIN_URL . "/?dir=place&amp;pid=hospital_form_update&amp;smode=1";

auth_check_menu($auth, $sub_menu, 'r');

add_javascript(G5_POSTCODE_JS, 0);


$html_title = '주소등록';

$seq = isset($_GET['seq']) ? (int) $_GET['seq'] : 0;
$place = array('seq' => 0, 'store_name'=>'', 'zipcode' => '', 'address1' => '', 'address2' => '', 'tel' => '', 'sido'=> '');

$category = 'hospital';
if ($w == 'u') {
    $html_title .= '수정';
    $readonly = ' readonly';

    $sql = " select * from sleep_place where category = '{$category}' and seq = '{$seq}' ";
    $place = sql_fetch($sql);
    if (!$place['seq']) {
        alert('등록된 자료가 없습니다.');
    }

    if($place['main_image_file']) {
        $main_img_file = G5_DATA_PATH . '/place/'.$place['main_image_file'];
        if(file_exists($main_img_file)) {
            $place['thumb'] = get_place_thumbnail($main_img_file, 120, 120);
        }
    }

} else {
    $html_title .= '입력';
}

$g5['title'] = $html_title;

/**
 * 버튼
 */
$frm_submit  = ' <div class="text-center margin-top-30 margin-bottom-30"> ';
$frm_submit .= ' <input type="submit" value="확인" class="btn-e btn-e-lg btn-e-red" accesskey="s">' ;
$frm_submit .= !$wmode ? ' <a href="' . G5_ADMIN_URL . '/?dir=place&amp;pid=hospitallist&amp;'.$qstr.'" class="btn-e btn-e-lg btn-e-dark">목록</a> ': '';
$frm_submit .= '</div>';