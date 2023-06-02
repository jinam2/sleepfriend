<?php
ini_set('display_errors', 1);
/**
 * core file : /eyoom/core/mypage/inquiry_write.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 회원체크
 */
if (!$is_member) alert('상품문의는 회원만 작성 가능합니다.',G5_URL);

$action_url = G5_SHOP_URL.'/itemqaformupdate.php';

$w     = preg_replace('/[^0-9a-z]/i', '', trim($_REQUEST['w']));
$it_id = get_search_string(trim($_REQUEST['it_id']));
$iq_id = preg_replace('/[^0-9]/', '', trim($_REQUEST['iq_id']));
$iq_category_type = preg_replace('/[^0-9]/', '', trim($_REQUEST['category_type']));
$od_id = preg_replace('/[^0-9]/', '', trim($_REQUEST['od_id']));

$iq_category_type_names = [
    '0' => '상품 문의',
    '1' => '주문취소 요청',
    '2' => '교환/환불 요청',
];

if($od_id) {
    $sql = "select * 
            from {$g5['g5_shop_order_table']} order, left join {$g5['g5_shop_cart_table']} cart on (order.od_id = cart.od_id and cart.ct_it_id  = '{$it_id}')
            where od_id = '{$od_id}' and mb_id = '{$member['mb_id']}'";
    $order = sql_fetch($sql);
}

$iq_category = $iq_category_type_names[$iq_category_type];
if(!$iq_category) {
    $iq_category = $iq_category_type_names['0'];
}


if($w != '' && $w != 'u') {
    alert('올바른 방법으로 이용해 주십시오.');
}

if($w == '') {
    $qa['iq_email'] = $member['mb_email'];
    $qa['iq_hp'] = $member['mb_hp'];

    $qa['iq_category'] = $iq_category;


    $it = get_shop_item($it_id, true);
    $cate = sql_fetch("select * from g5_shop_category where ca_id = '{$it['ca_id']}' ");

}


if ($w == "u")
{
    $qa = sql_fetch(" select * from {$g5['g5_shop_item_qa_table']} where iq_id = '$iq_id' ");
    if (!$qa) {
        alert("상품문의 정보가 없습니다.");
    }

    $it_id    = $qa['it_id'];
    $od_id    = $qa['od_id'];
    $iq_category = $qa['iq_category'];


    $it = get_shop_item($it_id, true);
    $cate = sql_fetch("select * from g5_shop_category where ca_id = '{$it['ca_id']}' ");


    if (!$is_admin && $qa['mb_id'] != $member['mb_id']) {
        alert("자신의 상품문의만 수정이 가능합니다.");
    }

    if($qa['iq_secret']) {
        $chk_secret = 'checked="checked"';
    }
}


