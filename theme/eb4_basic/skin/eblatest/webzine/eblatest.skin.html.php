<?php
/**
 * skin file : /theme/THEME_NAME/skin/eblatest/webzine/eblatest.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
<div class="position-relative <?php if ($el_master['el_state'] == '2') { ?>eb-hidden-space<?php } ?>">
    <div class="adm-edit-btn btn-edit-mode" style="top:0;text-align:right">
        <div class="btn-group">
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=eblatest_form&amp;thema=<?php echo $theme; ?>&amp;el_code=<?php echo $el_master['el_code']; ?>&amp;w=u&amp;wmode=1" onclick="eb_admset_modal(this.href); return false;" class="ae-btn-l"><i class="far fa-edit"></i> EB최신글 마스터 설정</a>
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=eblatest_form&amp;thema=<?php echo $theme; ?>&amp;el_code=<?php echo $el_master['el_code']; ?>&amp;w=u" target="_blank" class="ae-btn-r" title="새창 열기">
                <i class="fas fa-external-link-alt"></i>
            </a>
        </div>
    </div>
</div>
<?php } ?>

<?php if (isset($el_master) && $el_master['el_state'] == '1') { // 보이기 상태에서만 출력 ?>
<style>
.webzine-latest .tab-content {position:relative;padding:0}
.webzine-latest .webzine-item {position:relative; width:100%; overflow:hidden; border-top:1px solid #c4c4c4; padding:30px 0;}
.webzine-latest .webzine-item:first-child {border-top:0; padding-top:0;}
.webzine-latest .webzine-img {position:relative;overflow:hidden; float:left; width:240px;}
.webzine-latest .img-box {position:relative;overflow:hidden;width:100%; min-height:154px;border-radius:10px;}
.webzine-latest .img-box:before {content:"";display:block;padding-top:55%}
.webzine-latest .img-box img {position:absolute;top:50%;left:0;right:0;bottom:0;border-radius:10px;-webkit-transform:translateY(-50%); -ms-transformY:translate(-50%); transform:translateY(-50%); }
.webzine-latest .img-box .no-image {position:absolute;top:50%;left:0;width:100%;text-align:center;margin-bottom:0;margin-top:-8px;color:#959595;font-size:.8125rem}
.webzine-latest .webzine-txt {position:relative;overflow:hidden; float:left; padding-left:30px; width:calc(100% - 240px);}
.webzine-latest .txt-subj {position:relative;}
.webzine-latest .txt-subj h4 {font-size:20px;color:#343434;margin-top:0;margin-bottom:20px;line-height:1.3;word-break:keep-all;overflow:hidden;text-overflow:ellipsis;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;}
.webzine-latest .txt-subj h4 .category {display:block; color:#FD4F00; font-size:14px; margin:12px 0 20px;}
.webzine-latest .txt-subj h4 .webzine-new-icon {position:relative;display:inline-block;width:16px;height:16px; line-height:16px; vertical-align:middle; border-radius:3px; text-align:center; font-size:11px; background-color:#cc2300; margin:0 0 4px 5px; padding:0; color:#fff;}
.webzine-latest .txt-subj h4 a:hover {color:#fd4f00;}
.webzine-latest .txt-subj .webzine-cont {position:relative; color:#5f5f5f;overflow:hidden;text-overflow:ellipsis;display:-webkit-box;-webkit-line-clamp:3;
-webkit-box-orient:vertical; font-size:15px; line-height:160%; font-weight:400;}

.webzine-latest .txt-cont {position:relative;overflow:hidden;height:43px;font-size:.9375rem;color:#959595;margin-bottom:10px}
.webzine-latest .txt-photo img {width:17px;height:17px;margin-right:2px;display:inline-block}
.webzine-latest .txt-photo .txt-user-icon {color:#959595;margin-right:2px}
.webzine-latest .txt-nick {color:#959595}
.webzine-latest .txt-info {margin-top:5px;padding-top:5px;font-size:11px;text-align:right;color:#b5b5b5;border-top:1px solid #e5e5e5}
.webzine-latest .txt-info span {margin-left:5px}

@media (max-width:1440px) {
	.webzine-latest .img-box {min-height:146px;}
	.webzine-latest .webzine-img {width:200px;}
	.webzine-latest .webzine-txt {padding-left:20px; width:calc(100% - 200px);}
	.webzine-latest .txt-subj h4 {font-size:19px; margin-top:6px;}
}

</style>

<div class="webzine-latest">
    <div class="tab-content">
        <?php if (is_array($el_item)) { foreach ($el_item as $k => $eb_latest) { ?>
        <div class="tab-pane <?php echo ($k==0) ? 'active': ''; ?> in" id="webzine-tlb-<?php echo $el_master['el_code']; ?>-<?php echo ($k+1); ?>">
            <?php if (count((array)$eb_latest['list']) > 0) { foreach ($eb_latest['list'] as $data) { ?>
            <div class="webzine-item">
                <div class="webzine-img">
                    <a href="<?php echo $data['href']; ?>">
                        <div class="img-box">
                            <?php if ($data['wr_image']) { ?>
                            <img class="img-fluid" src="<?php echo $data['wr_image']; ?>" alt="">
                            <?php if ($eb_latest['li_bo_subject'] == 'y') { ?>
                            <span class="img-bo-subj"><?php echo $data['bo_subject']; ?></span>
                            <?php } ?>
                            <?php if ($data['is_video']) { ?><span class="video-icon"><i class="far fa-play-circle"></i></span><?php } ?>
                            <?php } else { ?>
                            <span class="no-image">No Image</span>
                            <?php } ?>
                            <?php if ($eb_latest['li_use_date'] == 'y') { ?>
                            <div class="img-caption">
                                <span><i class="far fa-clock m-r-5"></i><?php echo $eb_latest['li_date_type'] == '1' ? $eb->date_time("{$eb_latest['li_date_kind']}",$data['wr_datetime']):  $eb->date_format("{$eb_latest['li_date_kind']}",$data['wr_datetime']); ?></span>
                            </div>
                            <?php } ?>
                        </div>
                    </a>
                </div>
                <div class="webzine-txt">
                    <a href="<?php echo $data['href']; ?>">
                        <div class="txt-subj">
						<h4>
								<?php if ($eb_latest['li_ca_view'] == 'y' && $data['ca_name']) { ?>
								<span class="category"><?php echo $list[$i]['ca_name']; ?></span>
								<?php } ?>
							<?php echo $data['wr_subject']; ?>
						</h4>
						<p class="webzine-cont">
							<?php echo cut_str($data['wr_content'],200, '…'); ?>
						</p>
                        </div>
                    </a>
                </div>
            </div>
            <?php }} else { ?>
            <p class="text-center text-gray m-t-30 m-b-30"><i class="fas fa-exclamation-circle"></i> 최신글이 없습니다.</p>
            <?php } ?>
        </div>
        <div class="clearfix"></div>
        <?php }} ?>

        <?php if ($el_default) { ?>
        <div class="tab-pane active in" id="webzine-tlb-<?php echo time(); ?>-1">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="list-unstyled">
                        <li class="no-latest"><p class="text-center text-gray m-t-30 m-b-30"><i class="fas fa-exclamation-circle"></i> 최신글이 없습니다.</p></li>
                    </ul>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

<script>
$(document).ready(function() {
    $('.eblatest-webzine-tabs li a').hover(function (e) {
        e.preventDefault()
        $(this).tab('show');
    });

    $('.eblatest-webzine-tabs li a').click(function (e) {
        return true;
    });

    $('.eblatest-webzine-tabs li a').on("click",function (e) {
        if ($(this).attr("data-href")) {
            window.location.href = $(this).attr("data-href");
        }
    });
});

$(function(){
    var duration = 120;
    var $img_cap = $('.webzine-latest .webzine-img');
    $img_cap.find('.img-box')
        .on('mouseover', function(){
            $(this).find('.img-caption').stop(true).animate({bottom: '0px'}, duration);
        })
        .on('mouseout', function(){
            $(this).find('.img-caption').stop(true).animate({bottom: '-30px'}, duration);
        });
});
</script>
<?php } ?>