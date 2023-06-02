<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
// 썸네일 크기 설정
$thumb_width = '440';    //썸네일 넓이
$thumb_height = '290';    //썸네일 높이

//하루에 한번 날짜로 카테고리 업데이트
if(G5_TIME_YMD != $board['bo_1']){

	$sql = " select wr_id, ca_name, wr_1, wr_2 from {$write_table} where wr_is_comment = 0 order by wr_id desc limit 0, 1000 ";
	$result = sql_query($sql);
	for ($i=0; $row = sql_fetch_array($result); $i++) {
		if($row['wr_1'] <= G5_TIME_YMD && $row['wr_2'] >= G5_TIME_YMD){
			sql_query(" update {$write_table} set ca_name='진행중' where wr_id = {$row['wr_id']} ");
		}elseif($row['wr_1'] > G5_TIME_YMD && $row['wr_2'] > G5_TIME_YMD){
			sql_query(" update {$write_table} set ca_name='진행전' where wr_id = {$row['wr_id']} ");
		}elseif($row['wr_1'] < G5_TIME_YMD && $row['wr_2'] < G5_TIME_YMD){
			sql_query(" update {$write_table} set ca_name='진행완료' where wr_id = {$row['wr_id']} ");
		}
	}

	sql_query(" update g5_board set bo_1_subj='카테고리업데이트', bo_1='".G5_TIME_YMD."' where bo_table ='$bo_table' ");
}

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<?php echo stripslashes($board['bo_content_head']) //게시판 상단내용 ?>

<!-- 게시판 목록 시작 { -->
<div id="bo_gall" style="width:<?php echo $width; ?>">

    <?php if ($is_category) { ?>

    <nav id="bo_cate">
        <h2><?php echo $board['bo_subject'] ?> 카테고리</h2>
        <ul id="bo_cate_ul">
            <?php echo $category_option ?>
        </ul>
    </nav>

    <?php } ?>

    <form name="fboardlist"  id="fboardlist" action="./board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="sw" value="">

    <div class="bo_fx">
		<?php if ($is_admin) { ?>
		<div class="board-info m-b-20">
			<div class="float-start">
				<?php if ($is_checkbox) { ?>
					<button class="btn-e btn-e-sm btn-gray" type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value">선택삭제</button>
					<button class="btn-e btn-e-sm btn-gray" type="submit" name="btn_submit" value="선택복사" onclick="document.pressed=this.value">선택복사</button>
					<button class="btn-e btn-e-sm btn-gray" type="submit" name="btn_submit" value="선택이동" onclick="document.pressed=this.value">선택이동</button>
				<?php ;} ?>
			</div>
			<?php if ($write_href) { ?>
			<div class="float-end">
				<a href="<?php echo $write_href; ?>" class="btn-e-md btn-e-dark" type="button">글쓰기</a>
			</div>
			<?php ;} ?>
			<div class="clearfix"></div>
		</div>
		<?php ;} ?>
    </div>

    <?php if ($is_checkbox) { ?>
    <div id="gall_allchk">
        <label for="chkall" class="sound_only">현재 페이지 게시물 전체</label>
    </div>
    <?php } ?>

    <ul id="gall_ul">

        <?php for ($i=0; $i<count($list); $i++) {
         ?>

		<li class="gall_li <?php if ($wr_id == $list[$i]['wr_id']) { ?>gall_now<?php } ?>">

            <ul class="gall_con"> <!-- 이미지 출력 -->
                <li class="gall_href">
                    <a href="<?php echo $list[$i]['href'] ?>">
                    <?php
                    if ($list[$i]['is_notice']) { // 공지사항  ?>
                        <strong style="width:<?php echo $thumb_width ?>px;height:45px">알림</strong>
                    <?php } else {
                        // $thumb = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], $board['bo_gallery_width'], $board['bo_gallery_height']);
                        $thumb = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], $thumb_width, $thumb_height); // 썸네일 크기를 위에서 선언한 크기사용

                        if($thumb['src']) {
                            // $img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'" width="'.$board['bo_gallery_width'].'" height="'.$board['bo_gallery_height'].'">';
                            $img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'">';
                        } else {
                            $img_content = '<span style="width:'.$board['bo_gallery_width'].'px;height:'.$board['bo_gallery_height'].'px">no image</span>';
                        }

                        echo $img_content;
                    }
                     ?>
                    </a>
                </li>
			</ul>

            <ul class="gall_con2">  <!-- 제목,내용 출력 -->
                <li class="gall_text_href">
		            <?php if ($is_checkbox) { ?>
					    <label for="chk_wr_id_<?php echo $i ?>" class="sound_only"><?php echo $list[$i]['subject'] ?></label>
						<input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
				    <?php } ?>
                    <a href="<?php echo $list[$i]['href'] ?>">
                        <?php echo $list[$i]['subject'] ?>
                        <?php if ($list[$i]['comment_cnt']) { ?><span class="sound_only">댓글</span><?php echo $list[$i]['comment_cnt']; ?><span class="sound_only">개</span><?php } ?>
                        <?php if ($list[$i]['icon_new']) { ?>
                        <span class="new-icon">N</span>
                        <?php ;} ?>
                    </a>
                </li>
                <li>
                    <strong>기간 : <?php echo $list[$i]['wr_1'] ?> ~ <?php echo $list[$i]['wr_2'] ?></strong>
				</li>
			</ul>
        </li>
        <?php } ?>
        <?php if (count($list) == 0) { echo "<li class=\"empty_list\">게시물이 없습니다.</li>"; } ?>
    </ul>

    <?php if ($list_href || $is_checkbox || $write_href) { ?>
    <div class="bo_fx">

        <?php if ($list_href || $write_href) { ?>
        <ul class="btn_bo_user">
            <?php if ($list_href) { ?><li><a href="<?php echo $list_href ?>" class="btn-e-md btn-e-dark">목록</a></li><?php } ?>
            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn-e-md btn-e-dark">글쓰기</a></li><?php } ?>
        </ul>
        <?php } ?>
    </div>
    <?php } ?>
    </form>