//주문에 대한 취소 환불 요청인 경우, 주문정보를 노출한다.
if($iq_category == "주문취소 요청" || $iq_category == "교환/환불 요청") {

    $st_count1 = $st_count2 = 0;
    $custom_cancel = false;

    $sql = "select * from {$g5['g5_shop_order_table']} where od_id='{$od_id}' and mb_id='{$member['mb_id']}' ";
    $od = sql_fetch($sql);
    $sql = " select it_id, it_name, ct_send_cost, it_sc_type
            from {$g5['g5_shop_cart_table']}
            where od_id = '$od_id'
            group by it_id
            order by ct_id ";

    $result = sql_query($sql);
    $order = array();
    for($i=0; $row=sql_fetch_array($result); $i++) {
        $image = get_it_image($row['it_id'], 200, 0);

        $item = get_shop_item($row['it_id']);


        $sql = " select ct_id, it_name, ct_option, ct_qty, ct_price, ct_point, ct_status, io_type, io_price
				from {$g5['g5_shop_cart_table']}
				where od_id = '$od_id'
					and it_id = '{$row['it_id']}'
				order by io_type asc, ct_id asc ";
        $res = sql_query($sql);
        $rowspan = sql_num_rows($res) + 1;

        // 합계금액 계산
        $sql = " select SUM(IF(io_type = 1, (io_price * ct_qty), ((ct_price + io_price) * ct_qty))) as price,
					SUM(ct_qty) as qty
				from {$g5['g5_shop_cart_table']}
				where it_id = '{$row['it_id']}'
					and od_id = '$od_id' ";
        $sum = sql_fetch($sql);

        // 배송비
        switch($row['ct_send_cost'])
        {
            case 1:
                $ct_send_cost = '착불';
                break;
            case 2:
                $ct_send_cost = '무료';
                break;
            default:
                $ct_send_cost = '선불';
                break;
        }

        // 조건부무료
        if($row['it_sc_type'] == 2) {
            $sendcost = get_item_sendcost($row['it_id'], $sum['price'], $sum['qty'], $od_id);

            if($sendcost == 0)
                $ct_send_cost = '무료';
        }

        $order[$i] = $row;
        $order[$i]['rowspan'] = $rowspan;
        $order[$i]['image'] = $image;
        $order[$i]['ct_send_cost'] = $ct_send_cost;
        $order[$i]['it_brand'] = $item['it_brand'];

        $loop = &$order[$i]['option'];
        for($k=0; $opt=sql_fetch_array($res); $k++) {
            if($opt['io_type'])
                $opt_price = $opt['io_price'];
            else
                $opt_price = $opt['ct_price'] + $opt['io_price'];

            $sell_price = $opt_price * $opt['ct_qty'];
            $point = $opt['ct_point'] * $opt['ct_qty'];

            $loop[$k] = $opt;
            $loop[$k]['opt_price'] = $opt_price;
            $loop[$k]['sell_price'] = $sell_price;
            $loop[$k]['point'] = $point;

            $tot_point += $point;

            $st_count1++;
            if($opt['ct_status'] == '주문')
                $st_count2++;
        }
        $order[$i]['cnt'] = count((array)$loop);
    }
    $order_count = count((array)$order);

    /**
     * 주문 상품의 상태가 모두 주문이면 고객 취소 가능
     */
    if($st_count1 > 0 && $st_count1 == $st_count2)
        $custom_cancel = true;

    /**
     * 결제/배송 정보
     *
     * 총계 = 주문상품금액합계 + 배송비 - 상품할인 - 결제할인 - 배송비할인
     */
    $tot_price = $od['od_cart_price'] + $od['od_send_cost'] + $od['od_send_cost2']
        - $od['od_cart_coupon'] - $od['od_coupon'] - $od['od_send_coupon']
        - $od['od_cancel_price'];

    $receipt_price  = $od['od_receipt_price']
        + $od['od_receipt_point'];
    $cancel_price   = $od['od_cancel_price'];

    $misu = true;
    $misu_price = $tot_price - $receipt_price;

    if ($misu_price == 0 && ($od['od_cart_price'] > $od['od_cancel_price'])) {
        $wanbul = " (완불)";
        $misu = false; // 미수금 없음
    }
    else
    {
        $wanbul = display_price($receipt_price);
    }

    /**
     * 결제정보처리
     */
    if($od['od_receipt_price'] > 0)
        $od_receipt_price = display_price($od['od_receipt_price']);
    else
        $od_receipt_price = '아직 입금되지 않았거나 입금정보를 입력하지 못하였습니다.';

    $app_no_subj = '';
    $disp_bank = true;
    $disp_receipt = false;
    if($od['od_settle_case'] == '신용카드' || $od['od_settle_case'] == 'KAKAOPAY' || is_inicis_order_pay($od['od_settle_case']) ) {
        $app_no_subj = '승인번호';
        $app_no = $od['od_app_no'];
        $disp_bank = false;
        $disp_receipt = true;
    } else if($od['od_settle_case'] == '간편결제') {
        $app_no_subj = '승인번호';
        $app_no = $od['od_app_no'];
        $disp_bank = false;
    } else if($od['od_settle_case'] == '휴대폰') {
        $app_no_subj = '휴대폰번호';
        $app_no = $od['od_bank_account'];
        $disp_bank = false;
        $disp_receipt = true;
    } else if($od['od_settle_case'] == '가상계좌' || $od['od_settle_case'] == '계좌이체') {
        $app_no_subj = '거래번호';
        $app_no = $od['od_tno'];

        if( function_exists('shop_is_taxsave') && $misu_price == 0 && shop_is_taxsave($od, true) === 2 ){
            $disp_receipt = true;
        }
    }

}


$qa['it_name'] = $it['it_name'];
$qa['it_brand'] = $it['it_brand'];

$qa['ca_name'] = $cate['ca_name'];
$qa['it_image'] = get_it_image($it['it_id'], 80, 80);
$qa['it_basic'] = $it['it_basic'];

$token = _token();
set_session('ss_qa_write_token', $token);


$editor_html = editor_html('iq_question', get_text(html_purifier($qa['iq_question']), 0), $is_dhtml_editor);
$editor_js = '';
$editor_js .= get_editor_js('iq_question', $is_dhtml_editor);
$editor_js .= chk_editor_js('iq_question', $is_dhtml_editor);


$list_href = G5_URL.'/mypage/inquiry.php'.preg_replace('/^&amp;/', '?', $qstr);

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/mypage/inquiry_write.php');

/**
 * HTML 출력
 */
include_once($eyoom_skin_path['mypage'].'/inquiry_write.skin.html.php');