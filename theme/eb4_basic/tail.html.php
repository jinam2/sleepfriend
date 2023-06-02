<?php
/**
 * theme file : /theme/THEME_NAME/tail.html.php
 */
if (!defined('_EYOOM_')) exit;

//if(strpos(strtolower($g5['lo_url']), "/mypage/") == 0 ) {
//    //todo 특정 페이지만 include 변경
//    if(in_array($g5['page_name'], $mypage_target_pages)) {
//        include_once __DIR__."/tail.html_mypage.php";
//        return;
//    }
//}
?>

<?php if (!$wmode) { ?>

		<?php if($bo_table) { ?>
			</div>
		<? } ?> 

        </main>


	</div><?php /* End .basic-body */ ?>

	<?php /*----- footer 시작 -----*/ ?>
	<footer class="footer">
		<div class="container">

			<div class="footer_logo"><img src="/images/footer_logo.png"></div>

			<div class="footer-cont-info wide">
				<p class="cs">고객센터 안내 : <?php echo $bizinfo['bi_cs_tel1']; ?><span class="info-divider">/</span>
				운영시간 : <?php echo $bizinfo['bi_cs_time']; ?><span class="info-divider">/</span>
				무통장입금계좌 : 기업은행 986-027444-04-020 (슬립프렌드)
				</p>

				<p class="info">
				<?php echo $bizinfo['bi_company_name']; ?> &nbsp;  &nbsp; 
				대표.  <?php echo $bizinfo['bi_company_ceo']; ?> &nbsp;  &nbsp; 
				사업자등록번호. <?php echo $bizinfo['bi_company_bizno']; ?><br>
				통신판매업신고번호. <?php echo $bizinfo['bi_company_sellno']; ?> &nbsp;  &nbsp; 
				의료기기판매업신고번호. 제2021-3220033-00606호 &nbsp;  &nbsp; 
				<!--TEL. <?php echo $bizinfo['bi_cs_tel1']; ?>-->
				개인정보관리책임자. <?php echo $bizinfo['bi_company_infoman']; ?> &nbsp;  &nbsp; 
				주소.  <?php echo $bizinfo['bi_company_zip']; ?>  <?php echo $bizinfo['bi_company_addr1']; ?> <?php echo $bizinfo['bi_company_addr2']; ?><br>

				CONTACT FOR MORE INFORMATION. COPYRIGHT &copy; <?php echo $config['cf_title']; ?>. ALL RIGHTS RESERVED.
				</p>

				<p class="service">고객님의 안전한 결제를 위해 저희 쇼핑몰에서 가입한 PG사의 구매안전 에스크로 서비스를 이용하실 수 있습니다.</p>

				<p class="footer-nav">
					<a href="<?php echo get_eyoom_pretty_url('page','brand'); ?>">회사소개</a>
					<a href="<?php echo get_eyoom_pretty_url('page','provision'); ?>">이용약관</a>
					<a href="<?php echo get_eyoom_pretty_url('page','privacy'); ?>">개인정보처리취급방침</a>
					<a href="<?php echo get_eyoom_pretty_url('page','guide'); ?>">이용안내</a>
				</p>
			</div>

			<script>
			function boxOpen() {
				document.getElementById('con_copy').style.display = "block";
				document.getElementById('btn_copy').innerHTML="<a href='javascript:boxClose();'><img src='/images/copy_arrow_up.png'></a>";
			 }
			function boxClose() {
				document.getElementById('con_copy').style.display = "none";
				document.getElementById('btn_copy').innerHTML="<a href='javascript:boxOpen();'><img src='/images/copy_arrow_down.png'></a>";
			 }
			</script>

			<div class="footer-cont-info mob">
				<p class="cs">고객센터 안내 : <?php echo $bizinfo['bi_cs_tel1']; ?><br>
				운영시간 : <?php echo $bizinfo['bi_cs_time']; ?><br>
				무통장입금계좌 : 기업은행 986-027444-04-020 (슬립프렌드)
				</p>

				<p class="copyright">
					CONTACT FOR MORE INFORMATION. <span id="btn_copy"><a href="javascript:boxOpen();"><img src="/images/copy_arrow_down.png"></a></span>
				</p>

				<div id="con_copy">
					<p class="info">
					<?php echo $bizinfo['bi_company_name']; ?><br>
					대표.  <?php echo $bizinfo['bi_company_ceo']; ?><br>
					사업자등록번호. [<?php echo $bizinfo['bi_company_bizno']; ?>] <br>
					통신판매업신고번호. <?php echo $bizinfo['bi_company_sellno']; ?><br>
					의료기기판매업신고번호. 제2021-3220033-00606호<br>
					개인정보관리책임자. <?php echo $bizinfo['bi_company_infoman']; ?><br>
					주소. <?php echo $bizinfo['bi_company_zip']; ?>  <?php echo $bizinfo['bi_company_addr1']; ?> <?php echo $bizinfo['bi_company_addr2']; ?><br>
					COPYRIGHT &copy; <?php echo $config['cf_title']; ?>. ALL RIGHTS RESERVED.
					</p>

					<p class="service">고객님의 안전한 결제를 위해 저희 쇼핑몰에서 가입한 PG사의 구매안전 에스크로 서비스를 이용하실 수 있습니다..</p>
				</div>
				<p class="footer-nav">
					<a href="<?php echo get_eyoom_pretty_url('page','company'); ?>">회사소개</a>
					<a href="<?php echo get_eyoom_pretty_url('page','provision'); ?>">이용약관</a>
					<a href="<?php echo get_eyoom_pretty_url('page','privacy'); ?>">개인정보처리취급방침</a>
					<a href="<?php echo get_eyoom_pretty_url('page','guide'); ?>">이용안내</a>
				</p>

			</div>

		</div>
	</footer>
	<?php /*----- footer 끝 -----*/ ?>
</div>
<?php /*----- wrapper 끝 -----*/ ?>

<?php /*----- 전체 검색 입력창 시작 -----*/ ?>
<div class="search-full">
	<div class="search-close-btn"></div>
	<fieldset class="search-field">
		<legend>게시판 전체검색</legend>
		<form name="fsearchbox" method="get" action="<?php echo G5_SHOP_URL ?>/search.php" onsubmit="return fsearchbox_submit(this);">
		<input type="hidden" name="sfl" value="wr_subject||wr_content">
		<input type="hidden" name="sop" value="and">
		<label for="sch_stx" class="sound_only">검색어 입력 필수</label>
		<input type="text" name="stx" id="search_input" maxlength="20" placeholder="검색">
		<button type="submit" class="search-btn" value="검색"><i class="fas fa-search" aria-hidden="true"></i><span class="sound_only">검색</span></button>
		</form>
		<p>검색어 입력후 엔터를 누르거나 X 이미지를 클릭하여 닫을 수 있습니다.</p>
		<script>
		function fsearchbox_submit(f)
		{
			if (f.stx.value.length < 2) {
				alert("검색어는 두글자 이상 입력하십시오.");
				f.stx.select();
				f.stx.focus();
				return false;
			}

			var cnt = 0;
			for (var i=0; i<f.stx.value.length; i++) {
				if (f.stx.value.charAt(i) == ' ')
					cnt++;
			}

			if (cnt > 1) {
				alert("빠른 검색을 위하여 검색어에 공백은 한개만 입력할 수 있습니다.");
				f.stx.select();
				f.stx.focus();
				return false;
			}

			return true;
		}
		</script>
	</fieldset>
</div>
<?php /*----- 전체 검색 입력창 끝 -----*/ ?>

<?php /* 사이드바 회원 버튼 */ ?>
<!--button type="button" class="sidebar-user-trigger sidebar-user-btn mo-btn" data-bs-toggle="offcanvas" data-bs-target="#offcanvasUserRight" aria-controls="offcanvasUserRight"><i class="fas fa-user-alt"></i></button-->

<?php /* Back To Top */ ?>
<div class="eb-backtotop">
	<svg class="backtotop-progress" width="100%" height="100%" viewBox="-1 -1 102 102">
		<path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"/>
		<span class="progress-count"></span>
	</svg>
</div>
<?php } // !$wmode ?>

