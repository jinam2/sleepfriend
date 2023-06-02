<?php
/**
 * skin file : /theme/THEME_NAME/skin/eblatest/realreview/eblatest.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

add_javascript('<script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js"></script>', 1);

?>

<?php if (isset($el_master) && $el_master['el_state'] == '1') { // 보이기 상태에서만 출력 ?>

<div class="list" data-masonry='{"percentPosition": true }'>
    <?php if (is_array($el_item)) { foreach ($el_item as $k => $eb_latest) { ?>

        <?php if (count((array)$eb_latest['list']) > 0) { foreach ($eb_latest['list'] as $i => $data) { ?>
            <div class="box">
                <div class="img">
                    <a href="<?php echo $data['href']?>"><img src="<?php echo $data['wr_image']?>"></a>
                </div>
                <div class="desc">
                    <h5><?php echo $data['wr_subject']; ?></h5>
                    <p><?php echo $data['wr_name']; ?>님의 솔직 후기입니다.</p>
                    <p>
                        <?php echo $data['wr_content']; ?>
                    </p>
                    <a href="<?php echo $data['href']?>"><img src="/images/icon_arrow.png">자세히 보기</a>
                </div>
            </div>
        <?php }}?>

    <?php }} ?>
</div>

<?php } ?>