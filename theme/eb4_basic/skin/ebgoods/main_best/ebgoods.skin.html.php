<?php
/**
 * skin file : /theme/THEME_NAME/skin/ebgoods/basic/ebgoods.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

?>

<?php if (isset($eg_master) && $eg_master['eg_state'] == '1') { // 보이기 상태에서만 출력 ?>

<ul>
    <?php if (is_array($eg_item)) { foreach ($eg_item as $k => $eb_goods) { ?>
        <?php if (count((array)$eb_goods['list']) > 0) { foreach ($eb_goods['list'] as $i => $data) { ?>
            <li>
                <div class="img">
                    <a href="<?php echo $data['href']; ?>"><?php echo $data['it_image']; ?></a>
                </div>
                <div class="desc">
                    <a href="<?php echo $data['href']; ?>"><?php echo $data['it_name']?></a>
                    <p class="price">
                    <?php if ($eb_goods['gi_view_it_price'] == 'y') { ?>
                        <?php echo number_format($data['it_price']); ?>원
                    <?php } ?>
                    <?php if ($eb_goods['gi_view_it_cust_price'] == 'y' && $data['it_cust_price']) { ?>
                        <s><?php echo number_format($data['it_cust_price']); ?>원</s>
                    <?php } ?>
                    </p>
                </div>
            </li>
        <?php }}?>

    <?php }} ?>
</ul>

<?php } ?>