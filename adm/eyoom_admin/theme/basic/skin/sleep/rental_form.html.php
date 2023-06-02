<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/place/rental_form.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

?>

    <div class="admin-member-form">
        <div class="adm-headline">
            <h3>렌탈 신청 정보</h3>
        </div>

        <form name="fwrite" id="fwrite" method="post" action="<?php echo $action_url1; ?>" onsubmit="return fwrite_submit(this);" class="eyoom-form">
            <input type="hidden" name="w" value="<?php echo $w ?>">
            <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
            <input type="hidden" name="stx" value="<?php echo $stx ?>">
            <input type="hidden" name="sst" value="<?php echo $sst ?>">
            <input type="hidden" name="sod" value="<?php echo $sod ?>">
            <input type="hidden" name="page" value="<?php echo $page ?>">
            <input type="hidden" name="wmode" value="<?php echo $wmode ?>">
            <input type="hidden" name="od_id" value="<?php echo $od_id ?>">
            <input type="hidden" name="token" value="">

            <div class="adm-table-form-wrap margin-bottom-30">
                <header><strong><i class="fas fa-caret-right"></i> 렌탈 신청 정보</strong></header>
                <div class="table-list-eb">
                    <?php if (!G5_IS_MOBILE) { ?>
                    <div class="table-responsive">
                        <?php } ?>
                        <table class="table">
                            <tbody>
                            <tr>
                                <th class="table-form-th">
                                    <label for="it_name" class="label">제품</label>
                                </th>
                                <td colspan="3">
                                    <label class="input form-width-500px">
                                        [<?php echo $rental['it_brand'];?>] <?php echo $rental['it_name'];?>
                                    </label>
                                </td>
                            </tr>

                            <tr>
                                <th class="table-form-th">
                                    <label for="it_name" class="label">신청자</label>
                                </th>
                                <td colspan="3">
                                    <label class="input form-width-500px">
                                        <?php echo $rental['mb_name'];?>
                                    </label>
                                </td>
                            </tr>

                            <tr>
                                <th class="table-form-th">
                                    <label for="rental_type_name" class="label">렌탈 형태</label>
                                </th>
                                <td colspan="3">
                                    <label class="input form-width-500px">
                                        <?php echo $rental['rental_type_name'];?>
                                    </label>
                                </td>
                            </tr>

                            <tr>
                                <th class="table-form-th">
                                    <label for="od_file1" class="label">신분증</label>
                                </th>
                                <td colspan="3">
                                    <label class="input form-width-500px">
                                        <?php echo $rental['od_filename1'];?>
                                        <?php if($rental['link1']) {?>
                                            <span><?=$rental['link1']?></span>
                                        <?php } ?>
                                    </label>
                                </td>
                            </tr>
                            <?php if($rental['od_rental_type'] == 'insurance') {?>
                                <tr>
                                    <th class="table-form-th">
                                        <label for="od_file2" class="label">처방전</label>
                                    </th>
                                    <td colspan="3">
                                        <label class="input form-width-500px">
                                            <?php echo $rental['od_filename2'];?>
                                            <?php if($rental['link2']) {?>
                                                <span><?=$rental['link2']?></span>
                                            <?php } ?>
                                        </label>
                                    </td>
                                </tr>

                                <tr>
                                    <th class="table-form-th">
                                        <label for="od_file3" class="label">등록신청서</label>
                                    </th>
                                    <td colspan="3">
                                        <label class="input form-width-500px">
                                            <?php echo $rental['od_filename3'];?>
                                            <?php if($rental['link3']) {?>
                                                <span><?=$rental['link3']?></span>
                                            <?php } ?>
                                        </label>
                                    </td>
                                </tr>

                                <tr>
                                    <th class="table-form-th">
                                        <label for="od_file4" class="label">수면다원검사결과지</label>
                                    </th>
                                    <td colspan="3">
                                        <label class="input form-width-500px">
                                            <?php echo $rental['od_filename4'];?>
                                            <?php if($rental['link4']) {?>
                                                <span><?=$rental['link4']?></span>
                                            <?php } ?>
                                        </label>
                                    </td>
                                </tr>

                            <?php } ?>
                            <tr>
                                <th class="table-form-th border-left-th">
                                    <label for="bf_status" class="label">상태</label>
                                </th>
                                <td>
                                    <select name="od_status" id="od_status">
                                        <option value="대기" <?=$rental['od_status'] == "대기" ? "selected" : "" ?>>대기</option>
                                        <option value="접수" <?=$rental['od_status'] == "접수" ? "selected" : "" ?>>접수</option>
                                        <option value="반려" <?=$rental['od_status'] == "반려" ? "selected" : "" ?>>반려</option>
                                        <option value="완료" <?=$rental['od_status'] == "완료" ? "selected" : "" ?>>완료</option>
                                    </select>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <?php if (!G5_IS_MOBILE) { ?>
                    </div>
                <?php } ?>
                </div>
            </div>

            <?php echo $frm_submit; ?>

        </form>
    </div>

    <script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/eyoom-form/plugins/jquery-maskedinput/jquery.maskedinput.min.js"></script>
    <script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/eyoom-form/plugins/jquery-chained/jquery.chained.remote.min.js"></script>

    <script>
        jQuery(function($){

        });

        function fwrite_submit(f)
        {

            return true;
        }

    </script>

