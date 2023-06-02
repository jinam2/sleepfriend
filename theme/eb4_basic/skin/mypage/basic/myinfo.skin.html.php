
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
    var yourUserId = "<?= $member['mb_id'] ?>";


    if(typeof android !== "undefined") {
        android?.setExternalUserId?.(yourUserId);
    }
    if(typeof webkit !== "undefined") {
        webkit?.messageHandlers?.setExternalUserId?.postMessage?.(yourUserId);
    }

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

        <!-- info -->
        <div class="info">
            <div class="info_top">
                <p class="grade"><!--span>등급명</span--> 고객번호 <?php echo $member['mb_no']?></p>
                <p class="name">
                    <strong><?=$member['mb_name']?></strong>님, 안녕하세요!
                    <a href="<?php echo G5_BBS_URL ?>/member_confirm.php?url=<?php echo G5_URL ?>/mypage/modify_myinfo.php"><i class="xi-pen"></i></a>
                    <a href="/bbs/logout.php" class="logout">로그아웃</a>
                </p>
            </div>

            <div class="benefit">
                <h5>현재 내 혜택</h5>
                <ul>
                    <li>멤버십 포인트(P)<span>0</span></li>
                    <li>수면 코디 서비스<span>0</span></li>
                </ul>
                <p>나에게 맞는 제품관리 서비스와 활동내역을 확인하세요.</p>
            </div>
        </div>

        <!-- 렌탈 -->
        <div class="status">
            <p>임대기간 <strong><?php echo $rental_period?></strong></p>
            <ul>
                <?php 
                //  230602 - jinam23 링크 변경 
                foreach($list as $row) {
                    echo '<li><a href="/mypage/contract.php" title="'.$row['it_name'].'">'.$row['thumb'].'</a></li>' ;
                    /* <li><a href="/shop/item.php?it_id=<?php echo $row['it_id']; ?>" title="<?php echo $row['it_name']?>"><?=$row['thumb']?></a></li> */
                } 
                ?>
            </ul>
        </div>

        <!--div class="btn">
            <a href="/page/?pid=membership" class="button">전체 등급 혜택 보기</a>
        </div-->

    </div>
</div>
