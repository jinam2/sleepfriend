<?php
/**
 * skin file : /theme/THEME_NAME/skin/shop/basic/item.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/skin/shop/'.$eyoom['shop_skin'].'/css/item_style.css?ver='.G5_CSS_VER.'" type="text/css" media="screen">',0);
?>

<style>
.page-title-wrap {display:none;}
.shop-item {margin-top:80px;}
@media (max-width:767px) {
	.shop-item {margin-top:0px;}
}
</style>

<div class="shop-item">
    <?php /* 네이게이션 정보 */ ?>
    <?php //include $nav_skin; ?>

    <?php /* 상품분류 정보 */ ?>
    <?php if ($cate_skin) include $cate_skin; ?>

    <?php /* 상단 HTML */ ?>
    <div id="sit_hhtml" class="m-b-20"><?php echo conv_content($it['it_head_html'], 1); ?></div>

    <?php include_once(G5_SHOP_PATH.'/settle_naverpay.inc.php'); ?>

    <?php if($is_orderable) { ?>
    <script src="<?php echo G5_JS_URL; ?>/shop.js"></script>
    <?php } ?>

    <?php /* 상품 구입폼 */ ?>
    <?php include_once($form_skin); ?>

    <?php /* 상품 상세정보 */ ?>
    <?php include_once($info_skin); ?>

    <?php /* 하단 HTML */ ?>
    <div id="sit_thtml"><?php echo conv_content($it['it_tail_html'], 1); ?></div>
</div>