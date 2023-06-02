<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/sleep/config_form.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.G5_JS_URL.'/remodal/remodal.css">', 11);
add_stylesheet('<link rel="stylesheet" href="'.G5_JS_URL.'/remodal/remodal-default-theme.css">', 12);
add_javascript('<script src="'.G5_JS_URL.'/remodal/remodal.js"></script>', 10);
?>

<style>
@media (min-width: 1100px) {
    .pg-anchor-in.tab-e2 .nav-tabs li a {font-size:14px;font-weight:bold;padding:8px 17px}
    .pg-anchor-in.tab-e2 .nav-tabs li.active a {z-index:1;border:1px solid #000;border-top:1px solid #DE2600;color:#DE2600}
    .pg-anchor-in.tab-e2 .tab-bottom-line {position:relative;display:block;height:1px;background:#000;margin-bottom:20px}
}
@media (max-width: 1099px) {
    .pg-anchor-in {position:relative;overflow:hidden;margin-bottom:20px;border:1px solid #757575}
    .pg-anchor-in.tab-e2 .nav-tabs li {width:33.33333%;margin:0}
    .pg-anchor-in.tab-e2 .nav-tabs li a {font-size:12px;padding:6px 0;text-align:center;border-bottom:1px solid #d5d5d5;margin-right:0;font-weight:bold;background:#fff}
    .pg-anchor-in.tab-e2 .nav-tabs li.active a {border:0;border-bottom:1px solid #d5d5d5 !important;color:#DE2600;background:#fff1f0}
    .pg-anchor-in.tab-e2 .nav-tabs li:nth-child(1) a {border-right:1px solid #d5d5d5}
    .pg-anchor-in.tab-e2 .nav-tabs li:nth-child(2) a {border-right:1px solid #d5d5d5}
    .pg-anchor-in.tab-e2 .nav-tabs li:nth-child(4) a {border-right:1px solid #d5d5d5}
    .pg-anchor-in.tab-e2 .nav-tabs li:nth-child(5) a {border-right:1px solid #d5d5d5}
    .pg-anchor-in.tab-e2 .nav-tabs li:nth-child(7) a {border-right:1px solid #d5d5d5;border-bottom:0 !important}
    .pg-anchor-in.tab-e2 .nav-tabs li:nth-child(8) a {border-right:1px solid #d5d5d5;border-bottom:0 !important}
    .pg-anchor-in.tab-e2 .nav-tabs li:nth-child(9) a {border-bottom:0 !important}
    .pg-anchor-in.tab-e2 .tab-bottom-line {display:none}
}
.cf_cert_hide {display:none;position:absolute;top:-20000px;left:-10000px}

.cf_tr_hide {display:none;}
</style>

<div class="admin-config-form">
    <form name="fconfigform" id="fconfigform" method="post" onsubmit="return fconfigform_submit(this);" class="eyoom-form">
    <input type="hidden" name="token" id="token" value="">

    <div class="adm-headline">
        <h3>슬립프렌드 환경 설정</h3>
    </div>

    <div id="anc_cf_basic">
        <div class="pg-anchor">
        <?php echo adm_pg_anchor('anc_cf_basic'); ?>
        </div>
        <div class="adm-table-form-wrap margin-bottom-30">
            <header><strong><i class="fas fa-caret-right"></i>AirView 접속 정보</strong></header>
            <div class="table-list-eb">
                <?php if (!G5_IS_MOBILE) { ?>
                <div class="table-responsive">
                <?php } ?>
                <table class="table">
                    <tbody>
                        <tr>
                            <th class="table-form-th">
                                <label for="resmed_username" class="label">로그인 아이디<strong class="sound_only">필수</strong></label>
                            </th>
                            <td colspan="3">
                                <label class="input form-width-250px">
                                    <input type="text" name="resmed_username" value="<?php echo get_sanitize_input($sleep_config['resmed_username']); ?>" id="resmed_username" required>
                                </label>
                            </td>
                        </tr>

                        <tr>
                            <th class="table-form-th">
                                <label for="cf_title" class="label">로그인 패스워드<strong class="sound_only">필수</strong></label>
                            </th>
                            <td colspan="3">
                                <label class="input form-width-250px">
                                    <input type="text" name="resmed_password" value="<?php echo get_sanitize_input($sleep_config['resmed_password']); ?>" id="resmed_password" required>
                                </label>
                            </td>
                        </tr>

                    </tbody>
                </table>
                <?php if (!G5_IS_MOBILE) { ?>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <?php echo $frm_submit; // 버튼 ?>


    </form>
</div>

<script>


function fconfigform_submit(f) {

    f.action = "<?php echo $action_url1; ?>";
    return true;
}

</script>