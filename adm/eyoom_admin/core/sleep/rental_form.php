<?php
/**
 * @file    /adm/eyoom_admin/core/sleep/rental_form.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "600110";

/**
 * 폼 action URL
 */
$action_url1 = G5_ADMIN_URL . "/?dir=sleep&amp;pid=rental_form_update&amp;smode=1";

auth_check_menu($auth, $sub_menu, 'r');

add_javascript(G5_POSTCODE_JS, 0);


$html_title = '렌탈 신청 정보';

$od_id = isset($_GET['od_id']) ? (int) $_GET['od_id'] : 0;
$prescription_file = array('od_id' => 0, 'mb_id'=>'', 'od_it_id' => '');

$rental_type_names = [
    "noinsurance" => '비보험렌탈',
    "insurance" => '보험렌탈',
];

if ($w == 'u') {
    $html_title .= '수정';
    $readonly = ' readonly';

    $sql = " select R.*, I.it_name, I.it_brand, I.ca_id
            from g5_shop_rental R inner join g5_shop_item I on(R.od_it_id = I.it_id)
            where R.od_id = '{$od_id}' ";
    $rental = sql_fetch($sql);
    if (!$rental['od_id']) {
        alert('등록된 렌탈 신청 자료가 없습니다.');
    }

    $mem = sql_fetch(" select * from {$g5['member_table']} where mb_id = '{$rental['mb_id']}' ");
    $cate = sql_fetch("select * from g5_shop_category where ca_id = '{$rental['ca_id']}' ");
    $rental['product_family'] = $cate['ca_name'];

    $rental['mb_name'] = $mem['mb_name'];
    $rental['mb_id'] = $mem['mb_id'];

    $rental['rental_type_name'] = $rental_type_names[$rental['od_rental_type']];

    for($j= 1; $j <=4; $j++ ) {
        $file = G5_DATA_PATH.$rental["od_file{$j}"];
        $file_url = G5_DATA_URL.$rental["od_file{$j}"];

        if(is_file($file) || true) {
            $rental["link{$j}"] = "<a href='{$file_url}' target='_blank'>보기</a>";
        } else {
            $rental["link{$j}"] = "";
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
$frm_submit .= !$wmode ? ' <a href="' . G5_ADMIN_URL . '/?dir=sleep&amp;pid=rentallist&amp;'.$qstr.'" class="btn-e btn-e-lg btn-e-dark">목록</a> ': '';
$frm_submit .= '</div>';