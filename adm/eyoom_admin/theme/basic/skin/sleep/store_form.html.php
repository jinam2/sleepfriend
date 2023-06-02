<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/sleep/store_form.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>


<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=<?php echo $config['cf_map_daum_id'];?>&libraries=clusterer,services"></script>


    <div class="admin-member-form">
        <div class="adm-headline">
            <h3>매장 정보</h3>
        </div>

        <form name="fwrite" id="fwrite" method="post" action="<?php echo $action_url1; ?>" onsubmit="return fwrite_submit(this);" class="eyoom-form">
            <input type="hidden" name="w" value="<?php echo $w ?>">
            <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
            <input type="hidden" name="stx" value="<?php echo $stx ?>">
            <input type="hidden" name="sst" value="<?php echo $sst ?>">
            <input type="hidden" name="sod" value="<?php echo $sod ?>">
            <input type="hidden" name="page" value="<?php echo $page ?>">
            <input type="hidden" name="wmode" value="<?php echo $wmode ?>">
            <input type="hidden" name="seq" value="<?php echo $seq ?>">
            <input type="hidden" name="token" value="">

            <div class="adm-table-form-wrap margin-bottom-30">
                <header><strong><i class="fas fa-caret-right"></i> 매장 정보</strong></header>
                <div class="table-list-eb">
                    <?php if (!G5_IS_MOBILE) { ?>
                    <div class="table-responsive">
                        <?php } ?>
                        <table class="table">
                            <tbody>
                            <tr>
                                <th class="table-form-th">
                                    <label for="store_name" class="label">매장명</label>
                                </th>
                                <td colspan="3">
                                    <label class="input form-width-500px">
                                        <input type="text" name="store_name" id="store_name" value="<?php echo $store['store_name']; ?>" maxlength="20" required>
                                    </label>
                                </td>
                            </tr>

                            <tr>
                                <th class="table-form-th border-left-th">
                                    <label for="tel" class="label">전화번호</label>
                                </th>
                                <td>
                                    <label class="input form-width-250px">
                                        <i class="icon-append fas fa-phone"></i>
                                        <input type="text" name="tel" id="tel" value="<?php echo $store['tel']; ?>" maxlength="20">
                                    </label>
                                </td>
                            </tr>

                            <tr>
                                <th class="table-form-th">
                                    <label for="mb_hp" class="label">주소</label>
                                </th>
                                <td colspan="3">
                                    <div class="row">
                                        <div class="col col-3">
                                            <section>
                                                <label for="zipcode" class="sound_only">우편번호</label>
                                                <label class="input">
                                                    <i class="icon-append fas fa-question-circle"></i>
                                                    <input type="text" name="zipcode" value="<?php echo $store['zipcode']; ?>" id="zipcode" maxlength="6" readonly="readonly" required>
                                                    <b class="tooltip tooltip-top-right">우편번호</b>
                                                </label>
                                            </section>
                                        </div>
                                        <div class="col col-2">
                                            <section>
                                                <button type="button" onclick="win_zip_coord('fwrite', 'zipcode', 'address1', 'address2', 'address3', 'address_jibeon', 'address_lat', 'address_lon', 'address_bcode', 'sido');" class="btn-e btn-e-purple" style="padding:4px 12px 3px">주소 검색</button>
                                            </section>
                                        </div>
                                    </div>
                                    <section>
                                        <label class="input">
                                            <input type="text" name="address1" value="<?php echo $store['address1']; ?>" id="address1" required>
                                        </label>
                                        <div class="note"><strong>Note:</strong> 기본주소</div>
                                    </section>
                                    <div class="row">
                                        <div class="col col-6">
                                            <section>
                                                <label class="input">
                                                    <input type="text" name="address2" value="<?php echo $store['address2']; ?>" id="address2">
                                                </label>
                                                <div class="note"><strong>Note:</strong> 상세주소</div>
                                            </section>
                                        </div>

                                        <input type="hidden" name="address3" value="<?php echo $store['address3']; ?>">
                                        <input type="hidden" name="address_jibeon" value="<?php echo $store['address_jibeon']; ?>">
                                        <input type="hidden" name="address_lat" value="<?php echo $store['address_lat']; ?>">
                                        <input type="hidden" name="address_lon" value="<?php echo $store['address_lon']; ?>">
                                        <input type="hidden" name="address_bcode" value="<?php echo $store['address_bcode']; ?>">
                                        <input type="hidden" name="sido" value="<?php echo $store['sido']; ?>">
                                    </div>
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

