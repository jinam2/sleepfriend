<?php
/**
 * skin file : /theme/THEME_NAME/skin/shop/basic/item.form.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/slick/slick.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/fotorama/fotorama.css" type="text/css" media="screen">',0);
?>

<form name="fitem" method="post" action="<?php echo $action_url; ?>" onsubmit="return fitem_submit(this);">
<input type="hidden" name="it_id[]" value="<?php echo $it_id; ?>">
<input type="hidden" name="sw_direct">
<input type="hidden" name="url">

<div class="shop-product">
    <?php if ($is_admin) { ?>
    <div class="text-end m-b-10">
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=itemform&amp;w=u&amp;it_id=<?php echo $it_id; ?>&amp;wmode=1"  onclick="eb_admset_modal(this.href); return false;" class="btn-e btn-e-red btn-edit-mode">상품 관리</a>
    </div>
    <?php }?>

    <div class="row">
        <div class="col-md-7">
            <?php /* ---------- 상품이미지 미리보기 시작 ---------- */ ?>
            <?php if ($item_view == 'zoom') { // 상품이미지 미리보기 종류 - zoom ?>
            <div class="shop-product-img">
                <div class="product-img-big">
                    <?php foreach ($big_img as $k => $bimg) { ?>
                    <a href="javascript:void(0);" <?php if (!G5_IS_MOBILE) { ?>class="elevaterzoom_item" data-bs-toggle="modal" data-bs-target=".shop-img-modal"<?php } ?>>
                        <?php echo $bimg['image']; ?>
                    </a>
                    <?php } ?>
                    <?php if ($big_img_count == 0) { ?>
                    <i class="far fa-image"></i>
                    <?php } ?>
                </div>
                <?php if ($thumb_total_count > 1) { ?>
                <div class="product-thumb">
                    <?php foreach ($thumb_info as $k => $timg) { ?>
                    <div class="thumb-img">
                        <?php echo $timg['image']; ?> <span class="sound_only"><?php echo $timg['cnt']; ?>번째 이미지 새창</span>
                    </div>
                    <?php } ?>
                </div>
                <?php } ?>
            </div>
            <?php } else if ($item_view == 'slider') { ?>
            <div class="shop-product-img">
                <div class="product-img-big fotorama" data-nav="thumbs" data-max-width="100%" data-loop="true" data-allowfullscreen="false">
                    <?php foreach ($big_img as $k => $bimg) { ?>
                    <?php echo $bimg['image']; ?>
                    <?php } ?>
                    <?php if ($big_img_count == 0) { ?>
                    <i class="far fa-image"></i>
                    <?php } ?>
                </div>
            </div>
            <?php } ?>
        </div>

        <div class="col-md-5">
            <?php /* ---------- 상품 요약정보 및 구매 시작 ---------- */ ?>
            <div class="shop-product-form 2017_renewal_itemform">
                <h3 class="product-title">
                            <?php if ($it['it_brand']) { ?>
                            <span><?php echo $it['it_brand']; ?></span>
                            <?php } ?>
                    <strong><?php echo stripslashes($it['it_name']); ?></strong>
                    <span class="sound_only">요약정보 및 구매</span>
                </h3>
                <p class="basic"><?php echo $it['it_basic']; ?></p>
                <?php if ($is_orderable) { ?>
                <p class="sound_only">
                    상품 선택옵션 <?php echo $option_count; ?> 개, 추가옵션 <?php echo $supply_count; ?> 개
                </p>
                <?php } ?>

                <div class="shop-description-box">
                    <p class="price">
                        <?php if ($it['it_cust_price']) { ?>
                        판매가 <?php echo display_price($it['it_cust_price']); ?>
                        <?php } ?>
                    </p>

                    <p class="it_price">
                        <span>구매</span>
                        <?php echo display_price(get_price($it)); ?>
                        <input type="hidden" id="it_price" value="<?php echo get_price($it); ?>">
                    </p>

                    <?php if($it['it_is_rental']) {?>
                    <p class="it_rental">
                        <span>렌탈</span><?= is_numeric($it['it_rental_price']) ? "월".number_format($it['it_rental_price'])."원" :   $it['it_rental_price']?>
                        <br/><em>└ 순응통과 후 자부담율 20% 기준 금액입니다.</em>
                    <?php } ?>

                    <p class="point">
                        적립 예정 포인트
                            <?php if ($config['cf_use_point']) { // 포인트 사용한다면 ?>
                                    <?php
                                    if($it['it_point_type'] == 2) {
                                        echo '구매금액(추가옵션 제외)의 '.$it['it_point'].'%';
                                    } else {
                                        $it_point = get_item_point($it);
                                        echo number_format($it_point).'P';
                                    }
                                    ?>
                            <?php } ?>
					</p>

                    <table class="table" style="display:none;">
                        <tbody>
                            <?php if (!$it['it_use']) { // 판매가능이 아닐 경우 ?>
                            <tr>
                                <th scope="row">판매가격</th>
                                <td>판매중지</td>
                            </tr>
                            <?php } else if ($it['it_tel_inq']) { // 전화문의일 경우 ?>
                            <tr>
                                <th scope="row">판매가격</th>
                                <td>전화문의</td>
                            </tr>
                            <?php } else { // 전화문의가 아닐 경우?>
                            <tr>
                                <th scope="row">판매가격</th>
                                <td>
                                    <strong class="shop-product-prices"><?php echo display_price(get_price($it)); ?></strong>
                                    <input type="hidden" id="it_price" value="<?php echo get_price($it); ?>">
                                </td>
                            </tr>
                            <?php } ?>

                            <tr>
                                <th><?php echo $ct_send_cost_label; ?></th>
                                <td>
                                    <?php if($it['it_sc_type'] != 1 && $it['it_sc_method'] == 2) { ?>
                                    <select name="ct_send_cost" id="ct_send_cost">
                                        <option value="0">주문시 결제</option>
                                        <option value="1">수령후 지불</option>
                                    </select>
                                    <?php } else { ?>
                                    <?php echo $sc_method; ?>
                                    <?php } ?>
                                </td>
                            </tr>

                            <?php if($it['it_buy_min_qty']) { ?>
                            <tr>
                                <th>최소구매수량</th>
                                <td><?php echo number_format($it['it_buy_min_qty']); ?> 개</td>
                            </tr>
                            <?php } ?>
                            <?php if($it['it_buy_max_qty']) { ?>
                            <tr>
                                <th>최대구매수량</th>
                                <td><?php echo number_format($it['it_buy_max_qty']); ?> 개</td>
                            </tr>
                            <?php } ?>

                            <?php if ($it['it_maker']) { ?>
                            <tr>
                                <th scope="row">제조사</th>
                                <td><?php echo $it['it_maker']; ?></td>
                            </tr>
                            <?php } ?>

                            <?php if ($it['it_origin']) { ?>
                            <tr>
                                <th scope="row">원산지</th>
                                <td><?php echo $it['it_origin']; ?></td>
                            </tr>
                            <?php } ?>

                            <?php if ($it['it_model']) { ?>
                            <tr>
                                <th scope="row">모델</th>
                                <td><?php echo $it['it_model']; ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <?php /* 선택옵션 시작 */ ?>
                <?php if ($optitem) { ?>
                <div class="sit_option eyoom-form">
                    <!--h3>선택옵션</h3-->
                    <?php if ($option_count > 1) { ?>
                    <?php for($i=0; $i<$option_count; $i++) { ?>
                    <div class="get_item_options">
                        <label for="it_option_<?php echo $optitem[$i]['seq']; ?>"><?php echo $optitem[$i]['subject']; ?></label>
                        <div class="select m-b-10">
                            <select id="it_option_<?php echo $optitem[$i]['seq']; ?>" class="it_option" <?php echo $optitem[$i]['disabled']; ?>>
                                <option value="">선택</option>
                                <?php foreach ($optitem[$i]['select'] as $k => $select) { ?>
                                <option value="<?php echo $select['opt_val']; ?>"><?php echo $select['opt_val']; ?></option>
                                <?php } ?>
                            </select><i></i>
                        </div>
                    </div>
                    <?php } ?>
                    <?php } else { ?>
                    <div class="get_item_options">
                        <label for="it_option_1"><?php echo $optitem['subject']; ?></label>
                        <div class="select m-b-10">
                            <select id="it_option_1" class="it_option">
                                <option value="">선택</option>
                                <?php foreach ($optitem['select'] as $k => $select) { ?>
                                <option value="<?php echo $select['io_id']; ?>,<?php echo $select['io_price']; ?>,<?php echo $select['io_stock_qty']; ?>"><?php echo $select['io_id']; ?><?php echo $select['price']; ?><?php echo $select['soldout']; ?></option>
                                <?php } ?>
                            </select><i></i>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <?php } ?>
                <?php /* 선택옵션 끝 */ ?>

                <?php /* 추가옵션 시작 */ ?>
                <?php if($supitem) { ?>
                <div class="sit_option eyoom-form">
                    <h3>추가옵션</h3>
                    <?php for($i=0; $i<$supply_count; $i++) { ?>
                    <div class="get_item_supply">
                        <label for="it_supply_<?php echo $supitem[$i]['seq']; ?>"><?php echo $supitem[$i]['subject']; ?></label>
                        <div class="select m-b-10">
                            <select id="it_supply_<?php echo $supitem[$i]['seq']; ?>" class="it_supply">
                                <option value="">선택</option>
                                <?php foreach ($supitem[$i]['select'] as $k => $select) { ?>
                                <?php echo $select['opt_val']; ?>
                                <?php } ?>
                            </select><i></i>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <?php } ?>
                <?php /* 추가옵션 끝 */ ?>

                <?php if ($is_orderable) { ?>
                <?php /* 선택된 옵션 시작 */ ?>
                <div id="sit_sel_option">
                    <h3>선택된 옵션</h3>
                    <?php
                    if(!$optitem) {
                        if(!$it['it_buy_min_qty'])
                            $it['it_buy_min_qty'] = 1;
                    ?>
                    <ul id="sit_opt_added">
                        <li class="sit_opt_list">
                            <input type="hidden" name="io_type[<?php echo $it_id; ?>][]" value="0">
                            <input type="hidden" name="io_id[<?php echo $it_id; ?>][]" value="">
                            <input type="hidden" name="io_value[<?php echo $it_id; ?>][]" value="<?php echo $it['it_name']; ?>">
                            <input type="hidden" class="io_price" value="0">
                            <input type="hidden" class="io_stock" value="<?php echo $it['it_stock_qty']; ?>">
                            <div class="opt_name">
                                <span class="sit_opt_subj"><?php echo $it['it_name']; ?></span>
                            </div>
                            <div class="opt_count">
                                <label for="ct_qty_<?php echo $i; ?>" class="sound_only">수량</label>
                                <button type="button" class="sit_qty_minus"><i class="fas fa-minus" aria-hidden="true"></i><span class="sound_only">감소</span></button>
                                <input type="text" name="ct_qty[<?php echo $it_id; ?>][]" value="<?php echo $it['it_buy_min_qty']; ?>" id="ct_qty_<?php echo $i; ?>" class="num_input" size="5">
                                <button type="button" class="sit_qty_plus"><i class="fas fa-plus" aria-hidden="true"></i><span class="sound_only">증가</span></button>
                                <span class="sit_opt_prc">+0원</span>
                            </div>
                        </li>
                    </ul>
                    <script>
                    $(function() {
                        price_calculate();
                    });
                    </script>
                    <?php } ?>
                </div>
                <?php /* 선택된 옵션 끝 */ ?>

                <?php /* 총 구매액 */ ?>
                <div id="sit_tot_price"></div>
                <?php } ?>

                <?php if($is_soldout) { ?>
                <p id="sit_ov_soldout">상품의 재고가 부족하여 구매할 수 없습니다.</p>
                <?php } ?>

                <div id="sit_ov_btn">
					<span class="MyBtn pop_order" rel="myModal1">구매</span>
                    <?php if($it['it_is_rental']) {?>
					<span class="MyBtn pop_rental" rel="myModal2">렌탈</span>
                    <?php } ?>
					<a href="/mypage/inquiry_write.php?w=&it_id=<?php echo $it_id; ?>">문의하기</a>
<!--
                    <?php if ($is_orderable) { ?>
                    <button type="submit" onclick="document.pressed=this.value;" value="구매" id="sit_btn_buy">구매</button>
					<a href="/page/?pid=rental" class="btn_rental">렌탈</a>
                    <button type="submit" onclick="document.pressed=this.value;" value="장바구니" id="sit_btn_cart">장바구니</button>
                    <?php } ?>
-->

                    <?php if ($naverpay_button_js) { ?>
                    <div class="itemform-naverpay"><?php echo $naverpay_request_js.$naverpay_button_js; ?></div>
                    <?php } ?>
                </div>

				<!-- 구매팝업 -->
				<div id="myModal1" class="modal modal_order">
					<div class="modal-content">
						<div class="modal-body">
							<h4>제품 구매하기</h4>
							<span class="Myclose" rel="myModal1"><i class="fa fa-times" aria-hidden="true"></i></span>

							<div class="product">
								<div class="img">
                                    <a href="<?php echo shop_item_url($it['it_id']); ?>"><?php echo get_it_image($it['it_id'], 160, 160)?></a>
								</div>
								<div class="desc">
									<a href="<?php echo shop_item_url($it['it_id']); ?>">
                                        <span>[<?php echo $it['it_brand']?>]</span>
                                        <?php echo $it['it_name']?>
									</a>
									<p><!-- it_basic -->
                                        <?php echo $it['it_basic']?>
									</p>
								</div>
							</div>

							<div class="btn_order">
								<?php if ($is_orderable) { ?>
								<button type="submit" onclick="document.pressed=this.value;" value="장바구니" id="sit_btn_cart">장바구니</button>
								<button type="submit" onclick="document.pressed=this.value;" value="구매" id="sit_btn_buy">구매하기</button>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>

				<!-- 렌탈팝업 -->
				<div id="myModal2" class="modal modal_order">
					<div class="modal-content">
						<div class="modal-body">
							<h4>제품 구매하기</h4>
							<span class="Myclose" rel="myModal2"><i class="fa fa-times" aria-hidden="true"></i></span>

							<div class="product">
								<div class="img">
									<a href="<?php echo shop_item_url($it['it_id']); ?>"><?php echo get_it_image($it['it_id'], 160, 160)?></a>
								</div>
								<div class="desc">
									<a href="<?php echo shop_item_url($it['it_id']); ?>">
										<span>[<?php echo $it['it_brand']?>]</span>
                                        <?php echo $it['it_name']?>
									</a>
									<p><!-- it_basic -->
                                        <?php echo $it['it_basic']?>
									</p>
								</div>
							</div>

							<div class="btn_rental">
								<?php if ($is_orderable) { ?>
								<button type="submit" onclick="document.pressed=this.value;" value="장바구니" id="sit_btn_cart">장바구니</button>
								<a href="/page/?pid=rental1&it_id=<?php echo $it_id; ?>" id="sit_btn_rental1">보험렌탈 주문</a>
								<a href="/page/?pid=rental2&it_id=<?php echo $it_id; ?>" id="sit_btn_rental2">비보험렌탈 주문</a>
								<?php } ?>
							</div>

						</div>
					</div>
				</div>


				<script type="text/javascript">
					var button_click = function() {
						var ModalID = this.getAttribute("rel");
						document.getElementById(ModalID).style.display = 'block';
					};
					var close_click = function() {
						var ModalID = this.getAttribute("rel");
						document.getElementById(ModalID).style.display = 'none';
					};
					var btn = document.getElementsByClassName('MyBtn');
					var close = document.getElementsByClassName('Myclose') ;
					for(iCount = 0; iCount < btn.length; iCount++) {
						btn[iCount].addEventListener('click', button_click, false) ;
						close[iCount].addEventListener('click', close_click, false) ;
					}
				</script>


                <script>
                // 상품보관
                function item_wish(f, it_id) {
                    f.url.value = "<?php echo G5_SHOP_URL; ?>/wishupdate.php?it_id="+it_id;
                    f.action = "<?php echo G5_SHOP_URL; ?>/wishupdate.php";
                    f.submit();
                }

                // 추천메일
                function popup_item_recommend(it_id) {
                    if (!g5_is_member)
                    {
                        if (confirm("회원만 추천하실 수 있습니다."))
                            document.location.href = "<?php echo G5_BBS_URL; ?>/login.php?url=<?php echo urlencode(shop_item_url($it_id)); ?>";
                    } else {
                        url = "./itemrecommend.php?it_id=" + it_id;
                        opt = "scrollbars=yes,width=616,height=420,top=10,left=10";
                        popup_window(url, "itemrecommend", opt);
                    }
                }

                // 재입고SMS 알림
                function popup_stocksms(it_id) {
                    url = "<?php echo G5_SHOP_URL; ?>/itemstocksms.php?it_id=" + it_id;
                    opt = "scrollbars=yes,width=616,height=420,top=10,left=10";
                    popup_window(url, "itemstocksms", opt);
                }
                </script>
            </div>
            <?php /* ---------- 상품 요약정보 및 구매 끝 ---------- */ ?>
        </div>
    </div>
</div>
</form>

<?php /* ---------- 상품이미지 크게 보기 모달 시작 ---------- */ ?>
<div class="modal fade shop-img-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="fotorama" data-nav="thumbs" data-max-width="100%" data-loop="true">
                    <?php foreach ($big_img as $k => $bimg) { ?>
                    <?php echo $bimg['image']; ?>
                    <?php } ?>
                </div>
            </div>
            <div class="modal-footer">
                <button data-bs-dismiss="modal" aria-label="Close" class="btn-e btn-e-lg btn-e-dark" type="button"><i class="fas fa-times"></i> 닫기</button>
            </div>
        </div>
    </div>
</div>
<?php /* ---------- 상품이미지 크게 보기 모달 끝 ---------- */ ?>

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/slick/slick.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/fotorama/fotorama.js"></script>
<?php if ($item_view == 'zoom') { // 상품이미지 미리보기 종류 - zoom ?>
<?php if (!G5_IS_MOBILE) { // PC버전의 경우에만 줌적용 ?>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/jquery-elevateZoom/jquery.elevateZoom.min.js"></script>
<?php } ?>
<script>
$(document).ready(function(){
    <?php if (!G5_IS_MOBILE) { // PC버전의 경우에만 줌적용 ?>
    $('.elevaterzoom_item img').elevateZoom({
        zoomWindowWidth: 526,
        zoomWindowHeight: 526,
        borderSize: 0,
        borderColour: "#000"
    });
    <?php } ?>
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
<?php } ?>
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

function fsubmit_check(f)
{
    // 판매가격이 0 보다 작다면
    if (document.getElementById("it_price").value < 0) {
        alert("전화로 문의해 주시면 감사하겠습니다.");
        return false;
    }

    if($(".sit_opt_list").size() < 1) {
        alert("상품의 선택옵션을 선택해 주십시오.");
        return false;
    }

    var val, io_type, result = true;
    var sum_qty = 0;
    var min_qty = parseInt(<?php echo $it['it_buy_min_qty']; ?>);
    var max_qty = parseInt(<?php echo $it['it_buy_max_qty']; ?>);
    var $el_type = $("input[name^=io_type]");

    $("input[name^=ct_qty]").each(function(index) {
        val = $(this).val();

        if(val.length < 1) {
            alert("수량을 입력해 주십시오.");
            result = false;
            return false;
        }

        if(val.replace(/[0-9]/g, "").length > 0) {
            alert("수량은 숫자로 입력해 주십시오.");
            result = false;
            return false;
        }

        if(parseInt(val.replace(/[^0-9]/g, "")) < 1) {
            alert("수량은 1이상 입력해 주십시오.");
            result = false;
            return false;
        }

        io_type = $el_type.eq(index).val();
        if(io_type == "0")
            sum_qty += parseInt(val);
    });

    if(!result) {
        return false;
    }

    if(min_qty > 0 && sum_qty < min_qty) {
        alert("선택옵션 개수 총합 "+number_format(String(min_qty))+"개 이상 주문해 주십시오.");
        return false;
    }

    if(max_qty > 0 && sum_qty > max_qty) {
        alert("선택옵션 개수 총합 "+number_format(String(max_qty))+"개 이하로 주문해 주십시오.");
        return false;
    }

    return true;
}

// 바로구매, 장바구니 폼 전송
function fitem_submit(f)
{
    f.action = "<?php echo $action_url; ?>";
    f.target = "";

    if (document.pressed == "장바구니") {
        f.sw_direct.value = 0;
    } else { // 바로구매
        f.sw_direct.value = 1;
    }

    // 판매가격이 0 보다 작다면
    if (document.getElementById("it_price").value < 0) {
        alert("전화로 문의해 주시면 감사하겠습니다.");
        return false;
    }

    if($(".sit_opt_list").size() < 1) {
        alert("상품의 선택옵션을 선택해 주십시오.");
        return false;
    }

    var val, io_type, result = true;
    var sum_qty = 0;
    var min_qty = parseInt(<?php echo $it['it_buy_min_qty']; ?>);
    var max_qty = parseInt(<?php echo $it['it_buy_max_qty']; ?>);
    var $el_type = $("input[name^=io_type]");

    $("input[name^=ct_qty]").each(function(index) {
        val = $(this).val();

        if(val.length < 1) {
            alert("수량을 입력해 주십시오.");
            result = false;
            return false;
        }

        if(val.replace(/[0-9]/g, "").length > 0) {
            alert("수량은 숫자로 입력해 주십시오.");
            result = false;
            return false;
        }

        if(parseInt(val.replace(/[^0-9]/g, "")) < 1) {
            alert("수량은 1이상 입력해 주십시오.");
            result = false;
            return false;
        }

        io_type = $el_type.eq(index).val();
        if(io_type == "0")
            sum_qty += parseInt(val);
    });

    if(!result) {
        return false;
    }

    if(min_qty > 0 && sum_qty < min_qty) {
        alert("선택옵션 개수 총합 "+number_format(String(min_qty))+"개 이상 주문해 주십시오.");
        return false;
    }

    if(max_qty > 0 && sum_qty > max_qty) {
        alert("선택옵션 개수 총합 "+number_format(String(max_qty))+"개 이하로 주문해 주십시오.");
        return false;
    }

    return true;
}
</script>
<?php /* 2017 리뉴얼한 테마 적용 스크립트입니다. 기존 스크립트를 오버라이드 합니다. */ ?>
<script src="<?php echo G5_JS_URL; ?>/shop.override.js"></script>