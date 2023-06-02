<?php
/**
 * skin file : /theme/THEME_NAME/skin/shop/basic/listcategory.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.shop-list {}
.shop-list .sct-ct {width:100%; margin:0 0 50px; height:50px; border-bottom:1px solid #E1E1E1;}
.shop-list .sct-ct ul {margin:0;padding:0;}
.shop-list .sct-ct ul:after {content:"";display:block;clear:both}
.shop-list .sct-ct li {float:left;}
.shop-list .sct-ct li a {display:block; line-height:47px; padding:0 20px; color:#5F5F5F; font-size:16px; font-weight:600;}
.shop-list .sct-ct li a.active {border-bottom:3px solid #141751;}
.shop-list .sct-ct li a span {color:#353535}


@media (max-width:767px) {
	.shop-list .sct-ct {margin:0 0 14px; height:46px; border:0;}
	.shop-list .sct-ct {position:relative; width:100%; overflow-x:auto;}
	.shop-list .sct-ct div {position:absolute; top:0px; left:0; padding:0; white-space: nowrap;}

	.shop-list .sct-ct {
  -ms-overflow-style: none;  /* IE and Edge */
  scrollbar-width: none;  /* Firefox */
  }
	.shop-list .sct-ct::-webkit-scrollbar {
  display:none;
  width: 0;
  height: 0;
  background: transparent; 
  -webkit-appearance: none;
  }
	.shop-list .sct-ct li {float:none; display:inline-block;}
	.shop-list .sct-ct li + li {margin-left:5px;}
	.shop-list .sct-ct li a {line-height:33px; font-size:15px; border:1px solid #141751; color:#141751; border-radius:30px; padding:0 24px;}
	.shop-list .sct-ct li a.active {background:#141751; color:#fff;}
}
</style>

<?php if ($listcategory) { ?>
<aside class="sct-ct">
    <ul class="list-unstyled">
    <div>
        <li><a href="#" class="active"><?php echo $ca['ca_name']; ?> 전체</a></li>
        <?php foreach ($listcategory as $k => $cateinfo) { ?>
        <li><a href="<?php echo $cateinfo['href']; ?>"><?php echo $cateinfo['ca_name']; ?><!-- [<span><?php echo $cateinfo['cnt']; ?></span>]--></a></li>
        <?php } ?>
    </div>
    </ul>
    <div class="clearfix"></div>
</aside>
<?php } ?>