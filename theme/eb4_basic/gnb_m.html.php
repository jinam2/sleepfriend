	<!-- 모바일 펼침메뉴 -->
	<div class="sidebar-left offcanvas offcanvas-start" tabindex="-1" id="offcanvasLeft" aria-controls="offcanvasLeftLabel">
		<div class="sidebar-left-content">
			<div class="nav-top">
				<div class="logo"><a href="/"><img src="/images/logo_m.png"></a></div>
				<div class="user">
					<a class="navbar-toggler search-toggle mobile-search-btn"><img src="/images/top_search_m.png"></a>
					<a href="<?php echo G5_SHOP_URL; ?>/cart.php"><img src="/images/top_cart_m.png"></button></a>
					<button type="button" class="close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
				</div>
			</div>

			<div class="menu">
			<?php if ($is_member) {  ?>
				<a href="/bbs/logout.php">로그아웃</a>
				<a href="/mypage">마이페이지</a>
			<?php } else { ?>
				<a href="/bbs/login.php">로그인</a>
				<a href="/bbs/register.php">회원가입</a>
			<?php }  ?>
				<a href="/shop">쇼핑몰</a>
			</div>

			<div class="nav">
				<strong>회사소개</strong>
				<ul>
					<li><a href="/page/?pid=brand">브랜드 가치</a></li>
					<li><a href="/bbs/board.php?bo_table=news">새로운 소식</a></li>
				</ul>
			</div>

			<div class="nav">
				<strong>양압기 치료</strong>
				<ul>
					<li><a href="/page/?pid=cure">양압기 치료</a></li>
				</ul>
			</div>

			<div class="nav">
				<strong>솔루션</strong>
				<ul>
					<li><a href="/page/?pid=app">어플리케이션</a></li>
					<li><a href="/page/?pid=check">가정수면검사</a></li>
					<li><a href="/page/?pid=coordinator">수면코디네이터</a></li>
					<li><a href="/page/?pid=callcenter">24시간 콜센터</a></li>
					<li><a href="/page/?pid=video">영상상담</a></li>
					<li><a href="/page/?pid=experience">양압기 및 마스크 체험 서비스</a></li>
					<li><a href="/liage/?pid=rental">양압기 임대</a></li>
					<li><a href="/page/?pid=data">데이터 분석</a></li>
				</ul>
			</div>

			<!--div class="nav">
				<strong>멤버쉽</strong>
				<ul>
					<li><a href="/page/?pid=membership">멤버쉽 소개</a></li>
				</ul>
			</div-->

			<div class="nav">
				<strong>매장 · 병원</strong>
				<ul>
					<li><a href="/page/?pid=hospital">수면검사병원 찾기</a></li>
					<li><a href="/page/?pid=store">매장 찾기</a></li>
					<li><a href="/page/?pid=store_reservation">매장 방문 예약</a></li>
				</ul>
			</div>


			<div class="nav">
				<strong>고객지원</strong>
				<ul>
					<li><a href="/page/?pid=service">서비스예약</a></li>
					<li><a href="/bbs/board.php?bo_table=guide">영상가이드</a></li>
					<li><a href="/bbs/board.php?bo_table=faq">자주하는 질문</a></li>
					<li><a href="/bbs/board.php?bo_table=event">이벤트</a></li>
				</ul>
			</div>

			<div class="nav">
				<strong>쇼핑몰</strong>
				<ul>
					<li><a href="/shop/list.php?ca_id=10">양압기</a></li>
					<li><a href="/shop/list.php?ca_id=20">마스크</a></li>
					<li><a href="/shop/list.php?ca_id=30">필수소모품</a></li>
				</ul>
			</div>

		</div>
	</div>



	<!-- 모바일 하단 메뉴 -->
	<div id="bottom_nav">
		<ul>
			<li><a href="/"><img src="/images/m_menu1.png"><span>홈</span></a></li>
			<li><a href="/mypage/"><img src="/images/m_menu2.png"><span>마이페이지</span></a></li>
			<li class="btn_sns_share">
				<div class="sns_area">
					<a href="#" class="share-facebook"><i class="xi-facebook"></i></a>
					<a href="#" class="share-twitter"><i class="xi-twitter"></i></a>
					<a href="#" class="share-kakao"><i class="xi-kakaotalk"></i></a>
					<a href="#" class="share-link"><i class="xi-link"></i></a>
				</div>
				<img src="/images/m_menu3.png"><span>공유하기</span>
			</li>
			<li><a href="/shop/"><img src="/images/m_menu4.png"><span>쇼핑몰</span></a></li>
		</ul>
	</div>

	        <script>
	        $(".btn_sns_share").click(function(){
	            $(".sns_area").show();
	        });
	        $(document).mouseup(function (e){
	            var container = $(".sns_area");
	            if( container.has(e.target).length === 0)
	            container.hide();
	        });
	        </script>

<style>
.btn_sns_share {cursor:pointer; position:relative;}
#bottom_nav .sns_area {display:none; position:absolute; top:-76px; left:50%; margin-left:-120px; width:240px; text-align:center;background:#fff; border:1px solid #333; padding:10px;z-index:10}
#bottom_nav .sns_area:before {content:"";position:absolute;bottom:-8px; left:50%; margin-left:-4px;width:0;height:0; border-left:8px solid transparent; border-top:8px solid #333; border-right:8px solid transparent;}
#bottom_nav .sns_area:after {content:"";position:absolute;bottom:-7px; left:50%; margin-left:-4px;width:0;height:0; border-left:8px solid transparent; border-top:8px solid #fff; border-right:8px solid transparent;}
#bottom_nav .sns_area a {display:inline-block;width:44px;height:44px; line-height:44px; background:#eee; text-align:center; border-radius:50%;}
#bottom_nav .sns_area a + a {margin-left:5px;}
#bottom_nav .sns_area a i {font-size:30px; vertical-align:middle;}
#bottom_nav .sns_area .share-facebook {background:#45568e; color:#fff;}
#bottom_nav .sns_area .share-twitter {background:#1c9cea; color:#fff;}
#bottom_nav .sns_area .share-kakao {background:#f2da00; color:#3a1d1d;}
#bottom_nav .sns_area .share-link {background:#333; color:#fff;}
</style>

