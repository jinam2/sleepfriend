<?php
/**
 * skin file : /theme/THEME_NAME/skin/member/basic/social_login.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

if( ! $config['cf_social_login_use']) {     //소셜 로그인을 사용하지 않으면
    return;
}

$social_pop_once = false;

$self_url = G5_BBS_URL."/login.php";

//새창을 사용한다면
if( G5_SOCIAL_USE_POPUP ) {
    $self_url = G5_SOCIAL_LOGIN_URL.'/popup.php';
}

add_stylesheet('<link rel="stylesheet" href="'.get_social_skin_url().'/style.css?ver='.G5_CSS_VER.'">', 10);
?>

<style>
#sns_login {margin-top:20px;padding:30px;border:1px solid #141751; border-radius:10px;}
#sns_login h5 {text-align:center;color:#141751;font-size:17px; margin-bottom:20px; font-weight:500;}
#sns_login .social-login {list-style:none;margin:0 -5px;padding:0}
#sns_login .social-login:after {content:"";display:block;clear:both}
#sns_login .social-login li {position:relative;overflow:hidden;float:left;width:50%; padding:0 5px;box-sizing:border-box}
#sns_login .social-login li a {display:block; color:#fff; font-size:15px; font-weight:500; height:44px; line-height:44px; border-radius:5px; text-align:center;}
#sns_login .social-login li a:hover {text-decoration:none}
#sns_login .social-login li img {vertical-align:middle; width:auto;}
#sns_login .social-login li span {margin-left:10px}
#sns_login .social-login li .naver-sl-btn {background:#2db400}
#sns_login .social-login li .kakao-sl-btn {background:#fae100}
#sns_login .social-login li .kakao-sl-btn span {color:#3C1E1D}
#sns_login .social-login li .facebook-sl-btn {background:#5E82D1}
#sns_login .social-login li .google-sl-btn {background:#EA5E4C}
#sns_login .social-login li .twitter-sl-btn {background:#40BFF5}
#sns_login .social-login li .payco-sl-btn {background:#FA2829}

@media (max-width: 500px) {
    #sns_login .social-login {margin:0}
    #sns_login .social-login li {width:100%;padding:0}
    #sns_login .social-login li + li {margin-top:6px;}
}
</style>

<div id="sns_login">
    <h5>SNS 계정으로 로그인하기</h5>
    <ul class="social-login">
        <?php if( social_service_check('naver') ) {     //네이버 로그인을 사용한다면 ?>
        <li><a href="<?php echo $self_url;?>?provider=naver&amp;url=<?php echo $urlencode;?>" class="social_link naver-sl-btn" title="네이버"><img src="/images/sns_naver.png"><span>네이버 로그인</span></a></li>
        <?php }     //end if ?>
        <?php if( social_service_check('kakao') ) {     //카카오 로그인을 사용한다면 ?>
        <li><a href="<?php echo $self_url;?>?provider=kakao&amp;url=<?php echo $urlencode;?>" class="social_link kakao-sl-btn" title="카카오"><img src="/images/sns_kakao.png"><span>카카오 로그인</span></a></li>
        <?php }     //end if ?>
        <?php if( social_service_check('facebook') ) {     //페이스북 로그인을 사용한다면 ?>
        <li><a href="<?php echo $self_url;?>?provider=facebook&amp;url=<?php echo $urlencode;?>" class="social_link facebook-sl-btn" title="페이스북"><img src="<?php echo EYOOM_THEME_URL; ?>/image/social/facebook.png"><span>페이스북 로그인</span></a></li>
        <?php }     //end if ?>
        <?php if( social_service_check('google') ) {     //구글 로그인을 사용한다면 ?>
        <li><a href="<?php echo $self_url;?>?provider=google&amp;url=<?php echo $urlencode;?>" class="social_link google-sl-btn" title="구글"><img src="<?php echo EYOOM_THEME_URL; ?>/image/social/google.png"><span>구글 로그인</span></a></li>
        <?php }     //end if ?>
        <?php if( social_service_check('twitter') ) {     //트위터 로그인을 사용한다면 ?>
        <li><a href="<?php echo $self_url;?>?provider=twitter&amp;url=<?php echo $urlencode;?>" class="social_link twitter-sl-btn" title="트위터"><img src="<?php echo EYOOM_THEME_URL; ?>/image/social/twitter.png"><span>트위터 로그인</span></a></li>
        <?php }     //end if ?>
        <?php if( social_service_check('payco') ) {     //페이코 로그인을 사용한다면 ?>
        <li><a href="<?php echo $self_url;?>?provider=payco&amp;url=<?php echo $urlencode;?>" class="social_link payco-sl-btn" title="페이코"><img src="<?php echo EYOOM_THEME_URL; ?>/image/social/payco.png"><span>페이코 로그인</span></a></li>
        <?php }     //end if ?>
    </ul>

    <?php if( G5_SOCIAL_USE_POPUP && !$social_pop_once ){
    $social_pop_once = true;
    ?>
    <script>
        jQuery(function($){
            $(".social-login").on("click", "a.social_link", function(e){
                e.preventDefault();

                var pop_url = $(this).attr("href");
                var newWin = window.open(
                    pop_url,
                    "social_sing_on",
                    "location=0,status=0,scrollbars=1,width=600,height=500"
                );

                if(!newWin || newWin.closed || typeof newWin.closed=='undefined')
                     alert('브라우저에서 팝업이 차단되어 있습니다. 팝업 활성화 후 다시 시도해 주세요.');

                return false;
            });
        });
    </script>
    <?php } ?>
</div>