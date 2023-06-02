
<!-- 페이지 타이틀 -->
<div class="page_navi">
    <div><span><a href="/">홈</a></span><span><a href="/mypage/contract.php">마이페이지</a></span><span>주문/배송조회</span><span>상품 문의</span></div>
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
    <h2 class="wide">상품 문의</h2>
    <h2 class="mob">주문/배송조회 <div id="btn_nav"><a href="javascript:;" class="open"></a></div></h2>
    <div class="menu mob">
        <div>
            <a href="/mypage/myorder.php" >주문내역</a>
            <!--a href="#">취소/교환/반품</a-->
            <a href="/mypage/inquiry.php" class="active">상품 문의</a>
            <a href="/mypage/review.php">내가 남긴 리뷰</a>
        </div>
    </div>
</div>

<div id="mypage" class="order3">
    <div class="my_left">
        <ul>
            <li><a href="/mypage/sleep_data.php">My 슬립케어</a></li>
            <li><a href="/mypage/reservation.php">예약 내역</a></li>
            <li><a href="/mypage/myinfo.php">나의 정보</a></li>
            <li class="active"><a href="/mypage/myorder.php">주문/배송조회</a>
                <ul>
                    <li><a href="/mypage/myorder.php">주문내역</a></li>
                    <li><!--a href="#">취소/교환/반품</a--></li>
                    <li class="on"><a href="/mypage/inquiry.php">상품 문의</a></li>
                    <li><a href="/mypage/review.php">내가 남긴 리뷰</a></li>
                </ul>
            </li>
        </ul>
    </div>

    <div class="my_right inner">

        <h3 class="line">상품 문의</h3>

        <p class="s_title">총 <?php echo number_format($total_count) ?>건</p>

        <table class="table01 wide">
            <tr>
                <th>분류</th>
                <th>문의일</th>
                <th>상품명</th>
                <th>제목</th>
                <th>답변상태</th>
            </tr>
            <?php
            for ($i=0; $i<count($list); $i++) {

            ?>
            <tr>
                <td><?php echo $list[$i]['iq_category']; ?></td>
                <td><?php echo $list[$i]['date']; ?></td>
                <td><?php echo $list[$i]['it_name']; ?></td>
                <td><a href="<?php echo $list[$i]['view_href']; ?>"><?php echo $list[$i]['subject'] ?></a></td>
                <td><span class="<?php echo ($list[$i]['qa_status'] ? 'status02' : 'status01'); ?>"><?php echo ($list[$i]['qa_status'] ? '답변 완료' : '답변 예정'); ?></span></td>
            </tr>
            <?php } ?>
        </table>

        <ul class="table02 mob">
            <?php
            for ($i=0; $i<count($list); $i++) {
            ?>
            <li>
                <dl><dt>분류</dt><dd><?php echo $list[$i]['iq_category']; ?></dd></dl>
                <dl><dt>문의일</dt><dd><?php echo $list[$i]['date']; ?></dd></dl>
                <dl><dt>상품명</dt><dd><?php echo $list[$i]['it_name']; ?></dd></dl>
                <dl><dt>제목</dt><dd><a href="<?php echo $list[$i]['view_href']; ?>"><?php echo $list[$i]['subject'] ?></a></dd></dl>
                <dl><dt>답변상태</dt><dd><span class="<?php echo ($list[$i]['qa_status'] ? 'status01' : 'status02'); ?>"><?php echo ($list[$i]['qa_status'] ? '답변 완료' : '답변 예정'); ?></span></dd></dl>
            </li>
            <?php } ?>
        </ul>

        <?php if($total_count == 0) {?>
            <!-- 데이타가 없을 경우 -->
            <p class="empty">문의내역이 없습니다.</p>
        <?php }  else { ?>

            <!--  페이징 -->
            <?php echo eb_paging(); ?>
        <?php } ?>

    </div>
</div>
