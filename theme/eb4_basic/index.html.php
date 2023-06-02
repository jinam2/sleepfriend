<?php
/**
 * theme file : /theme/THEME_NAME/index.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<?php /* ---------- 쇼핑몰 메인 EB 슬라이더 시작 ---------- */ ?>
<div class="main-slider">
	<?php echo eb_slider('1668610115'); ?>
</div>
<?php /* ---------- 쇼핑몰 메인 EB 슬라이더 끝 ---------- */ ?>


<div class="main_contents">

	<!-- 스페셜 -->
	<div class="main_list main_special">
		<h2 class="subject">SLEEP FRIEND’s Speciality</h2>
		<p>당신의 건강한 삶을 함께합니다.</p>

		<div class="slider">
			<div class="box">
				<img src="/images/main_special1.png" class="img">
				<h5>체험 서비스</h5>
				<p>나에게 맞는 양압기 & 마스크 <br>체험해보고 결정!</p>
				<a href="/page/?pid=experience"><img src="/images/icon_arrow.png">자세히 보기</a>
			</div>

			<div class="box">
				<img src="/images/main_special2.png" class="img">
				<h5>동영상 가이드</h5>
				<p>모든 브랜드의 양압기를 <br>쉽게 알려주는 영상 설명서!</p>
				<a href="/bbs/board.php?bo_table=guide"><img src="/images/icon_arrow.png">자세히 보기</a>
			</div>

			<div class="box">
				<img src="/images/main_special3.png" class="img">
				<h5>수면 코디네이터</h5>
				<p>설치부터 케어까지 <br>편한 시간에 받아보세요!</p>
				<a href="/page/?pid=coordinator"><img src="/images/icon_arrow.png">자세히 보기</a>
			</div>

			<div class="box">
				<img src="/images/main_special1.png" class="img">
				<h5>체험 서비스</h5>
				<p>나에게 맞는 양압기 & 마스크 체험해보고 결정!</p>
				<a href="/page/?pid=experience"><img src="/images/icon_arrow.png">자세히 보기</a>
			</div>

			<!--div class="box">
				<img src="/images/main_special1.png" class="img">
				<h5>멤버십 혜택 소개</h5>
				<p>무료 회원가입만 해도 <br>차별화 된 혜택 가득한 SF멤버십!</p>
				<a href="/page/?pid=membership"><img src="/images/icon_arrow.png">자세히 보기</a>
			</div-->

			<div class="box">
				<img src="/images/main_special2.png" class="img">
				<h5>동영상 가이드</h5>
				<p>모든 브랜드의 양압기를 <br>쉽게 알려주는 영상 설명서!</p>
				<a href="/bbs/board.php?bo_table=guide"><img src="/images/icon_arrow.png">자세히 보기</a>
			</div>

			<div class="box">
				<img src="/images/main_special3.png" class="img">
				<h5>수면 코디네이터</h5>
				<p>설치부터 케어까지 <br>편한 시간에 받아보세요!</p>
				<a href="/page/?pid=coordinator"><img src="/images/icon_arrow.png">자세히 보기</a>
			</div>
		</div>

	</div>

	<script>
	$(window).load(function(){
		$('.main_special .slider').slick({
			slidesToShow: 3,
			arrows: true,
			prevArrow: '<button class="slick-prev" aria-label="Previous" type="button">Previous</button>',
			nextArrow: '<button class="slick-next" aria-label="Next" type="button">Next</button>',
			dots: false,
			autoplay: true,
			autoplaySpeed: 5000,
			responsive: [
				{
					breakpoint: 980,
					settings: {
						slidesToShow: 2,
					}
				},
				{
					breakpoint: 768,
					settings: {
						arrows: false,
						slidesToShow: 2,
					}
				},
				{
					breakpoint: 480,
					settings: {
						arrows: false,
						slidesToShow: 1,
					}
				}
			]
		});
	});
	</script>



	<!-- 건강한 수면 -->
	<div class="main_list main_sleep">
		<h2 class="subject">슬립프렌드와 함께하는 <br>건강한 수면</h2>

		<ul>
			<li>
				<h5>기획전</h5>
				<a href="<?php echo G5_URL.'/bbs/board.php?bo_table=event'?>"><img src="/images/icon_arrow.png">자세히 보기</a>
			</li>

			<li>
				<h5>프로모션</h5>
				<a href="<?php echo G5_URL.'/bbs/board.php?bo_table=event'?>"><img src="/images/icon_arrow.png">자세히 보기</a>
			</li>

			<li>
				<h5>렌탈 상담</h5>
				<a href="<?php echo G5_URL.'/page/?pid=rental'?>"><img src="/images/icon_arrow.png">자세히 보기</a>
			</li>

			<li>
				<h5>보험임대</h5>
				<a href="/page/?pid=rental"><img src="/images/icon_arrow.png">자세히 보기</a>
			</li>

			<li>
				<h5>매장안내</h5>
				<a href="/page/?pid=store"><img src="/images/icon_arrow.png">자세히 보기</a>
			</li>
		</ul>
	</div>


	<!--  베스트 상품 -->
	<div class="main_list main_best">
		<h2 class="subject">SLEEP FRIEND’s Best Products</h2>
		<p>카테고리별 베스트 상품</p>

		<div class="tab">
			<button class="tablinks" onclick="openProduct(event, 'Product1')" id="defaultOpen">양압기</button>
			<button class="tablinks" onclick="openProduct(event, 'Product2')">마스크</button>
			<button class="tablinks" onclick="openProduct(event, 'Product3')">소모품</button>
		</div>

		<div id="Product1" class="tabcontent">
			<div class="banner">
				<img src="/images/main_banner.png">
			</div>


            <?php echo eb_goods('1673219099'); ?>


		</div>

		<div id="Product2" class="tabcontent">
			<div class="banner">
				<img src="/images/main_banner.png">
			</div>

            <?php echo eb_goods('1673219361'); ?>

		</div>

		<div id="Product3" class="tabcontent">
			<div class="banner">
				<img src="/images/main_banner.png">
			</div>
            <?php echo eb_goods('1673219431'); ?>
		</div>

		<script>
		function openProduct(evt, goodsName) {
		  var i, tabcontent, tablinks;
		  tabcontent = document.getElementsByClassName("tabcontent");
		  for (i = 0; i < tabcontent.length; i++) {
			tabcontent[i].style.display = "none";
		  }
		  tablinks = document.getElementsByClassName("tablinks");
		  for (i = 0; i < tablinks.length; i++) {
			tablinks[i].className = tablinks[i].className.replace(" active", "");
		  }
		  document.getElementById(goodsName).style.display = "block";
		  evt.currentTarget.className += " active";
		}

		// Get the element with id="defaultOpen" and click on it
		document.getElementById("defaultOpen").click();
		</script>
	</div>


	<!-- 리뷰 -->
	<div class="main_list main_review">
		<h2 class="subject">SLEEP FRIEND’s Real Review</h2>
		<p>슬립프렌드와 함께 상쾌한 아침을 경험해보세요.</p>

        <?php echo eb_latest('1673216416'); ?>


	</div>


	<!-- 도움 -->
	<div class="main_list main_help">

		<div class="left">
			<h2 class="subject">슬립프렌드의 <br>도움이 필요하신가요?</h2>
			<p>슬립프렌드는 수면치료 시장의 전문 인재들이 함께 <br>수면시장의 새로운 비즈니스 모델을 구축하여 <br>환자별 최적의 수면 솔루션을 제공하고 있습니다.<br><br><strong>We Make Your Healthy Life</strong></p>
		</div>

		<div class="right">
			<ul>
				<li>
					<div class="img"><img src="/images/main_help1.png"></div>
					<div class="desc"><a href="/bbs/board.php?bo_table=faq">
						<h5>자주 찾는 질문</h5>
						<p>상담 전 공통적으로 문의하시는 질문들을 <br>빠르게 확인해보세요.</p>
					</a></div>
				</li>

				<li>
					<div class="img"><img src="/images/main_help2.png"></div>
					<div class="desc"><a href="<?php echo G5_URL.'/page/?pid=service';?>">
						<h5>1:1 상담예약</h5>
						<p>방문설치부터 가정수면검사까지, 비대면슬립케어 및 화상상담 등 <br>고객님께서 필요하신 모든 서비스를 제공해드립니다.</p>
					</a></div>
				</li>

				<li>
					<div class="img"><img src="/images/main_help3.png"></div>
					<div class="desc"><a href="<?php echo G5_URL.'/page/?pid=app';?>">
						<h5> APP 다운로드</h5>
						<p>손안에 꿀잠 파트너, 슬립프렌드. <br>보다 편리하고 차별화된 서비스를 만나보세요.</p>
					</a></div>
				</li>

				<li>
					<div class="img"><img src="/images/main_help4.png"></div>
					<div class="desc"><a href="<?php echo G5_URL.'/page/?pid=service';?>">
						<h5>B2B 상담 및 문의</h5>
						<p>간편한 문의, 빠른 답변, 믿을 수 있는 파트너. <br>슬립프렌드는 언제나 열려있습니다.</p>
					</a></div>
				</li>
			</ul>
		</div>

	</div>


</div>



