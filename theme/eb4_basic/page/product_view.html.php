<?php
/**
 * page file : /theme/THEME_NAME/page/aboutus.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<link rel="stylesheet" href="<?php echo EYOOM_THEME_URL; ?>/plugins/slick/slick.min.css" type="text/css" media="screen">
<link rel="stylesheet" href="<?php echo EYOOM_THEME_URL; ?>/plugins/fotorama/fotorama.css" type="text/css" media="screen">
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/slick/slick.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/fotorama/fotorama.js"></script>

<style>
.page-title-wrap {display:none;}
.page-view {margin-top:80px;}
@media (max-width:767px) {
	.page-view {margin-top:0px;}
}
</style>

<div class="sub-page page-view">

	<div class="row">
		<div class="col-md-7">
			<div class="shop-product-img">
				<div class="product-img-big fotorama" data-nav="thumbs" data-max-width="100%" data-loop="true" data-allowfullscreen="false">
					<img src="/data/item/1664174712/thumb-1665811114_6195_img2_1000x1000.jpg">
					<img src="/images/img_1000x1000.jpg">
					<img src="/data/item/1664174712/thumb-1665811114_6195_img2_1000x1000.jpg">
				</div>
			</div>
		</div>

		<div class="col-md-5">
			<div class="shop-product-form 2017_renewal_itemform">
				<h3 class="product-title">
					<span>레즈메드</span>
					<strong>에어센스10 오토셋 3G 양압기</strong>
				</h3>
				<p class="basic">Take off the day with our new makeup removing wash. Our ingredients ensure that your makeup comes off easily , without drying your skin. </p>
				<div class="shop-description-box">
					<p class="price">판매가 1,400,000원</p>
					<p class="it_price"><span>구매</span>1,400,000원</p>
					<p class="it_rental"><span>렌탈</span>월 48,900원~</p>
					<p class="point">적립 예정 포인트 42,000P</p>
				</div>
				<div id="sit_ov_btn">
					<a href="/shop/item.php?it_id=1664174712">구매</a>
				</div>
			</div>
		</div>
	</div>

<script>
$(document).ready(function(){
	$(function(){
		// 상품이미지 첫번째 링크
		$(".product-img-big a:first").addClass("visible");
		// 상품이미지 미리보기 (썸네일에 마우스 오버시)
		$(".product-thumb .thumb-img").bind("mouseover focus", function(){
			var idx = $(".product-thumb .thumb-img").index($(this));
			$(".product-img-big a.visible").removeClass("visible");
			$(".product-img-big a:eq("+idx+")").addClass("visible");
		});
	});
});
</script>

<script>
$(window).load(function(){
	$('.product-thumb').fadeIn(300);
});

$(function(){
	$('.product-thumb').slick({
		arrows: true,
		infinite: false,
		slidesToShow: 5,
		slidesToScroll: 5,
		autoplay: false
	});
});
</script>

<script>
$(function(){
	// 상품이미지 첫번째 링크
	$("#sit_pvi_big a:first").addClass("visible");

	// 상품이미지 미리보기 (썸네일에 마우스 오버시)
	$("#sit_pvi .img_thumb").bind("mouseover focus", function(){
		var idx = $("#sit_pvi .img_thumb").index($(this));
		$("#sit_pvi_big a.visible").removeClass("visible");
		$("#sit_pvi_big a:eq("+idx+")").addClass("visible");
	});

	// 상품이미지 크게보기
	$(".popup_item_image").click(function() {
		var url = $(this).attr("href");
		var top = 10;
		var left = 10;
		var opt = 'scrollbars=yes,top='+top+',left='+left;
		popup_window(url, "largeimage", opt);

		return false;
	});
});

</script>
<script src="<?php echo G5_JS_URL; ?>/shop.override.js"></script>

	<!-- 관련상품 -->
	<section id="sit_rel">
		<h2>함께 구매하면 좋아요</h2>

		<div class="relation-10"><div class="relation-10-in">

			<div class="item-relation-10"><div class="item-relation-10-in">
				<div class="product-img-wrap">
					<a href="http://sleep.dplant.co.kr/shop/item.php?it_id=1664169883">
					<div class="product-img">
						<div class="product-img-in"><img src="/images/img_1000x1000.jpg"></div>
					</div>
					</a>
				</div>

				<div class="product-description">
					<div class="product-description-in">
						<h4 class="product-name"><a href="/shop/item.php?it_id=1664169883">에어센스10 오토셋 3G 양압기</a></h4>
						<div class="product-price"><span class="title-price">₩ 1,400,000</span></div>
					</div>
				</div>
			</div></div>

			<div class="item-relation-10"><div class="item-relation-10-in">
				<div class="product-img-wrap">
					<a href="http://sleep.dplant.co.kr/shop/item.php?it_id=1664169883">
					<div class="product-img">
						<div class="product-img-in"><img src="/images/img_1000x1000.jpg"></div>
					</div>
					</a>
				</div>

				<div class="product-description">
					<div class="product-description-in">
						<h4 class="product-name"><a href="/shop/item.php?it_id=1664169883">에어센스10 오토셋 3G 양압기</a></h4>
						<div class="product-price"><span class="title-price">₩ 1,400,000</span></div>
					</div>
				</div>
			</div></div>

			<div class="item-relation-10"><div class="item-relation-10-in">
				<div class="product-img-wrap">
					<a href="http://sleep.dplant.co.kr/shop/item.php?it_id=1664169883">
					<div class="product-img">
						<div class="product-img-in"><img src="/images/img_1000x1000.jpg"></div>
					</div>
					</a>
				</div>

				<div class="product-description">
					<div class="product-description-in">
						<h4 class="product-name"><a href="/shop/item.php?it_id=1664169883">에어센스10 오토셋 3G 양압기</a></h4>
						<div class="product-price"><span class="title-price">₩ 1,400,000</span></div>
					</div>
				</div>
			</div></div>

			<div class="item-relation-10"><div class="item-relation-10-in">
				<div class="product-img-wrap">
					<a href="http://sleep.dplant.co.kr/shop/item.php?it_id=1664169883">
					<div class="product-img">
						<div class="product-img-in"><img src="/images/img_1000x1000.jpg"></div>
					</div>
					</a>
				</div>

				<div class="product-description">
					<div class="product-description-in">
						<h4 class="product-name"><a href="/shop/item.php?it_id=1664169883">에어센스10 오토셋 3G 양압기</a></h4>
						<div class="product-price"><span class="title-price">₩ 1,400,000</span></div>
					</div>
				</div>
			</div></div>

			<div class="item-relation-10"><div class="item-relation-10-in">
				<div class="product-img-wrap">
					<a href="http://sleep.dplant.co.kr/shop/item.php?it_id=1664169883">
					<div class="product-img">
						<div class="product-img-in"><img src="/images/img_1000x1000.jpg"></div>
					</div>
					</a>
				</div>

				<div class="product-description">
					<div class="product-description-in">
						<h4 class="product-name"><a href="/shop/item.php?it_id=1664169883">에어센스10 오토셋 3G 양압기</a></h4>
						<div class="product-price"><span class="title-price">₩ 1,400,000</span></div>
					</div>
				</div>
			</div></div>

		</div>

		<script>
		$('.relation-10-in').slick({
			dots: false,
			infinite: true,
			centerMode: true,
			centerPadding: '0px',
			slidesToShow: 3,
			slidesToScroll: 1,
			autoplay: true,
			autoplaySpeed: 4000,
			responsive: [
				{
					breakpoint: 1200,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 2
					}
				},
				{
					breakpoint: 768,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 2
					}
				}
			]
		});
		</script>

	</section>

	<!-- 상세설명 -->
	<section id="sit_inf">
		<div class="pg-anchor-in">
			<ul class="nav nav-tabs">
				<li class="active">상세설명</li>
			</ul>
			<div class="tab-bottom-line"></div>
		</div>

		<div id="sit_inf_explan">
			상세설명 내용이 보여집니다.<br><br>
			<img src="http://sleep.dplant.co.kr/data/editor/2209/55137be0b1ce520f0d38a7b4769df528_1664170058_4518_1664170109_1664170112_1664174712.png" />
		</div>
	</section>

	<div class="button">
		<a onclick="javascript:history.go(-1);" style="cursor:pointer"><img src="/images/icon_arrow_w.png"> 목록보기</a>
	</div>



</div>