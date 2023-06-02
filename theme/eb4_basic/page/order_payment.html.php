<?php
/**
 * page file : /theme/THEME_NAME/page/aboutus.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<div class="sub-page page-order">
	<h4>정기 주문하기</h4>

	<!-- 신용카드의 경우 -->
	<h5>결제방법</h5>
	<div class="order_payment">
		<dl>
			<dt>결제일</dt>
			<dd>
				<select>
					<option>결제일을 선택하세요</option>
				</select>
			</dd>
		</dl>

		<dl>
			<dt>결제방법</dt>
			<dd>
				<select>
					<option>신용카드</option>
				</select>
			</dd>
		</dl>

		<dl>
			<dt>카드사</dt>
			<dd>
				<select>
					<option>선택하세요</option>
				</select>
			</dd>
		</dl>

		<dl>
			<dt>카드 소유자명</dt>
			<dd>
				<input type="text" name="" value="">
			</dd>
		</dl>

		<dl>
			<dt>카드번호</dt>
			<dd class="credit">
				<input type="text" name="" value=""><input type="text" name="" value=""><input type="text" name="" value=""><input type="text" name="" value="">
			</dd>
		</dl>

		<dl>
			<dt>카드 비밀번호</dt>
			<dd>
				<input type="text" name="" value="">
			</dd>
		</dl>

		<dl>
			<dt>유효기간</dt>
			<dd class="date">
				<select>
					<option>월</option>
				</select>

				<select>
					<option>년</option>
				</select>
			</dd>
		</dl>
	</div>

	<div class="order-btn">
		<!--button type="button" class="order">주문하기</button-->
		<a href="/page/?pid=order_complete" class="order">주문하기</a>
	</div>


	<!-- 계좌이체의 경우 -->
	<h5>결제방법</h5>
	<div class="order_payment">
		<dl>
			<dt>결제일</dt>
			<dd>
				<select>
					<option>결제일을 선택하세요</option>
				</select>
			</dd>
		</dl>

		<dl>
			<dt>결제방법</dt>
			<dd>
				<select>
					<option>계좌이체</option>
				</select>
			</dd>
		</dl>

		<dl>
			<dt>은행</dt>
			<dd>
				<select>
					<option>선택하세요</option>
				</select>
			</dd>
		</dl>

		<dl>
			<dt>계좌번호</dt>
			<dd>
				<input type="text" name="" value="">
			</dd>
		</dl>

		<dl>
			<dt>예금주명</dt>
			<dd>
				<input type="text" name="" value="">
			</dd>
		</dl>
	</div>

	<div class="order-btn">
		<!--button type="button" class="order">주문하기</button-->
		<a href="/page/?pid=order_complete" class="order">주문하기</a>
	</div>

</div>