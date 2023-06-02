<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (!$config['cf_social_login_use']) {     //소셜 로그인을 사용하지 않으면
    return;
}

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.G5_JS_URL.'/remodal/remodal.css">', 11);
add_stylesheet('<link rel="stylesheet" href="'.G5_JS_URL.'/remodal/remodal-default-theme.css">', 12);
add_stylesheet('<link rel="stylesheet" href="'.get_social_skin_url().'/style.css?ver='.G5_CSS_VER.'">', 13);
add_javascript('<script src="'.G5_JS_URL.'/remodal/remodal.js"></script>', 10);
add_javascript('<script src="'.G5_JS_URL.'/jquery.register_form.js"></script>', 14);
add_javascript('<script src="'.G5_JS_URL.'/jquery.countdown.min.js"></script>', 0);
if ($config['cf_cert_use'] && ($config['cf_cert_simple'] || $config['cf_cert_ipin'] || $config['cf_cert_hp']))
    add_javascript('<script src="'.G5_JS_URL.'/certify.js?v='.G5_JS_VER.'"></script>', 15);

$email_msg = $is_exists_email ? '등록할 이메일이 중복되었습니다.다른 이메일을 입력해 주세요.' : ''; 
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/perfect-scrollbar/perfect-scrollbar.min.css" type="text/css" media="screen">',0);


?>

