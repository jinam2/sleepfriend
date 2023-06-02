<?php
/**
 * skin file : /theme/THEME_NAME/skin/shop/basic/orderinquiryview.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * LG 현금영수증 JS
 */
if($od['od_pg'] == 'lg') {
    if($default['de_card_test']) {
        echo '<script language="JavaScript" src="'.SHOP_TOSSPAYMENTS_CASHRECEIPT_TEST_JS.'"></script>'.PHP_EOL;
    } else {
        echo '<script language="JavaScript" src="'.SHOP_TOSSPAYMENTS_CASHRECEIPT_REAL_JS.'"></script>'.PHP_EOL;
    }
}
?>

<style>
.order_view {width:100%; border-radius:5px; background:#fff; padding:40px 40px 30px; border:1px solid #141751; margin:0 0 20px;}
.order_view li {overflow:hidden; padding-bottom:20px;}
.order_view li + li {margin:20px 0 0; border-top:1px solid #dadada; padding-top:30px;}
.order_view li .img {float:left; width:132px; position:relative;}
.order_view li .img img {width:132px; height:auto; border-radius:10px;}
.order_view li .img span {position:absolute; left:50%; bottom:-10px; margin-left:-40px; display:block; width:80px; height:23px; line-height:21px; text-align:center; font-size:12px; font-weight:400; border-radius:20px;}
.order_view li .img span.status01 {background:#141751; color:#fff; border:1px solid #141751;} /* 구매 */
.order_view li .img span.status02 {background:#ffede5; color:#FD4F00; border:1px solid #FD4F00;} /* 보험렌탈 */
.order_view li .img span.status03 {background:#FD4F00; color:#fff; border:1px solid #FD4F00;} /* 비보험렌탈 */
.order_view li .desc {float:left; width:calc(100% - 132px); padding-left:30px;}
.order_view li .desc table {min-height:130px; width:100%; border-collapse:collapse; border-spacing:0;}
.order_view li .desc table td {text-align:center; padding:0 10px; word-break:keep-all;}
.order_view li .desc table.wide td:nth-of-type(1) {width:auto;}
.order_view li .desc table.wide td:nth-of-type(2) {width:100px;}
.order_view li .desc table.wide td:nth-of-type(3) {width:210px;}
.order_view li .desc table.wide td:nth-of-type(4) {width:210px;}
.order_view li .desc table.wide td:nth-of-type(5) {width:150px;}
.order_view li .desc table.wide td:nth-of-type(6) {width:50px;}
.order_view li .desc table td.title {font-weight:600; line-height:150%; text-align:left;}
.order_view li .desc table td.title a {color:#343434;}
.order_view li .desc table td.title strong {font-weight:600; font-size:16px;}
.order_view li .desc table td.title span {font-size:14px; font-weight:500; display:block; margin:0; width:auto; text-align:left;}
.order_view li .desc table td ul {padding:0; font-size:14px; color:#999; margin:6px 0 0;}
.order_view li .desc table td ul li {font-size:14px; color:#999; font-weight:400; line-height:1.2;}
.order_view li .desc table td button {border:0; outline:0; padding:0 10px; background:#000; color:#fff; border-radius:3px; margin:0;}
.order_view li .desc table td span {display:inline-block; margin-left:10px;}
.order_view li .desc table td .price {color:#141751; font-weight:600;}
.order_view .wide {}
.order_view .mob {min-height:auto; display:none;}

@media all and (max-width:1440px) {
	.order_view li .desc {padding-left:20px;}
	.order_view li .desc table.wide td:nth-of-type(2) {width:110px;}
	.order_view li .desc table.wide td:nth-of-type(3) {width:150px;}
	.order_view li .desc table.wide td:nth-of-type(4) {width:150px;}
	.order_view li .desc table.wide td:nth-of-type(5) {width:120px;}
	.order_view li .desc table.wide td:nth-of-type(6) {width:40px;}
	.order_view li .desc table td span {display:block; margin:0 0 4px;}
}
@media all and (max-width:1200px) {
	.order_view {padding:30px 30px 20px;}
	.order_view li .desc {padding-left:15px;}
	.order_view li .desc table.wide td:nth-of-type(2) {width:90px;}
	.order_view li .desc table.wide td:nth-of-type(3) {width:120px;}
	.order_view li .desc table.wide td:nth-of-type(4) {width:120px;}
	.order_view li .desc table.wide td:nth-of-type(5) {width:80px;}
	.order_view li .desc table.wide td:nth-of-type(6) {width:40px;}
	.order_view li .desc table td span {display:block; margin:0 0 4px;}
}
@media all and (max-width:980px) {
	.order_view {padding:20px 20px 15px;}
	.order_view li .desc table {min-height:auto; padding:0 0 10px;}
	.order_view li + li {margin:10px 0 0; padding-top:30px;}
	.order_view li .desc {padding-left:20px;}
	.order_view table.mob {margin:0 0 10px;}
	.order_view .mob th {text-align:left; line-height:25px; word-break:keep-all; font-weight:500; font-size:16px;}
	.order_view .mob td {text-align:right; line-height:25px; color:#5f5f5f; font-size:16px;}
	.order_view .mob td.title {text-align:left; font-size:15px;}
	.order_view .mob td.title span {display:inline-block; font-size:14px; font-weight:400; color:#999;}
	.order_view .mob td label {margin:10px 0 25px;}
	.order_view .mob td button {margin:0;}
	.order_view .mob dl {overflow:hidden; width:100%; padding:0 10px;}
	.order_view .mob dl + dl {margin-top:4px;}
	.order_view .mob dl dt {float:left; width:50%;}
	.order_view .mob dl dd {float:left; width:50%; text-align:right;}
	.order_view .mob dl dd .price {color:#141751;}

	.order_view .wide {display:none;}
	.order_view .mob {display:block;}
}

@media all and (max-width:767px) {
	.order_view .mob td ul {margin:0 0 10px;}
	.order_view .mob td ul li {padding:0; margin:0 0 10px;}
	.order_view .mob td button {}
}

@media (max-width:576px) {
	.order_view li {padding-left:0;}
	.order_view li .img {width:90px;}
	.order_view li .img img {width:90px;}
	.order_view li .img span {margin-left:-35px; width:70px;}
	.order_view li .desc {width:calc(100% - 90px); padding-left:5px;}
}

@media (max-width:400px) {
	.order_view {padding:20px 10px 15px 20px;}
	.order_view .mob td.title {font-size:14px;}
	.order_view .mob td.title span {font-size:13px;}
	.order_view .mob td ul li {font-size:13px;}
	.order_view .mob dl dt {width:60px;font-size:13px;}
	.order_view .mob dl dd {width:calc(100% - 60px); text-align:left;font-size:13px;}
}

.shop-order-inquiry-view {}
.shop-order-inquiry-view h4 {font-size:24px; color:#000; line-height:1; padding:0 0 20px; border-bottom:1px solid rgba(20,23,81,0.3); margin:0 0 40px; font-weight:700;}
.shop-order-inquiry-view h5 {position:relative; font-size:16px; color:#5F5F5F; padding:0 0 0 14px; margin:0 0 20px}
.shop-order-inquiry-view h5:before {content:""; display:block; position:absolute; top:7px; left:2px; width:4px;height:4px; border-radius:5px; background:#5F5F5F; border-radius:5px;}

.shop-order-inquiry-view .order_num {width:100%; border-radius:5px; background:#fff; font-weight:600; padding:20px; border:1px solid #141751; margin:0 0 50px;}
.shop-order-inquiry-view .order_complete {margin:60px 0 100px; text-align:center}
.shop-order-inquiry-view .order_complete img {margin:0 0 30px}
.shop-order-inquiry-view .order_complete p {font-size:24px; color:#000; line-height:130%; font-weight:600;}
.shop-order-inquiry-view .frame {overflow:hidden; width:100%; margin:60px 0 0;}
.shop-order-inquiry-view .delivery {float:left; width:48%;}
.shop-order-inquiry-view .delivery table {width:100%; border-collapse:collapse; border-spacing:0; border-top:1px solid #141751; border-bottom:1px solid #eaeaea;}
.shop-order-inquiry-view .delivery table th {padding:10px 15px; font-weight:600; width:120px; font-size:16px; color:#333; vertical-align:top; line-height:40px;}
.shop-order-inquiry-view .delivery table td {padding:10px 15px; line-height:40px;}
.shop-order-inquiry-view .delivery table td.address {padding:20px 15px; line-height:120%;}

.shop-order-inquiry-view .info {float:left; width:48%; margin-left:4%;}
.shop-order-inquiry-view .info table {width:100%; border-collapse:collapse; border-spacing:0; border-top:1px solid #141751; border-bottom:1px solid #c4c4c4;}
.shop-order-inquiry-view .info table + h5 {margin-top:50px}
.shop-order-inquiry-view .info table tr:first-child th, .shop-order-inquiry-view .info table tr:first-child td {padding-top:20px;}
.shop-order-inquiry-view .info table tr:last-child th, .shop-order-inquiry-view .info table tr:last-child td {padding-bottom:20px;}
.shop-order-inquiry-view .info table th {padding:10px 15px; font-weight:600; width:150px; font-size:16px; color:#333; line-height:40px;  vertical-align:top;}
.shop-order-inquiry-view .info table td {padding:10px 15px; line-height:40px;vertical-align:top;}
.shop-order-inquiry-view .info table.table {}
.shop-order-inquiry-view .info table.table tr {border-bottom:1px solid #eaeaea;}
.shop-order-inquiry-view .info table.table tr:first-child th, .shop-order-inquiry-view .info table.table tr:first-child td {padding-top:10px;}
.shop-order-inquiry-view .info table.table tr:last-child th, .shop-order-inquiry-view .info table.table tr:last-child td {padding-bottom:10px;}
.shop-order-inquiry-view .info table.table th {width:50%;}
.shop-order-inquiry-view .info table.table td {text-align:right; font-size:14px; line-height:40px;}
.shop-order-inquiry-view .info table.table th.total {font-size:16px; font-weight:700;}
.shop-order-inquiry-view .info table.table td.total {font-size:16px; font-weight:700; color:#141751;}
.shop-order-inquiry-view .info p.caution {margin:0 0 40px; color:#c00000;}

.shop-order-inquiry-view .info .order-payment-cancel {display:block; width:100%; margin:60px 0 0; overflow:hidden;}
.shop-order-inquiry-view .info .order-payment-cancel .sod_fin_c_btn {width:100%; display:block; height:58px; line-height:58px; border:1px solid #141751; font-size:16px; text-align:center; outline:none; border-radius:5px; font-weight:600; cursor:pointer; background:#141751; color:#fff;}


@media (max-width:767px) {
	.shop-order-inquiry-view h4 {font-size:16px;padding:0 0 16px;margin:0 0 30px;}
	.shop-order-inquiry-view h5 {margin:0 0 14px}
	.shop-order-inquiry-view .order_complete {margin:50px 0 70px;}
	.shop-order-inquiry-view .order_complete p {font-size:16px;}
}

@media (max-width:1200px) {
	.shop-order-inquiry-view .info table th {width:120px;}
	.shop-order-inquiry-view .delivery table th {width:100px;}
}

@media (max-width:767px) {
	.shop-order-inquiry-view .order_complete {margin:50px 0 70px;}
	.shop-order-inquiry-view .order_complete p {font-size:16px;}
	.shop-order-inquiry-view .frame {margin:60px 0 0;}
	.shop-order-inquiry-view .delivery {float:none; width:100%;}
	.shop-order-inquiry-view .delivery table th {width:70px; font-size:14px; padding:10px 0;}
	.shop-order-inquiry-view .delivery table td {padding:10px 0;}
	.shop-order-inquiry-view .delivery table.table th.total {font-size:14px;}
	.shop-order-inquiry-view .delivery table.table td.total {font-size:14px;}
	.shop-order-inquiry-view .delivery table td.address {padding:20px 0px;}

	.shop-order-inquiry-view .info {float:none; width:100%; margin:40px 0 0;}
	.shop-order-inquiry-view .info table th {width:90px; font-size:14px; padding:10px 0;}
	.shop-order-inquiry-view .info table td { padding:10px 0;}
	.shop-order-inquiry-view .info table.table th.total {font-size:14px;}
	.shop-order-inquiry-view .info table.table td.total {font-size:14px;}

	.shop-order-inquiry-view .order-total {margin:30px 0 0; padding:20px 0 0;}
	.shop-order-inquiry-view .info .order-payment-cancel {margin:30px 0 0;}
	.shop-order-inquiry-view .info .order-payment-cancel .recent, .order .info .cart-act-btn .add {float:none; width:100%;}
	.shop-order-inquiry-view .info .order-payment-cancel .add {margin:16px 0 0;}
}

#sod_cancel_pop {display:none;position:relative}
#sod_fin_cancelfrm form {padding:0}
.shop-order-inquiry-view .order-payment-cancel h2 {position:absolute;font-size:0;line-height:0;overflow:hidden}
.shop-order-inquiry-view .order-payment-cancel button {width:100%; display:block; height:58px; line-height:58px; border:1px solid #141751; font-size:16px; text-align:center; outline:none; border-radius:5px; font-weight:600; cursor:pointer; background:#333; color:#fff;}

.shop-order-inquiry-view .order-payment-cancel #sod_fin_cancelfrm {display:block;position:relative;top:inherit;left:inherit;width:100%;margin:20px 0 0;padding:0;background:none;box-shadow:0 0 0 #fff;border:0 none}
.shop-order-inquiry-view .order-payment-cancel #sod_fin_cancelfrm input[type=text] {width:100%; height:40px; line-height:40px; background:#F6F6F6; font-size:14px; color:#5F5F5F; border:none !important; outline:none; padding-left:10px; border-radius:5px; box-shadow:none;}

.shop-order-inquiry-view .order-payment-cancel #sod_fin_cancelfrm input[type=submit] {width:100%; display:block; height:40px; line-height:40px; border:1px solid #c4c4c4; font-size:16px; text-align:center; outline:none; border-radius:5px; font-weight:600; cursor:pointer; background:#f2f2f2; color:#333; margin-top:6px;}

.shop-order-inquiry-view #sod_fin_test {padding:0;margin-top:20px}

</style>

<div class="shop-order-inquiry-view">

	<h4>주문완료</h4>

	<div class="order_complete">
		<img src="/images/order_complete.png">
		<p>주문이 완료되었습니다. <br>구매하신 제품은 안전하게 배송해드리겠습니다.</p>
	</div>

	<h5>주문번호</h5>
	<div class="order_num">
	<?php echo $od_id; ?>
	</div>

	<h5>상품정보</h5>
	<ul class="order_view">
		<?php for ($i=0; $i<$order_count; $i++) { ?>
		<?php foreach ($order[$i]['option'] as $k => $opt) { ?>
		<?php if ($k==0) { ?><?php } ?>
		<li>
			<div class="img">
				<div class="tag"><span class="status01">구매</span><!--span class="status02">보험렌탈</span><span class="status03">비보험렌탈</span--></div>
				<a href="./item.php?it_id=<?php echo $order[$i]['it_id']; ?>"><?php echo $order[$i]['image']; ?></a>
			</div>
			<div class="desc">
				<table class="wide">
					<tr>
						<td class="title">
							<a href="<?php echo shop_item_url($list[$i]['it_id']); ?>">
								<a href="./item.php?it_id=<?php echo $order[$i]['it_id']; ?>">
								<span>[레드메드]</span>
								<strong><?php echo $order[$i]['it_name']; ?></strong>
							</a>
						</td>
						<td>수량  <?php echo number_format($opt['ct_qty']); ?>개</td>
						<td>구매가격<span><?php echo number_format($opt['opt_price']); ?>원</span></td>
						<td>결제가격<span class="price"><?php echo number_format($opt['sell_price']); ?>원</span></td>
						<td>배송비<span><?php echo number_format($opt['ct_send_cost']); ?></span></td>
					</tr>
				</table>

				<table class="mob">
					<tr>
						<td colspan="2" class="title">
							<a href="<?php echo shop_item_url($list[$i]['it_id']); ?>">
								<span>[레드메드]</span>
								<strong><?php echo $order[$i]['it_name']; ?></strong>
							</a>
						</td>
					</tr>
				</table>
				<div class="mob">
					<dl>
						<dt>수량</dt>
						<dd><?php echo number_format($opt['ct_qty']); ?>개</dd>
					</dl>

					<dl>
						<dt>구매가격</dt>
						<dd><?php echo number_format($opt['opt_price']); ?>원</dd>
					</dl>

					<dl>
						<dt>결제가격</dt>
						<dd><span class="price"><?php echo number_format($opt['sell_price']); ?>원</dd>
					</dl>

					<dl>
						<dt>배송비</dt>
						<dd><?php echo number_format($opt['ct_send_cost']); ?></dd>
					</dl>
				</div>
			</div>
		</li>
		<?php } ?>
		<?php } ?>
	</ul>

	<div class="frame">
		<div class="delivery">
			<h5>배송지 정보</h5>
			<table class="table">
				<tr>
					<th>수령인</th>
					<td><?php echo get_text($od['od_b_name']); ?></td>
				</tr>

				<tr>
					<th>연락처</th>
					<td><?php echo get_text($od['od_b_hp']); ?></td>
				</tr>

				<tr>
					<th>배송지</th>
					<td class="address"><?php echo get_text(sprintf("(%s%s)", $od['od_b_zip1'], $od['od_b_zip2']).' '.print_address($od['od_b_addr1'], $od['od_b_addr2'], $od['od_b_addr3'], $od['od_b_addr_jibeon'])); ?></td>
				</tr>

				<tr>
					<th>배송메모</th>
					<td><?php echo conv_content($od['od_memo'], 0); ?></td>
				</tr>
			</table>
		</div>

		<div class="info">
			<h5>결제 정보</h5>
			<table class="table">
				<tr><th class="total">상품금액 합계</th><td class="total"><?php echo number_format($tot_price); ?>원</td></tr>
				<tr><th>배송비</th><td><?php echo number_format($od['od_send_cost']); ?>원</td></tr>
				<tr><th>할인금액</th><td>-0원</td></tr>
				<tr><th>결제금액</th><td><?php echo number_format($tot_price); ?>원</td></tr>
				<tr><th>결제수단</th><td><?php echo check_pay_name_replace($od['od_settle_case'], $od, 1); ?></td></tr>
				<?php if($od['od_receipt_price'] > 0) { ?>
				<tr><th>결제일시</th><td><?php echo $od['od_receipt_time']; ?></td></tr>
				<?php } ?>
			</table>

			<p class="caution">렌탈 제품은 계약 진행을 위해 해피콜 전화를 드립니다.  <br>해피콜 완료 후 결제 및 배송되오니 1670-3171 전화를 꼭 받아주세요.</p>

			<div class="order-payment-cancel">
                <?php
                // 취소한 내역이 없다면
                if ($cancel_price == 0) {
                    if ($custom_cancel) {
                ?>
                <button type="button" class="sod_fin_c_btn">주문 취소하기</button>

                <div id="sod_cancel_pop">
                    <div id="sod_fin_cancelfrm">
                        <h2>주문취소</h2>
                        <form method="post" action="<?php echo G5_SHOP_URL; ?>/orderinquirycancel.php" onsubmit="return fcancel_check(this);" class="eyoom-form">
                        <input type="hidden" name="od_id"  value="<?php echo $od['od_id']; ?>">
                        <input type="hidden" name="token"  value="<?php echo $token; ?>"><input type="text" name="cancel_memo" id="cancel_memo" required size="40" maxlength="100" placeholder="취소사유">
                        <input type="submit" value="확인">
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
                <?php
                    }
                } else {
                ?>
                <div class="cont-text-bg">
                    <p class="bg-danger"><i class="fas fa-exclamation-circle"></i> 주문 취소, 반품, 품절된 내역이 있습니다.</p>
                </div>
                <?php } ?>
			</div>
		</div>

	</div>

</div>

<script>
$(function() {
    $("#state_explan_open").on("click", function() {
        var $explan = $("#state_explan_box");
        if($explan.is(":animated"))
            return false;

        if($explan.is(":visible")) {
            $explan.slideUp(200);
            $("#state_explan_open").text("상태설명보기");
        } else {
            $explan.slideDown(200);
            $("#state_explan_open").text("상태설명닫기");
        }
    });

    $("#state_explan_close").on("click", function() {
        var $explan = $("#state_explan_box");
        if($explan.is(":animated"))
            return false;

        $explan.slideUp(200);
        $("#state_explan_open").text("상태설명보기");
    });
});

function fcancel_check(f) {
    if(!confirm("주문을 정말 취소하시겠습니까?"))
        return false;

    var memo = f.cancel_memo.value;
    if(memo == "") {
        alert("취소사유를 입력해 주십시오.");
        return false;
    }

    return true;
}
</script>