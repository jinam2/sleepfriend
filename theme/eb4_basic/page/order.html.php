<?php
/**
 * page file : /theme/THEME_NAME/page/aboutus.html.php
 */
if (!defined('_EYOOM_')) exit;

?>

<div id="order" class="page-order">
	<h4>정기 주문하기</h4>

	<h5>상품정보</h5>
	<ul class="order_view">
		<li>
			<div class="img">
				<div class="tag"><span class="status01">구매</span></div>
				<a href="#"><img src="/data/item/1664170112/thumb-img_160x160.jpg"></a>
			</div>
			<div class="desc">
				<table class="wide">
					<tr>
						<td class="title">
							<label for="ct_chk_<?php echo $i; ?>" class="sound_only">상품</label>
							<label class="checkbox">
								<input type="checkbox" name="ct_chk[<?php echo $i; ?>]" value="1" id="ct_chk_<?php echo $i; ?>" checked="checked"><i></i>
							</label>
							<a href="<?php echo shop_item_url($list[$i]['it_id']); ?>">
								<span>[레드메드]</span>
								<strong>에어센스10 오토셋 3G 양압기</strong>
							</a>
						</td>
						<td>수량  1개</td>
						<td>구매가격<span>1,400,000원</span></td>
						<td>결제가격<span class="price"><strong id="sell_price_<?php echo $i; ?>">1,400,000</strong>원</span></td>
						<td>배송비<span>선불</span></td>
						<td class="check">
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
							<label for="ct_chk_<?php echo $i; ?>" class="sound_only">상품</label>
							<label class="checkbox">
								<input type="checkbox" name="ct_chk[<?php echo $i; ?>]" value="1" id="ct_chk_<?php echo $i; ?>" checked="checked"><i></i>
							</label>
							<a href="<?php echo shop_item_url($list[$i]['it_id']); ?>">
								<span>[레드메드]</span>
								<strong>에어센스10 오토셋 3G 양압기</strong>
							</a>
						</td>
					</tr>
				</table>
				<div class="mob">
					<dl>
						<dt>수량</dt>
						<dd>1개</dd>
					</dl>

					<dl>
						<dt>구매가격</dt>
						<dd>1,400,000원</dd>
					</dl>

					<dl>
						<dt>결제가격</dt>
						<dd><span class="price">1,400,000원</dd>
					</dl>

					<dl>
						<dt>배송비</dt>
						<dd>선불</dd>
					</dl>
				</div>
			</div>
		</li>
	</ul>

	<div class="delete">
		<button type="button" onclick="return form_check('seldelete');">선택삭제</button>
		<button type="button" onclick="return form_check('alldelete');" class="all">전체삭제</button>
	</div>

	<div class="shop-cart-total">
		<div class="delivery">
			<h5>배송주기</h5>
			<div class="radio">
				<input type="radio" id="radio1" name="date_search" value='주 1회' checked><label for="radio1">주 1회</label>
				<input type="radio" id="radio2" name="date_search" value='주 2회'><label for="radio2">주 2회</label>
				<input type="radio" id="radio3" name="date_search" value='월 2회'><label for="radio3">월 2회</label>
				<input type="radio" id="radio4" name="date_search" value='연 1회'><label for="radio4">연 1회</label>
			</div>
		</div>

		<div class="info">
			<h5>결제방법</h5>
			<table>
				<tr><th>결제일</th><td>
					<select>
						<option>결제일을 선택하세요</option>
					</select>
				</td></tr>
				<tr><th>결제방법</th><td>
					<select>
						<option>결제방법을 선택하세요</option>
					</select>
				</td></tr>
			</table>

			<div class="cart-act-btn">
				<!--button type="button" class="recent">최근 사용한 결제방법</button-->
				<a href="/page/?pid=order_info" class="recent">최근 사용한 결제방법</a>

				<!--button type="button" class="add">간편결제기능 추가</button-->
				<a href="/page/?pid=order_info" class="add">간편결제기능 추가</a>

			</div>
		</div>

	</div>

</div>