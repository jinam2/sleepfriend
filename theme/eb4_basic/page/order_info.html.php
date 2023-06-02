<?php
/**
 * page file : /theme/THEME_NAME/page/aboutus.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<div class="sub-page page-order">

	<div class="delivery">
		<h5>배송지 정보</h5>
		<table>
			<tr>
				<th>수령인</th>
				<td><input type="text" name="" value=""></td>
			</tr>

			<tr>
				<th>연락처</th>
				<td>
					<input type="text" name="" value="">
				</td>
			</tr>

			<tr>
				<th>배송지</th>
				<td class="address">
					<input type="text" name="" value="" class="zip"> <button>우편번호 검색</button>
					<input type="text" name="" value="">
					<input type="text" name="" value="">
				</td>
			</tr>

			<tr>
				<th>배송메모</th>
				<td>
					<input type="text" name="" value="">
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
				<input type="text" name="" value="">P <span>(사용가능 포인트 <strong>4,000P</strong>)</span>
			</td>
		</tr>
		</table>

		<h5>결제 예정금액</h5>
		<table class="table">
			<tr><th class="total">상품금액 합계</th><td class="total">1,400,000원</td></tr>
			<tr><th>배송비</th><td>0원</td></tr>
			<tr><th>할인금액</th><td>-0원</td></tr>
			<tr><th>결제금액</th><td>1,400,000원</td></tr>
		</table>

		<div class="cart-act-btn">
			<!--button type="button" class="order">정기배송 신청하기</button-->
			<a href="/page/?pid=order_payment" class="order">정기배송 신청하기</a>
		</div>

	</div>

</div>