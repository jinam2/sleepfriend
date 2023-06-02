<?php
/**
 * skin file : /theme/THEME_NAME/skin/eblatest/gallery/eblatest.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
<!--div class="position-relative <?php if ($el_master['el_state'] == '2') { ?>eb-hidden-space<?php } ?>">
    <div class="adm-edit-btn btn-edit-mode" style="top:0;text-align:right">
        <div class="btn-group">
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=eblatest_form&amp;thema=<?php echo $theme; ?>&amp;el_code=<?php echo $el_master['el_code']; ?>&amp;w=u&amp;wmode=1" onclick="eb_admset_modal(this.href); return false;" class="ae-btn-l"><i class="far fa-edit"></i> EB최신글 마스터 설정</a>
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=eblatest_form&amp;thema=<?php echo $theme; ?>&amp;el_code=<?php echo $el_master['el_code']; ?>&amp;w=u" target="_blank" class="ae-btn-r" title="새창 열기">
                <i class="fas fa-external-link-alt"></i>
            </a>
        </div>
    </div>
</div-->
<?php } ?>

<?php if (isset($el_master) && $el_master['el_state'] == '1') { // 보이기 상태에서만 출력 ?>
<style>
.movie2-latest .tab-content {position:relative;padding:0;}
.movie2-latest .gallery-item {position:relative; width:48.5%; float:left; margin:0 0 50px !important;}
.movie2-latest .gallery-item:nth-of-type(even) {margin-left:3% !important;}
.movie2-latest .gallery-img {position:relative;overflow:hidden; margin-bottom:15px}
.movie2-latest .img-box {position:relative;overflow:hidden;width:100%; border-radius:10px; margin:0 0 10px;}
.movie2-latest .img-box img {width:100%;}
.movie2-latest .img-box .no-image {position:absolute;top:50%;left:0;width:100%;text-align:center;margin-bottom:0;margin-top:-8px;color:#959595;font-size:.8125rem}
.movie2-latest .img-bo-subj {position:absolute;top:5px;left:5px;display:inline-block;padding:3px 10px;font-size:.8125rem;line-height:1;color:#fff;text-align:center;white-space:nowrap;vertical-align:baseline;background:#252525}
.movie2-latest .img-box .video-icon {position:absolute;top:50%;left:50%;color:#fff;width:40px;height:40px;line-height:40px;margin-top:-20px;margin-left:-20px;text-align:center;font-size:30px}
.movie2-latest .img-caption {color:#fff;font-size:.8125rem;position:absolute;left:0;bottom:-30px;display:block;z-index:1;background:rgba(0, 0, 0, 0.7);text-align:left;width:100%;height:30px;line-height:30px;margin-bottom:0;padding:0 5px}
.movie2-latest .img-caption span {margin-right:7px;color:#c5c5c5;font-size:.8125rem}
.movie2-latest .img-caption span i {color:#a5a5a5}
.movie2-latest .gallery-txt {position:relative;}
.movie2-latest .txt-subj {position:relative;margin-bottom:10px}
.movie2-latest .txt-subj h5 {color:#000; font-size:24px;margin:0;}
.movie2-latest .txt-subj h5 .gallery-new-icon {position:relative;display:inline-block;width:18px;height:14px;background-color:#cc2300;margin-right:2px}
.movie2-latest .txt-subj h5 .gallery-new-icon:before {content:"";position:absolute;top:4px;left:5px;width:2px;height:6px;background-color:#fff}
.movie2-latest .txt-subj h5 .gallery-new-icon:after {content:"";position:absolute;top:4px;right:5px;width:2px;height:6px;background-color:#fff}
.movie2-latest .txt-subj h5 .gallery-new-icon b {position:absolute;top:3px;left:8px;width:2px;height:8px;background-color:#fff;transform:rotate(-60deg)}
.movie2-latest .txt-subj h5 span {display:block; margin:5px 0 0; font-size:15px; color:#666; font-weight:400;}
.movie2-latest .txt-subj .gallery-comment {display:block;position:absolute;top:-2px;right:0;color:#f4511e;background:#fff;padding-left:5px}
.movie2-latest .txt-cont {position:relative;overflow:hidden;height:43px;font-size:.9375rem;color:#959595;margin-bottom:10px}
.movie2-latest .txt-photo img {width:17px;height:17px;margin-right:2px;display:inline-block}
.movie2-latest .txt-photo .txt-user-icon {color:#959595;margin-right:2px}
.movie2-latest .txt-nick {color:#959595}
.movie2-latest .txt-info {margin-top:5px;padding-top:5px;font-size:11px;text-align:right;color:#b5b5b5;border-top:1px solid #e5e5e5}
.movie2-latest .txt-info span {margin-left:5px}
@media (max-width:1220px) {
	.movie2-latest .txt-subj h5 span {font-size:14px;}
	.movie2-latest .txt-subj h5 {font-size:20px;}
}
@media (max-width:768px) {
	.movie2-latest .txt-subj h5 {font-size:18px;}
}
@media (max-width:520px) {
	.movie2-latest .gallery-item {width:100%; float:none; margin:0 0 50px !important;}
	.movie2-latest .gallery-item:nth-of-type(even) {margin-left:0% !important;}
}
</style>

<div class="movie2-latest">

    <div class="tab-content">
        <?php if (is_array($el_item)) { foreach ($el_item as $k => $eb_latest) { ?>
        <div class="tab-pane <?php echo ($k==0) ? 'active': ''; ?> in" id="gallery-tlb-<?php echo $el_master['el_code']; ?>-<?php echo ($k+1); ?>">
            <?php if (count((array)$eb_latest['list']) > 0) { foreach ($eb_latest['list'] as $data) { ?>
            <div class="gallery-item">
                <div class="gallery-img">
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
                <div class="gallery-txt">
                    <a href="<?php echo $data['href']; ?>">
                        <div class="txt-subj">
                            <h5 class="ellipsis">
                                <?php if ($data['new']) { ?>
                                <span class="gallery-new-icon"><b></b></span>
                                <?php } ?>

                                <?php if ($eb_latest['li_ca_view'] == 'y' && $data['ca_name']) { ?>
                                <span class="text-gray"><?php echo $data['ca_name']; ?> <span class="text-light-gray">|</span></span>
                                <?php } ?>

                                <?php echo $data['wr_subject']; ?><br>
								<span class="date">기간 : <?php echo $data['wr_1'] ?> ~ <?php echo $data['wr_2'] ?></span>
                            </h5>
                            <?php if ($data['wr_comment']) { ?>
                            <span class="gallery-comment">+<?php echo number_format($data['wr_comment']); ?></span>
                            <?php } ?>
                        </div>

                        <?php if ($eb_latest['li_content'] == 'y') { ?>
                        <p class="txt-cont"><?php echo $data['wr_content']; ?></p>
                        <?php } ?>

                        <?php if ($eb_latest['li_mbname_view'] == 'y' && $data['wr_name']) { ?>
                        <span class="txt-photo">
                            <?php if ($eb_latest['li_photo'] == 'y') { ?>
                            <span class="txt-photo">
                                <?php if ($data['mb_photo']) { ?>
                                <?php echo $data['mb_photo']; ?>
                                <?php } else { ?>
                                <span class="txt-user-icon"><i class="far fa-user-circle"></i></span>
                                <?php } ?>
                            </span>
                            <?php } ?>
                            <span class="txt-nick"><?php echo $data['wr_name']; ?></span>
                        </span>
                        <?php } ?>

                    </a>
                </div>
            </div>
            <?php }} else { ?>
            <p class="text-center text-gray m-t-30 m-b-30"><i class="fas fa-exclamation-circle"></i> 최신글이 없습니다.</p>
            <?php } ?>

            <?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
            <?php } ?>
        </div>
        <div class="clearfix"></div>
        <?php }} ?>

        <?php if ($el_default) { ?>
        <div class="tab-pane active in" id="gallery-tlb-<?php echo time(); ?>-1">
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
    $('.eblatest-gallery-tabs li a').hover(function (e) {
        e.preventDefault()
        $(this).tab('show');
    });

    $('.eblatest-gallery-tabs li a').click(function (e) {
        return true;
    });

    $('.eblatest-gallery-tabs li a').on("click",function (e) {
        if ($(this).attr("data-href")) {
            window.location.href = $(this).attr("data-href");
        }
    });
});

$(function(){
    var duration = 120;
    var $img_cap = $('.movie2-latest .gallery-img');
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