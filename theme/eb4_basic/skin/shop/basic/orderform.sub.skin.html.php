<?php
/**
 * skin file : /theme/THEME_NAME/skin/shop/basic/orderform.sub.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

require_once(G5_SHOP_PATH.'/settle_'.$default['de_pg_service'].'.inc.php');
require_once(G5_SHOP_PATH.'/settle_kakaopay.inc.php');

if( $default['de_inicis_lpay_use'] || $default['de_inicis_kakaopay_use'] ){   //이니시스 Lpay 또는 이니시스 카카오페이 사용시
    require_once(G5_SHOP_PATH.'/inicis/lpay_common.php');
}

if(function_exists('is_use_easypay') && is_use_easypay('global_nhnkcp')){  // 타 PG 사용시 NHN KCP 네이버페이 사용이 설정되어 있다면
    require_once(G5_SHOP_PATH.'/kcp/global_nhn_kcp.php');
}

/**
 * 결제대행사별 코드 include (스크립트 등)
 */
require_once(G5_SHOP_PATH.'/'.$default['de_pg_service'].'/orderform.1.php');

if( $default['de_inicis_lpay_use'] || $default['de_inicis_kakaopay_use'] ){   //이니시스 L.pay 사용시
    require_once(G5_SHOP_PATH.'/inicis/lpay_form.1.php');
}

if(function_exists('is_use_easypay') && is_use_easypay('global_nhnkcp')){  // 타 PG 사용시 NHN KCP 네이버페이 사용이 설정되어 있다면
    require_once(G5_SHOP_PATH.'/kcp/global_nhn_kcp_form.1.php');
}

if($is_kakaopay_use) {
    require_once(G5_SHOP_PATH.'/kakaopay/orderform.1.php');
}
?>