<style>
.member-skin {font-size:.9375rem}
.member-skin  .content-box {position:relative;border:1px solid #b5b5b5;background:#FFF}
.member-skin  .content-box-header {padding:15px;border-bottom:1px solid #E5E5E5;background:#F5F5F5}
.member-skin  .content-box-header h1, .member-skin  .content-box-header h2, .member-skin  .content-box-header h3, .member-skin  .content-box-header h4, .member-skin  .content-box-header h5, .content-box-header h6 {line-height:1;margin:0}
.member-skin  .content-box-body {padding:15px}
.member-skin  .content-box-body p:last-child {margin-bottom:0}
.member-skin  .content-box-footer {padding:10px 15px;border-top:1px solid #E5E5E5;background:#F5F5F5;text-align:right}
.member-skin #register_scroll_1 {position:relative;overflow:hidden;height:250px}
.member-skin #register_scroll_2 {position:relative;overflow:hidden;height:250px}
.member-skin .member-box {border:1px solid #ddd;margin-bottom:30px}
.member-skin .eyoom-form header {padding:20px 15px;background:#fafafa}
.member-skin .eyoom-form header h5 {line-height:1;font-size:1.125rem}
.member-skin .eyoom-form footer {padding:15px;text-align:right}
.member-skin .eyoom-form fieldset {padding:0}
.member-skin .eyoom-form fieldset {padding:0}
.member-skin .member-agree {padding:15px}
.member-skin .member-agree h5 {font-size:.9375rem}
.member-skin .fregister-agree label {display:inline-block;margin-right:5px}
.member-skin #sns_register {border:1px solid #d5d5d5;box-shadow:none;border-radius:0;margin-bottom:30px}
.member-skin #sns_register h2 {margin:0;padding:15px;font-weight:700;background:#fafafa;font-size:.875rem;line-height:1.5}
.member-skin .btn_confirm button {display:block; width:180px; margin:0 auto; height:50px; line-height:48px; padding:0 !important; color:#141751; border:1px solid #141751;  font-size:15px; text-align:center; outline:none; background:#fff; border-radius:5px; font-weight:600; cursor:pointer;}
.member-skin .btn_confirm button:hover {background:#141751; color:#fff;}

#register_form {max-width:1400px; margin:0 auto; padding:0 0 40px;}
#register_form h2 {padding:0 0 20px; color:#333; font-weight:600; border:0;}
#register_form ul {padding:0; border-top:1px solid #141751;}
#register_form ul li {border-bottom:1px solid #d9d9d9; overflow:hidden; padding:12px 0; margin:0;}
#register_form ul li label {float:left; width:220px; line-height:40px; padding:0 0 0 20px; margin:0;}
#register_form ul li label strong {color:#f34747;}
#register_form ul li .input {float:left; width:calc(100% - 220px); padding:0; margin:0;line-height:40px;}
#register_form ul li .input input[type="number"],
#register_form ul li .input input[type="text"],
#register_form ul li .input input[type="password"] {width:100%; border:0; height:40px; line-height:40px; border-radius:5px; font-size:14px; color:#5f5f5f; border:0; padding-left:8px; background:#f6f6f6 !important;}
#register_form ul li .input input[type="radio"] {position:relative; width:20px !important; height:20px !important; display:inline-block; vertical-align:middle; margin:0 4px 0 0; border-radius:40px; padding:0;}
#register_form ul li .input .w30 {width:160px !important; display:inline-block; vertical-align:top; border:1px solid #c1c1c1;}
#register_form ul li:hover input[type="radio"] { border:1px solid #c1c1c1;}
#register_form ul li input[type="radio"]:checked {border:1px solid #141751;}
#register_form ul li input[type="radio"]:checked:before {content:''; position:absolute; width:10px; height:10px; background:#141751; left:4px; top:4px; border-radius:10px;}
#register_form ul li .input .address-search-btn {display:inline-block; min-width:120px; width:auto; margin:0 0 0 5px; height:40px; line-height:40px; padding:0 15px; color:#fff; border:0;  font-size:15px; text-align:center; outline:none; background:#141751; border-radius:5px; font-weight:600; cursor:pointer;}
#register_form ul li .input br {display:none;}

@media all and (max-width:998px) {
	#register_form ul li label {width:130px;}
	#register_form ul li .input {width:calc(100% - 130px); }
}
@media all and (max-width:780px) {
	#register_form ul li .input br {display:block;}
	#register_form ul li br + .w30 {margin-top:6px;}
	#register_form ul li br + .w30 + .address-search-btn {margin-top:6px;}
}
@media all and (max-width:520px) {
	#register_form ul li label {width:100%; padding:0;}
	#register_form ul li .input {width:100%;}
}
</style>

<style>
.page-title-wrap .sub-breadcrumb-wrap {display:none !important;}
.page-title-wrap .inner h2 {display:none;}
.page-title-wrap .inner h2.join {display:block;}
</style>

<div class="page-title-wrap">
	<div class="inner">
		<h2 class="join">회원가입</h2>
	</div>
</div>

<!-- 회원가입약관 동의 시작 { -->
<div class="member-skin contents-box-inner">
    
    <form name="fregister" id="fregister"  action="<?php echo $register_action_url; ?>" onsubmit="return fregisterform_submit(this);" method="POST" autocomplete="off" class="eyoom-form">

    <div class="content-box m-b-30">
        <div class="content-box-body">
            <p class="text-indigo"><i class="fas fa-exclamation-circle"></i> <span>회원가입약관 및 개인정보처리방침안내의 내용에 동의하셔야 회원가입 하실 수 있습니다.</span></p>
        </div>
        <div class="content-box-footer">
            <div class="fregister-agree">
                <label class="checkbox" for="agree_all">
                    <input type="checkbox" name="agree_all" value="1" id="agree_all"><i></i><span>아래 약관 및 안내 내용에 <u class="color-red">모두 동의</u></span>
                </label>
            </div>
        </div>
    </div>

    <section id="fregister_term" class="member-box">
        <header><h5 class="m-0 f-w-700">회원가입약관</h5></header>
        <div class="member-agree">
            <div id="register_scroll_1" class="panel-body ps-container"">
                <?php
                @include_once(EYOOM_THEME_PATH . '/page/provision.html.php')
                ?>
            </div>
        </div>
        <footer>
            <fieldset class="fregister-agree">
                <label class="checkbox" for="agree11">
                    <input type="checkbox" name="agree" value="1" id="agree11"><i></i>회원가입약관의 내용에 동의합니다.
                </label>
            </fieldset>
        </footer>
    </section>

    <section id="fregister_private" class="member-box">
        <header><h5 class="m-0 f-w-700">개인정보처리방침안내</h5></header>
        <div class="member-agree">
            <div id="register_scroll_2" class="panel-body ps-container" style="padding:0 !important">
                <?php
                @include_once(EYOOM_THEME_PATH . '/page/privacy.html.php')
                ?>
            </div>
        </div>
        <footer>
            <fieldset class="fregister-agree">
                <label class="checkbox" for="agree21">
                    <input type="checkbox" name="agree2" value="1" id="agree21"><i></i>개인정보처리방침안내의 내용에 동의합니다.
                </label>
            </fieldset>
        </footer>
    </section>

        <!-- 새로가입 시작 -->
        <input type="hidden" name="w" value="<?php echo $w; ?>">
        <input type="hidden" name="url" value="<?php echo $urlencode; ?>">
        <input type="hidden" name="provider" value="<?php echo $provider_name; ?>">
        <input type="hidden" name="action" value="register">
        <input type="hidden" name="cert_type" value="<?php echo $member['mb_certify']; ?>">
        <input type="hidden" name="cert_no" value="">
        <input type="hidden" name="mb_id" value="<?php echo $user_id; ?>" id="reg_mb_id">
        <input type="hidden" name="hp_auth" value="">
        <input type="hidden" name="hp_auth_ok" value="">
        <input type="hidden" name="hp_auth_token" value="">

        <div id="register_form">

                <h2>개인정보 입력</h2>
                        <?php 
                        if ($config['cf_cert_use']) {
                            if ($config['cf_cert_simple']) {
                                echo '<button type="button" id="win_sa_kakao_cert" class="btn_frmline win_sa_cert" data-type="">간편인증</button>'.PHP_EOL;
                            }
                            if ($config['cf_cert_hp'])
                                echo '<button type="button" id="win_hp_cert" class="btn_frmline">휴대폰 본인확인</button>' . PHP_EOL;
                            if ($config['cf_cert_ipin'])
                                echo '<button type="button" id="win_ipin_cert" class="btn_frmline">아이핀 본인확인</button>' . PHP_EOL;

                            echo '<span class="cert_req">(필수)</span>';
                            echo '<noscript>본인확인을 위해서는 자바스크립트 사용이 가능해야합니다.</noscript>' . PHP_EOL;
                        }
                        ?>
                <ul>
                    <li>
                        <label for="reg_mb_name">
                            이름 <strong>*</strong>
                        </label>
                        <div class="input">
                            <input type="text" name="mb_name" value="<?php echo isset($user_name) ? get_text($user_name) : ''; ?>" id="reg_mb_name" required class="frm_input required nospace full_input" size="10" maxlength="20" placeholder="이름">
                            <span id="msg_mb_name"></span>
                        </div>
                    </li>

                    <li>
                        <label for="mb_sex">
                            성별 <strong>*</strong>
                        </label>
                        <div class="input">
                           <input type="radio" name="mb_sex" value="M"<?php echo ($user_gender == "male" || $user_gender == "M") ? " checked" : "";?>> 남 &nbsp; &nbsp;
                            <input type="radio" name="mb_sex" value="F"<?php echo ($user_gender == "female" || $user_gender == "F") ? " checked" : "";?>> 여
                        </div>
                    </li>


                    <?php if ($config['cf_use_hp'] || ($config["cf_cert_use"] && ($config['cf_cert_hp'] || $config['cf_cert_simple']))) {  ?>
                    <li>
                        <label for="reg_mb_nick">
                            휴대폰 <strong>*</strong>
                        </label>
                        <div class="input">
                            <input type="text" name="mb_hp" value="<?php echo get_text($user_phone); ?>" id="reg_mb_hp" required class="frm_input required nospace w30">
                            <button name="btn_auth_num"  class="address-search-btn">인증번호 받기</button>
                        <?php if ($config['cf_cert_use'] && ($config['cf_cert_hp'] || $config['cf_cert_simple'])) { ?>
                            <input type="hidden" name="old_mb_hp" value="<?php echo get_text($user_phone); ?>">
                        <?php } ?>
<br>
                            <input type="number" name="auth_num" value="" id="auth_num"  size="5" min="10000" max="99999" disabled class="frm_input nospace w30">
                            <button type="button" name="btn_send_auth_num" class="address-search-btn">인증번호 입력 <span id="expire_timer"></span></button>
                       </div>

                    </li>

                    <?php }  ?>

                    <li>
                        <label for="reg_mb_email">E-mail <strong>*</strong>
                            <?php if ($config['cf_use_email_certify']) {  ?>
                                <button type="button" class="tooltip_icon"><i class="fa fa-question-circle-o" aria-hidden="true"></i><span class="sound_only">설명보기</span></button>
                                <span class="tooltip">
                                    <?php if ($w == '') {
                                        echo "E-mail 로 발송된 내용을 확인한 후 인증하셔야 회원가입이 완료됩니다.";
                                    }  ?>
                                    <?php if ($w == 'u') {
                                        echo "E-mail 주소를 변경하시면 다시 인증하셔야 합니다.";
                                    }  ?>
                                </span>
                            <?php }  ?>
                        </label>
                        <div class="input">
                        <input type="hidden" name="old_email" value="<?php echo $member['mb_email'] ?>">
                        <input type="text" name="mb_email" value="<?php echo isset($user_email) ? $user_email : ''; ?>" id="reg_mb_email" required <?php echo (isset($user_email) && $user_email != '' && !$is_exists_email)? "readonly":''; ?> class="frm_input email full_input required" size="70" maxlength="100" placeholder="E-mail">
                        <div class="check"><?php echo $email_msg; ?></div>
                        </div>
                    </li>
                </ul>
        </div>

        <div class="btn_confirm">
            <button type="submit" id="btn_submit" class="btn_submit" accesskey="s"><?php echo $w == '' ? '회원가입' : '정보수정'; ?></button>
        </div>

    </form>

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/perfect-scrollbar/perfect-scrollbar.jquery.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
<script>
$(document).ready(function(){
    new PerfectScrollbar('#register_scroll_1');
    new PerfectScrollbar('#register_scroll_2');
});

function fregister_submit(f) {
    if (!f.agree.checked) {
        Swal.fire({
            title: "중요!",
            text: "회원가입약관의 내용에 동의하셔야 회원가입 하실 수 있습니다.",
            confirmButtonColor: "#e53935",
            icon: "warning",
            confirmButtonText: "확인"
        });
        f.agree.focus();
        return false;
    }
    if (!f.agree2.checked) {
        Swal.fire({
            title: "중요!",
            text: "개인정보처리방침안내의 내용에 동의하셔야 회원가입 하실 수 있습니다.",
            confirmButtonColor: "#e53935",
            icon: "warning",
            confirmButtonText: "확인"
        });
        f.agree2.focus();
        return false;
    }
    return true;
}

$(function(){
    $("#agree_all").click(function(){
        if ($(this).is(':checked')) {
            $("input:checkbox[id='agree11']").prop("checked", true);
            $("input:checkbox[id='agree21']").prop("checked", true);
        } else {
            $("input:checkbox[id='agree11']").prop("checked", false);
            $("input:checkbox[id='agree21']").prop("checked", false);
        }
    });
});
</script>

	<!-- 기존 계정 연결 -->
	<div class="member_connect">
		<p class="strong">혹시 기존 회원이신가요?</p>
		<button type="button" class="connect-opener btn-txt" data-remodal-target="modal">
			기존 계정에 연결하기
			<i class="fa fa-angle-double-right"></i>
		</button>
	</div>

	<div id="sns-link-pnl" class="remodal" data-remodal-id="modal" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
		<button type="button" class="connect-close" data-remodal-action="close">
			<i class="fa fa-close"></i>
			<span class="txt">닫기</span>
		</button>
		<div class="connect-fg">
			<form method="post" action="<?php echo $login_action_url ?>" onsubmit="return social_obj.flogin_submit(this);">
				<input type="hidden" id="url" name="url" value="<?php echo $login_url ?>">
				<input type="hidden" id="provider" name="provider" value="<?php echo $provider_name ?>">
				<input type="hidden" id="action" name="action" value="social_account_linking">

				<div class="connect-title">기존 계정에 연결하기</div>

				<div class="connect-desc">
					기존 아이디에 SNS 아이디를 연결합니다.<br>
					이 후 SNS 아이디로 로그인 하시면 기존 아이디로 로그인 할 수 있습니다.
				</div>

				<div id="login_fs">
					<label for="login_id" class="login_id">아이디 (필수)</label>
					<span class="lg_id"><input type="text" name="mb_id" id="login_id" class="frm_input required" size="20" maxLength="20"></span>
					<label for="login_pw" class="login_pw">비밀번호 (필수)</label>
					<span class="lg_pw"><input type="password" name="mb_password" id="login_pw" class="frm_input required" size="20" maxLength="20"></span>
					<br>
					<input type="submit" value="연결하기" class="login_submit btn_submit">
				</div>

			</form>
		</div>
	</div>

</div>




<script>
    $(function() {
        // 모두선택
        $("input[name=chk_all]").click(function() {
            if ($(this).prop('checked')) {
                $("input[name^=agree]").prop('checked', true);
            } else {
                $("input[name^=agree]").prop("checked", false);
            }
        });

        $("#reg_zip_find").css("display", "inline-block");
        var pageTypeParam = "pageType=register";

        <?php if ($config['cf_cert_use'] && $config['cf_cert_simple']) { ?>
            // 이니시스 간편인증
            var url = "<?php echo G5_INICERT_URL; ?>/ini_request.php";
            var type = "";
            var params = "";
            var request_url = "";
            
            $(".win_sa_cert").click(function() {
                if (!cert_confirm()) return false;
                type = $(this).data("type");
                params = "?directAgency=" + type + "&" + pageTypeParam;
                request_url = url + params;
                call_sa(request_url);
            });
        <?php } ?>
        <?php if ($config['cf_cert_use'] && $config['cf_cert_ipin']) { ?>
            // 아이핀인증
            var params = "";
            $("#win_ipin_cert").click(function() {
                if (!cert_confirm()) return false;
                params = "?" + pageTypeParam;
                var url = "<?php echo G5_OKNAME_URL; ?>/ipin1.php" + params;
                certify_win_open('kcb-ipin', url);
                return;
            });

        <?php } ?>
        <?php if ($config['cf_cert_use'] && $config['cf_cert_hp']) { ?>
            // 휴대폰인증
            var params = "";
            $("#win_hp_cert").click(function() {
                if (!cert_confirm()) return false;
                params = "?" + pageTypeParam;
                <?php
                switch ($config['cf_cert_hp']) {
                    case 'kcb':
                        $cert_url = G5_OKNAME_URL.'/hpcert1.php';
                        $cert_type = 'kcb-hp';
                        break;
                    case 'kcp':
                        $cert_url = G5_KCPCERT_URL.'/kcpcert_form.php';
                        $cert_type = 'kcp-hp';
                        break;
                    case 'lg':
                        $cert_url = G5_LGXPAY_URL.'/AuthOnlyReq.php';
                        $cert_type = 'lg-hp';
                        break;
                    default:
                        echo 'alert("기본환경설정에서 휴대폰 본인확인 설정을 해주십시오");';
                        echo 'return false;';
                        break;
                }
                ?>

                certify_win_open("<?php echo $cert_type; ?>", "<?php echo $cert_url; ?>" + params);
                return;
            });
        <?php } ?>

        //tooltip
        $(document).on("click", ".tooltip_icon", function(e) {
            $(this).next(".tooltip").fadeIn(400).css("display", "inline-block");
        }).on("mouseout", ".tooltip_icon", function(e) {
            $(this).next(".tooltip").fadeOut();
        });
    });

    // submit 최종 폼체크
    function fregisterform_submit(f) {

        if (!f.agree.checked) {
            alert("회원가입약관의 내용에 동의하셔야 회원가입 하실 수 있습니다.");
            f.agree.focus();
            return false;
        }

        if (!f.agree2.checked) {
            alert("개인정보 수집 및 이용의 내용에 동의하셔야 회원가입 하실 수 있습니다.");
            f.agree2.focus();
            return false;
        }

        <?php if ($w == '' && $config['cf_cert_use'] && $config['cf_cert_req']) { ?>
            // 본인확인 체크
            if (f.cert_no.value == "") {
                alert("회원가입을 위해서는 본인확인을 해주셔야 합니다.");
                return false;
            }
        <?php } ?>


        <?php if($w == '' && $config['cf_auth_hp']) { ?>
        // 본인확인 체크
        if(f.hp_auth.value=="") {
            alert('회원가입을 위해서는 휴대폰인증을 해주셔야 합니다.');
            return false;
        }
        <?php } ?>



        // E-mail 검사
        if ((f.w.value == "") || (f.w.value == "u" && f.mb_email.defaultValue != f.mb_email.value)) {
            var msg = reg_mb_email_check();
            if (msg) {
                alert(msg);
                f.reg_mb_email.select();
                return false;
            }
        }

        document.getElementById("btn_submit").disabled = "disabled";

        return true;
    }

    function flogin_submit(f) {
        var mb_id = $.trim($(f).find("input[name=mb_id]").val()),
            mb_password = $.trim($(f).find("input[name=mb_password]").val());

        if (!mb_id || !mb_password) {
            return false;
        }

        return true;
    }
</script>

<script>
    <?php if (($config['cf_use_hp'] || $config['cf_cert_hp']) && $config['cf_req_hp']) { ?>

    $(function() {
        $("button[name=btn_auth_num]").click(function(e) {
            var params = {};

            $thisbtn = $(this);
            // 휴대폰번호 체크
            var msg = reg_mb_hp_check();
            if (msg) {
                alert(msg);
                $("input[name=mb_hp]").focus();
                return false;
            }

            params['mb_hp'] = $("input[name=mb_hp]").val();

            $.ajax({
                url: "/bbs/ajax_send.php",
                type: 'POST',
                cache: false,
                async: false,
                dataType: 'json',
                data: params,
                success: function (response) {
                    if(response['code'] == '200') {

                        $thisbtn.prop('disabled', true);

                        alert(response['message']);

                        $("input[name=hp_auth_token]").val(response['hp_auth_token']);
                        $("input[name=mb_hp]").attr('readonly', true);
                        $("button[name=btn_auth_num]").prop('disabled', true);
                        $("input[name=auth_num]").prop('disabled', false);
                        $("button[name=btn_send_auth_num]").prop('disabled', false);

                        var expire_time = new Date().getTime() + 180 * 1000;
                        $('#expire_timer').countdown(expire_time, {elapse: false})
                            .on('update.countdown', function(event) {
                                var $this = $(this);
                                $this.html(event.strftime('%M:%S'));

                            }).on('finish.countdown', function(event) {
                            var $this = $(this);

                            $this.html(event.strftime('<em>만료</em>'));
                            $("input[name=mb_hp]").attr('readonly', false);
                            $("button[name=btn_auth_num]").prop('disabled', false);
                            $("input[name=auth_num").prop('disabled', true);
                            $("button[name=btn_send_auth_num]").prop('disabled', true);

                            console.log("end!!");
                        });

                    } else {
                        alert(response['message']);
                        return;
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr);
                    alert("인증 오류");
                }
            });
        });

        $("button[name= btn_send_auth_num]").click(function(e) {
            var params = {};

            $thisbtn = $(this);
            // 휴대폰번호 체크
            params['auth_num'] = $("input[name=auth_num]").val();
            params['mb_hp'] = $("input[name=mb_hp]").val();
            params['hp_auth_token'] = $("input[name=hp_auth_token]").val();

            if(params['auth_num'] < 10000 || params['auth_num'] > 99999) {
                alert('5자리 인증번호를 입력하세요.');
                $("input[name=auth_num]").focus();
                return;
            }

            $.ajax({
                url: "/bbs/ajax_check.php",
                type: 'POST',
                cache: false,
                async: false,
                dataType: 'json',
                data: params,
                success: function (response) {
                    if(response['code'] == '200') {
                        $("input[name=hp_auth_token]").val(response['token']);
                        $("input[name=hp_auth]").val("Y");
                        $thisbtn.prop('disabled', true);

                        $('#expire_timer').countdown('stop');

                        $("input[name=mb_hp]").attr('readonly', true);
                        $("button[name=btn_auth_num]").prop('disabled', true);
                        $("input[name=auth_num]").prop('disabled', true);
                        $("button[name=btn_send_auth_num]").prop('disabled', true);
                        $("button[name=btn_send_auth_num]").html("인증완료");

                        var expire_time = new Date().getTime() + 10 * 1000;
                        $('#expire_timer').countdown(expire_time, {elapse: false})
                            .on('update.countdown', function(event) {
                                var $this = $(this);
                                $this.html(event.strftime('%M:%S'));

                            }).on('finish.countdown', function(event) {
                            var $this = $(this);

                            $this.html(event.strftime('<em>만료</em>'));
                            $("input[name=mb_hp]").attr('readonly', false);
                            $("button[name=btn_auth_num]").prop('disabled', false);
                            $("input[name=auth_num").prop('disabled', true);
                            $("button[name=btn_send_auth_num]").prop('disabled', true);

                            console.log("end!!");
                        });

                    } else {
                        alert(response['message']);
                        return;
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr);
                    alert("인증 오류");
                }
            });
        });

    });


    <?php } ?>

</script>

<!-- } 회원정보 입력/수정 끝 -->