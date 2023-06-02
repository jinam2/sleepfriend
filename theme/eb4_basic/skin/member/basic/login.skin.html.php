<?php
/**
 * skin file : /theme/THEME_NAME/skin/member/basic/login.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/perfect-scrollbar/perfect-scrollbar.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/sweetalert2/sweetalert2.min.css" type="text/css" media="screen">',0);
?>




<style>
.eb-login {max-width:1400px; margin:0 auto;}
.eb-login .login-btn {text-align:center;position:relative;overflow:hidden;width:100%;padding:0 0 0 120px;}
.eb-login .login-btn .btn-e-lg {display:block; width:100%; height:44px; line-height:42px; padding:0; color:#141751; border:1px solid #141751;  font-size:15px; text-align:center; outline:none; background:#fff; border-radius:5px; font-weight:600; cursor:pointer;}
.eb-login .login-btn .btn-e-lg:hover {background:#141751; color:#fff;}

.login-box .login-box-in {width:600px; padding:40px 60px 30px; border:1px solid #141751; border-radius:10px; margin:0 auto;}
.login-box .login-box-in .login-form-margin-bottom {margin-bottom:20px}
.login-box .login-box-in .login-form h1 {font-size:30px;font-weight:700;text-align:center;margin:0 0 30px}
.login-box .login-box-in a {color:#141751;}
.login-box .login-box-in a:hover {color:#333;}
.login-box .login-box-in .login-form section {overflow:hidden; width:100%; padding:0; margin:0 0 12px;}
.login-box .login-box-in .login-form .label {float:left; width:120px; line-height:40px; padding:0; margin:0;}
.login-box .login-box-in .login-form .input {float:left; width:calc(100% - 120px); padding:0; margin:0;}
.login-box .login-box-in .login-form .input input {width:100% !important; border:0 !important; height:40px; line-height:40px; border-radius:5px; font-size:14px; color:#5f5f5f; border:0; padding-left:8px; background:#f6f6f6 !important;}
.login-box .login-box-in .login-form .checkbox {margin-left:120px;}
.login-box .login-box-in .login-link {text-align:right}
.login-box .login-box-in .login-link a {text-decoration:underline; font-size:14ppx; color:#141751; font-weight:500;}
.login-box .login-box-in .login-link a + a {margin-left:14px;}
.login-box .login-box-in #sns_login h5 {text-align:center;color:#353535;font-size:.9375rem;margin-bottom:15px}
.login-box .login-box-in .non-members {}
.login-box .login-box-in .non-members .scroll-box-login {position:relative;overflow:hidden;border:1px solid #b5b5b5;padding:10px;height:150px}
.login-box .login-box-in .non-member-order {}
.eyoom-form .btn-e {box-sizing:border-box;-moz-box-sizing:border-box}

@media (max-width: 767px) {
	.login-box {width:100%; padding:0 40px;}
	.login-box .login-box-in {width:100%; padding:30px 40px 20px;}
    .login-box .login-box-in {height:auto}
    .login-box .login-box-in .login-form {}
    .login-box .login-box-in .login-form h1 {font-size:24px}
}
@media (max-width: 576px) {
	.login-box {padding:0 20px;}
	.login-box .login-box-in {width:100%}
	.login-box .login-box-in .login-form .label {width:90px;}
	.login-box .login-box-in .login-form .input {width:calc(100% - 90px);}
	.eb-login .login-btn {padding:0 0 0 90px;}
	.login-box .login-box-in .login-form .checkbox {margin-left:90px;}
}
@media (max-width: 480px) {
	.login-box .login-box-in {padding:30px 20px 20px;}
	.login-box .login-box-in .login-form .label {width:76px;}
	.login-box .login-box-in .login-form .input {width:calc(100% - 76px);}
	.eb-login .login-btn {padding:0 0 0 76px;}
	.login-box .login-box-in .login-form .checkbox {margin-left:76px;}
}
</style>


<div class="eb-login">
    <div class="login-content">
        <div class="login-box">
            <div class="login-box-in">
                <div class="login-form">
                    <h1>로그인</h1>
                    <form name="flogin" action="<?php echo $login_action_url;?>" onsubmit="return flogin_submit(this);" method="post" class="eyoom-form">
                    <input type="hidden" name="url" value='<?php echo $login_url; ?>'>
                    <section>
                        <label class="label">아이디</label>
                        <label class="input">
                            <input type="text" name="mb_id" placeholder="아이디를 입력해주세요" required class="required" size="20" maxLength="20">
                        </label>
                    </section>

                    <section>
                        <label class="label">비밀번호</label>
                        <label class="input">
                            <input type="password" id="mb_password" name="mb_password" placeholder="비밀번호를 입력해주세요" required class="required" size="20" maxLength="20">
                        </label>
                    </section>

                    <label class="checkbox">
                        <input type="checkbox" name="auto_login" id="login_auto_login"><i></i>자동로그인
                    </label>

                    <div class="m-b-20"></div>

                    <div class="login-btn">
                        <button type="submit" value="로그인" class="btn-e-lg">로그인</button>
                    </div>

                    <div class="m-b-20"></div>

                    <div class="login-link m-b-10">
                        <a href="<?php echo G5_BBS_URL; ?>/register.php">회원가입</a>
                        <a href="<?php echo G5_BBS_URL; ?>/password_lost.php">아이디/비밀번호찾기</a>
                    </div>


                    </form>
                </div>
            </div>

                    <?php
                    //  230530 edited by jinam23 , 앱 심사위해서 임시 주석처리.
                    // 소셜로그인 사용시 소셜로그인 버튼
                    // @include_once($eyoom_skin_path['member'].'/social_login.skin.html.php');
                    ?>

                    <div class="text-center m-t-30">
                        <a href="<?php echo G5_URL; ?>">메인으로 돌아가기</a>
                    </div>

            <?php /* 쇼핑몰 비회원 구매 시작 */ ?>
            <?php if ($default['de_level_sell'] == 1) { ///#1) ?>

            <?php if (preg_match('/orderform.php/',$url)) { ///#2) ?>
            <div class="m-b-30"></div>
            <div class="login-box-in">
                <div class="non-members">
                    <div class="text-center m-b-30"><h4><strong>비회원 구매</strong></h4></div>
                    <div class="cont-text-bg m-b-20">
                        <p class="bg-info f-s-13r" style="border-radius:5px;"><i class="fas fa-exclamation-circle"></i> 비회원으로 주문하시는 경우 포인트는 지급하지 않습니다.</p>
                    </div>

                    <div id="scrollbar" class="scroll-box-login m-b-10">
                        <!--?php echo $default['de_guest_privacy'];?-->
						<div style="font-size:13px; color:#666; line-height:150%;">
						(주)슬립프렌드는(이하 "회사"는) 고객님의 개인정보를 중요시하며, "개인정보 보호법" 등 관련 법령을 준수하고 있습니다.<br>
						회사는 개인정보처리방침을 통하여 고객님께서 제공하시는 개인정보가 어떠한 용도와 방식으로 이용되고 있으며, 개인정보보호를 위해 어떠한 조치가 취해지고 있는지 알려드립니다.<br><br>

						<h5 style="font-size:14px; margin:0 0 10px;">■ 수집하는 개인정보 항목 및 수집방법</h5>
						<strong>수집하는 개인정보 항목 </strong><br>
						o 회사는 웹사이트 및 앱 이용을 위해 아래와 같은 개인정보를 수집하고 있습니다.<br>
						회원가입시 : 이름 , 생년월일 , 성별 , 로그인ID , 비밀번호 , 자택 전화번호 , 휴대폰 번호 , 이메일 , 14세미만 가입자의 경우 법정대리인의 정보<br><br>

						<div style="padding:10px; border:1px solid #eaeaea; background:#f7f7f7;">
							<strong>네이버 간편회원 가입 시</strong><br>
							 [필수항목] 이용자 고유 식별자, 이름, 이메일<br>
							 [선택항목] 성별, 생일, 연령대, 연계정보(CI), 프로필사진, 별명<br><br>

							<strong>카카오 간편회원 가입 시</strong><br>
							 [필수항목] 프로필 정보(닉네임/프로필 사진), 성별, 연계정보(CI), 카카오계정(전화번호), 출생 연도, 플러스친구 추가 상태 및 내역, 생일<br>
							 [선택항목] 카카오계정(이메일), 연령대
						 </div><br>

						서비스 이용 시: 주소 및 결제 정보(신용카드 번호, 유효기간, 소유주 성명)<br><br>

						o 회사는 슬립프렌드의 상품 및 서비스 이용을 위해 아래와 같은 개인정보를 수집하고 있습니다.<br>
						상품의 렌탈∙이용 및 에어뷰 서비스 이용 시: 성명, 생년월일, 성별, 주소, 이메일, 전화번호, 결제 정보(은행명, 계좌번호, 예금주명, 신용카드 소유주 성명, 신용카드 유효기간 등), 상담∙구매∙수리 내역 정보, 고객의 건강정보(수면 정보, 산소 포화도, 기기 이용 시간, 마스크 데이터, 유출 데이터, 압력값 등), 기타 고객이 제공한 정보 <br><br>

						o 회사는 연구 수행 및 컨퍼런스, 기타 교육 행사 개최 등을 위해 아래와 같은 개인정보를 수집하고 있습니다.<br>
						연구 참여 시 : 성명, 생년월일, 성별, 주소, 전화번호, 의료전문가 정보, 신원 및 배경정보, 사진, 사용 상품 및 서비스에 대한 정보, 기타 고객이 제공하는 정보 <br>
						컨퍼런스 및 교육 행사 등 참여 시: 성명, 생년월일, 사업자명, 주소, 이메일, 전화번호, 기타 고객이 제공한 정보 <br><br>

						o 회사는 채용 시 아래와 같은 개인정보를 수집하고 있습니다.<br>
						채용 지원 시 : 성명, 성별, 국적, 전화번호, 주소, 이메일, 해당 국가 내에서 근로 가능 여부, 직무 수행 경험 및 기타 경력, 기타 개인이 제공한 정보<br><br>

						o 서비스 이용 과정이나 사업 처리 과정에서 서비스이용기록, 접속로그, 쿠키, 접속 IP, 결제 기록, 불량이용 기록이 생성되어 수집될 수 있습니다.<br><br>
						 
						<strong>수집방법 </strong><br>
						홈페이지, 서면양식, 게시판, 이메일, 이벤트 응모, 배송요청, 전화, 팩스, 생성 정보 수집 툴을 통한 수집<br><br>


						<h5 style="font-size:14px; margin:0 0 10px;">■ 개인정보의 수집 및 이용목적</h5>
						회사는 수집한 개인정보를 다음의 목적을 위해 활용합니다.<br><br>

						o 상품 및 서비스 제공에 관한 계약 이행 및 요금정산 : 상품 및 서비스 제공(기술적 지원, 수면 관리, 연간 점검) , 구매 및 요금 결제 , 물품배송 또는 청구지 등으로의 발송 , 금융거래 본인 인증 및 금융 서비스<br><br>
						o 회원 가입 및 관리 : 회원제 서비스 이용에 따른 본인확인, 개인 식별, 불량회원의 부정 이용 방지와 비인가 사용 방지, 가입 의사 확인, 연령확인, 만14세 미만 아동 개인정보 수집 시 법정 대리인 동의여부 확인, 불만처리 등 민원처리, 고지사항 전달<br><br>
						o 연구 및 분석 : 통계적 분석, 설문조사, 연구, 분석, 상품 및 서비스 개선<br><br>
						o 마케팅 및 광고에 활용 : 이벤트 등 광고성 정보 전달, 뉴스레터 발송, 접속 빈도 파악 또는 회원의 서비스 이용에 대한 통계<br><br>
						o 채용절차 활용 : 지원자 평가, 레퍼런스 확인, 지원자에 대한 통보<br><br>
						o 법률상 의무 이행 : 법률상 의무 이행, 법률상 소송 대응<br><br>


						<h5 style="font-size:14px; margin:0 0 10px;">■ 개인정보의 보유 및 이용기간</h5>
						회사는 회원 탈퇴시 또는 목적 달성 시까지 개인정보를 처리∙보유합니다. 단, 다음의 정보에 대해서는 아래의 이유로 명시한 기간 동안 보존합니다.<br><br>

						<strong>가. 회사 내부방침에 의한 정보보유 사유</strong><br>
						회원이 탈퇴한 경우에도 불량회원의 부정한 이용의 재발을 방지, 분쟁해결 및 수사기관의 요청에 따른 협조를 위하여, 이용계약 해지일로부터 1년간 회원의 정보를 보유할 수 있습니다.<br><br>

						<strong>나. 관련 법령에 의한 정보 보유 사유</strong><br>
						전자상거래등에서의소비자보호에관한법률 등 관계법령의 규정에 의하여 보존할 필요가 있는 경우 회사는 아래와 같이 관계법령에서 정한 일정한 기간 동안 회원정보를 보관합니다.<br><br>

						o 계약 또는 청약철회 등에 관한 기록<br>
						-보존이유 : 전자상거래등에서의소비자보호에관한법률<br>
						-보존기간 : 5년<br><br>

						o 대금 결제 및 재화 등의 공급에 관한 기록<br>
						-보존이유: 전자상거래등에서의소비자보호에관한법률<br>
						-보존기간 : 5년 <br><br>

						o 소비자 불만 또는 분쟁처리에 관한 기록<br>
						-보존이유 : 전자상거래등에서의소비자보호에관한법률<br>
						-보존기간 : 3년 <br><br>

						o 로그 기록 <br>
						-보존이유: 통신비밀보호법<br>
						-보존기간 : 3개월 <br>

						<h5 style="font-size:14px; margin:0 0 10px;">■ 개인정보의 파기절차 및 방법</h5>
						회사는 원칙적으로 개인정보 수집 및 이용목적이 달성된 후에는 해당 정보를 지체없이 파기합니다. 파기절차 및 방법은 다음과 같습니다.<br><br>

						<strong>[파기절차]</strong><br>
						회원님이 회원가입 등을 위해 입력하신 정보는 목적이 달성된 후 별도의 DB로 옮겨져(종이의 경우 별도의 서류함) 내부 방침 및 기타 관련 법령에 의한 정보보호 사유에 따라(보유 및 이용기간 참조) 일정 기간 저장된 후 파기되어 집니다. 별도 DB로 옮겨진 개인정보는 법률에 의한 경우가 아니고서는 수집 목적 이외의 다른 목적으로 이용되지 않습니다.<br><br>

						<strong>[파기방법]</strong><br>
						전자적 파일형태로 저장된 개인정보는 기록을 재생할 수 없는 기술적 방법을 사용하여 삭제합니다.<br><br>


						<h5 style="font-size:14px; margin:0 0 10px;">■ 개인정보 제공</h5>
						회사는 이용자의 개인정보를 원칙적으로 외부에 제공하지 않습니다. 다만, 아래의 경우에는 예외로 합니다.<br><br>

						o 이용자들이 사전에 동의한 경우<br>
						o 법령의 규정에 의거하거나, 수사 목적으로 법령에 정해진 절차와 방법에 따라 수사기관의 요구가 있는 경우<br><br>


						<h5 style="font-size:14px; margin:0 0 10px;">■ 이용자 및 법정 대리인의 권리와 그 행사 방법</h5>
						o 이용자는 언제든지 등록되어 있는 자신의 개인정보를 조회하거나 수정할 수 있으며 가입 해지를 요청할 수도 있습니다.<br><br>
						o 이용자들의 개인정보 조회, 수정을 위해서는 "개인정보변경"(또는 "회원정보수정" 등)을 가입해지(동의철회)를 위해서는 "회원탈퇴"를 클릭하여 본인 확인 절차를 거치신 후 직접 열람, 정정 또는 탈퇴가 가능합니다.<br><br>
						o 혹은 개인정보보호책임자에게 서면, 전화 또는 이메일로 연락하시면 지체없이 조치하겠습니다.<br><br>
						o 만 14세 미만 아동의 경우에는 법정대리인이 아동의 개인정보를 조회하거나 수정 및 가입해지를 요청할 권리를 가집니다. <br><br>
						o 귀하가 개인정보의 오류에 대한 정정을 요청하신 경우에는 정정을 완료하기 전까지 당해 개인정보를 이용 또는 제공하지 않습니다. 또한 잘못된 개인정보를 제3자에게 이미 제공한 경우에는 정정 처리결과를 제3자에게 지체없이 통지하여 정정이 이루어지도록 하겠습니다.<br><br>
						o 회사는 이용자의 요청에 의해 해지 또는 삭제된 개인정보는 "회사가 수집하는 개인정보의 보유 및 이용기간"에 명시된 바에 따라 처리하고 그 외의 용도로 열람 또는 이용할 수 없도록 처리하고 있습니다.<br><br>


						<h5 style="font-size:14px; margin:0 0 10px;">■ 개인정보의 안정성 확보조치에 관한 사항</h5>
						회사는 개인정보의 안전성 확보를 위해 다음과 같은 조치를 취하고 있습니다.<br>
						1. 관리적 조치: 내부관리계획 수립·시행, 정기적 직원 교육 등<br>
						2. 기술적 조치: 개인정보처리시스템 등의 접근권한 관리, 접근통제시스템 설치, 고유식별정보 등의 암호화, 보안프로그램 설치<br>
						3. 물리적 조치: 전산실, 자료보관실 등의 접근통제<br><br>


						<h5 style="font-size:14px; margin:0 0 10px;">■ 개인정보 자동수집 장치의 설치, 운영 및 그 거부에 관한 사항</h5>
						회사는 귀하의 정보를 수시로 저장하고 찾아내는 "쿠키(cookie)" 등을 운용합니다. 쿠키란 웹사이트를 운영하는데 이용되는 서버가 귀하의 브라우저에 보내는 아주 작은 텍스트 파일로서 귀하의 컴퓨터 하드디스크에 저장됩니다.<br>
						회사은(는) 다음과 같은 목적을 위해 쿠키를 사용합니다.<br><br>

						<strong>[쿠키 등 사용 목적]</strong><br>
						1. 회원과 비회원의 접속 빈도나 방문 시간 등을 분석, 이용자의 취향과 관심분야를 파악 및 자취 추적, 각종 이벤트 참여 정도 및 방문 회수 파악 등을 통한 타겟 마케팅 및 개인 맞춤 서비스 제공<br>
						2. 귀하는 쿠키 설치에 대한 선택권을 가지고 있습니다. 따라서, 귀하는 웹브라우저에서 옵션을 설정함으로써 모든 쿠키를 허용하거나, 쿠키가 저장될 때마다 확인을 거치거나, 아니면 모든 쿠키의 저장을 거부할 수도 있습니다.<br><br>

						<strong>[쿠키 설정 거부 방법]</strong><br>
						1. 쿠키 설정을 거부하는 방법으로는 회원님이 사용하시는 웹 브라우저의 옵션을 선택함으로써 모든 쿠키를 허용하거나 쿠키를 저장할 때마다 확인을 거치거나, 모든 쿠키의 저장을 거부할 수 있습니다.<br>
						2. 설정방법 예(인터넷 익스플로어의 경우) : 웹 브라우저 상단의 도구 > 인터넷 옵션 > 개인정보<br>
						3. 단, 귀하께서 쿠키 설치를 거부하였을 경우 서비스 제공에 어려움이 있을 수 있습니다.<br><br>


						<h5 style="font-size:14px; margin:0 0 10px;">■ 개인정보에 관한 민원서비스</h5>
						회사는 고객의 개인정보를 보호하고 개인정보와 관련한 불만을 처리하기 위하여 아래와 같이 관련 부서 및 개인정보보호책임자를 지정하고 있습니다.<br><br>

						<div style="padding:10px; border:1px solid #eaeaea; background:#f7f7f7;">
							<strong>[개인정보보호책임자]</strong><br>
							성명 : 김민재<br>
							직급 : 대표<br>
							전화번호 : 1670-3171<br>
							이메일 : <a href="mailto:mj.kim@medihomes.net">mj.kim@medihomes.net</a>
						</div>
						</div><br>
                    </div>

                    <div class="eyoom-form">
                        <label class="checkbox" for="agree">
                            <input type="checkbox" id="agree" value="1"><i></i><span class="f-s-12">개인정보수집에 대한 내용을 읽었으며 이에 동의합니다.</span>
                        </label>
                    </div>

                    <div class="login-btn m-t-15 text-center" style="padding:0;">
                        <a href="javascript:guest_submit(document.flogin);" class="btn-e-lg">비회원으로 구매하기</a>
                    </div>

                    <script>
                    function guest_submit(f) {
                        if (document.getElementById('agree')) {
                            if (!document.getElementById('agree').checked) {
                                Swal.fire({
                                    title: "중요!",
                                    text: "개인정보수집에 대한 내용을 읽고 이에 동의하셔야 합니다.",
                                    confirmButtonColor: "#FF2900",
                                    type: "error",
                                    confirmButtonText: "확인"
                                });
                                return;
                            }
                        }

                        f.url.value = "<?php echo $url;?>";
                        f.action = "<?php echo $url;?>";
                        f.submit();
                    }
                    </script>
                </div>
            </div>
            <?php } else if (preg_match('/orderinquiry.php$/',$url)) { ///#2 ?>
            <div class="m-b-30"></div>
            <div class="login-box-in">
                <div class="non-member-order">
                    <div class="text-center m-b-30"><h4><strong>비회원 주문조회</strong></h4></div>
                    <form name="forderinquiry" method="post" action="<?php echo urldecode($url); ?>" autocomplete="off" class="eyoom-form">
                    <section>
                        <label for="od_id" class="label">주문서번호<strong class="sound_only"> 필수</strong></label>
                        <label class="input">
                            <i class="icon-append fas fa-shopping-cart"></i>
                            <input type="text" class="form-control" placeholder="Order Number" name="od_id" value="<?php echo $od_id;?>" id="od_id" required size="20">
                        </label>
                    </section>
                    <div class="login-form-margin-bottom"></div>
                    <section>
                        <label for="id_pwd" class="label">비밀번호<strong class="sound_only"> 필수</strong></label>
                        <label class="input">
                            <i class="icon-append fas fa-lock"></i>
                            <input type="password" class="form-control" placeholder="Password" name="od_pwd" size="20" id="od_pwd" required>
                        </label>
                    </section>
                    <div class="login-form-margin-bottom"></div>
                    <div class="login-btn m-b-20">
                        <input class="btn-e btn-e-dark btn-e-lg btn-block" type="submit" value="확인">
                    </div>
                    </form>
                    <div class="cont-text-bg m-b-20">
                        <p class="bg-danger f-s-13r">
                            <strong class="text-black"><i class="fas fa-exclamation-circle"></i> 비회원 주문조회 안내</strong><br>
                            메일로 발송해드린 주문서의 <strong>주문번호</strong> 및 주문 시 입력하신 <strong>비밀번호</strong>를 정확히 입력해주십시오.
                        </p>
                    </div>
                </div>
            </div>
            <?php } //#2 ?>

            <?php } //#1 ?>
            <?php /* 쇼핑몰 비회원 구매 끝 */ ?>
        </div>
    </div>
