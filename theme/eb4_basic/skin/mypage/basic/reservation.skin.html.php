<!-- 페이지 타이틀 -->
<div class="page_navi">
    <div><span><a href="/">홈</a></span><span><a href="/mypage/reservation.php">예약 내역</a></span><span>상담 신청내역</span><span>수면데이터</span></div>
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
    <h2 class="wide">예약 내역</h2>
    <h2 class="mob">예약 내역 <div id="btn_nav"><a href="javascript:;" class="open"></a></div></h2>
</div>

<div id="mypage" class="reservation">
    <div class="my_left">
        <ul>
            <li><a href="/mypage/sleep_data.php">My 슬립케어</a></li>
            <li class="active"><a href="/mypage/reservation.php">예약 내역</a>
                <ul>
                    <li class="on"><a href="/mypage/reservation.php">상담 신청내역</a></li>
                </ul>
            </li>
            <li><a href="/mypage/myinfo.php">나의 정보</a></li>
            <li><a href="/mypage/myorder.php">주문/배송조회</a></li>
        </ul>
    </div>

    <div class="my_right inner">

        <h3 class="line">상담 신청내역</h3>

        <p class="s_title">총 <?php echo number_format($total_count) ?>건</p>

        <table class="table01 wide">
            <tr>
                <th>상담신청일</th>
                <th>분류</th>
                <th>상담유형</th>
                <th>상담희망일시</th>
                <th>상담제품</th>
                <th>상담상태</th>
            </tr>
            <?php
            foreach($list as $row) {

            ?>
            <tr>
                <td><?=$row['date']?></td>
                <td><?=$row['qa_category']?></td>
                <td><a href="<?=$row['view_href']?>"><?=$row['qa_group']?></a></td>
                <td><?=$row['reserve_time']?></td>
                <td><?=$row['qa_1']?></td>
                <td><span class="<?=$row['status_class']?>"><?=$row['status']?></span></td>
            </tr>
            <?php } ?>

        </table>

        <ul class="table02 mob">
            <?php
            foreach($list as $row) {

            ?>
            <li>
                <dl><dt>상담신청일</dt><dd><?=$row['date']?></dd></dl>
                <dl><dt>분류</dt><dd><?=$row['qa_category']?></dd></dl>
                <dl><dt>상담유형</dt><dd><a href="<?=$row['view_href']?>"><?=$row['qa_group']?></a></dd></dl>
                <dl><dt>상담희망일시</dt><dd><?=$row['reserve_time']?><</dd></dl>
                <dl><dt>상담제품</dt><dd><?=$row['qa_1']?></dd></dl>
                <dl><dt>상담상태</dt><dd><span class="<?=$row['status_class']?>"><?=$row['status']?></span></dd></dl>
            </li>
            <?php } ?>
        </ul>

        <?php echo eb_paging(); ?>
        <?php if($total_count == 0) {?>
            <!-- 데이타가 없을 경우 -->
            <p class="empty">예약내역이 없습니다.</p>
        <?php }  else { ?>

            <!--  페이징 -->
            <?php echo eb_paging(); ?>
        <?php } ?>


        <div class="btn">
            <a href="/mypage/reservation_write.php" class="button">상담 신청하기</a>
        </div>
    </div>
</div>
