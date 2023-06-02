<?php
/**
 * page file : /theme/THEME_NAME/page/aboutus.html.php
 */
if (!defined('_EYOOM_')) exit;
?>


<div class="sub-page page-rental">

	<div class="tab"><div>
		<button class="tablinks" onclick="openRental(event, 'rental1')" id="defaultOpen">보험 임대</button>
		<button class="tablinks" onclick="openRental(event, 'rental2')">비보험 임대</button>
	</div></div>

	<!--  보험 임대 -->
	<div id="rental1" class="tabcontent">

		<div class="section section1">
			<h4>양압기 치료 건강보험 적용 항목</h4>

			<ul class="option">
				<li>
					<div class="img"><img src="/images/rental1_icon1.png"></div>
					<p>진단을 위한 <br>제1형 수면 다원검사</p>
				</li>

				<li>
					<div class="img"><img src="/images/rental1_icon2.png"></div>
					<p>처방을 위한 <br>압력적정검사</p>
				</li>

				<li>
					<div class="img"><img src="/images/rental1_icon3.png"></div>
					<p>치료를 위한 <br>양압기 대여료 & 연1회 마스크</p>
				</li>
			</ul>
		</div>

		<div class="section section2">
			<h4>국민건강보험 적용 시 양압기 사용료</h4>
			<h5>건강보험 혜택 항목</h5>

			<table class="wide">
			<tr><th colspan="2">급여대상품목</th><th>기준금액</th><th>본인부담금(50%)</th><th>본인부담금(20%)</th></tr>
			<tr><td rowspan="3">양압기 임대료</td><td>지속형(CPAP)</td><td>76,000원/월</td><td>38,000원/월</td><td>15,200원/월</td></tr>
			<tr><td>자동형(APAP)</td><td>89,000원/월</td><td>44,500원/월</td><td>17,800원/월</td></tr>
			<tr><td>이중형(BPAP)</td><td>126,000원/월</td><td>63,000원/월</td><td>25,200원/월</td></tr>
			<tr><td>마스크</td><td>1개/1년</td><td>95,000원</td><td colspan="2">19,000원 (본인 부담금 20%)</td></tr>
			</table>

			<table class="mob">
			<tr><th>급여대상<br>품목</th><th>기준금액</th><th>본인부담금<br>(50%)</th><th>본인부담금<br>(20%)</th></tr>
			<tr><td colspan="4" class="cols4"></td></tr>
			<tr><td>양압기 임대료<br>지속형(CPAP)</td><td>76,000원<br>/월</td><td>38,000원<br>/월</td><td>15,200원<br>/월</td></tr>
			<tr><td colspan="4" class="cols4"></td></tr>
			<tr><td>양압기 임대료<br>자동형(APAP)</td><td>89,000원<br>/월</td><td>44,500원<br>/월</td><td>17,800원<br>/월</td></tr>
			<tr><td colspan="4" class="cols4"></td></tr>
			<tr><td>양압기 임대료<br>이중형(BPAP)</td><td>126,000원<br>/월</td><td>63,000원<br>/월</td><td>25,200원<br>/월</td></tr>
			<tr><td colspan="4" class="cols4"></td></tr>
			<tr><td>마스크<br>1개/1년</td><td>95,000원</td><td colspan="2">19,000원<br>(본인 부담금 20%)</td></tr>
			</table>
		</div>

		<div class="section section3">
			<h4>양압기 보험 임대 절차</h4>
			<ul class="process">
				<li>
					<h5>수면다원검사</h5>
					<p>전문의 진단</p>
					<p>체형 수면다원검사 수검</p>
				</li>

				<li>
					<h5>수면부호흡증 진단 후 <br>양압기 처방</h5>
					<strong>필요한 서류</strong>
					<p>수면다원검사 결과지</p>
					<p>양압기 처방전</p>
					<p>양압기 등록신청서</p>
				</li>

				<li>
					<h5>양압기 및 <br>마스크 선택</h5>
					<p>처방전에 따라 양압기 종류 결정</p>
					<p>잘 맞는 마스크 선택</p>
				</li>

				<li>
					<h5>임대 계약</h5>
					<p>양압기 공급업체와 임대 계약 체결</p>
				</li>

				<li>
					<h5>양압기 임대 연장</h5>
					<p>최초 처방일로부터 90일 후 양압기 임대 연장을 위해 처방전 갱신</p>
					<p>이후 90일 마다 처방전 갱신</p>
				</li>
			</ul>
		</div>

		<div class="section section4">
			<h4>양압기 임대, 역시 슬립프렌드!</h4>

			<ul class="special">
				<li>
					<div class="img"><img src="/images/rental_icon4.png"></div>
					<p>1:1 수면 매니저 <br>매칭 시스템</p>
				</li>

				<li>
					<div class="img"><img src="/images/rental_icon5.png"></div>
					<p>수면 코디네이터 <br>방문 서비스</p>
				</li>

				<li>
					<div class="img"><img src="/images/rental_icon6.png"></div>
					<p>실시간 <br>데이터 모니터링</p>
				</li>

				<li>
					<div class="img"><img src="/images/rental_icon7.png"></div>
					<p>전자계약관리</p>
				</li>

				<li>
					<div class="img"><img src="/images/rental_icon8.png"></div>
					<p>24시간 <br>고객 컨택 센터</p>
				</li>

				<li>
					<div class="img"><img src="/images/rental_icon9.png"></div>
					<p>전국 매장 운영</p>
				</li>
			</ul>
		</div>

		<!--div class="section section5">
			<h4>양압기 보험 절차 안내 영상</h4>
			<div class="youtube"><img src="/images/youtube.png"></div>
		</div-->

		<div class="call">
			<h5>검사 전 상담하기</h5>
			<!--a href="#" class="kakao"><img src="/images/icon_kakao.png"> 카카오톡 상담</a-->
			<a href="tel:1670-3171" class="tel"><img src="/images/icon_tel.png"> 전화상담 1670-3171</a>
			<a href="/mypage/reservation_write.php" class="request"><img src="/images/icon_arrow_w.png">보험 임대 신청하기</a>
		</div>

	</div>

	<!--  비보험 임대 -->
	<div id="rental2" class="tabcontent">

		<div class="section section1">
			<h4>코골이나 수면무호흡증이 있다면?</h4>
			<p>수면다원검사를 받지 않아도 슬립프렌드 매니저의 1:1 수면 솔루션을 통하여 <br>편리한 양압기 임대와 사용이 가능합니다!</p>

			<ul class="option">
				<li>
					<div class="img"><img src="/images/rental2_icon1.png"></div>
					<p>다양한 브랜드 보유로 <br>고객별 맞춤 기기 추천</p>
				</li>

				<li>
					<div class="img"><img src="/images/rental2_icon2.png"></div>
					<p>1:1 전문 수면 매니저의 <br>커스텀 솔루션 제공</p>
				</li>

				<li>
					<div class="img"><img src="/images/rental2_icon3.png"></div>
					<p>양압기의 지속적이고 <br>체계적인 관리</p>
				</li>
			</ul>
		</div>

		<div class="section section2">
			<h4>양압기 일반 임대 절차 안내</h4>

			<ul class="process2">
				<li>
					<h5>1:1 상담</h5>
					<p>현재 증상과 전반적인 <br>건강 상태 상담 진행 후 <br>양압기 임대 신청</p>
				</li>

				<li>
					<h5>방문 설치</h5>
					<p>수면 코디네이터의 <br>방문을 통해 <br>대면 설치 및 교육 진행</p>
				</li>

				<li>
					<h5>쉬운 사용</h5>
					<p>어플 연동으로 <br>쉽고 빠른 데이터 확인 <br>& AI알림 전송</p>
				</li>

				<li>
					<h5>정기 관리</h5>
					<p>수면 코디네이터의 <br>정기적 슬립 홈케어 <br>(방문 or 비대면)</p>
				</li>
			</ul>
		</div>

		<div class="section section3">
			<h4>양압기 임대, 역시 슬립프렌드!</h4>

			<ul class="special">
				<li>
					<div class="img"><img src="/images/rental_icon4.png"></div>
					<p>1:1 수면 매니저 <br>매칭 시스템</p>
				</li>

				<li>
					<div class="img"><img src="/images/rental_icon5.png"></div>
					<p>수면 코디네이터 <br>방문 서비스</p>
				</li>

				<li>
					<div class="img"><img src="/images/rental_icon6.png"></div>
					<p>실시간 <br>데이터 모니터링</p>
				</li>

				<li>
					<div class="img"><img src="/images/rental_icon7.png"></div>
					<p>전자계약관리</p>
				</li>

				<li>
					<div class="img"><img src="/images/rental_icon8.png"></div>
					<p>24시간 <br>고객 컨택 센터</p>
				</li>

				<li>
					<div class="img"><img src="/images/rental_icon9.png"></div>
					<p>전국 매장 운영</p>
				</li>
			</ul>
		</div>

		<div class="call">
			<h5>검사 전 상담하기</h5>
			<!--a href="#" class="kakao"><img src="/images/icon_kakao.png"> 카카오톡 상담</a-->
			<a href="tel:1670-3171" class="tel"><img src="/images/icon_tel.png"> 전화상담 1670-3171</a>
			<a href="#" class="request"><img src="/images/icon_arrow_w.png">보험 임대 신청하기</a>
		</div>

	</div>


	<script>
	function openRental(evt, rentalName) {
	  var i, tabcontent, tablinks;
	  tabcontent = document.getElementsByClassName("tabcontent");
	  for (i = 0; i < tabcontent.length; i++) {
		tabcontent[i].style.display = "none";
	  }
	  tablinks = document.getElementsByClassName("tablinks");
	  for (i = 0; i < tablinks.length; i++) {
		tablinks[i].className = tablinks[i].className.replace(" active", "");
	  }
	  document.getElementById(rentalName).style.display = "block";
	  evt.currentTarget.className += " active";
	}

	// Get the element with id="defaultOpen" and click on it
	document.getElementById("defaultOpen").click();
	</script>


</div>