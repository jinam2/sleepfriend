<?php
/**
 * skin file : /theme/THEME_NAME/skin/shop/basic/main.30.skin.html.php
 */
if (!defined('_EYOOM_')) exit; 
//echo "<xmp>";
//var_dump($this);
//echo "</xmp>";
?>

<style>
.product-main-30 {}
.product-main-30 {margin-left:-10px; margin-right:-10px}
.product-main-30:after {content:""; display:block; clear:both}
.product-main-30 .item-main-wrap {padding:0 10px; width:33.333%; float:left; height:700px;}
.product-main-30 .item-main-30 {position:relative; -webkit-transition:all 0.2s ease-in-out; transition:all 0.2s ease-in-out; margin-bottom:50px;}
.product-main-30 .product-img {position:relative; overflow:hidden; margin-bottom:0px; background:#fff; border-radius:10px; }
.product-main-30 .product-img-in {position:relative; overflow:hidden; width:100%}
.product-main-30 .product-img-in:before {content:""; display:block; padding-top:100%; background:#fff}
.product-main-30 .product-img-in .first-img {display:block}
.product-main-30 .product-img-in .second-img {display:none}
.product-main-30 .item-main-30:hover .product-img-in .second-img {display:block}
.product-main-30 .product-img-in img {display:block; width:100% !important; height:auto !important; position:absolute; top:0; left:0; right:0; bottom:0; border-radius:10px; }
.product-main-30 .product-img-in .discount-percent {display:none; position:absolute; top:-40px; left:-40px; width:80px; height:80px; padding-top:57px; text-align:center; background:#cc2300; color:#fff; font-style:italic; font-size:.75rem; -webkit-transform:rotate(-45deg); -moz-transform:rotate(-45deg); transform:rotate(-45deg)}
.product-main-30 .product-description .product-description-in {position:relative; overflow:hidden; padding:0 0 40px; text-align:center; }
.product-main-30 .product-description .product-name {position:relative; overflow:hidden; margin:10px 0 5px; font-size:20px; font-weight:600; line-height:1.1; }
.product-main-30 .product-description .product-name .brand {display:block; font-size:16px; margin:0 0 10px; min-height:18px;}
.product-main-30 .product-description .product-name a {display:block; color:#343434; text-decoration:none !important; height:46px; }
.product-main-30 .product-description .product-price {min-height:70px;}
.product-main-30 .product-description .title-price {display:block; font-size:20px; font-weight:600; color:#141751; padding:2px 0; } /* 구매 */
.product-main-30 .product-description .title-price1 {font-size:16px; color:#3a3a3a;  font-weight:500; padding:2px 0; } /* 판매가 */
.product-main-30 .product-description .title-price2 {display:block; font-size:20px; font-weight:600; color:#FD4F00; padding:2px 0; } /* 렌탈 */
.product-main-30 .product-description .title-point {display:block; font-size:16px; color:#3a3a3a; font-weight:500; padding:2px 0; }
.product-main-30 .product-description .product-id {color:#757575; display:block; font-size:.8125rem; margin-top:10px}
.product-main-30 .product-description .product-info {position:relative; overflow:hidden; height:38px; color:#959595; font-size:.8125rem; margin-top:10px}
.product-main-30 .product-description .product-sns {position:relative; height:30px; margin-top:10px}
.product-main-30 .product-description .product-sns ul {position:absolute; top:0; right:0; margin:0; padding:0; list-style:none}
.product-main-30 .product-description .product-sns ul:after {content:""; display:block; clear:both}
.product-main-30 .product-description .product-sns ul li {float:left; margin-left:1px}
.product-main-30 .product-description .product-sns ul li a {display:block; width:30px; height:30px; line-height:30px; text-align:center; background:#b5b5b5; color:#fff; font-size:.75rem}
.product-main-30 .product-description .product-sns ul li:hover .wish-icon {background:#cc2300}
.product-main-30 .product-description .product-sns ul li:hover .facebook-icon {background:#39558f}
.product-main-30 .product-description .product-sns ul li:hover .twitter-icon {background:#4698e0}
.product-main-30 .product-description-bottom {position:relative; overflow:hidden; padding:12px 0; border-top:1px solid #e5e5e5}
.product-main-30 .product-description-bottom a:hover {text-decoration:underline; color:#000}
.product-main-30 .product-ratings {width:75px; margin:0; padding:0}
.product-main-30 .product-ratings li {padding:0; float:left; margin-right:0}
.product-main-30 .product-ratings li .rating {color:#a5a5a5; font-size:.8125rem; line-height:normal}
.product-main-30 .product-ratings li .rating-selected {color:#cc2300; font-size:.8125rem}
.product-main-30 .shop-rgba-red {background:#cc2300}
.product-main-30 .shop-rgba-yellow {background:#ff9500}
.product-main-30 .shop-rgba-green {background:#00897b}
.product-main-30 .shop-rgba-purple {background:#8e24aa}
.product-main-30 .shop-rgba-orange {background:#f4511e}
.product-main-30 .shop-rgba-dark {background:#3c3c3e}
.product-main-30 .shop-rgba-default {background:#A6A6A6}
.product-main-30 .rgba-banner-area {position:absolute; top:0; right:0}
.product-main-30 .rgba-banner {height:18px; width:70px; line-height:18px; color:#fff; font-size:.6875rem; text-align:center; font-weight:400; position:relative; text-transform:uppercase; margin-bottom:1px}
.product-main-30 .item-main-30:hover .product-name a {text-decoration:underline}

@media (max-width:991px) {
    .product-main-30 .item-main-wrap {width:50%}
	.product-main-30 .item-main-30 {margin-bottom:20px;}
}

@media (max-width:767px) {
    .product-main-30 {margin-left:-10px; margin-right:-10px}
    .product-main-30 .item-main-wrap {padding:10px; height:370px;}
	.product-main-30 .item-main-30 {margin-bottom:0px;}
	.product-main-30 .product-description .product-name {font-size:15px; }
	.product-main-30 .product-description .product-name .brand {font-size:14px; }
	.product-main-30 .product-description .product-name a {height:40px; }
	.product-main-30 .product-description .title-price {font-size:15px; } /* 구매 */
	.product-main-30 .product-description .title-price1 {font-size:13px; }
	.product-main-30 .product-description .title-price2 { font-size:15px; } /* 렌탈 */
	.product-main-30 .product-description .title-point {font-size:13px; }

}
</style>

<div class="product-main-30">
    <?php for ($i=0; $i<count((array)$list); $i++) {

        ?>
    <div class="item-main-wrap">
        <div class="item-main-30">
            <?php if ($list[$i]['href']) { ?>
            <a href="<?php echo $list[$i]['href']; ?>">
            <?php } ?>
                <div class="product-img">
                    <div class="product-img-in">
                        <div class="first-img">
                            <?php echo $list[$i]['it_image']; ?>
                        </div>
                        <?php if($list[$i]['it_image2']) { ?>
                        <div class="second-img">
                            <?php echo $list[$i]['it_image2']; ?>
                        </div>
                        <?php } ?>
                        <?php if ($this->view_it_icon) { ?>
                        <?php //echo $list[$i]['it_icon']; ?>
                        <?php } ?>
                        <?php if($list[$i]['dc_ratio']) { ?>
                        <div class="discount-percent"><?php echo $list[$i]['dc_ratio']; ?>%</div>
                        <?php } ?>
                    </div>
                </div>
            <?php if ($list[$i]['href']) { ?>
            </a>
            <?php } ?>

            <div class="product-description">
                <div class="product-description-in">
                    <h4 class="product-name">
                        <span class="brand">
                           <?php echo $list[$i]['it_brand']; ?>
                        </span>

                        <?php if ($list[$i]['href']) { ?>
                        <a href="<?php echo $list[$i]['href']; ?>">
                        <?php } ?>
                        <?php if ($this->view_it_name) { echo stripslashes($list[$i]['it_name']); } ?>
                        <?php if ($list[$i]['href']) { ?>
                        </a>
                        <?php } ?>
                    </h4>

                    <?php if($list[$i]['it_sale'] == '1' || $list[$i]['it_is_rental'] == '1') {?>
                    <div class="product-price">

                        <?php if($list[$i]['it_sale'] == '1') {?>
                        <span class="title-price">구매 <?php echo number_format($list[$i]['it_price']); ?>원</span>
                        <?php } ?>
                        <?php if($list[$i]['it_is_rental'] == '1') {?>
                        <span class="title-price2">렌탈 <?= is_numeric($list[$i]['it_rental_price']) ? "월".number_format($list[$i]['it_rental_price'])."원" :   $list[$i]['it_rental_price']?></span>
                        <?php } ?>

                        <?php if ($config['cf_use_point']) {?>
                        <span class="title-point">적립 예정 포인트 <?php echo $list[0]['it_point']; ?>P</span>
                        <?php } ?>
                    </div>
                    <?php } ?>

                    <?php if ($this->view_it_id) { ?>
                    <span class="product-id"><?php echo stripslashes($list[$i]['it_id']); ?></span>
                    <?php } ?>

                    <?php if ($this->view_it_basic) { ?>
                    <!--div class="product-info"><?php echo stripslashes($list[$i]['it_basic']); ?></div-->
                    <?php } ?>

                    <?php if ($this->view_sns) { ?>
                    <div class="product-sns">
                        <ul>
                            <li><a href="javascript:void(0); " class="wish-icon" onclick="item_wish_for_list(<?php echo $list[$i]['it_id']; ?>); " title="위시리스트"><i class="far fa-heart"></i></a></li>
                            <li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $list[$i]['sns_url']; ?>&amp; p=<?php echo $list[$i]['sns_title']; ?>" target="_blank" class="facebook-icon" title="페이스북"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="https://twitter.com/share?url=<?php echo $list[$i]['sns_url']; ?>&amp; text=<?php echo $list[$i]['sns_title']; ?>" target="_blank" class="twitter-icon" title="트위터"><i class="fab fa-twitter"></i></a></li>
                        </ul>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <!--div class="product-description-bottom">
                <a class="float-start" href="<?php echo G5_SHOP_URL; ?>/itemuselist.php?sfl=a.it_id&stx=<?php echo $list[$i]['it_id']; ?>">리뷰보기</a>
                <ul class="list-inline product-ratings float-end">
                    <li><i class="rating<?php if ($list[$i]['star_score'] > 0) { ?>-selected fas fa-star<?php } else { ?> far fa-star<?php } ?>"></i></li>
                    <li><i class="rating<?php if ($list[$i]['star_score'] > 1) { ?>-selected fas fa-star<?php } else { ?> far fa-star<?php } ?>"></i></li>
                    <li><i class="rating<?php if ($list[$i]['star_score'] > 2) { ?>-selected fas fa-star<?php } else { ?> far fa-star<?php } ?>"></i></li>
                    <li><i class="rating<?php if ($list[$i]['star_score'] > 3) { ?>-selected fas fa-star<?php } else { ?> far fa-star<?php } ?>"></i></li>
                    <li><i class="rating<?php if ($list[$i]['star_score'] > 4) { ?>-selected fas fa-star<?php } else { ?> far fa-star<?php } ?>"></i></li>
                </ul>
                <div class="clearfix"></div>
            </div-->
            <?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
            <div class="adm-edit-btn btn-edit-mode" style="bottom:0">
                <div class="btn-group">
                    <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&pid=itemform&w=u&it_id=<?php echo $list[$i]['it_id']; ?>&wmode=1" onclick="eb_admset_modal(this.href); return false; " class="ae-btn-l ae-item-btn"><i class="far fa-edit"></i> 개별상품 설정</a>
                    <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&pid=itemform&w=u&it_id=<?php echo $list[$i]['it_id']; ?>" target="_blank" class="ae-btn-r" title="새창 열기">
                        <i class="fas fa-external-link-alt"></i>
                    </a>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
    <?php } ?>
    <?php if (count((array)$list) == 0) { ?>
    <p class="text-center text-gray m-t-50 m-b-50"><i class="fas fa-exclamation-circle"></i> 등록된 상품이 없습니다.</p>
    <?php } ?>
</div>