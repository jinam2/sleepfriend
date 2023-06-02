<?php
/**
 * skin file : /theme/THEME_NAME/skin/member/basic/register_form.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/sweetalert2/sweetalert2.min.css" type="text/css" media="screen">',0);
add_javascript('<script src="'.G5_JS_URL.'/jquery.register_form.js"></script>', 0);
add_javascript('<script src="'.G5_JS_URL.'/jquery.countdown.min.js"></script>', 0);

if ($config['cf_cert_use'] && ($config['cf_cert_simple'] || $config['cf_cert_ipin'] || $config['cf_cert_hp']))
    add_javascript('<script src="'.G5_JS_URL.'/certify.js?v='.G5_JS_VER.'"></script>', 0);
?>

<script src="<?php echo EYOOM_THEME_URL; ?>/js/zxcvbn.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/js/jquery.password.strength.js"></script>

<style>
    input[type="number"]::-webkit-outer-spin-button,
    input[type="number"]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
    }

    input[type=number] {
        -moz-appearance: textfield;
    }
</style>
<!-- 페이지 타이틀 -->
<div class="page_navi">
    <div><span><a href="/">홈</a></span><span><a href="/mypage/sleep_data.php">마이페이지</a></span><span>나의 정보</span><span>개인정보</span></div>
</div>

<!-- 마이페이지 1차메뉴 오픈 -->
<div id="dropmenu">
    <ul>
        <li><a href="/mypage/sleep_data.php">My 슬립케어</a></li>
        <li><a href="/mypage/reservation.php">예약 내역</a></li>
        <li><a href="/mypage/myinfo.php">나의 정보</a></li>
        <li><a href="/mypage/myorder.php">주문/배송조회</a></li>
    </ul>
</div>

<script>
    $(function() {
        $("#btn_nav a").click(function (e) {
            if($(this).hasClass("open")) {
                $(this).removeClass("open").addClass("close");
                $("#dropmenu").css({"display": "block"});
            } else {
                $(this).removeClass("close").addClass("open");
                $("#dropmenu").css({"display": "none"});
            }
        });
    });
</script>

<div class="page_title">
    <h2 class="wide">개인정보</h2>
    <h2 class="mob">나의 정보 <div id="btn_nav"><a href="javascript:;" class="open"></a></div></h2>
    <div class="menu mob">
        <div>
            <a href="/mypage/myinfo.php" class="active">개인정보</a>
            <a href="/mypage/payinfo.php">결제정보</a>
        </div>
    </div>
</div>

<div id="mypage" class="myinfo1">
    <div class="my_left">
        <ul>
            <li><a href="/mypage/sleep_data.php">My 슬립케어</a></li>
            <li><a href="/mypage/reservation.php">예약 내역</a></li>
            <li class="active"><a href="/mypage/myinfo.php">나의 정보</a>
                <ul>
                    <li class="on"><a href="/mypage/myinfo.php">개인정보</a></li>
                    <li><a href="/mypage/payinfo.php">결제정보</a></li>
                </ul>
            </li>
            <li><a href="/mypage/myorder.php">주문/배송조회</a></li>
        </ul>
    </div>

    <div class="my_right inner">
        <!-- 정보수정 -->
        <h3>회원정보</h3>
        <form name="fregisterform" action="<?php echo $register_action_url; ?>" onsubmit="return fregisterform_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" class="eyoom-form">
        <input type="hidden" name="w" value="<?php echo $w; ?>">
        <input type="hidden" name="url" value="<?php echo $urlencode; ?>">
        <input type="hidden" name="agree" value="<?php echo $agree; ?>">
        <input type="hidden" name="agree2" value="<?php echo $agree2; ?>">
        <input type="hidden" name="cert_type" value="<?php echo $member['mb_certify']; ?>">
        <input type="hidden" name="cert_no" value="">
        <input type="hidden" name="hp_auth" value="">
        <input type="hidden" name="hp_auth_ok" value="">
        <input type="hidden" name="hp_auth_token" value="">
        <ul class="write">
            <li>
                <label>이름</label>
                <p><input type="text" name="mb_name" id="reg_mb_name"  value="<?php echo $member['mb_name']; ?>" required readonly></p>
            </li>

            <li>
                <label>아이디</label>
                <p><input type="text" name="mb_id"  value="<?php echo $member['mb_id']; ?>" id="reg_mb_id" readonly minlength="3" maxlength="20" autocomplete="off"></p>
            </li>

            <li>
                <label>비밀번호</label>
                <p><input class="password" type="password" name="mb_password" id="reg_mb_password" minlength="4" maxlength="20" placeholder="비밀번호를 변경하시는 경우 입력하세요." autocomplete="off"></p>
            </li>
            <li>
                <label>비밀번호 확인 </label>
                <p><input class="password" type="password" name="mb_password_re" id="reg_mb_password_re" minlength="4" maxlength="20"  placeholder="비밀번호를 변경하시는 경우 입력하세요." autocomplete="off"></p>
            </li>
            <?php   //  230530 - jinam23 
                if( G5_MB_SEX_USE_FLAG == 1 ) {   
            ?> 
            <li>
                <label>성별</label>
                <p>
                    <input type="radio" name="mb_sex" value="M"<?php echo ($member['mb_sex'] == "M") ? " checked" : "";?> <?php echo ($member['mb_sex']) ? " onclick='return false;'" : "";?>> 남
                    <input type="radio" name="mb_sex" value="F"<?php echo ($member['mb_sex'] == "F") ? " checked" : "";?> <?php echo ($member['mb_sex']) ? " onclick='return false;'" : "";?>> 여
                </p>
            </li>
            <?php   }   ?>
            <li>
                <label>휴대전화번호</label>
                <p class="hp">
                    <input class="phone" type="text" name="mb_hp" value="<?php echo $member['mb_hp']; ?>" id="reg_mb_hp" <?php if($config['cf_req_hp']) echo "required"; ?> maxlength="20">
                    <button name="btn_auth_num" class="button" style="display: none">인증번호 받기</button>
                </p>

                <input type="hidden" name="old_mb_hp" value="<?php echo $member['mb_hp']; ?>">

            </li>
            <li class="inner_auth_num" style="display: none">
                <label>인증번호</label>
                <p class="auth">
                    <input class="phone" type="text" name="auth_num" value="" id="auth_num" size="5"  disabled>
                    <button class="button" name="btn_send_auth_num">인증번호 입력 <span id="expire_timer"></span></button>
                </p>
            </li>

            <li>
                <label>이메일</label>
                <p class="email">
                    <input type="hidden" name="old_email" value="<?php echo $member['mb_email']; ?>">
                    <input type="text" name="mb_email" value="<?php echo $member['mb_email']; ?>" id="reg_mb_email" required  maxlength="100" class="check">
                </p>
            </li>


        </ul>


        <?php if ($w=='u' && function_exists('social_member_provider_manage')) { ?>
            <!--ul class="list-unstyle">
                <?php echo social_member_provider_manage(); ?>
            </ul-->
        <?php } ?>

        <div class="modify_btn">
            <button class="button" type="submit" value="정보수정" id="btn_submit">정보수정</button>
			<a href="/bbs/member_confirm.php?url=member_leave.php" class="leave">회원탈퇴</a>
        </div>
        </form>

    </div>
</div>

<script>
function fregisterform_submit(f)
{
    if (f.mb_password.value.length > 0) {
        if (f.mb_password_re.value.length < 4) {
            alert('비밀번호를 4글자 이상 입력하십시오.');
            f.mb_password_re.focus();
            return false;
        }
    }

    if (f.mb_password.value != f.mb_password_re.value) {
        alert('비밀번호가 같지 않습니다.');
        f.mb_password_re.focus();
        return false;
    }

    if(f.mb_hp.value != f.old_mb_hp.value) {
        alert('휴대폰 번호는 인증후 변경가능합니다. ');
        return false;
    }

    var msg = reg_mb_email_check();
    if (msg) {
        alert(msg);
        f.reg_mb_email.select();
        return false;
    }

    return;
}

$(function() {
    $("input[name=mb_hp]").keyup(function(key) {
        var old_hp_num = $("input[name=old_mb_hp]").val();
        var hp_num = $("input[name=mb_hp]").val();
        if(old_hp_num != hp_num) {
            $("button[name=btn_auth_num]").css({"display" : ""});
        }
    });


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

                        $(".inner_auth_num").css({"display" : ""});

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

});
</script>
