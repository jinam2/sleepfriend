<?php
/**
 * skin file : /theme/THEME_NAME/skin/board/webzine/write.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/sweetalert2/sweetalert2.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/venobox/venobox.min.css" type="text/css" media="screen">',0);
if ($config['cf_editor'] == 'tuieditor') echo tuieditor_resource();
?>

<style>
.board-write {font-size:.9375rem}
.board-write .board-setup {position:relative;border:1px solid #d5d5d5;height:38px;margin-bottom:20px}
.board-write .board-setup .select {position:absolute;top:-1px;left:-1px;display:inline-block;width:200px}
.board-write .board-setup-btn-box {position:absolute;top:-1px;right:-1px;display:inline-block;width:420px}
.board-write .board-setup-btn {float:left;width:25%;height:38px;line-height:38px;color:#fff;text-align:center;font-size:.8125rem}
.board-write .board-setup-btn:nth-child(odd) {background-color:#000}
.board-write .board-setup-btn:nth-child(even) {background-color:#3c3c3e}
.board-write .board-setup-btn:hover {opacity:0.8}
.board-write .board-write-title {position:relative;border-bottom:1px solid #959595;padding-bottom:15px;margin-bottom:15px}
.board-write .blind {position:absolute;top:-10px;left:-100000px;display:none}
.board-write .write-edit-wrap #wr_content {display:block;width:100%;min-height:200px;padding:6px 10px;outline:none;border-width:1px;border-style:solid;border-radius:0;background:#FFF;color:#353535;appearance:normal;-moz-appearance:none;-webkit-appearance:none;resize:vertical}
.board-write .write-option-btn {float:left;padding:0 15px;margin-bottom:3px;height:32px;line-height:32px;color:#fff;text-align:center;font-size:.8125rem}
.board-write .write-option-btn:nth-child(odd) {background:#000}
.board-write .write-option-btn:nth-child(even) {background:#3c3c3e}
.board-write .write-option-btn:hover {color:#fff;opacity:0.8}
.board-write .write-collapse-box {margin:10px 0;background:#f8f8f8;border:1px solid #d5d5d5;padding:15px 10px}
.board-write #modal_video_note .table-list-eb .table thead>tr>th {text-align:left}
/* Auto Save */
.autosave-btn {position:absolute;top:0;right:0}
#autosave_wrapper {position:relative}
#autosave_pop {display:none;z-index:10;position:absolute;top:0;right:0;padding:8px;width:320px;height:auto !important;height:180px;max-height:250px;border:2px solid #959595;background:#fff;box-shadow:0 1px 8px rgba(0, 0, 0, 0.2);overflow-y:scroll}
html.no-overflowscrolling #autosave_pop {height:auto;max-height:10000px !important}
#autosave_pop div {text-align:right}
#autosave_pop button {margin:0;padding:0;border:0;background:transparent;margin-left:10px}
#autosave_pop ul {margin:10px 0;padding:0;border-top:1px solid #e9e9e9;list-style:none}
#autosave_pop li {padding:7px 0;border-bottom:1px solid #e9e9e9;zoom:1;font-size:.75rem}
#autosave_pop li:after {display:block;visibility:hidden;clear:both;content:""}
#autosave_pop a {display:block;float:left}
#autosave_pop span {display:block;float:right}
#autosave_pop .autosave_heading {text-align:left}
#autosave_pop strong {font-size:.8125rem}
#autosave_pop .fa-times {position:absolute;top:10px;right:15px}
.autosave_close {cursor:pointer}
.autosave_content {display:none}
/* Tag */
#tag-box {position:relative;border:1px dashed #c5c5c5;min-height:47px;padding:10px;background:#fafafa;margin-top:15px}
#tag-box:before {content:"태그 박스";display:block;position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);font-size:.8125rem;color:#d5d5d5}
#tag-cloud div {position:relative;display:inline-block;line-height:1;background:#676769;padding:5px 10px;margin:2px 3px;font-size:.9375rem;color:#fff;border-radius:2px;z-index:1}
#tag-cloud div i {cursor:pointer;margin-left:5px}
/* Ckeditor */
.board-write a.cke_button {padding:2px 5px}
.board-write a.cke_button_on {padding:1px 4px}
.board-write a.cke_button_off:hover, .board-write a.cke_button_off:focus, .board-write a.cke_button_off:active {padding:1px 4px}
/* Smart Editor */
.cke_sc {margin-bottom:10px}
.btn_cke_sc {padding:0 10px}
.cke_sc_def {padding:10px;margin-bottom:10px;margin-top:10px}
.cke_sc_def button {padding:3px 15px;background:#555555;color:#fff;border:none}
/* Map */
#map_canvas {width:1000px;height:400px;display:none}
<?php if ($wmode) { ?>
.board-write {width:100%;overflow:hidden}
<?php } ?>
</style>

<div class="board-write">
    <?php if ($is_admin && !G5_IS_MOBILE && !$wmode) { ?>
    <div class="board-setup btn-edit-mode hidden-xs hidden-sm">
        <span class="eyoom-form">
            <label class="select">
                <select name="set_bo_skin" class="set_bo_skin">
                    <option value="">::스킨선택::</option>
                    <?php foreach ($bo_skin as $skin) { ?>
                    <option value="<?php echo $skin; ?>" <?php echo $skin == $eyoom_board['bo_skin'] ? 'selected': ''; ?>><?php echo $skin; ?></option>
                    <?php }?>
                </select><i></i>
            </label>
        </span>
        <span class="board-setup-btn-box">
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=board_copy&amp;bo_table=<?php echo $bo_table; ?>&amp;wmode=1"  onclick="eb_admset_modal(this.href); return false;" class="board-setup-btn"><i class="far fa-clone"></i> 복제하기</a>
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=board_form&amp;w=u&amp;bo_table=<?php echo $bo_table; ?>&amp;wmode=1"  onclick="eb_admset_modal(this.href); return false;" class="board-setup-btn"><i class="fas fa-list-alt"></i> 기본설정</a>
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=board_form&amp;w=u&amp;bo_table=<?php echo $bo_table; ?>&amp;wmode=1"  onclick="eb_admset_modal(this.href); return false;" class="board-setup-btn"><i class="far fa-list-alt"></i> 추가기능</a>
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=board_extend&amp;w=u&amp;bo_table=<?php echo $bo_table; ?>&amp;wmode=1"  onclick="eb_admset_modal(this.href); return false;" class="board-setup-btn"><i class="far fa-plus-square"></i> 확장필드 (<?php echo number_format($board['bo_ex_cnt']); ?>)</a>
        </span>
    </div>
    <?php } ?>

    <h5 class="board-write-title">
        <strong><?php echo $g5['title']; ?></strong>
    </h5>

    <form name="fwrite" id="fwrite" action="<?php echo $action_url; ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" class="eyoom-form">
    <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
    <input type="hidden" name="w" value="<?php echo $w; ?>">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table; ?>">
    <input type="hidden" name="wr_id" value="<?php echo $wr_id; ?>">
    <input type="hidden" name="sca" value="<?php echo $sca; ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
    <input type="hidden" name="stx" value="<?php echo $stx; ?>">
    <input type="hidden" name="spt" value="<?php echo $spt; ?>">
    <input type="hidden" name="sst" value="<?php echo $sst; ?>">
    <input type="hidden" name="sod" value="<?php echo $sod; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="board_skin_path" value="<?php echo EYOOM_CORE_PATH;?>/board">
    <input type="hidden" name="wmode" id="wmode" value="<?php echo $wmode; ?>">
    <input type="hidden" name="eb_1" id="eb_1" value="<?php echo $eb_1; ?>">
    <input type="hidden" name="eb_2" id="eb_2" value="<?php echo $eb_2; ?>">
    <input type="hidden" name="eb_3" id="eb_3" value="<?php echo $eb_3; ?>">
    <input type="hidden" name="eb_4" id="eb_4" value="<?php echo $eb_4; ?>">
    <input type="hidden" name="eb_5" id="eb_5" value="<?php echo $eb_5; ?>">
    <input type="hidden" name="eb_6" id="eb_6" value="<?php echo $eb_6; ?>">
    <input type="hidden" name="eb_7" id="eb_7" value="<?php echo $eb_7; ?>">
    <input type="hidden" name="eb_8" id="eb_8" value="<?php echo $eb_8; ?>">
    <input type="hidden" name="eb_9" id="eb_9" value="<?php echo $eb_9; ?>">
    <input type="hidden" name="eb_10" id="eb_10" value="<?php echo $eb_10; ?>">

    <?php if (($is_name) || ($is_password && !$is_admin) || ($is_email) || ($is_homepage)) { ?>
    <section>
        <div class="row">
            <?php if ($is_name) { ?>
            <div class="col col-3">
                <label for="wr_name" class="label">이름<strong class="sound_only">필수</strong></label>
                <label class="input required-mark m-b-10">
                    <i class="icon-append fas fa-user"></i>
                    <input type="text" name="wr_name" value="<?php echo $name; ?>" id="wr_name" required size="10" maxlength="20">
                </label>
            </div>
            <?php } ?>
            <?php if ($is_password && !$is_admin) { ?>
            <div class="col col-3">
                <label for="wr_password" class="label">비밀번호<strong class="sound_only">필수</strong></label>
                <label class="input required-mark m-b-10">
                    <i class="icon-append fas fa-lock"></i>
                    <input type="password" name="wr_password" id="wr_password" required maxlength="20">
                </label>
            </div>
            <?php } ?>
            <?php if ($is_email) { ?>
            <div class="col col-3">
                <label for="wr_email" class="label">이메일</label>
                <label class="input m-b-10">
                    <i class="icon-append fas fa-envelope"></i>
                    <input type="text" name="wr_email" value="<?php echo $email; ?>" id="wr_email" size="50" maxlength="100">
                </label>
            </div>
            <?php } ?>
            <?php if ($is_homepage) { ?>
            <div class="col col-3">
                <label for="wr_homepage" class="label">홈페이지</label>
                <label class="input m-b-10">
                    <i class="icon-append fas fa-home"></i>
                    <input type="text" name="wr_homepage" value="<?php echo $homepage; ?>" id="wr_homepage" size="50">
                </label>
            </div>
            <?php } ?>
        </div>
    </section>
    <?php } ?>
    <section>
        <div class="row">
            <?php if ($is_category) { ?>
            <div class="col col-4">
                <label class="select">
                    <select name="ca_name" id="ca_name" required class="form-control">
                        <option value="">분류 선택 - 필수</option>
                        <?php echo $category_option; ?>
                    </select>
                    <i></i>
                </label>
            </div>
            <?php } ?>
            <div class="col col-8">
            <?php if ($is_notice || $is_html || $is_secret || $is_mail || $bo_use_anonymous == '1') { ?>
                <div class="inline-group">
                    <?php if ($is_notice) { ?>
                    <label for="notice" class="checkbox"><input type="checkbox" id="notice" name="notice" value="1" <?php echo $notice_checked; ?>><i></i>공지</label>
                    <?php } ?>

                    <?php if ($is_html) { ?>
                    <?php if ($is_dhtml_editor) { ?>
                    <input type="hidden" value="html1" name="html">
                    <?php } else { ?>
                    <label for="html" class="checkbox"><input type="checkbox" id="html" name="html" onclick="html_auto_br(this);" value="<?php echo $html_value; ?>" <?php echo $html_checked; ?>><i></i>HTML</label>
                    <?php } ?>
                    <?php } ?>

                    <?php if ($is_secret) { ?>
                    <?php if ($is_admin || $is_secret == 1) { ?>
                    <label for="secret" class="checkbox"><input type="checkbox" id="secret" name="secret" value="secret" <?php echo $secret_checked; ?>><i></i>비밀글</label>
                    <?php } else { ?>
                    <input type="hidden" name="secret" value="secret">
                    <?php } ?>
                    <?php } ?>

                    <?php if ($bo_use_anonymous == '1') { ?>
                    <label for="wr_anonymous" class="checkbox"><input type="checkbox" id="wr_anonymous" name="wr_anonymous" value="1" <?php echo $wr_anonymous_checked; ?>><i></i>익명글</label>
                    <?php } ?>

                    <?php if ($is_mail) { ?>
                    <label for="mail" class="checkbox"><input type="checkbox" id="mail" name="mail" value="mail" <?php echo $recv_email_checked; ?>><i></i>답변메일받기</label>
                    <?php } ?>
                </div>
            <?php } ?>
            </div>
        </div>
    </section>
    <section>
        <div class="row">
            <div class="col col-12 md-m-b-10">
                <div class="position-relative">
                    <label for="wr_subject" class="label">
                        제목<strong class="sound_only"> 필수</strong>
                    </label>
                    <label class="input required-mark">
                        <input type="text" name="wr_subject" value="<?php echo $subject; ?>" id="wr_subject" required size="50" maxlength="255" placeholder="제목을 입력해 주세요.">
                    </label>
                    <?php if ($is_member) { //임시 저장된 글 기능 ?>
                    <span class="autosave-btn">
                        <script src="<?php echo G5_URL; ?>/js/autosave.js"></script>
                        <button type="button" id="btn_autosave" class="btn-e btn-dark position-relative">임시 저장된 글 <span id="autosave_count" class="badge badge-red rounded"><?php echo $autosave_count; ?></span></button>
                        <div id="autosave_pop">
                            <div class="autosave_heading">
                                <strong>임시 저장된 글 목록</strong>
                                <span class="autosave_close"><i class="fas fa-times"></i></span>
                            </div>
                            <div class="clearfix"></div>
                            <ul></ul>
                            <div><span class="autosave_close btn-e btn-e-dark btn-e-sm">닫기</span></div>
                        </div>
                    </span>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
    <?php if ($eyoom['use_tag'] == 'y' && $eyoom_board['bo_use_tag'] == '1' && $member['mb_level'] >= $eyoom_board['bo_tag_level']) { ?>
    <section class="m-b-20">
        <label class="label">태그 입력</label>
        <div class="input input-button">
            <i class="icon-prepend fas fa-tags"></i>
            <input type="text" name="tmp_tag" id="tmp_tag" size="50" maxlength="255">
            <b class="tooltip tooltip-top-left">관련 태그를 입력 후, TAB키를 누르시면 쉽게 태그를 추가할 수 있습니다.</b>
            <div class="button"><input type="button" class="add_tags"><i class="fas fa-plus"></i> 태그입력</div>
        </div>
        <div id="tag-box">
            <div id="tag-cloud">
            <?php if (is_array($wr_tags)) { ?>
            <?php foreach ($wr_tags as $key => $value) { ?>
                <div id="tag_box_<?php echo $key; ?>"><?php echo $value; ?> <i class="fas fa-times" onclick="del_tags('<?php echo $value; ?>','<?php echo $key; ?>');"></i></div>
            <?php } ?>
            <?php } ?>
            </div>
        </div>
        <input type="hidden" name="wr_tag" id="wr_tag" value="<?php echo $write['wr_tag']; ?>">
        <input type="hidden" name="del_tag" id="del_tag" value="">
    </section>
    <?php } ?>
    <section>
        <div class="wr_content">
            <label class="label" for="wr_content">본문 내용</label>
            <div class="wr_content  <?php echo $is_dhtml_editor ? $config['cf_editor'] : ''; ?>">
                <?php if($write_min || $write_max) { ?>
                <!-- 최소/최대 글자 수 사용 시 -->
                <p id="char_count_desc">이 게시판은 최소 <strong><?php echo $write_min; ?></strong>글자 이상, 최대 <strong><?php echo $write_max; ?></strong>글자 이하까지 글을 쓰실 수 있습니다.</p>
                <?php } ?>
                <div class="write-edit-wrap">
                    <?php /* 에디터 사용시는 에디터로, 아니면 textarea 로 노출 */ ?>
                    <?php echo $editor_html; ?>
                </div>
                <?php if($write_min || $write_max) { ?>
                <!-- 최소/최대 글자 수 사용 시 -->
                <div id="char_count_wrap"><span id="char_count"></span>글자</div>
                <?php } ?>
            </div>
        </div>
    </section>
    <section>
        <?php $wl_cnt = count((array)$wr_link); ?>
        <?php for ($i=1; $i<=$wl_cnt; $i++) { ?>
        <div class="row">
            <div class="col col-12">
                <label class="label">관련 링크 <?php echo $i; ?></label>
                <label class="input">
                    <i class="icon-append fas fa-link"></i>
                    <input type="text" name="wr_link<?php echo $i; ?>" value="<?php if ($w == 'u') echo $wr_link[$i]['link_val']; ?>" id="wr_link<?php echo $i; ?>" class="form-control" size="50">
                    <b class="tooltip tooltip-top-right">링크주소를 입력 해 주세요.</b>
                </label>
            </div>
        </div>
        <?php } ?>
    </section>
    <section>
        <?php $wf_cnt = count((array)$wr_file); ?>
        <?php for ($i=0; $i<$wf_cnt; $i++) { ?>
        <div class="row">
            <div class="col col-12">
                <label for="bf_file_<?php echo $i+1 ?>" class="label">파일 <?php echo $i+1; ?> 업로드</label>
                <label class="input">
                    <input type="file" class="form-control" id="bf_file_<?php echo $i+1 ?>" name="bf_file[]" value="사진선택">
                    <b class="tooltip tooltip-top-right">파일첨부 <?php echo $i+1; ?> : 용량 <?php echo $upload_max_filesize; ?> 이하만 업로드 가능</b>
                </label>
            </div>
            <?php if ($is_file_content) { ?>
            <div class="col col-12">
                <label class="input">
                    <i class="icon-append fas fa-question-circle"></i>
                    <input type="text" name="bf_content[]" value="<?php if ($w == 'u') echo $wr_file[$i]['bf_content']; ?>" class="form-control" size="50" placeholder="파일<?php echo $i+1; ?> 설명">
                    <b class="tooltip tooltip-top-right">파일 <?php echo $i+1; ?> 설명을 입력 해 주세요.</b>
                </label>
            </div>
            <div class="clearfix"></div>
            <?php } ?>
            <?php if ($w=='u' && $wr_file[$i]['file']) { ?>
            <div class="col col-12 m-b-15">
                <label for="bf_file_del<?php echo $i; ?>" class="checkbox"><input type="checkbox" id="bf_file_del<?php echo $i; ?>" name="bf_file_del[<?php echo $i; ?>]" value="1"><i></i><?php echo $wr_file[$i]['source'];?> (<?php echo $wr_file[$i]['size']; ?>) 파일삭제</label>
            </div>
            <?php } ?>
        </div>
        <?php } ?>
    </section>
    <?php if ($is_use_captcha) { ?>
    <section>
        <label class="label">자동등록방지</label>
        <div class="vc-captcha"><?php echo $captcha_html; ?></div>
        <div class="m-b-20"></div>
    </section>
    <?php } ?>

    <div class="text-center">
        <input type="submit" value="작성완료" id="btn_submit" accesskey="s" class="btn-e btn-e-xlg btn-e-red">
        <a href="<?php echo $infinite_wmode ? "javascript:history.go(-1)": get_eyoom_pretty_url($bo_table, '', $qstr); ?>" class="btn-e btn-e-xlg btn-e-dark">취소</a>
    </div>
    </form>
</div>
<div id="map_canvas"></div>

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
<?php if ($eyoom_board['bo_use_addon_emoticon'] == '1') { ?>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/venobox/venobox.min.js"></script>
<?php } ?>
<?php if ($eyoom_board['bo_use_addon_map'] == '1' && ($config['cf_map_google_id'] || $config['cf_map_naver_id'] || $config['cf_map_daum_id'])) { ?>
<?php if ($config['cf_map_google_id']) { ?>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $config['cf_map_google_id']; ?>" async defer></script>
<?php } ?>
<?php if ($config['cf_map_naver_id']) { ?>
<script src="https://openapi.map.naver.com/openapi/v3/maps.js?clientId=<?php echo $config['cf_map_naver_id']; ?>&submodules=geocoder"></script>
<?php } ?>
<?php if ($config['cf_map_daum_id']) { ?>
<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=<?php echo $config['cf_map_daum_id']; ?>&libraries=services"></script>
<?php } ?>
<?php } ?>
<script>
$(document).ready(function(){
    <?php if ($eyoom_board['bo_use_addon_emoticon'] == '1') { ?>
    $(".emoticon").venobox({
        framewidth : '800px',
        frameheight: '500px'
    });
    <?php } ?>

    <?php if ($eyoom_board['bo_use_addon_video'] == '1') { ?>
    // 동영상 추가
    $("#btn_video").click(function(){
        var v_url = $("#video_url").val();
        if (!v_url){
            Swal.fire({
                title: "중요!",
                text: "동영상 주소를 입력해 주세요.",
                confirmButtonColor: "#e53935",
                icon: "warning",
                confirmButtonText: "확인"
            });
        } else {
            set_textarea_contents('video',v_url);
        }
        $("#video_url").val('');
    });
    <?php } ?>

    <?php if ($eyoom_board['bo_use_addon_soundcloud'] == '1') { ?>
    // 사운드크라우드 추가
    $("#btn_scloud").click(function(){
        var s_url = $("#scloud_url").val();
        if (!s_url){
            Swal.fire({
                title: "중요!",
                text: "사운드클라우드 주소를 입력해 주세요.",
                confirmButtonColor: "#e53935",
                icon: "warning",
                confirmButtonText: "확인"
            });
        } else {
            set_textarea_contents('sound',s_url);
        }
    });
    $("#scloud_url").val('');
    <?php } ?>

    <?php if ($eyoom_board['bo_use_addon_map'] == '1') { ?>
    // 지도 추가
    $("#btn_map").click(function(){
        var map_type = $("input[name='map_type']:checked").val();
        var map_addr1 = $("#map_addr1").val();
        var map_addr2 = $("#map_addr2").val();
        var map_name = $("#map_name").val();
        set_map_address(map_type, map_addr1, map_addr2, map_name);
    });
    <?php } ?>
});

<?php if ($eyoom_board['bo_use_addon_emoticon'] == '1') { ?>
function set_emoticon(emoticon) {
    var type='emoticon';
    set_textarea_contents(type,emoticon);
}
<?php } ?>

<?php if ($eyoom_board['bo_use_addon_map'] == '1' && ($config['cf_map_google_id'] || $config['cf_map_naver_id'] || $config['cf_map_daum_id'])) { ?>
function set_map_address(map_type, map_addr1, map_addr2, map_name) {
    switch(map_type) {
        case '1':
            <?php if ($config['cf_map_google_id']) { ?>
            set_map_google_address(map_type, map_addr1, map_addr2, map_name);
            <?php } ?>
            break;
        case '2':
            <?php if ($config['cf_map_naver_id']) { ?>
            set_map_naver_address(map_type, map_addr1, map_addr2, map_name);
            <?php } ?>
            break;
        case '3':
            <?php if ($config['cf_map_daum_id']) { ?>
            set_map_daum_address(map_type, map_addr1, map_addr2, map_name);
            <?php } ?>
            break;
    }
}

<?php if ($config['cf_map_google_id']) { ?>
function set_map_google_address(map_type, map_addr1, map_addr2, map_name) {
    var map = new google.maps.Map(document.getElementById('map_canvas'), {
        zoom: 8,
        center: {lat: -34.397, lng: 150.644}
    });
    var geocoder = new google.maps.Geocoder();

    var address = map_addr1 + " " + map_addr2;
    geocoder.geocode({'address': map_addr1}, function(results, status) {
        if (status === 'OK') {
            map.setCenter(results[0].geometry.location);
            var latlng = map.getCenter();
            set_textarea_contents('map', map_type+'^|^'+address+'^|^'+map_name+'^|^'+latlng);
        } else {
            Swal.fire({
                title: "중요!",
                text: "잘못된 주소입니다.",
                confirmButtonColor: "#e53935",
                icon: "warning",
                confirmButtonText: "확인"
            });
        }
    });
}
<?php }?>

<?php if ($config['cf_map_naver_id']) { ?>
function set_map_naver_address(map_type, map_addr1, map_addr2, map_name) {
    var address = map_addr1 + " " + map_addr2;

    naver.maps.Service.geocode({
        address: map_addr1
    }, function(status, response) {
        if (status !== naver.maps.Service.Status.OK) {
            Swal.fire({
                title: "중요!",
                text: "잘못된 주소입니다.",
                confirmButtonColor: "#e53935",
                icon: "warning",
                confirmButtonText: "확인"
            });
        }

        var item = response.result.items[0],
            point = new naver.maps.Point(item.point.x, item.point.y);

        var latlng = '('+point.y+', '+point.x+')';
        set_textarea_contents('map', map_type+'^|^'+address+'^|^'+map_name+'^|^'+latlng);
    });
}
<?php }?>

<?php if ($config['cf_map_daum_id']) { ?>
function set_map_daum_address(map_type, map_addr1, map_addr2, map_name) {
    var address = map_addr1 + " " + map_addr2;

    var mapContainer = document.getElementById('map_canvas'), // 지도를 표시할 div
        mapOption = {
            center: new daum.maps.LatLng(33.450701, 126.570667), // 지도의 중심좌표
            level: 3 // 지도의 확대 레벨
        };

    // 지도를 생성합니다
    var map = new daum.maps.Map(mapContainer, mapOption);

    // 주소-좌표 변환 객체를 생성합니다
    var geocoder = new daum.maps.services.Geocoder();

    // 주소로 좌표를 검색합니다
    geocoder.addressSearch(map_addr1, function(result, status) {
        // 정상적으로 검색이 완료됐으면
        if (status === daum.maps.services.Status.OK) {
            var latlng = new daum.maps.LatLng(result[0].y, result[0].x);
            set_textarea_contents('map', map_type+'^|^'+address+'^|^'+map_name+'^|^'+latlng);
        }
    });
}
<?php }?>

<?php } ?>

function set_textarea_contents(type,value) {
    var type_text = '';
    var content = '';
    switch(type) {
        case 'emoticon': type_text = '이모티콘'; break;
        case 'video': type_text = '동영상'; break;
        case 'code': type_text = 'code'; break;
        case 'sound': type_text = 'soundcloud'; break;
        case 'map': type_text = '지도'; break;
    }
    if (type_text != 'code') {
        content = '{'+type_text+':'+value+'}';
    } else {
        content = '{code:'+value+'}<br><br>{/code}<br>'
    }
    if (g5_editor.indexOf('ckeditor')!=-1 && !g5_is_mobile) {
        CKEDITOR.instances.wr_content.insertHtml(content);
    } else if (g5_editor.indexOf('smarteditor')!=-1 && !g5_is_mobile) {
        oEditors.getById["wr_content"].exec("PASTE_HTML", [content]);
    } else if (g5_editor.indexOf('tuieditor')!=-1 && !g5_is_mobile) {
        tui_wr_content.insertText(content);
    } else {
        var wr_html = $("#wr_content").val();
        var wr_emo = content;
        wr_html += wr_emo;
        $("#wr_content").val(wr_html);
    }
}

<?php if ($write_min || $write_max) { ?>
// 글자수 제한
var char_min = parseInt(<?php echo $write_min; ?>); // 최소
var char_max = parseInt(<?php echo $write_max; ?>); // 최대
check_byte("wr_content", "char_count");

$(function() {
    $("#wr_content").on("keyup", function() {
        check_byte("wr_content", "char_count");
    });
});
<?php } ?>

function html_auto_br(obj) {
    if (obj.checked) {
        Swal.fire({
            title: "자동 줄바꿈",
            text: "자동 줄바꿈을 하시겠습니까? 자동 줄바꿈은 게시물 내용 중 줄바뀐 곳을 <br>태그로 변환하는 기능입니다.",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#00897b",
            confirmButtonText: "승인",
            cancelButtonText: "취소"
        }).then((result) => {
            if (result.isConfirmed) {
                obj.value = "html2";
            } else {
                obj.value = "html1";
            }
        });
    }
    else
        obj.value = "";
}

function fwrite_submit(f) {
    <?php echo $editor_js; ?> // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함

    var subject = "";
    var content = "";
    $.ajax({
        url: g5_bbs_url+"/ajax.filter.php",
        type: "POST",
        data: {
            "subject": f.wr_subject.value,
            "content": f.wr_content.value
        },
        dataType: "json",
        async: false,
        cache: false,
        success: function(data, textStatus) {
            subject = data.subject;
            content = data.content;
        }
    });

    if (subject) {
        Swal.fire({
            title: "알림!",
            html: "제목에 금지단어 '<strong class='text-crimson'>"+subject+"</strong>' 단어가 포함되어있습니다.",
            confirmButtonColor: "#e53935",
            icon: "error",
            confirmButtonText: "확인"
        });
        f.wr_subject.focus();
        return false;
    }

    if (content) {
        Swal.fire({
            title: "알림!",
            text: "내용에 금지단어 '<strong class='text-crimson'>"+content+"</strong>' 단어가 포함되어있습니다.",
            confirmButtonColor: "#e53935",
            icon: "error",
            confirmButtonText: "확인"
        });
        if (typeof(ed_wr_content) != "undefined")
            ed_wr_content.returnFalse();
        else
            f.wr_content.focus();
        return false;
    }

    if (document.getElementById("char_count")) {
        if (char_min > 0 || char_max > 0) {
            var cnt = parseInt(check_byte("wr_content", "char_count"));
            if (char_min > 0 && char_min > cnt) {
                Swal.fire({
                    title: "알림!",
                    html: "내용은 <strong class='text-crimson'>"+char_min+"</strong> 글자 이상 쓰셔야 합니다.",
                    confirmButtonColor: "#e53935",
                    icon: "error",
                    confirmButtonText: "확인"
                });
                return false;
            }
            else if (char_max > 0 && char_max < cnt) {
                Swal.fire({
                    title: "알림!",
                    html: "내용은 <strong class='text-crimson'>"+char_max+"</strong> 글자 이하로 쓰셔야 합니다.",
                    confirmButtonColor: "#e53935",
                    icon: "error",
                    confirmButtonText: "확인"
                });
                return false;
            }
        }
    }

    <?php echo $captcha_js; ?> // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함

    document.getElementById("btn_submit").disabled = "disabled";

    return true;
}

<?php if ($eyoom['use_tag'] == 'y' && $eyoom_board['bo_use_tag'] == '1' && $member['mb_level'] >= $eyoom_board['bo_tag_level']) { ?>
var tag_size = '<?php echo (count((array)$wr_tags) > 0)? count((array)$wr_tags):0; ?>';
$(function(){
    $(".add_tags").click(function(){
        add_tags();
    });
    $("#tmp_tag").blur(function(){
        var tag = $('#tmp_tag').val();
        if (tag) add_tags();
    });

    var add_tags = function() {
        var obj = $('#tmp_tag');
        var tag = obj.val();
        if (!tag) {
            obj.focus();
        } else {
            <?php if (!$is_admin) { ?>
            var count = $('#tag-cloud > div:not(.blind)').length;
            var limit = '<?php echo $eyoom_board['bo_tag_limit'];?>';
            var max = parseInt(limit)-1;
            if (count > max) {
                Swal.fire({
                    title: "알림!",
                    html: "태그는 <strong class='text-crimson'>"+limit+"</strong> 개까지 등록가능합니다.",
                    confirmButtonColor: "#e53935",
                    icon: "warning",
                    confirmButtonText: "확인"
                });
                obj.val('');
                obj.focus();
                return;
            }
            <?php } ?>
            var duplicate = false;
            $('#tag-cloud > div:not(.blind)').each(function(){
                if ($(this).text().trim() == tag) {
                    duplicate = true;
                }
            });
            if (duplicate) {
                Swal.fire({
                    title: "알림!",
                    text: "중복된 태그입니다.",
                    confirmButtonColor: "#e53935",
                    icon: "error",
                    confirmButtonText: "확인"
                });
                obj.val('');
                obj.focus();
                return;
            }
            var tag_html = $('#tag-cloud').html();
            tag_html += '<div id="tag_box_'+tag_size+'">'+tag+' <i class="fas fa-times" onclick="del_tags(\''+tag+'\',\''+tag_size+'\');"></i></div>';
            $('#tag-cloud').html(tag_html);

            var add_tags = $('#wr_tag').val();
            if (add_tags) {
                add_tags += ',';
            }
            add_tags += tag;
            $('#wr_tag').val(add_tags);

            tag_size++;
            obj.val('');
            obj.focus();
        }
    }
});

function del_tags(tag, num) {
    var del_tags = $('#del_tag').val();
    if (del_tags) {
        del_tags += ',';
    }
    del_tags += tag;
    $('#del_tag').val(del_tags);
    $('#tag_box_'+num).addClass('blind');
}
<?php } ?>

<?php if ($is_admin) { ?>
$(function() {
    $(".set_bo_skin").change(function() {
        var skin = $(this).val();
        if (!skin) {
            Swal.fire({
                title: "알림",
                text: '스킨을 선택해 주세요.',
                confirmButtonColor: "#e53935",
                icon: "warning",
                confirmButtonText: "확인"
            });
        } else {
            var bo_table = '<?php echo $bo_table; ?>';
            var url = '<?php echo EYOOM_CORE_URL; ?>/board/set_bo_skin.php';
            $.post(url, { bo_table: bo_table, skin: skin }, function() {
                document.location.href = '<?php echo str_replace('&amp;','&', get_pretty_url($bo_table));?>';
            });
        }
    });
});
<?php } ?>
</script>