
<!-- 페이지 타이틀 -->
<div class="page_navi">
    <div><span><a href="/">홈</a></span><span><a href="/mypage/contract.php">마이페이지</a></span><span>주문/배송조회</span><span>내가 남긴 리뷰</span></div>
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
    <h2 class="wide">내가 남긴 리뷰</h2>
    <h2 class="mob">주문/배송조회 <div id="btn_nav"><a href="javascript:;" class="open"></a></div></h2>
    <div class="menu mob">
        <div>
            <a href="/mypage/myorder.php">주문내역</a>
            <!--a href="#">취소/교환/반품</a-->
            <a href="/mypage/inquiry.php">상품 문의</a>
            <a href="/mypage/review.php" class="active">내가 남긴 리뷰</a>
        </div>
    </div>
</div>

<div id="mypage" class="order4">
    <div class="my_left">
        <ul>
            <li><a href="/mypage/sleep_data.php">My 슬립케어</a></li>
            <li><a href="/mypage/reservation.php">예약 내역</a></li>
            <li><a href="/mypage/myinfo.php">나의 정보</a></li>
            <li class="active"><a href="/mypage/myorder.php">주문/배송조회</a>
                <ul>
                    <li><a href="/mypage/myorder.php">주문내역</a></li>
                    <li><!--a href="#">취소/교환/반품</a--></li>
                    <li><a href="/mypage/inquiry.php">상품 문의</a></li>
                    <li class="on"><a href="/mypage/review.php">내가 남긴 리뷰</a></li>
                </ul>
            </li>
        </ul>
    </div>

    <div class="my_right inner">

        <p class="s_title">총 <?php echo $total_count?>건</p>

        <?php foreach($list as $row) { ?>
        <div class="review_info">
            <div class="img"><img src="<?php echo $eyoom_skin_url['mypage']; ?>/images/img_132x132.png"></div>
            <div class="desc">
                <div class="date"><?=substr($row['is_time'], 0, 10)?> 작성</div>
                <p class="title"><a href="<?= $row['item_url'] ?>"><span>[ <?=$row['it_brand']?> ]</span><?=$row['it_name']?></a></p>
                <a href="<?= $row['item_url'] ?>#sit_use">
                    <div class="txt">
                        <?=$row['subject']?>
                    </div>
                </a>
            </div>
        </div>
        <?php } ?>

        <?php if($total_count == 0) {?>
		<!-- 리뷰가 없을 경우 -->
		<p class="empty">작성하신 리뷰가 없습니다.</p>
        <?php }  else { ?>

        <!--  페이징 -->
        <?php echo eb_paging(); ?>
        <?php } ?>
    </div>
</div>
