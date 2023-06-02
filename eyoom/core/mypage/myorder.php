<?php
/**
 * core file : /eyoom/core/mypage/contract.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 회원체크
 */
if (!$is_member) alert('회원만 접근하실 수 있습니다.',G5_URL);



$before_7day = date("Y-m-d", strtotime("-7 day", time()));
$today = date("Y-m-d");


$fr_date = isset($_REQUEST['fr_date']) ? preg_replace('/[^0-9 :\-]/i', '', $_REQUEST['fr_date']) : '';
$to_date = isset($_REQUEST['to_date']) ? preg_replace('/[^0-9 :\-]/i', '', $_REQUEST['to_date']) : '';


$sql_search = "";

$sql_common = " from {$g5['g5_shop_order_table']} where mb_id = '{$member['mb_id']}' ";


if ($fr_date && $to_date) {
    $sql_search .= " and (od_time between '$fr_date 00:00:00' and '$to_date 23:59:59') ";
    $qstr .= "&amp;fr_date={$fr_date}&amp;to_date={$to_date}";
}

// 테이블의 전체 레코드수만 얻음
$sql = " select count(*) as cnt
            {$sql_common}
            {$sql_search} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함


/**
 * 주문내역
 */
$sql = " select *
          {$sql_common}
          {$sql_search}
          order by od_id desc
           limit {$from_record}, {$rows} ";
$result = sql_query($sql);
$list = array();
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $uid = md5($row['od_id'].$row['od_time'].$row['od_ip']);



    $status_class_arr = array(
        '주문' => 'status01',
        '입금' => 'status01',
        '준비' => 'status01',
        '배송' => 'status03',
        '완료' => 'status03',
        '취소' => 'status02',
        '주문취소' => 'status02',
        '반품' => 'status02',
        '품절' => 'status02',
    );

    switch($row['od_status']) {
        case '주문':
            $od_status = '입금확인중';
            $od_status_number = 1;
            $od_status_class = "status01";
            break;
        case '입금':
            $od_status = '입금완료';
            $od_status_number = 2;
            $od_status_class = "status01";
            break;
        case '준비':
            $od_status = '상품준비중';
            $od_status_number = 3;
            $od_status_class = "status01";
            break;
        case '배송':
            $od_status = '상품배송';
            $od_status_number = 4;
            $od_status_class = "status03";
            break;
        case '완료':
            $od_status = '배송완료';
            $od_status_number = 5;
            $od_status_class = "status03";
            break;
        default:
            $od_status = '주문취소';
            $od_status_number = 6;
            $od_status_class = "status02";
            break;
    }
    $list[$i]['ct_id'] = $row['ct_id'];
    $list[$i]['od_id'] = $row['od_id'];
    $list[$i]['od_time'] = $row['od_time'];
    $list[$i]['od_cart_count'] = $row['od_cart_count'];
    $list[$i]['od_receipt_price'] = $row['od_receipt_price'];
    $list[$i]['od_misu'] = $row['od_misu'];
    $list[$i]['od_price'] = $row['od_cart_price'] + $row['od_send_cost'] + $row['od_send_cost2'];
    $list[$i]['href'] = G5_SHOP_URL.'/orderinquiryview.php?od_id='.$row['od_id'].'&amp;uid='.$uid;
    $list[$i]['od_status_number'] = $od_status_number;
    $list[$i]['od_status'] = $od_status;
    $list[$i]['od_status_class'] = $od_status_class;

    $od_cart = sql_fetch("select * from g5_shop_cart where od_id = '{$row['od_id']}' order by ct_id asc limit 1");
    $od_cart_item = sql_fetch("select * from g5_shop_item where it_id = '{$od_cart['it_id']}' ");
    $list[$i]['od_it_name'] = $od_cart_item['it_name'];
    $list[$i]['od_it_brand'] = $od_cart_item['it_brand'];
    $list[$i]['od_extra_count'] =  $list[$i]['od_cart_count'] - 1;
    $list[$i]['od_it_name'] = $list[$i]['od_extra_count'] > 0 ? $od_cart_item['it_name']." 외 ".$list[$i]['od_extra_count']."건" : $od_cart_item['it_name'];

}
$count = count((array)$list);


/**
 * 페이징
 */
$paging = $eb->set_paging('/mypage/myorder', '', $qstr);



include_once(G5_PLUGIN_PATH.'/jquery-ui/datepicker.php');

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/mypage/myorder.php');

/**
 * HTML 출력
 */
include_once($eyoom_skin_path['mypage'].'/myorder.skin.html.php');