<style>
.shop-order-form .payment-info-box {position:relative;clear:both;padding:10px 15px;border:1px solid #e5e5e5;margin-top:-1px;background:#fff;text-align:right;color:#757575}
.shop-order-form .payment-info-box.border-color-red {border-color:#cc2300}
.shop-order-form .payment-info-box span {float:left}
.shop-order-form .payment-info-box strong {color:#000}
.shop-order-form .payment-info-box .cp_cancel {margin-left:3px;height:inherit;}
.shop-order-form #od_tot_price {position:relative;overflow:hidden;clear:both;padding:10px 15px;margin:0;text-align:right;line-height:inherit;background:#fff}
.shop-order-form #od_tot_price span {line-height:30px}
.shop-order-form #od_tot_price .print_price {color:#cc2300;font-size:1.25rem}
.shop-order-form .payment-select-wrap {position:relative;margin-top:20px}
.shop-order-form .payment-select-wrap #sod_frm_paysel {padding:0;background:none;border:0 none}
.shop-order-form .payment-select-wrap input[type="radio"] {position:absolute;width:0;height:0;overflow:hidden;visibility:hidden;text-indent:-999px;left:0;z-index:-1px}
.shop-order-form .payment-select-wrap .payment-select-box {position:relative;overflow:hidden;float:left;width:50%; height:58px; line-height:58px;  background:#fff;cursor:pointer;height:60px;box-sizing:border-box; border-radius:5px; text-align:center; border:1px solid #c4c4c4; color:#5f5f5f; font-weight:500; margin:-1px 0 0 -1px;padding:0;text-indent:inherit !important}
.shop-order-form .payment-select-wrap input[type="radio"]:checked+.payment-select-box {border:1px solid #141751; color:#141751; z-index:3}

.shop-order-form .payment-select-wrap #sod_frm_paysel .PAYNOW {background:#fff;background-image:url("<?php echo EYOOM_THEME_URL .'/skin/shop/'.$eyoom['shop_skin']; ?>/img/paynow.jpg");background-repeat:no-repeat;background-position:5px 5px;background-size:48px 48px}
.shop-order-form .payment-select-wrap #sod_frm_paysel .KPAY {background:#fff;background-image:url("<?php echo EYOOM_THEME_URL .'/skin/shop/'.$eyoom['shop_skin']; ?>/img/kpay.jpg");background-repeat:no-repeat;background-position:5px 5px;background-size:48px 48px}
.shop-order-form .payment-select-wrap #sod_frm_paysel .PAYCO {background:#fff;background-image:url("<?php echo EYOOM_THEME_URL .'/skin/shop/'.$eyoom['shop_skin']; ?>/img/payco.jpg");background-repeat:no-repeat;background-position:5px 5px;background-size:48px 48px}
.shop-order-form .payment-select-wrap #sod_frm_paysel .inicis_lpay {background:#fff;background-image:url("<?php echo EYOOM_THEME_URL .'/skin/shop/'.$eyoom['shop_skin']; ?>/img/lpay.jpg");background-repeat:no-repeat;background-position:5px 5px;background-size:48px 48px}
#display_pay_button {background:none;padding:0;border:0 none}
.shop-order-form #display_pay_button .btn_submit {display:block;width:100%;height:46px;line-height:46px;padding:0;background:#cc2300;color:#fff;font-size:.9375rem;font-weight:700;letter-spacing:0;border:0;margin-bottom:15px}
.shop-order-form #display_pay_button a.btn01 {display:block;width:100%;height:46px;line-height:46px;padding:0;background:#fff;color:#757575;font-size:.9375rem;font-weight:700;letter-spacing:0;border:1px solid #d5d5d5}

#settle_bank label {float:none;width:auto;line-height:inherit}
.shop-order-form .payment-point-use-box {margin-top:20px}
.shop-order-form .payment-point-use {position:relative;overflow:hidden;clear:both;padding:10px 15px;border:1px solid #e5e5e5;margin-top:-1px;background:#fff;color:#757575}
.shop-order-form .payment-point-use label {line-height:30px;margin-bottom:0}
.shop-order-form .payment-point-use .input {margin-bottom:0}
.shop-order-form #settle_bank {position:relative;padding:15px;border:1px solid #141751; border-radius:5px; margin:10px 0 0;display:none}
.shop-order-form #settle_bank .select {margin-bottom:10px}
#settle_bank select {width:100%;border:1px solid #c4c4c4}
.shop-order-form #settle_bank .input {margin-bottom:0}
.shop-order-form #settle_bank #od_deposit_name {width:100%;text-align:left;border:1px solid #ccc}

/* Datepicker CSS 수정 */
.ui-datepicker {width:260px}
.ui-datepicker td span, .ui-datepicker td a {padding:inherit;text-align:inherit;line-height:25px}
.ui-widget-header {border:0;border-bottom:1px solid #c5c5c5 !important;background:#e5e5e5}
.ui-widget-content .ui-state-default {border:inherit;background:none}
.ui-datepicker .ui-datepicker-buttonpane button {margin:10px 0 0;padding:5px 15px;border:0;background:#171C29;color:#fff}
.ui-datepicker .ui-datepicker-buttonpane button:hover {background:#1F263B !important}
.ui-datepicker .ui-datepicker-prev:hover, .ui-datepicker .ui-datepicker-next:hover {border:0}


/* 쿠폰 선택 테이블 */
.shop-order-form .payment-info-box .od_coupon h3 {padding: 0 10px;margin: 10px 0 7px;line-height: 35px;font-size: 13px;color:#fff;background:#333;}
.shop-order-form .payment-info-box .od_coupon .btn_close {top: 45px;right: 15px;width: 35px;height: 35px;color:#ddd;border:0 none;}
.shop-order-form .payment-info-box .od_coupon .btn_close:hover {color:#fff;background:transparent;}
.shop-order-form .payment-info-box .od_coupon .tbl_head02 {margin: 0;}
.shop-order-form .payment-info-box #sc_coupon_frm table thead th,
.shop-order-form .payment-info-box #sc_coupon_frm table tbody td {font-size: 12px;text-align: center;}
.shop-order-form .payment-info-box #sc_coupon_frm a.btn_frmline,
.shop-order-form .payment-info-box #sc_coupon_frm button.btn_frmline {width:auto;height:inherit;padding:4px 10px;font-size: 12px;}
</style>

<?php /* INICIS결제모듈 연동시 bootstrap css문제로 결제모달이 뜨지 않는 상황 발생하여 아래 코드 추가 */ ?>
<style>
    #inicisModalDiv {
        opacity : 1 !important;
    }
</style>
<form name="forderform" id="forderform" method="post" action="<?php echo $order_action_url; ?>" autocomplete="off" class="eyoom-form">
<div class="shop-order-form">

	<h4>주문하기</h4>
	<h5>상품정보</h5>

	<ul class="order_view">
	<?php if ($sod_count > 0) { ?>
	<?php for ($i=0; $i<$sod_count; $i++) { ?>
		<li>
			<div class="img">
				<div class="tag"><span class="status01">구매</span><!--span class="status02">보험렌탈</span><span class="status03">비보험렌탈</span--></div>
				<?php echo $list[$i]['image']; ?>
			</div>
			<div class="desc">
				<table class="wide">
					<tr>
						<td class="title">
							<input type="hidden" name="it_id[<?php echo $i; ?>]"    value="<?php echo $list[$i]['it_id']; ?>">
							<input type="hidden" name="it_name[<?php echo $i; ?>]"  value="<?php echo get_text($list[$i]['it_name']); ?>">
							<input type="hidden" name="it_price[<?php echo $i; ?>]" value="<?php echo $list[$i]['sell_price']; ?>">
							<input type="hidden" name="cp_id[<?php echo $i; ?>]" value="">
							<input type="hidden" name="cp_price[<?php echo $i; ?>]" value="0">
							<?php if($default['de_tax_flag_use']) { ?>
								<input type="hidden" name="it_notax[<?php echo $i; ?>]" value="<?php echo $list[$i]['it_notax']; ?>">
							<?php } ?>
								<span><?php echo $list[$i]['it_brand']; ?></span>
								<?php echo $list[$i]['it_name']; ?>
							<?php if ($list[$i]['cp_count']) { ?>
								<button type="button" class="btn-e btn-e-dark cp_btn" data-bs-toggle="modal" data-bs-target="#modal_coupon_apply">쿠폰적용</button>
							<?php } ?>
						</td>
						<td>수량  <?php echo number_format($list[$i]['sum_qty']); ?>개</td>
						<td class=".td_left">
                            <p>구매가격<span><?php echo number_format($list[$i]['ct_price']); ?>원</span></p>
                            <?php if($list[$i]['print_options_price']) {?>
                            <p>옵션가격<span><?php echo $list[$i]['print_options_price'] ?></span></p>
                            <?php } ?>
                        </td>
						<td>결제가격<span class="price"><?php echo number_format($list[$i]['sell_price']); ?>원</span></td>
						<td>배송비<span><?php echo $list[$i]['ct_send_cost']; ?></span></td>
					</tr>
				</table>

				<table class="mob">
					<tr>
						<td colspan="2" class="title">
							<a href="<?php echo shop_item_url($list[$i]['it_id']); ?>">
								<span><?php echo $list[$i]['it_brand']; ?></span>
								<?php echo $list[$i]['it_name']; ?>
							</a>
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
						<dd>
                            <?php echo number_format($list[$i]['ct_price']); ?>원
                        </dd>
					</dl>
                    <?php if($list[$i]['print_options_price']) {?>
                    <dl>
                        <dt>옵션가격</dt>
                        <dd>
                            <?php echo $list[$i]['print_options_price']; ?>원
                        </dd>
                    </dl>
                    <?php } ?>

					<dl>
						<dt>결제가격</dt>
						<dd><span class="price"><?php echo number_format($list[$i]['sell_price']); ?>원</dd>
					</dl>

					<dl>
						<dt>배송비</dt>
						<dd><?php echo $list[$i]['ct_send_cost']; ?></dd>
					</dl>
				</div>
			</div>
		</li>
	<?php } ?>
	<?php } ?>
	</ul>

	<div class="frame">
            <input type="hidden" name="od_price" value="<?php echo $tot_sell_price; ?>">
            <input type="hidden" name="org_od_price" value="<?php echo $tot_sell_price; ?>">
            <input type="hidden" name="od_send_cost" value="<?php echo $send_cost; ?>">
            <input type="hidden" name="od_send_cost2" value="0">
            <input type="hidden" name="item_coupon" value="0">
            <input type="hidden" name="od_coupon" value="0">
            <input type="hidden" name="od_send_coupon" value="0">
            <input type="hidden" name="od_goods_name" value="<?php echo $goods; ?>">
            <?php
            // 결제대행사별 코드 include (결제대행사 정보 필드)
            require_once(G5_SHOP_PATH.'/'.$default['de_pg_service'].'/orderform.2.php');

            if($is_kakaopay_use) {
                require_once(G5_SHOP_PATH.'/kakaopay/orderform.2.php');
            }
            ?>

		<div class="delivery">
			<h5>주문하시는 분</h5>
			<table>
				<tr>
					<th>주문인</th>
					<td><input type="text" name="od_name" value="<?php echo get_text($member['mb_name']); ?>" id="od_name" required maxlength="20"></td>
				</tr>

				<?php if (!$is_member) { // 비회원이면 ?>
				<tr>
					<th>비밀번호</th>
					<td><input type="password" name="od_pwd" id="od_pwd" required maxlength="20"><div class="note">영,숫자 3~20자 (주문서 조회시 필요)</div></td>
				</tr>
				<?php } ?>

				<tr>
					<th>전화번호</th>
					<td>
						<input type="text" name="od_tel" value="<?php echo get_text($member['mb_tel']); ?>" id="od_tel" required maxlength="20">
					</td>
				</tr>

				<tr>
					<th>연락처</th>
					<td>
						<input type="text" name="od_hp" value="<?php echo get_text($member['mb_hp']); ?>" id="od_hp" required maxlength="20">
					</td>
				</tr>

				<tr>
					<th>배송지</th>
					<td class="address">
						<input type="text" name="od_zip" value="<?php echo $member['mb_zip1'].$member['mb_zip2']; ?>" id="od_zip" required  class="zip" size="8" maxlength="6" placeholder="우편번호">
						<button type="button" onclick="win_zip('forderform', 'od_zip', 'od_addr1', 'od_addr2', 'od_addr3', 'od_addr_jibeon');">우편번호 검색</button>
						<input type="text" name="od_addr1" value="<?php echo get_text($member['mb_addr1']) ?>" id="od_addr1" required size="60" placeholder="기본주소">
						<input type="text" name="od_addr2" value="<?php echo get_text($member['mb_addr2']) ?>" id="od_addr2" size="60" placeholder="상세주소">
						<input type="text" name="od_addr3" value="<?php echo get_text($member['mb_addr3']) ?>" id="od_addr3" size="60" readonly="readonly" placeholder="참고항목">
						<input type="hidden" name="od_addr_jibeon" value="<?php echo get_text($member['mb_addr_jibeon']); ?>">
					</td>
				</tr>
			</table>

			<h5>받으시는 분</h5>
			<table>
				<tr>
					<th>배송지선택</th>
					<td class="address_select">
						<?php if ($is_member) { ?>
							<label for="ad_sel_addr_same" class="radio"><input type="radio" name="ad_sel_addr" value="same" id="ad_sel_addr_same"><i class="rounded-x"></i><span>주문자와 동일</span></label>
							<?php if ($ad_sel_addr) { ?>
							<label for="ad_sel_addr_def" class="radio"><input type="radio" name="ad_sel_addr" value="<?php echo $ad_sel_addr; ?>" id="ad_sel_addr_def"><i class="rounded-x"></i><span>기본배송지</span></label>
							<?php } ?>
							<?php if (is_array($latest_addr)) { ?>
								<?php foreach ($latest_addr as $k => $addrinfo) { ?>
								<label for="ad_sel_addr_<?php echo ($k+1); ?>" class="radio"><input type="radio" name="ad_sel_addr" value="<?php echo $addrinfo['val1']; ?>" id="ad_sel_addr_<?php echo ($k+1); ?>"><i class="rounded-x"></i><span>최근배송지</span>(<?php echo $addrinfo['ad_subject'] ? $addrinfo['ad_subject'] : $addrinfo['ad_name']; ?>)</label>
								<?php } ?>
							<?php } ?>
								<label for="od_sel_addr_new" class="radio"><input type="radio" name="ad_sel_addr" value="new" id="od_sel_addr_new"><i class="rounded-x"></i><span>신규배송지</span></label>
								<a href="<?php echo G5_SHOP_URL; ?>/orderaddress.php" id="order_address" class="btn-e btn-e-dark"><span>배송지목록</span></a>
						<?php } else { ?>
								<label for="ad_sel_addr_same" class="checkbox"><input type="checkbox" name="ad_sel_addr" value="same" id="ad_sel_addr_same"><i class="rounded-x"></i><span>주문자와 동일</span></label>
						<?php } ?>
					</td>
				</tr>

				<?php if($is_member) { ?>
				<tr>
					<th>배송지명</th>
					<td class="title">
						<input type="text" name="ad_subject" id="ad_subject" maxlength="20">
						<label class="checkbox">
							<input type="checkbox" name="ad_default" id="ad_default" value="1"><i></i><span>기본배송지로 설정</span>
						</label>
					</td>
				</tr>
				<?php } ?>

				<tr>
					<th>수령인</th>
					<td><input type="text" name="od_b_name" id="od_b_name" required maxlength="20"></td>
				</tr>

				<tr>
					<th>전화번호</th>
					<td>
						<input type="text" name="od_b_tel" id="od_b_tel" required maxlength="20">
					</td>
				</tr>

				<tr>
					<th>연락처</th>
					<td>
						<input type="text" name="od_b_hp" id="od_b_hp" required  maxlength="20">
					</td>
				</tr>

				<tr>
					<th>배송지</th>
					<td class="address">
						<input type="text" name="od_b_zip" id="od_b_zip" required class="zip" size="8" maxlength="6" placeholder="우편번호">
						<button type="button"  onclick="win_zip('forderform', 'od_b_zip', 'od_b_addr1', 'od_b_addr2', 'od_b_addr3', 'od_b_addr_jibeon');">우편번호 검색</button>
						<input type="text" name="od_b_addr1" id="od_b_addr1" size="60" placeholder="기본주소">
						<input type="text" name="od_b_addr2" id="od_b_addr2" size="60" placeholder="상세주소">
						<input type="text" name="od_b_addr3" id="od_b_addr3" readonly="readonly" size="60" placeholder="참고항목">
						<input type="hidden" name="od_b_addr_jibeon" value="">
					</td>
				</tr>

				<tr>
					<th>이메일</th>
					<td>
						<input type="text" name="od_email" value="<?php echo $member['mb_email']; ?>" id="od_email" required size="35" maxlength="100">
					</td>
				</tr>

				<tr>
					<th>배송메모</th>
					<td>
						<input type="text" name="od_memo" id="od_memo">
					</td>
				</tr>
			</table>
		</div>

		<div class="info">
			<h5>할인/포인트</h5>
			<table>
			<tr>
				<th>회원등급할인</th>
				<td><input type="text" name="" value="" placeholder="할인 가능 금액이 없습니다."></td>
			</tr>

			<tr>
				<th>포인트</th>
				<td class="point">
					<input type="text" name="" value="">P <span>(사용가능 포인트 <strong><?php echo number_format($tot_point); ?>P</strong>)</span>
				</td>
			</tr>
			</table>

			<h5>결제 예정금액</h5>
			<table class="table">
				<tr><th class="total">상품금액 합계</th><td class="total"><strong id="ct_tot_price"><?php echo number_format($tot_price); ?></strong>원</td></tr>
				<tr><th>배송비</th><td><?php echo number_format($send_cost); ?>원</td></tr>
				<?php if($oc_cnt > 0) { ?>
				<tr><th>주문할인</th><td>
					<div id="sod_frm_pay" class="payment-info-box">
						<strong id="od_cp_price">0</strong>원
						<input type="hidden" name="od_cp_id" value="">
						<button type="button" id="od_coupon_btn" class="btn-e btn-e-dark m-l-5" data-bs-toggle="modal" data-bs-target="#modal_od_coupon_apply">쿠폰적용</button>
					</div>
				</td></tr>
                <?php } ?>
                <?php if($sc_cnt > 0) { ?>
				<tr><th>배송비할인</th><td>
					<div class="payment-info-box">
						<span>배송비할인</span>
						<strong id="sc_cp_price">0</strong>원
						<input type="hidden" name="sc_cp_id" value="">
						<button type="button" id="sc_coupon_btn" class="btn-e btn-e-dark m-l-5">쿠폰적용</button>
					</div>
				</td></tr>
                <?php } ?>
				<!--tr><th>추가배송비</th><td>
						<span id="od_send_cost2">0</span>원
				</td></tr-->
				<tr><th>할인금액</th><td>-<span id="ct_tot_coupon">0</span>원</td></tr>
				<tr><th>결제금액</th><td><?php echo number_format($tot_sell_price); ?>원</td></tr>
			</table>

			<h5>결제방법</h5>

                <div class="payment-select-wrap">
                    <?php if ($is_kakaopay_use || $default['de_bank_use'] || $default['de_vbank_use'] || $default['de_iche_use'] || $default['de_card_use'] || $default['de_hp_use'] || $default['de_easy_pay_use'] || $default['de_inicis_lpay_use'] || $default['de_inicis_kakaopay_use']) { ?>
                    <fieldset id="sod_frm_paysel">
                    <legend>결제방법 선택</legend>
                    <?php } ?>

                    <?php if($is_kakaopay_use) { $multi_settle++; // 카카오페이 ?>
                    <input type="radio" id="od_settle_kakaopay" name="od_settle_case" value="KAKAOPAY" <?php echo $checked; ?>><label for="od_settle_kakaopay" class="payment-select-box">KAKAOPAY</label>
                    <?php $checked = ''; } ?>

                    <?php if($default['de_bank_use']) { $multi_settle++; // 무통장입금 사용 ?>
                    <input type="radio" id="od_settle_bank" name="od_settle_case" value="무통장" <?php echo $checked; ?>><label for="od_settle_bank" class="payment-select-box">무통장입금</label>
                    <?php $checked = ''; } ?>

                    <?php if($default['de_vbank_use']) { $multi_settle++; // 가상계좌 사용 ?>
                    <input type="radio" id="od_settle_vbank" name="od_settle_case" value="가상계좌" <?php echo $checked; ?>><label for="od_settle_vbank" class="payment-select-box"><?php echo $escrow_title; ?>가상계좌</label>
                    <?php $checked = ''; } ?>

                    <?php if($default['de_iche_use']) { $multi_settle++; // 계좌이체 사용 ?>
                    <input type="radio" id="od_settle_iche" name="od_settle_case" value="계좌이체" <?php echo $checked; ?>><label for="od_settle_iche" class="payment-select-box"><?php echo $escrow_title; ?>계좌이체</label>
                    <?php $checked = ''; } ?>

                    <?php if($default['de_hp_use']) { $multi_settle++; // 휴대폰 사용 ?>
                    <input type="radio" id="od_settle_hp" name="od_settle_case" value="휴대폰" <?php echo $checked; ?>><label for="od_settle_hp" class="payment-select-box">휴대폰</label>
                    <?php $checked = ''; } ?>

                    <?php if($default['de_card_use']) { $multi_settle++; // 신용카드 사용 ?>
                    <input type="radio" id="od_settle_card" name="od_settle_case" value="신용카드" <?php echo $checked; ?>><label for="od_settle_card" class="payment-select-box">신용카드</label>
                    <?php $checked = ''; } ?>

                    <?php if(isset($default['de_inicis_kakaopay_use']) && $default['de_inicis_kakaopay_use']) { $multi_settle++; // 이니시스 카카오페이  ?>
                    <input type="radio" id="od_settle_inicis_kakaopay" name="od_settle_case" value="inicis_kakaopay" <?php echo $checked; ?>><label for="od_settle_inicis_kakaopay" class="payment-select-box">KG 이니시스 카카오페이</label>
                    <?php $checked = ''; } ?>

                    <?php
                    $easypay_prints = array();

                    // PG 간편결제
                    if($default['de_easy_pay_use']) {
                        switch($default['de_pg_service']) {
                            case 'lg':
                                $pg_easy_pay_name = 'PAYNOW';
                                break;
                            case 'inicis':
                                $pg_easy_pay_name = 'KPAY';
                                break;
                            default:
                                $pg_easy_pay_name = 'PAYCO';
                                break;
                        }
                        $multi_settle++;

                        if($default['de_pg_service'] === 'kcp' && isset($default['de_easy_pay_services']) && $default['de_easy_pay_services']){
                            $de_easy_pay_service_array = explode(',', $default['de_easy_pay_services']);
                            if( in_array('nhnkcp_payco', $de_easy_pay_service_array) ){
                                $easypay_prints['nhnkcp_payco'] = '<input type="radio" id="od_settle_nhnkcp_payco" name="od_settle_case" data-pay="payco" value="간편결제"> <label for="od_settle_nhnkcp_payco" class="payment-select-box PAYCO nhnkcp_payco" title="NHN_KCP - PAYCO">PAYCO</label>';
                            }
                            if( in_array('nhnkcp_naverpay', $de_easy_pay_service_array) ){
                                $easypay_prints['nhnkcp_naverpay'] = '<input type="radio" id="od_settle_nhnkcp_naverpay" name="od_settle_case" data-pay="naverpay" value="간편결제" > <label for="od_settle_nhnkcp_naverpay" class="payment-select-box naverpay_icon nhnkcp_naverpay" title="NHN_KCP - 네이버페이">네이버페이</label>';
                            }
                            if( in_array('nhnkcp_kakaopay', $de_easy_pay_service_array) ){
                                $easypay_prints['nhnkcp_kakaopay'] = '<input type="radio" id="od_settle_nhnkcp_kakaopay" name="od_settle_case" data-pay="kakaopay" value="간편결제" > <label for="od_settle_nhnkcp_kakaopay" class="payment-select-box kakaopay_icon nhnkcp_kakaopay" title="NHN_KCP - 카카오페이">카카오페이</label>';
                            }
                        } else {
                            $easypay_prints[strtolower($pg_easy_pay_name)] = '<input type="radio" id="od_settle_easy_pay" name="od_settle_case" value="간편결제"> <label for="od_settle_easy_pay" class="payment-select-box '.$pg_easy_pay_name.'">'.$pg_easy_pay_name.'</label>';
                        }
                    }
                    if( ! isset($easypay_prints['nhnkcp_naverpay']) && function_exists('is_use_easypay') && is_use_easypay('global_nhnkcp') ){
                        $easypay_prints['nhnkcp_naverpay'] = '<input type="radio" id="od_settle_nhnkcp_naverpay" name="od_settle_case" data-pay="naverpay" value="간편결제" > <label for="od_settle_nhnkcp_naverpay" class="payment-select-box naverpay_icon nhnkcp_naverpay" title="NHN_KCP - 네이버페이">네이버페이</label>';
                    }
    
                    if($easypay_prints) {
                        $multi_settle++;
                        echo run_replace('shop_orderform_easypay_buttons', implode(PHP_EOL, $easypay_prints), $easypay_prints, $multi_settle);
                    }     
                    ?>

                    <?php if($default['de_inicis_lpay_use']) { // 이니시스 Lpay ?>
                    <input type="radio" id="od_settle_inicislpay" data-case="lpay" name="od_settle_case" value="lpay" <?php echo $checked; ?>><label for="od_settle_inicislpay" class="payment-select-box inicis_lpay">L.pay</label>
                    <?php $checked = ''; } ?>

                    <div class="clearfix"></div>

                    <?php if ($temp_point) { // 회원이면서 포인트사용이면 ?>
                    <div class="payment-point-use-box">
                        <div class="payment-point-use">
                            <label for="od_temp_point" class="float-start">사용 포인트(<?php echo $point_unit; ?>점 단위)</label>
                            <div class="float-end width-120px">
                                <input type="hidden" name="max_temp_point" value="<?php echo $temp_point; ?>">
                                <label class="input">
                                <i class="icon-append font-style-normal">점</i>
                                <input type="text" name="od_temp_point" value="0" id="od_temp_point" size="7">
                                </label>
                            </div>
                        </div>
                        <div class="payment-point-use">
                            <strong class="float-start">보유포인트</strong><span class="float-end"><?php echo display_point($member['mb_point']); ?></span>
                            <div class="clearfix"></div>
                            <strong class="float-start">최대 사용 가능 포인트</strong><strong class="float-end text-black"><?php echo display_point($temp_point); ?></strong>
                        </div>
                    </div>
                    <?php $multi_settle++; } ?>

                    <?php if ($default['de_bank_use']) { // 무통장입금 ?>
                    <div id="settle_bank">
                        <label for="od_bank_account" class="sound_only">입금할 계좌</label>
                        <?php if (count((array)$bank_str) <= 1) { ?>
                        <input type="hidden" name="od_bank_account" value="<?php echo $bank_account; ?>"> <?php echo $bank_account; ?>
                        <?php } else { ?>
                        <label class="select">
                            <select name="od_bank_account" id="od_bank_account">
                                <option value="">선택하십시오.</option>
                                <?php foreach ($bank_account as $bank_account) { ?>
                                <option value="<?php echo $bank_account['bank']; ?>"><?php echo $bank_account['bank']; ?></option>
                                <?php } ?>
                            </select>
                            <i></i>
                        </label>
                        <?php } ?>
                        <div class="clearfix m-b-10"></div>
                        <label for="od_deposit_name">입금자명</label>
                        <label class="input">
                            <input type="text" name="od_deposit_name" id="od_deposit_name" size="10" maxlength="20">
                        </label>
                    </div>
                    <?php } ?>

                    <?php if ($is_kakaopay_use || $default['de_bank_use'] || $default['de_vbank_use'] || $default['de_iche_use'] || $default['de_card_use'] || $default['de_hp_use'] || $default['de_easy_pay_use'] || $default['de_inicis_lpay_use'] || $default['de_inicis_kakaopay_use'] ) { ?>
                    </fieldset>
                    <?php } ?>

                    <?php if ($multi_settle == 0) { ?>
                    <p>결제할 방법이 없습니다.<br>운영자에게 알려주시면 감사하겠습니다.</p>
                    <?php } ?>
                </div>

            <?php /* ---------- 결제 정보 입력 끝 ---------- */ ?>

			<div class="cart-act-btn">
            <?php
            // 결제대행사별 코드 include (주문버튼)
            require_once(G5_SHOP_PATH.'/'.$default['de_pg_service'].'/orderform.3.php');

            if($is_kakaopay_use) {
                require_once(G5_SHOP_PATH.'/kakaopay/orderform.3.php');
            }
            ?>

            <?php
            if ($default['de_escrow_use']) {
                // 결제대행사별 코드 include (에스크로 안내)
                require_once(G5_SHOP_PATH.'/'.$default['de_pg_service'].'/orderform.4.php');
            }
            ?>
			</div>

			<p class="caution">
				렌탈 제품은 계약 진행을 위해 해피콜 전화를 드립니다. <br>
				해피콜 완료 후 결제 및 배송되오니 1670-3171 전화를 꼭 받아주세요.
			</p>

            <div>
                <p class="title">반품/환불 정보</p>
                <p>
                교환/반품 시 먼저 판매자와 연락하셔서 사유, 택배사, 배송비, 교환/반품지 주소 등을 협의하신 후 상품을 발송해 주시기 바랍니다.
                </p>
                <p class="title">반품/교환 사유에 따른 요청 가능 기간</p>
                <ul>
                    <li>1. 구매자 단순 변심은 상품 수령 후 7일 이내 (구매자 반품배송비 부담)</li>
                    <li>2. 표시/광고와 상이, 계약 내용과 다르게 이행된 경우 상품 수령 후 3개월 이내 혹은 표시/광고와 다른 사실을 안 날로부터 30일 이내 (판매자 반품 배송비 부담)</li>
                    <li>3. 둘 중 하나 경과 시 반품/교환 불가</li>
                </ul>

                <p class="title">반품/교환 불가능 사유</p>
                <ul>
                    <li>1. 반품요청기간이 지난 경우</li>
                    <li>2.구매자의 책임 있는 사유로 상품 등이 멸실 또는 훼손된 경우 (단, 상품의 내용을 확인하기 위하여 포장 등을 훼손한 경우는 제외)</li>
                    <li>3.구매자의 책임있는 사유로 포장이 훼손되어 상품 가치가 현저히 상실된 경우 (예: 식품, 화장품, 향수류, 음반 등)</li>
                    <li>4.구매자의 사용 또는 일부 소비에 의하여 상품의 가치가 현저히 감소한 경우 (라벨이 떨어진 의류 또는 태그가 떨어진 명품관 상품인 경우)</li>
                    <li>5.시간의 경과에 의하여 재판매가 곤란할 정도로 상품 등의 가치가 현저히 감소한 경우</li>
                    <li>6.고객의 요청사항에 맞춰 제작에 들어가는 맞춤제작상품의 경우 (판매자에게 회복불가능한 손해가 예상되고, 그러한 예정으로 청약철회권 행사가 불가하다는 사실을 서면 동의 받은 경우)</li>
                    <li>7.복제가 가능한 상품 등의 포장을 훼손한 경우 (CD/DVD/GAME/도서의 경우 포장 개봉 시)</li>
                </ul>
            </div>

		</div>
	</div>

</div>

</form>

<div id="modal_coupon_apply" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title f-s-20r"><strong>쿠폰 선택</strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"></div>
        </div>
    </div>
</div>

<div id="modal_od_coupon_apply" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title f-s-20r"><strong>쿠폰 선택</strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"></div>
        </div>
    </div>
</div>

<?php
if( $default['de_inicis_lpay_use'] || $default['de_inicis_kakaopay_use'] ){   //이니시스 L.pay 또는 이니시스 카카오페이 사용시
    require_once(G5_SHOP_PATH.'/inicis/lpay_order.script.php');
}

if(function_exists('is_use_easypay') && is_use_easypay('global_nhnkcp')){  // 타 PG 사용시 NHN KCP 네이버페이 사용이 설정되어 있다면
    require_once(G5_SHOP_PATH.'/kcp/global_nhn_kcp_order.script.php');
}
?>
<script>
window.closeCouponModal = function(){
    $('#modal_coupon_apply').modal('hide');
    $('#modal_od_coupon_apply').modal('hide');
};

var zipcode = "";
var form_action_url = "<?php echo $order_action_url; ?>";

function od_coupon_close(){
    var $coupon_frm = jQuery("#od_coupon_frm");
    if ( $coupon_frm.parent(".od_coupon_wrap").length ){
        $coupon_frm.parent(".od_coupon_wrap").remove();
    } else {
        $coupon_frm.remove();
    }
}

function cp_form_close(){
    var $cp_frm = jQuery("#cp_frm");
    if ( $cp_frm.parent(".od_coupon_wrap").length ){
        $cp_frm.parent(".od_coupon_wrap").remove();
    } else {
        $cp_frm.remove();
    }
}

$(function() {
    var $cp_btn_el;
    var $cp_row_el;

    $(".cp_btn").click(function() {
        $cp_btn_el = $(this);
        $cp_row_el = $(this).closest("tr");
        cp_form_close();
        var it_id = $cp_btn_el.closest("tr").find("input[name^=it_id]").val();

        $.post(
            "./orderitemcoupon.php",
            { it_id: it_id,  sw_direct: "<?php echo $sw_direct; ?>" },
            function(data) {
                $("#modal_coupon_apply .modal-body").html(data);
            }
        );
    });

	$(document).on("click", "#cp_close", function() {
        $(".od_coupon, .od_coupon_wrap").remove();
    });

    $(document).on("click", ".cp_apply", function() {
        var $el = $(this).closest("tr");
        var cp_id = $el.find("input[name='f_cp_id[]']").val();
        var price = $el.find("input[name='f_cp_prc[]']").val();
        var subj = $el.find("input[name='f_cp_subj[]']").val();
        var sell_price;

        if(parseInt(price) == 0) {
            if(!confirm(subj+"쿠폰의 할인 금액은 "+price+"원입니다.\n쿠폰을 적용하시겠습니까?")) {
                return false;
            }
        }

        // 이미 사용한 쿠폰이 있는지
        var cp_dup = false;
        var cp_dup_idx;
        var $cp_dup_el;
        $("input[name^=cp_id]").each(function(index) {
            var id = $(this).val();

            if(id == cp_id) {
                cp_dup_idx = index;
                cp_dup = true;
                $cp_dup_el = $(this).closest("tr");;

                return false;
            }
        });

        if(cp_dup) {
            var it_name = $("input[name='it_name["+cp_dup_idx+"]']").val();
            if(!confirm(subj+ "쿠폰은\n"+it_name+"에 사용되었습니다.\n"+it_name+"의 쿠폰을 취소한 후 적용하시겠습니까?")) {
                return false;
            } else {
                coupon_cancel($cp_dup_el);
                cp_form_close();
                $cp_dup_el.find(".cp_btn").text("쿠폰적용").focus();
                $cp_dup_el.find(".cp_cancel").remove();
            }
        }

        var $s_el = $cp_row_el.find(".total_price");;
        sell_price = parseInt($cp_row_el.find("input[name^=it_price]").val());
        sell_price = sell_price - parseInt(price);
        if(sell_price < 0) {
            alert("쿠폰할인금액이 상품 주문금액보다 크므로 쿠폰을 적용할 수 없습니다.");
            return false;
        }
        $s_el.text(number_format(String(sell_price)));
        $cp_row_el.find("input[name^=cp_id]").val(cp_id);
        $cp_row_el.find("input[name^=cp_price]").val(price);

        calculate_total_price();
        cp_form_close();
        $cp_btn_el.text("쿠폰변경").focus();
        if(!$cp_row_el.find(".cp_cancel").length)
            $cp_btn_el.after("<button type=\"button\" class=\"btn-e btn-e-gray cp_cancel\">취소</button>");
    });

    $(document).on("click", ".cp-close", function() {
        cp_form_close();
        $cp_btn_el.focus();
    });

    $(document).on("click", ".cp_cancel", function() {
        coupon_cancel($(this).closest("tr"));
        calculate_total_price();
        cp_form_close();
        $(this).closest("tr").find(".cp_btn").text("쿠폰적용").focus();
        $(this).remove();
    });

    $("#od_coupon_btn").click(function() {
        if( $("#od_coupon_frm").parent(".od_coupon_wrap").length ){
            $("#od_coupon_frm").parent(".od_coupon_wrap").remove();
        }
        od_coupon_close();
        var $this = $(this);
        var price = parseInt($("input[name=org_od_price]").val()) - parseInt($("input[name=item_coupon]").val());
        if(price <= 0) {
            alert('상품금액이 0원이므로 쿠폰을 사용할 수 없습니다.');
            return false;
        }
        $.post(
            "./ordercoupon.php",
            { price: price },
            function(data) {
                $("#modal_od_coupon_apply .modal-body").html(data);
            }
        );
    });

    $(document).on("click", ".od_cp_apply", function() {
        var $el = $(this).closest("tr");
        var cp_id = $el.find("input[name='o_cp_id[]']").val();
        var price = parseInt($el.find("input[name='o_cp_prc[]']").val());
        var subj = $el.find("input[name='o_cp_subj[]']").val();
        var send_cost = $("input[name=od_send_cost]").val();
        var item_coupon = parseInt($("input[name=item_coupon]").val());
        var od_price = parseInt($("input[name=org_od_price]").val()) - item_coupon;

        if(price == 0) {
            if(!confirm(subj+"쿠폰의 할인 금액은 "+price+"원입니다.\n쿠폰을 적용하시겠습니까?")) {
                return false;
            }
        }

        if(od_price - price <= 0) {
            alert("쿠폰할인금액이 주문금액보다 크므로 쿠폰을 적용할 수 없습니다.");
            return false;
        }

        $("input[name=sc_cp_id]").val("");
        $("#sc_coupon_btn").text("쿠폰적용");
        $("#sc_coupon_cancel").remove();

        $("input[name=od_price]").val(od_price - price);
        $("input[name=od_cp_id]").val(cp_id);
        $("input[name=od_coupon]").val(price);
        $("input[name=od_send_coupon]").val(0);
        $("#od_cp_price").text(number_format(String(price)));
        $("#sc_cp_price").text(0);
        calculate_order_price();
        if( $("#od_coupon_frm").parent(".od_coupon_wrap").length ){
            $("#od_coupon_frm").parent(".od_coupon_wrap").remove();
        }
        od_coupon_close();
        $("#od_coupon_btn").text("쿠폰변경").focus();
        if(!$("#od_coupon_cancel").length)
            $("#od_coupon_btn").after("<button type=\"button\" id=\"od_coupon_cancel\" class=\"btn-e btn-e-gray cp_cancel\">취소</button>");
    });

    $(document).on("click", ".od-coupon-close", function() {
        if( $("#od_coupon_frm").parent(".od_coupon_wrap").length ){
            $("#od_coupon_frm").parent(".od_coupon_wrap").remove();
        }
        od_coupon_close();
        $("#od_coupon_btn").focus();
    });

    $(document).on("click", "#od_coupon_cancel", function() {
        var org_price = $("input[name=org_od_price]").val();
        var item_coupon = parseInt($("input[name=item_coupon]").val());
        $("input[name=od_price]").val(org_price - item_coupon);
        $("input[name=sc_cp_id]").val("");
        $("input[name=od_coupon]").val(0);
        $("input[name=od_send_coupon]").val(0);
        $("#od_cp_price").text(0);
        $("#sc_cp_price").text(0);
        calculate_order_price();
        if( $("#od_coupon_frm").parent(".od_coupon_wrap").length ){
            $("#od_coupon_frm").parent(".od_coupon_wrap").remove();
        }
        od_coupon_close();
        $("#od_coupon_btn").text("쿠폰적용").focus();
        $(this).remove();
        $("#sc_coupon_btn").text("쿠폰적용");
        $("#sc_coupon_cancel").remove();
    });

    $("#sc_coupon_btn").click(function() {
        $("#sc_coupon_frm").remove();
        var $this = $(this);
        var price = parseInt($("input[name=od_price]").val());
        var send_cost = parseInt($("input[name=od_send_cost]").val());
        $.post(
            "./ordersendcostcoupon.php",
            { price: price, send_cost: send_cost },
            function(data) {
                $this.after(data);
            }
        );
    });

    $(document).on("click", ".sc_cp_apply", function() {
        var $el = $(this).closest("tr");
        var cp_id = $el.find("input[name='s_cp_id[]']").val();
        var price = parseInt($el.find("input[name='s_cp_prc[]']").val());
        var subj = $el.find("input[name='s_cp_subj[]']").val();
        var send_cost = parseInt($("input[name=od_send_cost]").val());

        if(parseInt(price) == 0) {
            if(!confirm(subj+"쿠폰의 할인 금액은 "+price+"원입니다.\n쿠폰을 적용하시겠습니까?")) {
                return false;
            }
        }

        $("input[name=sc_cp_id]").val(cp_id);
        $("input[name=od_send_coupon]").val(price);
        $("#sc_cp_price").text(number_format(String(price)));
        calculate_order_price();
        $("#sc_coupon_frm").remove();
        $("#sc_coupon_btn").text("쿠폰변경").focus();
        if(!$("#sc_coupon_cancel").length)
            $("#sc_coupon_btn").after("<button type=\"button\" id=\"sc_coupon_cancel\" class=\"btn-e btn-e-gray cp_cancel\">취소</button>");
    });

    $(document).on("click", "#sc_coupon_close", function() {
        $("#sc_coupon_frm").remove();
        $("#sc_coupon_btn").focus();
    });

    $(document).on("click", "#sc_coupon_cancel", function() {
        $("input[name=od_send_coupon]").val(0);
        $("#sc_cp_price").text(0);
        calculate_order_price();
        $("#sc_coupon_frm").remove();
        $("#sc_coupon_btn").text("쿠폰적용").focus();
        $(this).remove();
    });

    $("#od_b_addr2").focus(function() {
        var zip = $("#od_b_zip").val().replace(/[^0-9]/g, "");
        if(zip == "")
            return false;

        var code = String(zip);

        if(zipcode == code)
            return false;

        zipcode = code;
        calculate_sendcost(code);
    });

    $("#od_settle_bank").on("click", function() {
        $("[name=od_deposit_name]").val( $("[name=od_name]").val() );
        $("#settle_bank").show();
    });

    $("#od_settle_iche,#od_settle_card,#od_settle_vbank,#od_settle_hp,#od_settle_easy_pay,#od_settle_kakaopay,#od_settle_nhnkcp_payco,#od_settle_nhnkcp_naverpay,#od_settle_nhnkcp_kakaopay,#od_settle_inicislpay,#od_settle_inicis_kakaopay").bind("click", function() {
        $("#settle_bank").hide();
    });

    // 배송지선택
    $("input[name=ad_sel_addr]").on("click", function() {
        var addr = $(this).val().split(String.fromCharCode(30));

        if (addr[0] == "same") {
            gumae2baesong();
        } else {
            if(addr[0] == "new") {
                for(i=0; i<10; i++) {
                    addr[i] = "";
                }
            }

            var f = document.forderform;
            f.od_b_name.value        = addr[0];
            f.od_b_tel.value         = addr[1];
            f.od_b_hp.value          = addr[2];
            f.od_b_zip.value         = addr[3] + addr[4];
            f.od_b_addr1.value       = addr[5];
            f.od_b_addr2.value       = addr[6];
            f.od_b_addr3.value       = addr[7];
            f.od_b_addr_jibeon.value = addr[8];
            f.ad_subject.value       = addr[9];

            var zip1 = addr[3].replace(/[^0-9]/g, "");
            var zip2 = addr[4].replace(/[^0-9]/g, "");

            var code = String(zip1) + String(zip2);

            if(zipcode != code) {
                calculate_sendcost(code);
            }
        }
    });

    // 배송지목록
    $("#order_address").on("click", function() {
        var url = this.href;
        window.open(url, "win_address", "left=100,top=100,width=800,height=600,scrollbars=1");
        return false;
    });
});

function coupon_cancel($el)
{
    var $dup_sell_el = $el.find(".total_price");
    var $dup_price_el = $el.find("input[name^=cp_price]");
    var org_sell_price = $el.find("input[name^=it_price]").val();

    $dup_sell_el.text(number_format(String(org_sell_price)));
    $dup_price_el.val(0);
    $el.find("input[name^=cp_id]").val("");
}

function calculate_total_price()
{
    var $it_prc = $("input[name^=it_price]");
    var $cp_prc = $("input[name^=cp_price]");
    var tot_sell_price = sell_price = tot_cp_price = 0;
    var it_price, cp_price, it_notax;
    var tot_mny = comm_tax_mny = comm_vat_mny = comm_free_mny = tax_mny = vat_mny = 0;
    var send_cost = parseInt($("input[name=od_send_cost]").val());

    $it_prc.each(function(index) {
        it_price = parseInt($(this).val());
        cp_price = parseInt($cp_prc.eq(index).val());
        sell_price += it_price;
        tot_cp_price += cp_price;
    });

    tot_sell_price = sell_price - tot_cp_price + send_cost;

    $("#ct_tot_coupon").text(number_format(String(tot_cp_price)));
    $("#ct_tot_price").text(number_format(String(tot_sell_price)));

    $("input[name=good_mny]").val(tot_sell_price);
    $("input[name=od_price]").val(sell_price - tot_cp_price);
    $("input[name=item_coupon]").val(tot_cp_price);
    $("input[name=od_coupon]").val(0);
    $("input[name=od_send_coupon]").val(0);
    <?php if($oc_cnt > 0) { ?>
    $("input[name=od_cp_id]").val("");
    $("#od_cp_price").text(0);
    if($("#od_coupon_cancel").length) {
        $("#od_coupon_btn").text("쿠폰적용");
        $("#od_coupon_cancel").remove();
    }
    <?php } ?>
    <?php if($sc_cnt > 0) { ?>
    $("input[name=sc_cp_id]").val("");
    $("#sc_cp_price").text(0);
    if($("#sc_coupon_cancel").length) {
        $("#sc_coupon_btn").text("쿠폰적용");
        $("#sc_coupon_cancel").remove();
    }
    <?php } ?>
    $("input[name=od_temp_point]").val(0);
    <?php if($temp_point > 0 && $is_member) { ?>
    calculate_temp_point();
    <?php } ?>
    calculate_order_price();
}

function calculate_order_price()
{
    var sell_price = parseInt($("input[name=od_price]").val());
    var send_cost = parseInt($("input[name=od_send_cost]").val());
    var send_cost2 = parseInt($("input[name=od_send_cost2]").val());
    var send_coupon = parseInt($("input[name=od_send_coupon]").val());
    var tot_price = sell_price + send_cost + send_cost2 - send_coupon;

    $("input[name=good_mny]").val(tot_price);
    $("#od_tot_price .print_price").text(number_format(String(tot_price)));
    <?php if($temp_point > 0 && $is_member) { ?>
    calculate_temp_point();
    <?php } ?>
}

function calculate_temp_point()
{
    var sell_price = parseInt($("input[name=od_price]").val());
    var mb_point = parseInt(<?php echo $member['mb_point']; ?>);
    var max_point = parseInt(<?php echo $default['de_settle_max_point']; ?>);
    var point_unit = parseInt(<?php echo $default['de_settle_point_unit']; ?>);
    var temp_point = max_point;

    if(temp_point > sell_price)
        temp_point = sell_price;

    if(temp_point > mb_point)
        temp_point = mb_point;

    temp_point = parseInt(temp_point / point_unit) * point_unit;

    $("#use_max_point").text(number_format(String(temp_point))+"점");
    $("input[name=max_temp_point]").val(temp_point);
}

function calculate_sendcost(code)
{
    $.post(
        "./ordersendcost.php",
        { zipcode: code },
        function(data) {
            $("input[name=od_send_cost2]").val(data);
            $("#od_send_cost2").text(number_format(String(data)));

            zipcode = code;

            calculate_order_price();
        }
    );
}

function calculate_tax()
{
    var $it_prc = $("input[name^=it_price]");
    var $cp_prc = $("input[name^=cp_price]");
    var sell_price = tot_cp_price = 0;
    var it_price, cp_price, it_notax;
    var tot_mny = comm_free_mny = tax_mny = vat_mny = 0;
    var send_cost = parseInt($("input[name=od_send_cost]").val());
    var send_cost2 = parseInt($("input[name=od_send_cost2]").val());
    var od_coupon = parseInt($("input[name=od_coupon]").val());
    var send_coupon = parseInt($("input[name=od_send_coupon]").val());
    var temp_point = 0;

    $it_prc.each(function(index) {
        it_price = parseInt($(this).val());
        cp_price = parseInt($cp_prc.eq(index).val());
        sell_price += it_price;
        tot_cp_price += cp_price;
        it_notax = $("input[name^=it_notax]").eq(index).val();
        if(it_notax == "1") {
            comm_free_mny += (it_price - cp_price);
        } else {
            tot_mny += (it_price - cp_price);
        }
    });

    if($("input[name=od_temp_point]").length)
        temp_point = parseInt($("input[name=od_temp_point]").val());

    tot_mny += (send_cost + send_cost2 - od_coupon - send_coupon - temp_point);
    if(tot_mny < 0) {
        comm_free_mny = comm_free_mny + tot_mny;
        tot_mny = 0;
    }

    tax_mny = Math.round(tot_mny / 1.1);
    vat_mny = tot_mny - tax_mny;
    $("input[name=comm_tax_mny]").val(tax_mny);
    $("input[name=comm_vat_mny]").val(vat_mny);
    $("input[name=comm_free_mny]").val(comm_free_mny);
}

function forderform_check(f)
{
    // 재고체크
    var stock_msg = order_stock_check();
    if(stock_msg != "") {
        alert(stock_msg);
        return false;
    }

    errmsg = "";
    errfld = "";
    var deffld = "";

    check_field(f.od_name, "주문하시는 분 이름을 입력하십시오.");
    if (typeof(f.od_pwd) != 'undefined')
    {
        clear_field(f.od_pwd);
        if( (f.od_pwd.value.length<3) || (f.od_pwd.value.search(/([^A-Za-z0-9]+)/)!=-1) )
            error_field(f.od_pwd, "회원이 아니신 경우 주문서 조회시 필요한 비밀번호를 3자리 이상 입력해 주십시오.");
    }
    check_field(f.od_tel, "주문하시는 분 전화번호를 입력하십시오.");
    check_field(f.od_addr1, "주소검색을 이용하여 주문하시는 분 주소를 입력하십시오.");
    //check_field(f.od_addr2, " 주문하시는 분의 상세주소를 입력하십시오.");
    check_field(f.od_zip, "");

    clear_field(f.od_email);
    if(f.od_email.value=='' || f.od_email.value.search(/(\S+)@(\S+)\.(\S+)/) == -1)
        error_field(f.od_email, "E-mail을 바르게 입력해 주십시오.");

    if (typeof(f.od_hope_date) != "undefined")
    {
        clear_field(f.od_hope_date);
        if (!f.od_hope_date.value)
            error_field(f.od_hope_date, "희망배송일을 선택하여 주십시오.");
    }

    check_field(f.od_b_name, "받으시는 분 이름을 입력하십시오.");
    check_field(f.od_b_tel, "받으시는 분 전화번호를 입력하십시오.");
    check_field(f.od_b_addr1, "주소검색을 이용하여 받으시는 분 주소를 입력하십시오.");
    //check_field(f.od_b_addr2, "받으시는 분의 상세주소를 입력하십시오.");
    check_field(f.od_b_zip, "");

    var od_settle_bank = document.getElementById("od_settle_bank");
    if (od_settle_bank) {
        if (od_settle_bank.checked) {
            check_field(f.od_bank_account, "계좌번호를 선택하세요.");
            check_field(f.od_deposit_name, "입금자명을 입력하세요.");
        }
    }

    // 배송비를 받지 않거나 더 받는 경우 아래식에 + 또는 - 로 대입
    f.od_send_cost.value = parseInt(f.od_send_cost.value);

    if (errmsg)
    {
        alert(errmsg);
        errfld.focus();
        return false;
    }

    var settle_case = document.getElementsByName("od_settle_case");
    var settle_check = false;
    var settle_method = "";
    for (i=0; i<settle_case.length; i++)
    {
        if (settle_case[i].checked)
        {
            settle_check = true;
            settle_method = settle_case[i].value;
            break;
        }
    }
    if (!settle_check)
    {
        alert("결제방식을 선택하십시오.");
        return false;
    }

    var od_price = parseInt(f.od_price.value);
    var send_cost = parseInt(f.od_send_cost.value);
    var send_cost2 = parseInt(f.od_send_cost2.value);
    var send_coupon = parseInt(f.od_send_coupon.value);

    var max_point = 0;
    if (typeof(f.max_temp_point) != "undefined")
        max_point  = parseInt(f.max_temp_point.value);

    var temp_point = 0;
    if (typeof(f.od_temp_point) != "undefined") {
        var point_unit = parseInt(<?php echo $default['de_settle_point_unit']; ?>);
        temp_point = parseInt(f.od_temp_point.value) || 0;

        if (f.od_temp_point.value)
        {
            if (temp_point > od_price) {
                alert("상품 주문금액(배송비 제외) 보다 많이 포인트결제할 수 없습니다.");
                f.od_temp_point.select();
                return false;
            }

            if (temp_point > <?php echo (int)$member['mb_point']; ?>) {
                alert("회원님의 포인트보다 많이 결제할 수 없습니다.");
                f.od_temp_point.select();
                return false;
            }

            if (temp_point > max_point) {
                alert(max_point + "점 이상 결제할 수 없습니다.");
                f.od_temp_point.select();
                return false;
            }

            if (parseInt(parseInt(temp_point / point_unit) * point_unit) != temp_point) {
                alert("포인트를 "+String(point_unit)+"점 단위로 입력하세요.");
                f.od_temp_point.select();
                return false;
            }
        }

        // pg 결제 금액에서 포인트 금액 차감
        if(settle_method != "무통장") {
            f.good_mny.value = od_price + send_cost + send_cost2 - send_coupon - temp_point;
        }
    }

    var tot_price = od_price + send_cost + send_cost2 - send_coupon - temp_point;

    if (document.getElementById("od_settle_iche")) {
        if (document.getElementById("od_settle_iche").checked) {
            if (tot_price < 150) {
                alert("계좌이체는 150원 이상 결제가 가능합니다.");
                return false;
            }
        }
    }

    if (document.getElementById("od_settle_card")) {
        if (document.getElementById("od_settle_card").checked) {
            if (tot_price < 1000) {
                alert("신용카드는 1000원 이상 결제가 가능합니다.");
                return false;
            }
        }
    }

    if (document.getElementById("od_settle_hp")) {
        if (document.getElementById("od_settle_hp").checked) {
            if (tot_price < 350) {
                alert("휴대폰은 350원 이상 결제가 가능합니다.");
                return false;
            }
        }
    }

    <?php if($default['de_tax_flag_use']) { ?>
    calculate_tax();
    <?php } ?>

    <?php if($default['de_pg_service'] == 'inicis') { ?>
    if( f.action != form_action_url ){
        f.action = form_action_url;
        f.removeAttribute("target");
        f.removeAttribute("accept-charset");
    }
    <?php } ?>

    // 카카오페이 지불
    if(settle_method == "KAKAOPAY") {
        <?php if($default['de_tax_flag_use']) { ?>
        f.SupplyAmt.value = parseInt(f.comm_tax_mny.value) + parseInt(f.comm_free_mny.value);
        f.GoodsVat.value  = parseInt(f.comm_vat_mny.value);
        <?php } ?>
        getTxnId(f);
        return false;
    }

    var form_order_method = '';

    if( settle_method == "lpay" || settle_method == "inicis_kakaopay" ){      //이니시스 L.pay 또는 이니시스 카카오페이 이면 ( 이니시스의 삼성페이는 모바일에서만 단독실행 가능함 )
        form_order_method = 'samsungpay';
    } else if(settle_method == "간편결제") {
        if(jQuery("input[name='od_settle_case']:checked" ).attr("data-pay") === "naverpay"){
            form_order_method = 'nhnkcp_naverpay';
        }
    }

    if( jQuery(f).triggerHandler("form_sumbit_order_"+form_order_method) !== false ) {

        // pay_method 설정
        <?php if($default['de_pg_service'] == 'kcp') { ?>
        f.site_cd.value = f.def_site_cd.value;
        if(typeof f.payco_direct !== "undefined") f.payco_direct.value = "";
        if(typeof f.naverpay_direct !== "undefined") f.naverpay_direct.value = "A";
        if(typeof f.kakaopay_direct !== "undefined") f.kakaopay_direct.value = "A";
        switch(settle_method)
        {
            case "계좌이체":
                f.pay_method.value   = "010000000000";
                break;
            case "가상계좌":
                f.pay_method.value   = "001000000000";
                break;
            case "휴대폰":
                f.pay_method.value   = "000010000000";
                break;
            case "신용카드":
                f.pay_method.value   = "100000000000";
                break;
            case "간편결제":
                f.pay_method.value   = "100000000000";

                var nhnkcp_easy_pay = jQuery("input[name='od_settle_case']:checked" ).attr("data-pay");
                
                if(nhnkcp_easy_pay === "naverpay"){
                    if(typeof f.naverpay_direct !== "undefined") f.naverpay_direct.value = "Y";
                } else if(nhnkcp_easy_pay === "kakaopay"){
                    if(typeof f.kakaopay_direct !== "undefined") f.kakaopay_direct.value = "Y";
                } else {
                    if(typeof f.payco_direct !== "undefined") f.payco_direct.value = "Y";
                    <?php if($default['de_card_test']) { ?>
                    f.site_cd.value      = "S6729";
                    <?php } ?>
                }
                break;
            default:
                f.pay_method.value   = "무통장";
                break;
        }
        <?php } else if($default['de_pg_service'] == 'lg') { ?>
        f.LGD_EASYPAY_ONLY.value = "";
        if(typeof f.LGD_CUSTOM_USABLEPAY === "undefined") {
            var input = document.createElement("input");
            input.setAttribute("type", "hidden");
            input.setAttribute("name", "LGD_CUSTOM_USABLEPAY");
            input.setAttribute("value", "");
            f.LGD_EASYPAY_ONLY.parentNode.insertBefore(input, f.LGD_EASYPAY_ONLY);
        }

        switch(settle_method)
        {
            case "계좌이체":
                f.LGD_CUSTOM_FIRSTPAY.value = "SC0030";
                f.LGD_CUSTOM_USABLEPAY.value = "SC0030";
                break;
            case "가상계좌":
                f.LGD_CUSTOM_FIRSTPAY.value = "SC0040";
                f.LGD_CUSTOM_USABLEPAY.value = "SC0040";
                break;
            case "휴대폰":
                f.LGD_CUSTOM_FIRSTPAY.value = "SC0060";
                f.LGD_CUSTOM_USABLEPAY.value = "SC0060";
                break;
            case "신용카드":
                f.LGD_CUSTOM_FIRSTPAY.value = "SC0010";
                f.LGD_CUSTOM_USABLEPAY.value = "SC0010";
                break;
            case "간편결제":
                var elm = f.LGD_CUSTOM_USABLEPAY;
                if(elm.parentNode)
                    elm.parentNode.removeChild(elm);
                f.LGD_EASYPAY_ONLY.value = "PAYNOW";
                break;
            default:
                f.LGD_CUSTOM_FIRSTPAY.value = "무통장";
                break;
        }
        <?php }  else if($default['de_pg_service'] == 'inicis') { ?>
        switch(settle_method)
        {
            case "계좌이체":
                f.gopaymethod.value = "DirectBank";
                break;
            case "가상계좌":
                f.gopaymethod.value = "VBank";
                break;
            case "휴대폰":
                f.gopaymethod.value = "HPP";
                break;
            case "신용카드":
                f.gopaymethod.value = "Card";
                f.acceptmethod.value = f.acceptmethod.value.replace(":useescrow", "");
                break;
            case "간편결제":
                f.gopaymethod.value = "Kpay";
                break;
            case "lpay":
                f.gopaymethod.value = "onlylpay";
                f.acceptmethod.value = f.acceptmethod.value+":cardonly";
                break;
            case "inicis_kakaopay":
                f.gopaymethod.value = "onlykakaopay";
                f.acceptmethod.value = f.acceptmethod.value+":cardonly";
                break;
            default:
                f.gopaymethod.value = "무통장";
                break;
        }
        <?php } ?>

        // 결제정보설정
        <?php if($default['de_pg_service'] == 'kcp') { ?>
        f.buyr_name.value = f.od_name.value;
        f.buyr_mail.value = f.od_email.value;
        f.buyr_tel1.value = f.od_tel.value;
        f.buyr_tel2.value = f.od_hp.value;
        f.rcvr_name.value = f.od_b_name.value;
        f.rcvr_tel1.value = f.od_b_tel.value;
        f.rcvr_tel2.value = f.od_b_hp.value;
        f.rcvr_mail.value = f.od_email.value;
        f.rcvr_zipx.value = f.od_b_zip.value;
        f.rcvr_add1.value = f.od_b_addr1.value;
        f.rcvr_add2.value = f.od_b_addr2.value;

        if(f.pay_method.value != "무통장") {
            jsf__pay( f );
        } else {
            f.submit();
        }
        <?php } ?>
        <?php if($default['de_pg_service'] == 'lg') { ?>
        f.LGD_BUYER.value = f.od_name.value;
        f.LGD_BUYEREMAIL.value = f.od_email.value;
        f.LGD_BUYERPHONE.value = f.od_hp.value;
        f.LGD_AMOUNT.value = f.good_mny.value;
        f.LGD_RECEIVER.value = f.od_b_name.value;
        f.LGD_RECEIVERPHONE.value = f.od_b_hp.value;
        <?php if($default['de_escrow_use']) { ?>
        f.LGD_ESCROW_ZIPCODE.value = f.od_b_zip.value;
        f.LGD_ESCROW_ADDRESS1.value = f.od_b_addr1.value;
        f.LGD_ESCROW_ADDRESS2.value = f.od_b_addr2.value;
        f.LGD_ESCROW_BUYERPHONE.value = f.od_hp.value;
        <?php } ?>
        <?php if($default['de_tax_flag_use']) { ?>
        f.LGD_TAXFREEAMOUNT.value = f.comm_free_mny.value;
        <?php } ?>

        if(f.LGD_CUSTOM_FIRSTPAY.value != "무통장") {
            launchCrossPlatform(f);
        } else {
            f.submit();
        }
        <?php } ?>
        <?php if($default['de_pg_service'] == 'inicis') { ?>
        f.price.value       = f.good_mny.value;
        <?php if($default['de_tax_flag_use']) { ?>
        f.tax.value         = f.comm_vat_mny.value;
        f.taxfree.value     = f.comm_free_mny.value;
        <?php } ?>
        f.buyername.value   = f.od_name.value;
        f.buyeremail.value  = f.od_email.value;
        f.buyertel.value    = f.od_hp.value ? f.od_hp.value : f.od_tel.value;
        f.recvname.value    = f.od_b_name.value;
        f.recvtel.value     = f.od_b_hp.value ? f.od_b_hp.value : f.od_b_tel.value;
        f.recvpostnum.value = f.od_b_zip.value;
        f.recvaddr.value    = f.od_b_addr1.value + " " +f.od_b_addr2.value;

        if(f.gopaymethod.value != "무통장") {
            // 주문정보 임시저장
            var order_data = $(f).serialize();
            var save_result = "";
            $.ajax({
                type: "POST",
                data: order_data,
                url: g5_url+"/shop/ajax.orderdatasave.php",
                cache: false,
                async: false,
                success: function(data) {
                    save_result = data;
                }
            });

            if(save_result) {
                alert(save_result);
                return false;
            }

            if(!make_signature(f))
                return false;

            paybtn(f);
        } else {
            f.submit();
        }
        <?php } ?>
    }

}

// 구매자 정보와 동일합니다.
function gumae2baesong() {
    var f = document.forderform;

    f.od_b_name.value = f.od_name.value;
    f.od_b_tel.value  = f.od_tel.value;
    f.od_b_hp.value   = f.od_hp.value;
    f.od_b_zip.value  = f.od_zip.value;
    f.od_b_addr1.value = f.od_addr1.value;
    f.od_b_addr2.value = f.od_addr2.value;
    f.od_b_addr3.value = f.od_addr3.value;
    f.od_b_addr_jibeon.value = f.od_addr_jibeon.value;

    calculate_sendcost(String(f.od_b_zip.value));
}

<?php if ($default['de_hope_date_use']) { ?>
$(function(){
    $("#od_hope_date").datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", showButtonPanel: true, yearRange: "c-99:c+99", minDate: "+<?php echo (int)$default['de_hope_date_after']; ?>d;", maxDate: "+<?php echo (int)$default['de_hope_date_after'] + 6; ?>d;" });
});
<?php } ?>

$(function(){
	//tooltip
    $(".tooltip_icon").click(function(){
        $(this).next(".tooltip").fadeIn(400);
    }).mouseout(function(){
        $(this).next(".tooltip").fadeOut();
    });
});
</script>