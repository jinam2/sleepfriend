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

?>

<!-- 회원가입약관 동의 시작 { -->
<div class="social_register">
    
    <form name="fregisterform" id="fregisterform" action="<?php echo $register_action_url; ?>" onsubmit="return fregisterform_submit(this);" method="POST" autocomplete="off">

        <p><i class="fa fa-check-circle" aria-hidden="true"></i> 회원가입약관 및 개인정보 수집 및 이용의 내용에 동의하셔야 회원가입 하실 수 있습니다.</p>

        <section id="fregister_term">
            <h2>회원가입약관</h2>
            <textarea readonly><?php echo get_text($config['cf_stipulation']) ?></textarea>
            <fieldset class="fregister_agree">
                <input type="checkbox" name="agree" value="1" id="agree11" class="selec_chk">
                <label for="agree11"><span></span><b class="sound_only">회원가입약관의 내용에 동의합니다.</b></label>
            </fieldset>
        </section>

        <section id="fregister_private">
            <h2>개인정보 수집 및 이용</h2>
            <div>
                <table>
                    <caption>개인정보 수집 및 이용</caption>
                    <thead>
                        <tr>
                            <th>목적</th>
                            <th>항목</th>
                            <th>보유기간</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>이용자 식별 및 본인여부 확인</td>
                            <td>아이디, 이름, 비밀번호<?php echo ($config['cf_cert_use']) ? ", 생년월일, 휴대폰 번호(본인인증 할 때만, 아이핀 제외), 암호화된 개인식별부호(CI)" : ""; ?></td>
                            <td>회원 탈퇴 시까지</td>
                        </tr>
                        <tr>
                            <td>고객서비스 이용에 관한 통지,<br>CS대응을 위한 이용자 식별</td>
                            <td>연락처 (이메일, 휴대전화번호)</td>
                            <td>회원 탈퇴 시까지</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <fieldset class="fregister_agree">
                <input type="checkbox" name="agree2" value="1" id="agree21" class="selec_chk">
                <label for="agree21"><span></span><b class="sound_only">개인정보 수집 및 이용의 내용에 동의합니다.</b></label>
            </fieldset>
        </section>

        <div id="fregister_chkall" class="chk_all fregister_agree">
            <input type="checkbox" name="chk_all" id="chk_all" class="selec_chk">
            <label for="chk_all"><span></span>회원가입 약관에 모두 동의합니다</label>
        </div>
        <!-- } 회원가입 약관 동의 끝 -->

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

        <div id="register_form" class="form_01">
            <div class="tbl_frm01 tbl_wrap register_form_inner">
                <h2>개인정보 입력</h2>
                <ul>
                    <li>
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
                    </li>

                    <li>
                        <label for="reg_mb_name">
                            이름 (필수)
                        </label>

                        <input type="text" name="mb_name" value="<?php echo isset($user_name) ? get_text($user_name) : ''; ?>" id="reg_mb_name" required class="frm_input required nospace full_input" size="10" maxlength="20" placeholder="이름">
                        <span id="msg_mb_name"></span>
                    </li>

                    <!--li>
                        <label for="mb_sex">
                            성별 (필수)
                        </label>

                        <input type="radio" name="mb_sex" value="M"<?php echo ($user_gender == "male" || $user_gender == "M") ? " checked" : "";?>> 남 &nbsp; &nbsp;
                        <input type="radio" name="mb_sex" value="F"<?php echo ($user_gender == "female" || $user_gender == "F") ? " checked" : "";?>> 여
                    </li-->


                    <?php if ($config['cf_use_hp'] || ($config["cf_cert_use"] && ($config['cf_cert_hp'] || $config['cf_cert_simple']))) {  ?>
                    <li>
                        <label for="reg_mb_nick">
                            휴대폰(필수)
                            <input type="text" name="mb_hp" value="<?php echo get_text($user_phone); ?>" id="reg_mb_hp" required class="frm_input required nospace">
                            <button name="btn_auth_num"  class="address-search-btn">인증번호 받기</button>
                        </label>
                        <?php if ($config['cf_cert_use'] && ($config['cf_cert_hp'] || $config['cf_cert_simple'])) { ?>
                            <input type="hidden" name="old_mb_hp" value="<?php echo get_text($user_phone); ?>">
                        <?php } ?>

                       <div>
                           <label for="auth_num">
                               인증번호
                            <input type="number" name="auth_num" value="" id="auth_num"  size="5" min="10000" max="99999" disabled class="frm_input nospace">
                            <button type="button" name="btn_send_auth_num" class="address-search-btn">인증번호 입력 <span id="expire_timer"></span></button>
                           </label>
                       </div>

                    </li>

                    <?php }  ?>

                    <li>
                        <label for="reg_mb_email">E-mail (필수)

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
                        <input type="hidden" name="old_email" value="<?php echo $member['mb_email'] ?>">
                        <input type="text" name="mb_email" value="<?php echo isset($user_email) ? $user_email : ''; ?>" id="reg_mb_email" required <?php echo (isset($user_email) && $user_email != '' && !$is_exists_email)? "readonly":''; ?> class="frm_input email full_input required" size="70" maxlength="100" placeholder="E-mail">
                        <div class="check"><?php echo $email_msg; ?></div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="btn_confirm">
            <a href="<?php echo G5_URL ?>" class="btn_close">취소</a>
            <button type="submit" id="btn_submit" class="btn_submit" accesskey="s"><?php echo $w == '' ? '회원가입' : '정보수정'; ?></button>
        </div>

    </form>

</div>


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