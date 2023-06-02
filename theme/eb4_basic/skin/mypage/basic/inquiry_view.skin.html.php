
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
    <h2 class="mob">주문/배송조회 <div id="btn_nav"><a href="javascript:boxOpen();" class="open"></a></div></h2>
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
        <!-- 답변이 없을 경우 -->
        <div class="frame">
            <div class="view">
                <p class="title"> <?php  echo $view['subject']; ?></p>
                <p class="desc">
                    <?php echo get_view_thumbnail($view['content'], 480); ?>
                </p>
                <?php if($view['answer']) {?>
                    <hr>
                    <div class="answer">
                        <p class="desc"><?php echo get_view_thumbnail(conv_content($view['iq_answer'],0), 480); ?></p>
                    </div>
                <?php } else { ?>
                    <div class="ing">
                        상담사가 답변을 준비중입니다.<br>
                        문의 접수순으로 처리중이오니, 잠시만 기다려주시기 바랍니다.<br>
                        문의량이 많을 시, 답변이 지연될 수 있습니다.
                    </div>
                <?php } ?>
            </div>

            <div class="view_btn">
                <?php if ($update_href) {?>
                    <a href="<?php echo $update_href ?>" class="button">수정</a>
                <?php } ?>
                <?php if ($delete_href) {?>
                    <a href="<?php echo $delete_href ?>" class="button">삭제</a>
                <?php } ?>
                <a href="<?php echo $list_href ?>" class="button">목록</a>
            </div>
        </div>

    </div>
</div>
