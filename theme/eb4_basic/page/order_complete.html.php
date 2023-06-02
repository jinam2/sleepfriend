<?php
/**
 * page file : /theme/THEME_NAME/page/aboutus.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<div class="sub-page page-order">

	<h4>정기배송 신청완료</h4>

	<div class="order_complete">
		<img src="/images/order_complete.png">
		<p>주문이 완료되었습니다. <br>구매하신 제품은 안전하게 배송해드리겠습니다.</p>
	</div>

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
							<a href="<?php echo shop_item_url($list[$i]['it_id']); ?>">
								<span>[레드메드]</span>
								<strong>에어센스10 오토셋 3G 양압기</strong>
							</a>
						</td>
						<td>수량  1개</td>
						<td>구매가격<span>1,400,000원</span></td>
						<td>결제가격<span class="price"><strong id="sell_price_<?php echo $i; ?>">1,400,000</strong>원</span></td>
						<td>배송비<span>선불</span></td>
					</tr>
				</table>

				<table class="mob">
					<tr>
						<td colspan="2" class="title">
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

	<div class="frame">
		<div class="delivery">
			<h5>배송주기</h5>
			<table class="table">
				<tr>
					<th>배송주기</th>
					<td>월 1회</td>
				</tr>
			</table>

			<h5>배송지 정보</h5>
			<table class="table">
				<tr>
					<th>수령인</th>
					<td>홍길동</td>
				</tr>

				<tr>
					<th>연락처</th>
					<td>010-1234-5678</td>
				</tr>

				<tr>
					<th>배송지</th>
					<td>16425 서울시 강남구 삼성로 212 은마아파트 111-2222</td>
				</tr>
			</table>
		</div>

		<div class="info">
			<h5>결제 정보</h5>
			<table class="table">
			<tr>
				<th>결제일</th>
				<td>매월 1일</td>
			</tr>

			<tr>
				<th>결제방법</th>
				<td>계좌이체</td>
			</tr>

			<tr>
				<th>결제은행</th>
				<td>신한은행  1101406886246</td>
			</tr>

			<tr>
				<th>예금주</th>
				<td>전상훈</td>
			</tr>
			</table>

			<h5>결제 정보</h5>
			<table class="table">
				<tr><th class="total">상품금액 합계</th><td class="total">1,400,000원</td></tr>
				<tr><th>배송비</th><td>0원</td></tr>
				<tr><th>할인금액</th><td>-0원</td></tr>
				<tr><th>결제금액</th><td>1,400,000원</td></tr>
			</table>

			<div class="cart-act-btn">
				<a href="#" class="order">주문내역 가기</a>
			</div>

		</div>

	</div>
</div>