<?php
$rental_type_names = [
        "noinsurance" => '비보험렌탈',
        "insurance" => '보험렌탈',
];

if($rental['od_file1'] && file_exists(G5_DATA_PATH.$rental['od_file1'])) {
    $rental['link1'] = G5_DATA_URL."".$rental['od_file1'];
}

if($rental['od_file2'] && file_exists(G5_DATA_PATH.$rental['od_file2'])) {
    $rental['link2'] = G5_DATA_URL."".$rental['od_file2'];
}

if($rental['od_file3'] && file_exists(G5_DATA_PATH.$rental['od_file3'])) {
    $rental['link3'] = G5_DATA_URL."".$rental['od_file3'];
}

if($rental['od_file4'] && file_exists(G5_DATA_PATH.$rental['od_file4'])) {
    $rental['link4'] = G5_DATA_URL."".$rental['od_file4'];
}


?>
<!-- 페이지 타이틀 -->
<div class="page_navi">
    <div><span><a href="/">홈</a></span><span><a href="/mypage/contract.php">마이페이지</a></span><span>My 슬립케어</span><span>렌탈정보</span></div>
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
    <h2 class="wide">렌탈 신청 정보</h2>
    <h2 class="mob">My 슬립케어 <div id="btn_nav"><a href="javascript:;" class="open"></a></div></h2>
    <div class="menu mob">
        <div>
            <a href="/mypage/sleep_data.php">수면데이터</a>
            <!--a href="#">수면매니저</a-->
            <a href="/mypage/contract.php" class="active">계약정보</a>
            <!--a href="#">처방정부</a-->
            <a href="/mypage/schedule.php">병원진료일정</a>
            <a href="/mypage/invoice.php">납부내역</a>
            <a href="/mypage/document.php">문서보관함</a>
        </div>
    </div>
</div>

<div id="mypage" class="mycare3">
    <div class="my_left">
        <ul>
            <li class="active"><a href="/mypage/sleep_data.php">My 슬립케어</a>
                <ul>
                    <li><a href="/mypage/sleep_data.php">수면데이터</a></li>
                    <!--li><a href="#">수면매니저</a></li-->
                    <li class="on"><a href="/mypage/contract.php">계약정보</a></li>
                    <!--li><a href="#">처방정보</a></li-->
                    <li><a href="/mypage/schedule.php">병원진료일정</a></li>
                    <li><a href="/mypage/invoice.php">납부내역</a></li>
                    <li><a href="/mypage/document.php">문서보관함</a></li>
                </ul>
            </li>
            <li><a href="/mypage/reservation.php">예약 내역</a></li>
            <li><a href="/mypage/myinfo.php">나의 정보</a></li>
            <li><a href="/mypage/myorder.php">주문/배송조회</a></li>
        </ul>
    </div>

    <div class="my_right inner">

        <div class="frame">
            <h3>렌탈 신청 정보</h3>
            <ul class="table01">
                <li>렌탈 상태<span><?=$rental['od_status']?></span></li>
                <li>상품종류<span><?=$rental['it_name']?></span></li>
                <li>보험구분<span><?=$rental_type_names[$rental['od_rental_type']]?></span></li>
            </ul>

            <ul class="table01">
                <li>신분증<span><a href="<?php echo $rental['link1']?>" target="_blank"><?php echo $rental['od_filename1']?></a></span></li>
                <?php if($rental['od_rental_type'] == "insurance") {?>
                <li>처방전
                    <span>
                    <?php if($rental['link2']) {?>
                    <a href="<?php echo $rental['link2']?>" target="_blank"><?php echo $rental['od_filename2']?></a>
                    <?php } ?>
                    </span>
                </li>
                <li>등록신청서
                    <span>
                    <?php if($rental['link3']) {?>
                        <a href="<?php echo $rental['link3']?>" target="_blank"><?php echo $rental['od_filename3']?></a>
                    <?php } ?>
                    </span>
                </li>
                <li>수면다원검사결과지
                    <span>
                    <?php if($rental['link4']) {?>
                        <a href="<?php echo $rental['link4']?>" target="_blank"><?php echo $rental['od_filename4']?></a>
                    <?php } ?>
                    </span>
                </li>
                <?php } ?>
            </ul>

        </div>

    </div>
</div>