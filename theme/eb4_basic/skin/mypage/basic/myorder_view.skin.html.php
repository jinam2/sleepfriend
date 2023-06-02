<?php
// 총계 = 주문상품금액합계 + 배송비 - 상품할인 - 결제할인 - 배송비할인
$tot_price = $od['od_cart_price'] + $od['od_send_cost'] + $od['od_send_cost2']
    - $od['od_cart_coupon'] - $od['od_coupon'] - $od['od_send_coupon']
    - $od['od_cancel_price'];

$tot_dis_price =  $od['od_cart_coupon'] + $od['od_coupon'] + $od['od_send_coupon'];
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


$token = md5(uniqid(rand(), true));
set_session("ss_token", $token);

// 결제정보처리
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




/*
 *
주문, 입금, 준비, 배송, 완료, 취소, 반품, 품절
Discription 개발 필요사항
주문의 상태에 따라 아래 버튼의 노출 여부가 결정됨.
condition #1
 - 고객이 주문을 했는데 아직 입금이 되지 않은 경우 : ‘주문취소’, ‘주문내역 가기’ 버튼 노출.
 - ‘주문취소’ 버튼을 누른 경우 : 상품 문의 폼(카테고리 value : 주문취소 요청) 출력
condition #2
- 주문한 상품이 배송준비중, 배송중, 배송완료(14일 경과 이전) 상태인경우 : ‘교환/환불 요청’, ‘주문내역 가기’ 버튼 노출.
- ‘교환/환불 요청’ 버튼을 누른 경우 : 상품 문의 폼(카테고리 value : 교환/환불 요청) 출력
condition #3
- 주문한 상품이 구매완료 상태인 경우(배송완료 후 14일 이후) : ‘주문내역 가기’ 버튼만 출력
- ‘주문내역 가기’ 버튼을 누른 경우 : 목록으로 돌아가기

*/

$cancel_link = "";
$direct_cancel = false;
$refund_link = "";
$detail_link = "";

$cancel_price = $od['od_cancel_price'];

if($st_count1 > 0 && $st_count1 == $st_count2) {
    $custom_cancel = true;
}

if($od['od_status'] == "주문" ) {
    if($od['od_cancel_price'] == 0 && $custom_cancel) {
        $direct_cancel = true;
    } else {
        $cancel_link = G5_URL."/mypage/inquiry_write.php?category_type=1&od_id=".$od['od_id']."&it_id=".$od['it_id'];
    }
} else if($od['od_status'] == "입금" && $od['od_status'] == "준비" ||  $od['od_status'] == "배송" || $od['od_status'] == "완료") {
    $refund_link = G5_URL."/mypage/inquiry_write.php?category_type=2&od_id=".$od['od_id']."&it_id=".$od['it_id'];

    if($od['od_status'] == "완료") {
        //배송완료 14일이 지났는지를 체크
        if($od['od_complete_datetime'] && time() >  strtotime($od['od_complete_datetime']) + (86400*14) ) {
            $refund_link = "";
        }
    }
} else {

}

