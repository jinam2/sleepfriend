<?php
/**
 * skin file : /theme/THEME_NAME/skin/shop/basic/cart.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/sweetalert2/sweetalert2.min.css" type="text/css" media="screen">',0);
?>

<style>
.shop-cart h4 {font-size:24px; color:#000; line-height:1; padding:0 0 20px; border-bottom:1px solid rgba(20,23,81,0.3); margin:0 0 20px; font-weight:700;}
.shop-cart ul.desc {margin:0 0 50px;}
.shop-cart ul.desc li {position:relative; padding:0 0 0 14px; font-size:16px; color:#5F5F5F; line-height:1.3;}
.shop-cart ul.desc li + li {margin-top:6px;}
.shop-cart ul.desc li:before {content:'·'; position:absolute; left:2px; top:0; font-size:20px; line-height:1; font-weight:700;}

@media (max-width:767px) {
	.shop-cart h4 {font-size:16px; padding:0 0 15px;}
	.shop-cart ul {margin:0 0 30px;}
	.shop-cart li {padding:0 0 0 12px; font-size:14px;}
	.shop-cart li:before {font-size:18px;}
}

<?php if (!G5_IS_MOBILE) { // 모바일이 아닐경우 ?>
.shop-cart .eyoom-form .checkbox i {top:-8px}
.shop-cart .table-list-eb .table {margin-bottom:0;white-space:nowrap}
.shop-cart .table-list-eb .td-item-desc {position:relative;min-height:80px}
.shop-cart .table-list-eb .td-image {position:absolute;top:0;left:0;width:80px;height:80px;overflow:hidden}
.shop-cart .table-list-eb .td-image img {display:block;max-width:100%;height:auto}
.shop-cart .table-list-eb .td-item-name {margin-left:95px}
.shop-cart .table-list-eb .td-item-name ul {margin:5px 0}
.shop-cart .table-list-eb .td-item-name ul li {color:#959595}

.shop-cart .order_view {width:100%; border-radius:5px; background:#fff; padding:40px 40px 30px; border:1px solid #141751; margin:0 0 20px;}
.shop-cart .order_view li {overflow:hidden; padding-bottom:20px;}
.shop-cart .order_view li + li {margin:20px 0 0; border-top:1px solid #dadada; padding-top:30px;}
.shop-cart .order_view li .img {float:left; width:132px; position:relative;}
.shop-cart .order_view li .img img {width:132px; height:auto; border-radius:10px;}
.shop-cart .order_view li .img span {position:absolute; left:50%; bottom:-10px; margin-left:-40px; display:block; width:80px; height:23px; line-height:21px; text-align:center; font-size:12px; font-weight:400; border-radius:20px;}
.shop-cart .order_view li .img span.status01 {background:#141751; color:#fff; border:1px solid #141751;} /* 구매 */
.shop-cart .order_view li .img span.status02 {background:#ffede5; color:#FD4F00; border:1px solid #FD4F00;} /* 보험렌탈 */
.shop-cart .order_view li .img span.status03 {background:#FD4F00; color:#fff; border:1px solid #FD4F00;} /* 비보험렌탈 */

.shop-cart .order_view li .desc {float:left; width:calc(100% - 132px); padding-left:30px;}
.shop-cart .order_view li .desc table {min-height:130px; width:100%; border-collapse:collapse; border-spacing:0;}
.shop-cart .order_view li .desc table td {text-align:center; padding:0 10px; word-break:keep-all;}
.shop-cart .order_view li .desc table.wide td:nth-of-type(1) {width:auto;}
.shop-cart .order_view li .desc table.wide td:nth-of-type(2) {width:100px;}
.shop-cart .order_view li .desc table.wide td:nth-of-type(3) {width:210px;}
.shop-cart .order_view li .desc table.wide td:nth-of-type(4) {width:210px;}
.shop-cart .order_view li .desc table.wide td:nth-of-type(5) {width:150px;}
.shop-cart .order_view li .desc table.wide td:nth-of-type(6) {width:50px;}
.shop-cart .order_view li .desc table td.title {font-weight:600; line-height:150%; text-align:left;}
.shop-cart .order_view li .desc table td.title a {color:#343434;}
.shop-cart .order_view li .desc table td.title strong {font-weight:600; font-size:16px;}
.shop-cart .order_view li .desc table td.title span {font-size:14px; font-weight:500; display:block; margin:0; width:auto; text-align:left;}
.shop-cart .order_view li .desc table td ul {padding:0; font-size:14px; color:#999; margin:6px 0 0;}
.shop-cart .order_view li .desc table td ul li {font-size:14px; color:#999; font-weight:400; line-height:1.2;}
.shop-cart .order_view li .desc table td button {border:0; outline:0; padding:0 10px; background:#000; color:#fff; border-radius:3px; margin:0;}
.shop-cart .order_view li .desc table td span {display:inline-block; margin-left:10px;}
.shop-cart .order_view li .desc table td .price {color:#141751; font-weight:600;}
.shop-cart .order_view .mob {height:auto; display:none;}

.shop-cart .order_view .wide {}
.shop-cart .order_view .mob {height:auto; display:none;}
.shop-cart .delete {text-align:right; width:100%;}
.shop-cart .delete button {width:80px; height:30px; border:0; outline:0; line-height:30px; text-align:center; color:#fff; background:#141751; border-radius:5px;}
.shop-cart .delete button.all {background:#FD4F00;}

@media all and (max-width:1440px) {
	.shop-cart .order_view li .desc {padding-left:20px;}
	.shop-cart .order_view li .desc table.wide td:nth-of-type(2) {width:110px;}
	.shop-cart .order_view li .desc table.wide td:nth-of-type(3) {width:150px;}
	.shop-cart .order_view li .desc table.wide td:nth-of-type(4) {width:150px;}
	.shop-cart .order_view li .desc table.wide td:nth-of-type(5) {width:120px;}
	.shop-cart .order_view li .desc table.wide td:nth-of-type(6) {width:40px;}
	.shop-cart .order_view li .desc table td span {display:block; margin:0 0 4px;}
}
@media all and (max-width:1200px) {
	.shop-cart .order_view {padding:30px 30px 20px;}
	.shop-cart .order_view li .desc {padding-left:15px;}
	.shop-cart .order_view li .desc table.wide td:nth-of-type(2) {width:90px;}
	.shop-cart .order_view li .desc table.wide td:nth-of-type(3) {width:120px;}
	.shop-cart .order_view li .desc table.wide td:nth-of-type(4) {width:120px;}
	.shop-cart .order_view li .desc table.wide td:nth-of-type(5) {width:80px;}
	.shop-cart .order_view li .desc table.wide td:nth-of-type(6) {width:40px;}
	.shop-cart .order_view li .desc table td span {display:block; margin:0 0 4px;}
}
@media all and (max-width:980px) {
	.shop-cart .order_view {padding:20px 20px 15px;}
	.shop-cart .order_view li + li {margin:10px 0 0; padding-top:30px;}
	.shop-cart .order_view li .desc {padding-left:20px;}
	.shop-cart .order_view table.mob {margin:0 0 10px;}
	.shop-cart .order_view .mob th {text-align:left; line-height:25px; word-break:keep-all; font-weight:500; font-size:16px;}
	.shop-cart .order_view .mob td {text-align:right; line-height:25px; color:#5f5f5f; font-size:16px;}
	.shop-cart .order_view .mob td.title {text-align:left; font-size:15px;}
	.shop-cart .order_view .mob td.title span {display:inline-block; font-size:14px; font-weight:400; color:#999;}
	.shop-cart .order_view .mob td label {margin:10px 0 25px;}
	.shop-cart .order_view .mob td button {margin:0;}
	.shop-cart .order_view .mob dl {overflow:hidden; width:100%; padding:0 10px;}
	.shop-cart .order_view .mob dl + dl {margin-top:4px;}
	.shop-cart .order_view .mob dl dt {float:left; width:50%;}
	.shop-cart .order_view .mob dl dd {float:left; width:50%; text-align:right;}
	.shop-cart .order_view .mob dl dd .price {color:#141751;}

	.shop-cart .order_view .wide {display:none;}
	.shop-cart .order_view .mob {display:block;}
}

@media all and (max-width:767px) {
	.shop-cart .order_view .mob td ul {margin:0 0 10px;}
	.shop-cart .order_view .mob td ul li {padding:0; margin:0 0 10px;}
	.shop-cart .order_view .mob td button {}
}

@media (max-width:576px) {
	.shop-cart .order_view li {padding-left:0;}
	.shop-cart .order_view li .img {width:90px;}
	.shop-cart .order_view li .img img {width:90px;}
	.shop-cart .order_view li .img span {margin-left:-35px; width:70px;}
	.shop-cart .order_view li .desc {width:calc(100% - 90px); padding-left:5px;}
}

@media (max-width:400px) {
	.shop-cart .order_view {padding:20px 10px 15px 20px;}
	.shop-cart .order_view .mob td.title {font-size:14px;}
	.shop-cart .order_view .mob td.title span {font-size:13px;}
	.shop-cart .order_view .mob td ul li {font-size:13px;}
	.shop-cart .order_view .mob dl dt {width:60px;font-size:13px;}
	.shop-cart .order_view .mob dl dd {width:calc(100% - 60px); text-align:left;font-size:13px;}
}

<?php } else { // 모바일의 경우 ?>
.shop-cart .shop-cart-all-select {position:relative;padding:15px;margin-bottom:30px;border:1px solid #757575}
.shop-cart .shop-cart-li-wrap {margin:0 0 30px}
.shop-cart .shop-cart-li-wrap .shop-cart-li {background:#fff;border:1px solid #757575;margin:0 0 20px}
.shop-cart .shop-cart-li-wrap .li-name {position:relative;border-bottom:1px solid #757575;padding:15px 15px 15px 40px;font-size:1.0625rem;font-weight:700}
.shop-cart .shop-cart-li-wrap .li-name .checkbox {position:absolute;top:11px;left:15px}
.shop-cart .shop-cart-li-wrap .li-item-wrap {position:relative;padding:15px;padding-left:110px;min-height:110px}
.shop-cart .shop-cart-li-wrap .li-item-img {position:absolute;top:15px;left:15px;width:80px;height:80px;overflow:hidden}
.shop-cart .shop-cart-li-wrap .li-item-img img {display:block;max-width:100%;height:auto}
.shop-cart .shop-cart-li-wrap .li-opt {padding:0;color:#757575;margin:3px 0 7px;line-height:1.5}
.shop-cart .shop-cart-li-wrap .li-opt li {color:#757575;margin:3px 0;line-height:1.5}
.shop-cart .shop-cart-li-wrap .li-prqty {border-top:1px solid #e5e5e5;padding:15px}
.shop-cart .shop-cart-li-wrap .li-prqty:after {display:block;visibility:hidden;clear:both;content:''}
.shop-cart .shop-cart-li-wrap .li-prqty-sp {float:left;width:50%;display:block;line-height:20px;padding:0 7px;margin-bottom:5px;text-align:right;box-sizing:border-box}
.shop-cart .shop-cart-li-wrap .li-prqty-sp span {float:left}
.shop-cart .shop-cart-li-wrap .prqty-sc, .shop-cart .shop-cart-li-wrap .prqty-price {border-right:1px solid #e5e5e5}
.shop-cart .shop-cart-li-wrap .total-price {background:#f5f5f5;border:1px solid #d5d5d5;display:block;clear:both;margin:0 15px 15px;text-align:right;padding:15px}
.shop-cart .shop-cart-li-wrap .total-price span {float:left;font-weight:700}
.shop-cart .shop-cart-li-wrap .total-price strong {color:#cc2300}
<?php } // if (!G5_IS_MOBILE) END ?>

.shop-cart .shop-cart-total {width:100%; border-top:1px solid rgba(20,23,81,0.3); margin:50px 0 0; padding:50px 0 0; overflow:hidden;}
.shop-cart .shop-cart-total .info {float:right; width:340px;}
.shop-cart .shop-cart-total .info table {width:100%; border-collapse:collapse; border-spacing:0}
.shop-cart .shop-cart-total .info table th {padding:4px 2px; font-weight:600;}
.shop-cart .shop-cart-total .info table td {text-align:right; padding:4px 2px;}
.shop-cart .shop-cart-total .info table .total {font-size:20px; font-weight:700; color:#343434; padding-bottom:20px;}
.shop-cart .shop-cart-total .info table .price {color:#141751; font-size:16px; font-weight:700;}
.shop-cart .shop-cart-total .cart-act-btn {display:block; margin:50px 0 0;}
.shop-cart .shop-cart-total .cart-act-btn .btn_order {display:block; height:58px; line-height:58px; border:1px solid #141751; font-size:16px; text-align:center; outline:none; border-radius:5px; font-weight:600; cursor:pointer; display:inline-block; width:100%; background:#141751; color:#fff;}

@media (max-width:767px) {
	.shop-cart .shop-cart-total {margin:40px 0 0; padding:20px 0 0;}
}

@media (max-width:576px) {
	.shop-cart .shop-cart-total {margin:20px 0 0; padding:20px 0 0; border-top:0;}
	.shop-cart .shop-cart-total .info {float:none; width:100%;}
}


/* 영카트 모바일 css 관련 */
#mod_option_frm {position:relative;top:inherit;left:inherit;width:100%;border:0 none}
#mod_option_frm .shop-option {padding:0}


@media (max-width:576px) {
    .shop-cart .shop-cart-total .cart-total-box {font-size:.9375rem}
    .shop-cart .shop-cart-total .cart-total-box .cart-total-price {font-size:.9375rem}
}
</style>

<script src="<?php echo G5_JS_URL; ?>/shop.js"></script>
<script src="<?php echo G5_JS_URL; ?>/shop.override.js"></script>

<div class="shop-cart">

	<h4>장바구니 안내</h4>

	<ul class="desc">
		<li>장바구니 상품은 최대 30일간 저장됩니다.</li>
		<li>보험 렌탈은 주문일로부터 1개월 후에 결제됩니다.</li>
		<li>렌탈 주문 시, 계약 진행을 위해 해피콜 전화를 드립니다. 해피콜 완료 후 결제 및 배송되오니 1670-3171 전화를 꼭 받아주세요.</li>
	</ul>

    <form name="frmcartlist" id="sod_bsk_list" class="2017_renewal_itemform eyoom-form" method="post" action="<?php echo $cart_action_url; ?>">

    <?php if (!G5_IS_MOBILE) { // 모바일이 아닐경우 ?>


	<ul class="order_view">
		<?php if ($count > 0) { ?>
		<?php for ($i=0; $i<$count; $i++) { ?>
		<li>
			<div class="img">
				<div class="tag"><span class="status01">구매</span><!--span class="status02">보험렌탈</span><span class="status03">비보험렌탈</span--></div>
				<a href="<?php echo shop_item_url($list[$i]['it_id']); ?>"><?php echo $list[$i]['image']; ?></a>
			</div>
			<div class="desc">
				<table class="wide">
					<tr>
						<td class="title">
							<input type="hidden" name="it_id[<?php echo $i; ?>]"    value="<?php echo $list[$i]['it_id']; ?>">
							<input type="hidden" name="it_name[<?php echo $i; ?>]"  value="<?php echo $list[$i]['it_name']; ?>">

							<?php if ($list[$i]['it_options']) { ?>
							<a href="<?php echo shop_item_url($list[$i]['it_id']); ?>" class="f-s-17r">
								<span><?php echo $list[$i]['it_brand']; ?></span>
								<?php echo $list[$i]['it_name']; ?>
							</a>
							<?php echo $list[$i]['it_options']; ?>
							<button type="button" class="mod_options" data-bs-toggle="modal" data-bs-target="#modal_mod_option">선택사항수정</button>
							<?php } ?>
						</td>
						<td>수량  <?php echo number_format($list[$i]['sum_qty']); ?>개</td>
						<td>구매가격<span><?php echo number_format($list[$i]['ct_price']); ?>원</span></td>
						<td>결제가격<span class="price"><strong id="sell_price_<?php echo $i; ?>"><?php echo number_format($list[$i]['sell_price']); ?></strong>원</span></td>
						<td>배송비<span><?php echo $list[$i]['ct_send_cost']; ?></span></td>
						<td>
                            <label for="ct_chk_<?php echo $i; ?>" class="sound_only">상품</label>
                            <label class="checkbox">
                                <input type="checkbox" name="ct_chk[<?php echo $i; ?>]" value="1" id="ct_chk_<?php echo $i; ?>" checked="checked"><i></i>
                            </label>
						</td>
					</tr>
				</table>

				<table class="mob">
					<tr>
						<td colspan="2" class="title">
							<input type="hidden" name="it_id[<?php echo $i; ?>]"    value="<?php echo $list[$i]['it_id']; ?>">
							<input type="hidden" name="it_name[<?php echo $i; ?>]"  value="<?php echo $list[$i]['it_name']; ?>">
                            <label for="ct_chk_<?php echo $i; ?>" class="sound_only">상품</label>
                            <label class="checkbox">
                                <input type="checkbox" name="ct_chk[<?php echo $i; ?>]" value="1" id="ct_chk_<?php echo $i; ?>" checked="checked"><i></i>
                            </label>
							<?php if ($list[$i]['it_options']) { ?>
							<a href="<?php echo shop_item_url($list[$i]['it_id']); ?>">
								<span><?php echo $list[$i]['it_brand']; ?></span>
								<?php echo $list[$i]['it_name']; ?>
							</a>
							<?php echo $list[$i]['it_options']; ?>
							<button type="button" class="mod_options" data-bs-toggle="modal" data-bs-target="#modal_mod_option">선택사항수정</button>
							<?php } ?>
						</td>
					</tr>
				</table>
				<div class="mob">
					<dl>
						<dt>수량</dt>
						<dd><?php echo number_format($list[$i]['sum_qty']); ?>개</dd>
					</dl>

					<dl>
						<dt>구매가격</dt>
						<dd><?php echo number_format($list[$i]['ct_price']); ?>원</dd>
					</dl>

					<dl>
						<dt>결제가격</dt>
						<dd><span class="price"><strong id="sell_price_<?php echo $i; ?>"><?php echo number_format($list[$i]['sell_price']); ?></strong>원</dd>
					</dl>

					<dl>
						<dt>배송비</dt>
						<dd><?php echo $list[$i]['ct_send_cost']; ?></dd>
					</dl>
				</div>
			</div>
		</li>
		<?php } ?>
		<?php } else { ?>
			<li class="empty">장바구니에 담긴 상품이 없습니다.</li>
		<?php } ?>
	</ul>

    <?php } else { // 모바일의 경우 ?>
    <div class="shop-cart-all-select">
        <label for="ct_all" class="sound_only">상품 전체</label>
        <label class="checkbox">
            <input type="checkbox" name="ct_all" value="1" id="ct_all" checked="checked"><i></i>전체상품 선택
        </label>
    </div>

    <ul class="shop-cart-li-wrap">
    <?php if ($count > 0) { ?>
        <?php for ($i=0; $i<$count; $i++) { ?>
        <li class="shop-cart-li">
            <input type="hidden" name="it_id[<?php echo $i; ?>]"    value="<?php echo $list[$i]['it_id']; ?>">
            <input type="hidden" name="it_name[<?php echo $i; ?>]"  value="<?php echo $list[$i]['it_name']; ?>">
            <div class="li-name">
                <label for="ct_chk_<?php echo $i; ?>" class="sound_only">상품</label>
                <label class="checkbox">
                    <input type="checkbox" name="ct_chk[<?php echo $i; ?>]" value="1" id="ct_chk_<?php echo $i; ?>" checked="checked"><i></i>
                </label>
                <strong><?php echo $list[$i]['it_name']; ?></strong>
            </div>
            <div class="li-item-wrap">
                <div class="li-item-img">
                    <a href="<?php echo shop_item_url($list[$i]['it_id']); ?>">
                        <?php echo $list[$i]['image']; ?>
                    </a>
                </div>
                <div class="li-opt"><?php echo $list[$i]['it_options']; ?></div>
                <div class="li-mod" >
                    <button type="button" class="btn-e btn-e-dark mod_options" data-bs-toggle="modal" data-bs-target="#modal_mod_option">선택사항수정</button>
                </div>
            </div>

            <div class="li-prqty">
                <span class="li-prqty-sp prqty-price"><span>판매가 </span><?php echo number_format($list[$i]['ct_price']); ?></span>
                <span class="li-prqty-sp prqty-qty"><span>수량 </span><?php echo number_format($list[$i]['sum_qty']); ?></span>
                <span class="li-prqty-sp prqty-sc"><span>배송비 </span><?php echo $list[$i]['ct_send_cost']; ?></span>
                <span class="li-prqty-sp total-point"><span>적립포인트 </span><strong><?php echo number_format($list[$i]['point']); ?></strong></span>
            </div>
            <div class="total-price total-span"><span>소계 </span><strong id="sell_price_<?php echo $i; ?>"><?php echo number_format($list[$i]['sell_price']); ?></strong></div>
        </li>
        <?php } ?>
    <?php } else { ?>
        <li class="text-center"><span class="text-gray"><i class="fas fa-exclamation-circle"></i> 장바구니에 담긴 상품이 없습니다.</span></li>
    <?php } ?>
    </ul>

    <?php } // if (!G5_IS_MOBILE) END ?>


    <?php if ($count > 0) { ?>
    <div class="delete">
        <button type="button" onclick="return form_check('seldelete');">선택삭제</button>
        <button type="button" onclick="return form_check('alldelete');" class="all">전체삭제</button>
    </div>
    <?php } ?>

    <!--div class="shop-cart-total">
        <div class="cart-total-box">
            <span>배송비</span>
            <strong><?php echo number_format($send_cost); ?></strong> 원
        </div>
        <div class="cart-total-box">
            <span>포인트</span>
            <strong><?php echo number_format($tot_point); ?></strong> 점
        </div>
        <div class="cart-total-box">
            <span>총계 가격</span>
            <strong class="cart-total-price"><?php echo number_format($tot_price); ?></strong> 원
        </div>
    </div-->

		<div class="shop-cart-total">
			<div class="info">
				<?php if ($tot_price > 0 || $send_cost > 0) { ?>
				<table>
					<tr><th class="total">결제금액 합계</th><td class="total"><?php echo number_format($tot_price); ?>원</td></tr>
					<tr><th>배송비</th><td><?php echo number_format($send_cost); ?>원</td></tr>
					<tr><th>할인금액</th><td>-0원</td></tr>
					<tr><th class="price">결제 예정 금액</th><td class="price"><?php echo number_format($tot_price); ?>원</td></tr>
					<?php /*
                    <tr><th class="price">렌탈료 합계</th><td class="price">월 60,000원</td></tr>
                     */
                     ?>
				</table>

				<?php } ?>
				<div class="cart-act-btn">
					<?php if ($i == 0) { ?>
					<a href="<?php echo G5_SHOP_URL; ?>/" class="btn_order">쇼핑 계속하기</a>
					<?php } else { ?>
					<input type="hidden" name="url" value="<?php echo G5_SHOP_URL; ?>/orderform.php">
					<input type="hidden" name="records" value="<?php echo $i; ?>">
					<input type="hidden" name="act" value="">
					<!--a href="<?php echo shop_category_url($continue_ca_id); ?>" class="btn-e btn-e-brd btn-e-xl btn-e-dark">쇼핑 계속하기</a-->
					<button type="button" onclick="return form_check('buy');" class="btn_order">주문하기</button>

					<?php if ($naverpay_button_js) { ?>
					<div class="cart-naverpay"><?php echo $naverpay_request_js.$naverpay_button_js; ?></div>
					<?php } ?>
					<?php } ?>
				</div>
			</div>

		</div>
    </form>
</div>

<div id="modal_mod_option" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title f-s-20r"><strong>상품옵션 수정</strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"></div>
        </div>
    </div>
</div>

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
<script>
$(function() {
    var close_btn_idx;

    // 선택사항수정
    $(".mod_options").click(function() {
        <?php if (!G5_IS_MOBILE) { // 모바일이 아닐경우 ?>
        var it_id = $(this).closest("tr").find("input[name^=it_id]").val();
        <?php } else { // 모바일의 경우 ?>
        var it_id = $(this).closest("li").find("input[name^=it_id]").val();
        <?php } ?>
        var $this = $(this);
        close_btn_idx = $(".mod_options").index($(this));

        $.post(
            "./cartoption.php",
            { it_id: it_id },
            function(data) {
                $("#mod_option_frm").remove();
                $("#modal_mod_option .modal-body").html("<div id=\"mod_option_frm\"></div>");
                $("#mod_option_frm").html(data);
                price_calculate();
            }
        );
    });

    // 모두선택
    $("input[name=ct_all]").click(function() {
        if($(this).is(":checked"))
            $("input[name^=ct_chk]").attr("checked", true);
        else
            $("input[name^=ct_chk]").attr("checked", false);
    });

    // 옵션수정 닫기
    $(document).on("click", ".mod_option_close", function() {
        $("#mod_option_frm").remove();
        $(".mod_options").eq(close_btn_idx).focus();
    });
});

function fsubmit_check(f) {
    if($("input[name^=ct_chk]:checked").length < 1) {
        Swal.fire({
            title: "중요!",
            text: "구매하실 상품을 하나이상 선택해 주십시오.",
            confirmButtonColor: "#e53935",
            icon: "error",
            confirmButtonText: "확인"
        });
        return false;
    }

    return true;
}

function form_check(act) {
    var f = document.frmcartlist;
    var cnt = f.records.value;

    if (act == "buy") {
        if($("input[name^=ct_chk]:checked").length < 1) {
            Swal.fire({
                title: "중요!",
                text: "주문하실 상품을 하나이상 선택해 주십시오.",
                confirmButtonColor: "#e53935",
                icon: "error",
                confirmButtonText: "확인"
            });
            return false;
        }

        f.act.value = act;
        f.submit();
    } else if (act == "alldelete") {
        f.act.value = act;
        f.submit();
    } else if (act == "seldelete") {
        if($("input[name^=ct_chk]:checked").length < 1) {
            Swal.fire({
                title: "중요!",
                text: "삭제하실 상품을 하나이상 선택해 주십시오.",
                confirmButtonColor: "#e53935",
                icon: "error",
                confirmButtonText: "확인"
            });
            return false;
        }

        f.act.value = act;
        f.submit();
    }

    return true;
}
</script>