
<!-- 페이지 타이틀 -->
<div class="page_navi">
    <div><span><a href="/">홈</a></span><span><a href="/mypage/contract.php">마이페이지</a></span><span>My 슬립케어</span><span>문서보관함</span></div>
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
    <h2 class="wide">문서보관함</h2>
    <h2 class="mob">My 슬립케어 <div id="btn_nav"><a href="javascript:;" class="open"></a></div></h2>
    <div class="menu mob">
        <div>
            <a href="/mypage/sleep_data.php">수면데이터</a>
            <!--a href="#">수면매니저</a-->
            <a href="/mypage/contract.php">계약정보</a>
            <!--a href="#">처방정부</a-->
            <a href="/mypage/schedule.php">병원진료일정</a>
            <a href="/mypage/invoice.php">납부내역</a>
            <a href="/mypage/document.php" class="active">문서보관함</a>
        </div>
    </div>
</div>

<div id="mypage" class="mycare7">
    <div class="my_left">
        <ul>
            <li class="active"><a href="/mypage/sleep_data.php">My 슬립케어</a>
                <ul>
                    <li><a href="/mypage/sleep_data.php">수면데이터</a></li>
                    <!--li><a href="#">수면매니저</a></li-->
                    <li><a href="/mypage/contract.php">계약정보</a></li>
                    <!--li><a href="#">처방정보</a></li-->
                    <li><a href="/mypage/schedule.php">병원진료일정</a></li>
                    <li><a href="/mypage/invoice.php">납부내역</a></li>
                    <li class="on"><a href="/mypage/document.php">문서보관함</a></li>
                </ul>
            </li>
            <li><a href="/mypage/reservation.php">예약 내역</a></li>
            <li><a href="/mypage/myinfo.php">나의 정보</a></li>
            <li><a href="/mypage/myorder.php">주문/배송조회</a></li>
        </ul>
    </div>

    <div class="my_right inner">

        <h3 class="line">문서 보관함</h3>

        <!-- 내 문서-->
        <p class="s_title">내 문서(보험임대)</p>
        <ul class="document">
            <li><a href="/mypage/document.php?doc_type=1">표준계약서</a></li>
            <li><a href="/mypage/document.php?doc_type=2">의무기록사본 <br>(수면다원검사지)</a></li>
            <li><a href="/mypage/document.php?doc_type=3">임대료 납입서</a></li>
            <li><a href="/mypage/document.php?doc_type=4">데이터 리포트</a></li>
        </ul>

        <table class="table01 wide">
            <tr>
                <th>분류</th>
                <th>서식 제목</th>
                <th>비고</th>
            </tr>

            <?php foreach($list as $row) {?>
            <tr>
                <td><?=$row['category']?></td>
                <td><?=$row['doc_title']?></td>
                <td><?=$row['download_link']?><?=$row['view_link']?></td>
            </tr>
            <?php } ?>

        </table>

        <ul class="table02 mob">
            <?php foreach($list as $row) {?>
            <li>
                <dl><dt>분류</dt><dd><?=$row['category']?></dd></dl>
                <dl><dt>서식 제목</dt><dd><?=$row['doc_title']?></dd></dl>
                <dl><dt>비고</dt><dd><?=$row['download_link']?><?=$row['view_link']?></dd></dl>
            </li>
            <?php } ?>

        </ul>

    </div>
</div>