?>
<style>
     .order-payment-cancel {display:block; width:80%; margin:0px 0 0; overflow:hidden; float:right}
     .sod_fin_c_btn {margin-top:5px !important; display:block; height:58px; line-height:58px; border:1px solid #141751; font-size:16px; text-align:center; outline:none; border-radius:5px; font-weight:600; cursor:pointer; background:#141751; color:#fff;}

     #sod_cancel_pop {display:none;position:relative}
     #sod_fin_cancelfrm form {padding:0}

     @media (max-width:767px) {
         .order-payment-cancel {margin:30px 0 0;}
         .order-payment-cancel .recent, .order .info .cart-act-btn .add {float:none; width:100%;}
         .order-payment-cancel .add {margin:16px 0 0;}
     }
     .order-payment-cancel h2 {position:absolute;font-size:0;line-height:0;overflow:hidden}
     .order-payment-cancel button {width:100%; display:block; height:58px; line-height:58px; border:1px solid #141751; font-size:16px; text-align:center; outline:none; border-radius:5px; font-weight:600; cursor:pointer; background:#333; color:#fff;}

     .order-payment-cancel #sod_fin_cancelfrm {display:block;position:relative;top:inherit;left:inherit;width:100%;margin:20px 0 0;padding:0;background:none;box-shadow:0 0 0 #fff;border:0 none}
     .order-payment-cancel #sod_fin_cancelfrm input[type=text] {width:100%; height:40px; line-height:40px; background:#F6F6F6; font-size:14px; color:#5F5F5F; border:none !important; outline:none; padding-left:10px; border-radius:5px; box-shadow:none;}
     .order-payment-cancel #sod_fin_cancelfrm input[type=submit] {width:100%; display:block; height:40px; line-height:40px; border:1px solid #c4c4c4; font-size:16px; text-align:center; outline:none; border-radius:5px; font-weight:600; cursor:pointer; background:#f2f2f2; color:#333; margin-top:6px;}

     .order_view li .img span {
            display: inline-block;
            width: 100%;
            height: 100%;
            background: #fff;
            opacity: 0.8;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 1;
     }
 .view_btn .button {margin-bottom:6px;}
</style>
<!-- 페이지 타이틀 -->
<div class="page_navi">
    <div><span><a href="/">홈</a></span><span><a href="/mypage/contract.php">마이페이지</a></span><span>주문/배송조회</span><span>주문내역</span></div>
</div>

<!-- 마이페이지 1차메뉴 오픈 -->
<div id="dropmenu">
    <ul>
        <li><a href="/mypage/sleep_data.php">My 슬립케어</a></li>
        <li><a href="/mypage/reservation.php">예약 내역</a></li>
        <li><a href="/mypage/myinfo.php">나의 정보</a></li>
        <li><a href="/mypage/myorder.php">주문/배송조회</a></li>
    </ul>
</div>

<script>
    $(function() {
        $("#btn_nav a").click(function (e) {
            if($(this).hasClass("open")) {
                $(this).removeClass("open").addClass("close");
                $("#dropmenu").css({"display": "block"});
            } else {
                $(this).removeClass("close").addClass("open");
                $("#dropmenu").css({"display": "none"});
            }
        });
    });
</script>

<div class="page_title">
    <h2 class="wide">주문내역</h2>
    <h2 class="mob">주문/배송조회 <div id="btn_nav"><a href="javascript:;" class="open"></a></div></h2>
    <div class="menu mob">
        <div>
            <a href="/mypage/myorder.php" class="active">주문내역</a>
            <!--a href="#">취소/교환/반품</a-->
            <a href="/mypage/inquiry.php">상품 문의</a>
            <a href="/mypage/review.php">내가 남긴 리뷰</a>
        </div>
    </div>
</div>

<div id="mypage" class="order1">
    <div class="my_left">
        <ul>
            <li><a href="/mypage/sleep_data.php">My 슬립케어</a></li>
            <li><a href="/mypage/reservation.php">예약 내역</a></li>
            <li><a href="/mypage/myinfo.php">나의 정보</a></li>
            <li class="active"><a href="/mypage/myorder.php">주문/배송조회</a>
                <ul>
                    <li class="on"><a href="/mypage/myorder.php">주문내역</a></li>
                    <li><!--a href="#">취소/교환/반품</a--></li>
                    <li><a href="/mypage/inquiry.php">상품 문의</a></li>
                    <li><a href="/mypage/review.php">내가 남긴 리뷰</a></li>
                </ul>
            </li>
        </ul>
    </div>

    <div class="my_right inner">
        <h3>주문상세정보</h3>
        <div class="order_top">
            <dl>
                <dt>주문일자</dt><dd><?=substr($od['od_time'], 0, 10)?></dd>
                <dt>주문번호</dt><dd><?=$od_id?></dd>
            </dl>
        </div>

        <p class="s_title">상품정보</p>
        <ul class="order_view">
            <?php for ($i=0; $i<$order_count; $i++) { ?>
            <?php foreach ($order[$i]['option'] as $k => $opt) { ?>
            <?php if ($k==0) { ?><?php } ?>
            <li>
                <div class="img">
                    <div class="tag"><span class="<?=$status_class_arr[$opt['ct_status']]?>"><?=$opt['ct_status']?></span></div>
                    <a href="/shop/item.php?it_id=<?php echo $order[$i]['it_id']; ?>"><?php echo $order[$i]['image']; ?></a>
                </div>
                <div class="desc">
                    <table class="wide">
                        <tr>
                            <td class="title"><span>[ <?php echo $order[$i]['it_brand']; ?> ]</span><?php echo $order[$i]['it_name']; ?></td>
                            <td>수량  <?php echo number_format($opt['ct_qty']); ?>개</td>
                            <td>구매가격<span><?php echo number_format($opt['opt_price']); ?>원</span></td>
                            <td>결제가격<span class="price"><?php echo number_format($opt['sell_price']); ?>원</span></td>
                            <td>배송비<span><?php echo number_format($opt['ct_send_cost']); ?>원</span></td>
                        </tr>
                    </table>

                    <table class="mob">
                        <tr>
                            <td colspan="2" class="title"><span>[ <?php echo $order[$i]['it_brand']; ?>  ]</span><?php echo $order[$i]['it_name']; ?></td>
                        </tr>

                        <tr>
                            <th>수량</th>
                            <td><?php echo number_format($opt['ct_qty']); ?>개</td>
                        </tr>

                        <tr>
                            <th>구매가격</th>
                            <td><span><?php echo number_format($opt['opt_price']); ?>원</span></td>
                        </tr>

                        <tr>
                            <th>결제가격</th>
                            <td><span class="price"><?php echo number_format($opt['sell_price']); ?>원</span></td>
                        </tr>

                        <tr>
                            <th>배송비</th>
                            <td><span><?php echo number_format($opt['ct_send_cost']); ?>원</span></td>
                        </tr>
                    </table>
                </div>
            </li>
            <?php } ?>
            <?php } ?>
        </ul>

        <div class="frame">
            <div class="delivery">
                <p class="s_title">배송지정보</p>
                <table class="table02">
                    <tr><th>수취인</th><td><?php echo get_text($od['od_b_name']); ?></td></tr>
                    <tr><th>연락처</th><td><?php echo get_text($od['od_b_hp']); ?></td></tr>
                    <tr><th>배송지</th><td><?php echo get_text(sprintf("(%s%s)", $od['od_b_zip1'], $od['od_b_zip2']).' '.print_address($od['od_b_addr1'], $od['od_b_addr2'], $od['od_b_addr3'], $od['od_b_addr_jibeon'])); ?></td></tr>
                    <tr><th>배송메모</th><td><?php echo conv_content($od['od_memo'], 0); ?></td></tr>
                </table>
            </div>

            <div class="delivery">
                <p class="s_title">결제정보</p>
                <table class="table02">
                    <tr><th>상품금액 합계</th><td class="price right"><?php echo number_format($tot_price); ?>원</td></tr>
                    <tr><th>배송비</th><td class="right"><?php echo number_format($od['od_send_cost']); ?>원</td></tr>
                    <tr><th>할인금액</th><td class="right">-<?php echo number_format($tot_dis_price);?>원</td></tr>
                    <tr><th>결제금액</th><td class="right"><?php echo number_format($od['od_receipt_price']); ?>원</td></tr>
                    <tr><th>결제수단</th><td class="right"><?php echo check_pay_name_replace($od['od_settle_case'], $od, 1); ?></td></tr>
                </table>
                <p class="txt">렌탈 제품은 계약 진행을 위해 해피콜 전화를 드립니다.<br>해피콜 완료 후 결제 및 배송되오니 1670-3171 전화를 꼭 받아주세요.</p>
            </div>
        </div>

        <div class="view_btn">
            <a href="/mypage/myorder.php" class="button">주문내역 가기</a>
            <?php if($detail_link) { ?>
                <a href="<?=$detail_link?>" class="button">주문상세</a>
            <?php } ?>
            <?php if($direct_cancel) { ?>
                <a href="javascript:;" class="button sod_fin_c_btn">주문취소</a>
            <?php } ?>

            <?php if($cancel_link) { ?>
                <a href="<?=$cancel_link?>" class="button">주문취소</a>
            <?php } ?>

            <?php if($refund_link) { ?>
                <a href="<?=$refund_link?>" class="button">교환/환불 요청</a>
            <?php } ?>


        </div>

        <?php
        // 취소한 내역이 없다면
        if ($direct_cancel) { ?>
            <div class="order-payment-cancel">
                <div id="sod_cancel_pop">
                    <div id="sod_fin_cancelfrm">
                        <h2>주문취소</h2>
                        <form method="post" action="<?php echo G5_SHOP_URL; ?>/orderinquirycancel.php" onsubmit="return fcancel_check(this);" class="eyoom-form">
                            <input type="hidden" name="od_id"  value="<?php echo $od['od_id']; ?>">
                            <input type="hidden" name="token"  value="<?php echo $token; ?>"><input type="text" name="cancel_memo" id="cancel_memo" required size="40" maxlength="100" placeholder="취소사유">
                            <input type="submit" value="주문취소">
                        </form>
                    </div>
                </div>
                <script>
                    $(function (){
                        $(".sod_fin_c_btn").on("click", function() {
                            $("#sod_cancel_pop").show();
                        });
                        $(".sod_cls_btn").on("click", function() {
                            $("#sod_cancel_pop").hide();
                        });
                    });
                </script>
            </div>
            <?php
        }
        ?>

    </div>

</div>

