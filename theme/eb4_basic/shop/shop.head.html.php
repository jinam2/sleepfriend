<?php
/**
 * theme file : /theme/THEME_NAME/shop/shop.head.html.php
 */
if (!defined('_EYOOM_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/css/shop_style.css?ver='.G5_CSS_VER.'">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/css/custom.css?ver='.G5_CSS_VER.'">',0);

/**
 * 로고 타입 : 'image' || 'text'
 */
$logo = 'image';

/**
 * 메뉴바 전체 메뉴 출력 : 'yes' || 'no'
 */
$is_megamenu = 'yes';

/**
 * 상품 이미지 미리보기 종류 : 'zoom' || 'slider'
 */
$item_view = 'slider';
?>

<?php if (!$wmode) { ?>
<?php /*----- wrapper 시작 -----*/ ?>
<div class="wrapper">
    <h1 id="hd-h1"><?php echo $g5['title'] ?></h1>
    <div class="to-content"><a href="#container">본문 바로가기</a></div>
    <?php
    // 팝업창
    if (defined('_INDEX_') && $newwin_contents) { // index에서만 실행
        echo $newwin_contents;
    }
    ?>

	<?php if ($is_admin) { // 관리자일 경우 ?>
	<div class="admin_edit">
	<ul>
		<li><a href="<?php echo correct_goto_url(G5_ADMIN_URL); ?>"><i class="fas fa-cog text-red"></i> 관리자</a></li>
		<li>
			<div class="eyoom-form">
				<input type="hidden" name="edit_mode" id="edit_mode" value="<?php echo $eyoom_default['edit_mode']; ?>">
				<label class="toggle">
					<input type="checkbox" id="btn_edit_mode" <?php echo $eyoom_default['edit_mode'] == 'on' ? 'checked':''; ?>><i></i><span class="text-black"><span class="fas fa-sliders-h m-r-5"></span>편집모드</span>
				</label>
			</div>
		</li>
	</ul>
	</div>
	<?php } ?>

	<?php /*----- header 시작 -----*/ ?>
	<header class="header-wrap <?php if(!defined('_INDEX_')) { ?>page-header-wrap<?php } ?>">

		<div class="inner">
			<div class="logo">
				<a href="<?php echo G5_URL; ?>"><img src="<?php echo $logo_src['top']; ?>" alt="<?php echo $config['cf_title']; ?>"></a>
			</div>

			<? //include_once __DIR__."/gnb.html.php"; ?>
			<?php include(EYOOM_THEME_PATH.'/gnb.html.php'); ?>

			<div class="user">
            <?php if ($is_member) {  ?>
                <!--a href="/bbs/logout.php">로그인</a-->
                <a href="/mypage/contract.php"><img src="/images/top_user.png"></a>
            <?php } else { ?>
                <a href="/bbs/login.php"><img src="/images/top_user.png"></a>
            <?php }  ?>
				<a class="search-toggle mobile-search-btn"><img src="/images/top_search.png"></a>
				<a href="<?php echo G5_SHOP_URL; ?>/cart.php"><img src="/images/top_cart.png"></a>
			</div>

			<div class="header-title-mobile-btn">
				<button type="button" class="navbar-toggler" data-bs-toggle="offcanvas" data-bs-target="#offcanvasLeft" aria-controls="offcanvasLeft"></button>
			</div>

		</div>

	</header>
	<?php /*----- header 끝 -----*/ ?>

<?php include(EYOOM_THEME_PATH.'/gnb_m.html.php'); ?>


    <?php if(!defined('_INDEX_')) { // 메인이 아닐때 ?>
    <?php /*----- page title 시작 -----*/ ?>
    <div class="page-title-wrap">
            <div class="sub-breadcrumb-wrap hidden-xs">
                <div class="inner">
                    <ul class="sub-breadcrumb"><?php echo $subinfo['path']; ?></ul>
                </div>
            </div>

        <div class="inner">
        <?php if (!defined('_EYOOM_MYPAGE_')) { ?>
            <h2>
                <?php if (!$it_id) { ?>
                <?php echo $subinfo['title']; ?>
                <?php } else { ?>
                <?php echo $subinfo['title']; ?>
                <?php } ?>
            </h2>
            <?php if (!$it_id) { ?>

            <?php } ?>
        <?php } else { ?>
            <h2><i class="fas fa-arrow-alt-circle-right"></i> 마이페이지</h2>
        <?php } ?>
        </div>
    </div>
    <?php /*----- page title 끝 -----*/ ?>
    <?php } ?>

    <div class="basic-body <?php if(!defined('_INDEX_')) { ?>page-body<?php } ?>">
        <?php if(defined('_INDEX_')) { ?>
        <main class="basic-body-main">
        <?php } else { ?>
        <div class="container">
            <main class="basic-body-main">
        <?php } ?>
<?php } // !$wmode ?>

<script>
	function change(obj) {
		gnb11.style.display = "none";
		gnb12.style.display = "none";
		obj.style.display = "block";
	}

	function change3(obj) {
		gnb31.style.display = "none";
		gnb32.style.display = "none";
		gnb33.style.display = "none";
		gnb34.style.display = "none";
		gnb35.style.display = "none";
		gnb36.style.display = "none";
		gnb37.style.display = "none";
		gnb38.style.display = "none";
		obj.style.display = "block";
	}
	function change5(obj) {
		gnb50.style.display = "none";
		gnb51.style.display = "none";
		gnb52.style.display = "none";
		obj.style.display = "block";
	}
	function change7(obj) {
		gnb71.style.display = "none";
		gnb72.style.display = "none";
		gnb73.style.display = "none";
		gnb74.style.display = "none";
		obj.style.display = "block";
	}
</script>