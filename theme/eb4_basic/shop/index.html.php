<?php
/**
 * theme file : /theme/THEME_NAME/shop/index.html.php
 */
if (!defined('_EYOOM_')) exit;
?>


<?php /* ---------- 쇼핑몰 메인 EB 슬라이더 시작 ---------- */ ?>
<div class="shop-main-slider">
	<?php echo eb_slider('1526428620'); ?>
</div>
<?php /* ---------- 쇼핑몰 메인 EB 슬라이더 끝 ---------- */ ?>


<div class="main_contents">

	<!-- 양압기 best -->
	<h2 class="subject">양압기 Best <a href="/shop/list.php?ca_id=10"><img src="/images/main_arrow.png"> 전체보기</a></h2>

	<section class="main_list">
	<?php
		$list = new item_list($skin_dir.'/'.$default['de_type1_list_skin']);
		$list->set_category('10', 1);
		$list->set_list_mod(3);
		$list->set_list_row(2);
		$list->set_type(1); 
		$list->set_img_size(448, 448);
		$list->set_view('it_img', true);
		$list->set_view('it_id', false);
		$list->set_view('it_name', true);
		$list->set_view('it_basic', false);
		$list->set_view('it_cust_price', true);
		$list->set_view('it_price', true);
		$list->set_view('it_icon', false);
		$list->set_view('sns', false);
		echo $list->run();
		?>
	</section>


	<!-- 마스크 best -->
	<h2 class="subject">마스크 Best <a href="/shop/list.php?ca_id=20"><img src="/images/main_arrow.png"> 전체보기</a></h2>

	<section class="main_list">
	<?php
		$skin_file = G5_SHOP_SKIN_PATH .'/main.30.skin.php'; 
		$list->set_category('20', 1);
		$list->set_list_mod(3);
		$list->set_list_row(2);
		$list->set_type(1); 
		$list->set_img_size(448, 448);
		$list->set_view('it_img', true);
		$list->set_view('it_id', false);
		$list->set_view('it_name', true);
		$list->set_view('it_basic', false);
		$list->set_view('it_cust_price', true);
		$list->set_view('it_price', true);
		$list->set_view('it_icon', false);
		$list->set_view('sns', false);
		echo $list->run();
		?>
	</section>


	<!-- 필수소모품 best -->
	<h2 class="subject">필수소모품 Best <a href="/shop/list.php?ca_id=30"><img src="/images/main_arrow.png"> 전체보기</a></h2>

	<section class="main_list">
	<?php
		$skin_file = G5_SHOP_SKIN_PATH .'/main.30.skin.php'; 
		$list->set_category('30', 1);
		$list->set_list_mod(3);
		$list->set_list_row(2);
		$list->set_type(1); 
		$list->set_img_size(448, 448);
		$list->set_view('it_img', true);
		$list->set_view('it_id', false);
		$list->set_view('it_name', true);
		$list->set_view('it_basic', false);
		$list->set_view('it_cust_price', true);
		$list->set_view('it_price', true);
		$list->set_view('it_icon', false);
		$list->set_view('sns', false);
		echo $list->run();
		?>
	</section>


	<!-- 전체상품 -->
	<h2 class="subject">전체상품</h2>

	<section class="main_list">
	<?php
		$skin = G5_SHOP_SKIN_PATH .'/main.30.skin.php'; 
		$sql = " select * from {$g5['g5_shop_item_table']} where it_use = '1' order by it_order, it_id desc ";
		$list->set_list_mod(3);
		$list->set_list_row(2);
		$list->set_img_size(448, 448);
		$list->set_query($sql);
		//$list = new item_list($skin, $list_mod, $list_row, $img_width, $img_height);
		$order_by = "it_update_time desc"; // 최신등록순
		$list->set_view('it_img', true);
		$list->set_view('it_id', false);
		$list->set_view('it_name', true);
		$list->set_view('it_basic', false);
		$list->set_view('it_cust_price', true);
		$list->set_view('it_price', true);
		$list->set_view('it_icon', false);
		$list->set_view('sns', false);
		echo $list->run();
		?>



	</section>
</div>