</div>

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/perfect-scrollbar/perfect-scrollbar.jquery.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
<script>
jQuery.fn.center = function () {
    this.css("position","absolute");
    this.css("top", Math.max(0, (($(window).height() - $(this).outerHeight()) / 2) + $(window).scrollTop()) + "px");
    this.css("left", Math.max(0, (($(window).width() - $(this).outerWidth()) / 2) + $(window).scrollLeft()) + "px");
    return this;
}
$('.login-box').center();

<?php if (preg_match('/orderform.php/',$url)) { ///#2) ?>
$(document).ready(function(){
    new PerfectScrollbar('#scrollbar');
});
<?php } ?>

$(document).ready(function(){
    $("input, textarea, select").on({ 'touchstart' : function() {
        zoomDisable();
    }});
    $("input, textarea, select").on({ 'touchend' : function() {
        setTimeout(zoomEnable, 500);
    }});
    function zoomDisable(){
        $('head meta[name=viewport]').remove();
        $('head').prepend('<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">');
    }
    function zoomEnable(){
        $('head meta[name=viewport]').remove();
        $('head').prepend('<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=1">');
    }
});

document.querySelectorAll('[data-toggle="password"]').forEach(function (el) {
    el.addEventListener("click", function (e) {
        e.preventDefault();

        var target = el.dataset.target;
        document.querySelector(target).focus();

        if (document.querySelector(target).getAttribute('type') == 'password') {
            document.querySelector(target).setAttribute('type', 'text');
        } else {
            document.querySelector(target).setAttribute('type', 'password');
        }

        if (el.dataset.classActive) el.classList.toggle(el.dataset.classActive);
    });
});

jQuery(function($){
    $("#login_auto_login").click(function(){
        if ($(this).is(":checked")) {
            Swal.fire({
                title: "알림",
                html: "<div class='alert alert-info text-start f-s-13r'>자동로그인을 사용하시면 다음부터 회원아이디와 비밀번호를 입력하실 필요가 없습니다.<br><br>공공장소에서는 개인정보가 유출될 수 있으니 사용을 자제하여 주십시오.</div><span>자동로그인을 사용하시겠습니까?</span>",
                icon: "info",
                showCancelButton: true,
                confirmButtonColor: "#e53935",
                confirmButtonText: "확인",
                cancelButtonText: "취소"
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#login_auto_login").attr("checked");
                } else {
                    $("#login_auto_login").removeAttr("checked");
                }
            });
        }
    });
});

function flogin_submit(f) {
    if( $( document.body ).triggerHandler( 'login_sumit', [f, 'flogin'] ) !== false ){
        return true;
    }
    return false;
}
</script>