<?php
include_once(EYOOM_THEME_PATH . '/misc.html.php');
?>

<?php
if ($is_member && $eyoomer['onoff_push'] == 'on') {
    include_once(EYOOM_THEME_PATH . '/skin/push/basic/push.skin.html.php');
}
?>

<script src="<?php echo EYOOM_THEME_URL; ?>/js/app.js?ver=<?php echo G5_JS_VER; ?>"></script>
<?php if ($is_admin == 'super') { ?>
<script>
$(document).ready(function() {
    var edit_mode = "<?php echo $eyoom_default['edit_mode']; ?>";
    if (edit_mode == 'on') {
        $(".btn-edit-mode").show();
    } else {
        $(".btn-edit-mode").hide();
    }

    $("#btn_edit_mode").click(function() {
        var edit_mode = $("#edit_mode").val();
        if (edit_mode == 'on') {
            $(".btn-edit-mode").hide();
            $("#edit_mode").val('');
        } else {
            $(".btn-edit-mode").show();
            $("#edit_mode").val('on');
        }

        $.post("<?php echo G5_ADMIN_URL; ?>/?dir=theme&pid=theme_editmode&smode=1", { edit_mode: edit_mode });
    });
});
</script>
<?php } ?>

<?php
if ( $config['cf_analytics'] ) echo $config['cf_analytics'];
?>