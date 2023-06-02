<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/board/contentform.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
if ($config['cf_editor'] == 'tuieditor') echo tuieditor_resource();
?>

<div class="admin-contentform">
    <form name="fanswer" id="fanswer" method="post" action="<?php echo $action_url1; ?>" onsubmit="return frmqaform_check(this)" class="eyoom-form">
    <input type="hidden" name="qa_id" value="<?php echo $qa_id; ?>">
    <input type="hidden" name="w" value="<?php echo $w; ?>">
    <input type="hidden" name="qa_html" value="0">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="stx" value="<?php echo $stx; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="token" value="<?php echo $token ?>">
    <?php if($answer)  { ?>
        <input type="hidden" name="qa_category" value="<?php echo $answer['qa_category'] ?>">
        <input type="hidden" name="qa_group" value="<?php echo $answer['qa_group'] ?>">
    <?php } ?>

    <div class="adm-headline">
        <h3>내용 <?php echo $html_title; ?></h3>
    </div>

    <div class="adm-table-form-wrap">
        <div class="table-list-eb">
            <?php if (!G5_IS_MOBILE) { ?>
            <div class="table-responsive">
            <?php } ?>
            <table class="table">
                <tbody>
                    <tr>
                        <th class="table-form-th">
                            제목
                        </th>
                        <td>
                            <?php echo clean_xss_attributes($write['qa_subject']); ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="co_content" class="label">내용</label>
                        </th>
                        <td>
                            <div class="textarea">
                                <?php echo get_view_thumbnail(conv_content($write['qa_content'], $write['qa_html']), $qaconfig['qa_image_width']); ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="qa_subject" class="label">답변 제목<strong class="sound_only">필수</strong></label>
                        </th>
                        <td>
                            <label class="input form-width-500px">
                                <input type="text" name="qa_subject" value="<?php echo htmlspecialchars2($answer['qa_subject']); ?>" id="qa_subject" required>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="co_mobile_content" class="label">답변내용</label>
                        </th>
                        <td>
                            <div class="textarea">
                                <textarea name="qa_content" id="qa_content" rows="5"><?php echo $answer['qa_content']; ?></textarea>
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

<?php
// [KVE-2018-2089] 취약점 으로 인해 파일 경로 수정시에만 자동등록방지 코드 사용
?>
<script>
    var captcha_chk = false;



function frm_check_file(){
    var co_include_head = "<?php echo $co['co_include_head']; ?>";
    var co_include_tail = "<?php echo $co['co_include_tail']; ?>";
    var head = jQuery.trim(jQuery("#co_include_head").val());
    var tail = jQuery.trim(jQuery("#co_include_tail").val());

    if(co_include_head !== head || co_include_tail !== tail){
        // 캡챠를 사용합니다.
        jQuery("#admin_captcha_box").show();
        captcha_chk = true;

        use_captcha_check();

        return false;
    } else {
        jQuery("#admin_captcha_box").hide();
    }

    return true;
}


function frmqaform_check(f)
{
    errmsg = "";
    errfld = "";



    check_field(f.qa_subject, "답변 제목을 입력하세요.");
    check_field(f.qa_content, "답변 내용을 입력하세요.");

    if (errmsg != "") {
        alert(errmsg);
        errfld.focus();
        return false;
    }

    $.ajax({
        type: "POST",
        url: g5_bbs_url+"/ajax.write.token.php",
        data: { 'token_case' : 'qa_write' },
        cache: false,
        async: false,
        dataType: "json",
        success: function(data) {
            if (typeof data.token !== "undefined") {
                token = data.token;
                if(typeof f.token === "undefined")
                    $(f).prepend('<input type="hidden" name="token" value="">');
                $(f).find("input[name=token]").val(token);
            }
        }
    });

    document.getElementById("btn_submit").disabled = "disabled";

    return true;

}
</script>