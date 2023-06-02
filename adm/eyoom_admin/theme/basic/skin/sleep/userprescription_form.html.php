<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/place/store_form.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

    <div class="admin-member-form">
        <div class="adm-headline">
            <h3>처방 파일 정보</h3>
        </div>

        <form name="fwrite" id="fwrite" method="post" action="<?php echo $action_url1; ?>" onsubmit="return fwrite_submit(this);" class="eyoom-form">
            <input type="hidden" name="w" value="<?php echo $w ?>">
            <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
            <input type="hidden" name="stx" value="<?php echo $stx ?>">
            <input type="hidden" name="sst" value="<?php echo $sst ?>">
            <input type="hidden" name="sod" value="<?php echo $sod ?>">
            <input type="hidden" name="page" value="<?php echo $page ?>">
            <input type="hidden" name="wmode" value="<?php echo $wmode ?>">
            <input type="hidden" name="fid" value="<?php echo $fid ?>">
            <input type="hidden" name="token" value="">

            <div class="adm-table-form-wrap margin-bottom-30">
                <header><strong><i class="fas fa-caret-right"></i> 처방 파일 정보</strong></header>
                <div class="table-list-eb">
                    <?php if (!G5_IS_MOBILE) { ?>
                    <div class="table-responsive">
                        <?php } ?>
                        <table class="table">
                            <tbody>
                            <tr>
                                <th class="table-form-th">
                                    <label for="store_name" class="label">파일명</label>
                                </th>
                                <td colspan="3">
                                    <label class="input form-width-500px">
                                        <?php echo $prescription_file['bf_source'];?>
                                    </label>
                                </td>
                            </tr>

                            <tr>
                                <th class="table-form-th border-left-th">
                                    <label for="bf_status" class="label">상태</label>
                                </th>
                                <td>

                                    <select name="bf_status" id="bf_stauts">
                                        <option value="대기" <?=$prescription_file['bf_status'] == "대기" ? "selected" : "" ?>>대기</option>
                                        <option value="접수" <?=$prescription_file['bf_status'] == "접수" ? "selected" : "" ?>>접수</option>
                                        <option value="반려" <?=$prescription_file['bf_status'] == "반려" ? "selected" : "" ?>>반려</option>
                                        <option value="완료" <?=$prescription_file['bf_status'] == "완료" ? "selected" : "" ?>>완료</option>
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

