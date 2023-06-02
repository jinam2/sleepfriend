<?php
/**
 * core file : /eyoom/core/mypage/rental_view.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 회원체크
 */
if (!$is_member) alert('회원만 접근하실 수 있습니다.',G5_URL);

$ID  = filter_input(INPUT_GET, 'ID', FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/[A-Za-z0-9_]/')));


//렌탈 신청 정보
$sql = "select R.*, I.it_name, I.it_brand, I.ca_id
         from g5_shop_rental R inner join g5_shop_item I on(R.od_it_id = I.it_id)
         where R.mb_id = '{$member['mb_id']}'  and od_id = '{$ID}'
         and R.od_status in('접수', '신청','해피콜', '대기') order by R.od_datetime desc ";

$rental = sql_fetch($sql);
if($id = "") {

}

$cate = sql_fetch("select * from g5_shop_category where ca_id = '{$row['ca_id']}' ");
$rental['product_family'] = $cate['ca_name'];

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/mypage/rental_view.php');

/**
 * HTML 출력
 */
include_once($eyoom_skin_path['mypage'].'/rental_view.skin.html.php');