</div>

<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>
<?php } ?>

<!-- 페이지 -->
<?php echo $write_pages;  ?>

<!-- 게시물 검색 시작 { -->
<fieldset class="bo_sch">
    <legend>게시물 검색</legend>

    <form name="fsearch" method="get">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sop" value="and">
    <label for="sfl" class="sound_only">검색대상</label>
    <select name="sfl" id="sfl">
        <option value="wr_subject"<?php echo get_selected($sfl, 'wr_subject', true); ?>>제목</option>
        <option value="wr_content"<?php echo get_selected($sfl, 'wr_content'); ?>>내용</option>
        <option value="wr_subject||wr_content"<?php echo get_selected($sfl, 'wr_subject||wr_content'); ?>>제목+내용</option>
    </select>
    <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
            <div class="sch_bar">
                <input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" required id="stx" class="sch_input" size="25" maxlength="20" placeholder=" 검색어를 입력해주세요">
                <button type="submit" value="검색" class="sch_btn"><i class="fa fa-search" aria-hidden="true"></i><span class="sound_only">검색</span></button>
            </div>
    </form>
</fieldset>
<!-- } 게시물 검색 끝 -->



<?php if ($is_checkbox) { ?>
<script>
function all_checked(sw) {
    var f = document.fboardlist;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]")
            f.elements[i].checked = sw;
    }
}

function fboardlist_submit(f) {
    var chk_count = 0;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
            chk_count++;
    }

    if (!chk_count) {
        alert(document.pressed + "할 게시물을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택복사") {
        select_copy("copy");
        return;
    }

    if(document.pressed == "선택이동") {
        select_copy("move");
        return;
    }

    if(document.pressed == "선택삭제") {
		if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다\n\n답변글이 있는 게시글을 선택하신 경우\n답변글도 선택하셔야 게시글이 삭제됩니다."))
            return false;

        f.removeAttribute("target");
        f.action = "./board_list_update.php";

	}

    return true;
}

// 선택한 게시물 복사 및 이동
function select_copy(sw) {
    var f = document.fboardlist;

    if (sw == 'copy')
        str = "복사";
    else
        str = "이동";

    var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");

    f.sw.value = sw;
    f.target = "move";
    f.action = "./move.php";
    f.submit();
}
</script>
<?php } ?>
<!-- } 게시판 목록 끝 -->
