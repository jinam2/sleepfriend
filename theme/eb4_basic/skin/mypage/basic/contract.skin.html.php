
<!-- 페이지 타이틀 -->
<div class="page_navi">
    <div><span><a href="/">홈</a></span><span><a href="/mypage/contract.php">마이페이지</a></span><span>My 슬립케어</span><span>계약정보</span></div>
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
    <h2 class="wide">계약정보</h2>
    <h2 class="mob">My 슬립케어 <div id="btn_nav"><a href="javascript:boxOpen();" class="open"></a></div></h2>
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

    <div class="my_right">

        <div class="frame">
            <h3 class="line m_inner">렌탈</h3>
            <p class="caution m_inner">렌탈 제품은 계약 진행을 위해 해피콜을 드립니다. <br>해피콜 완료 후 결제 및 배송되오니 <strong>1670-3171</strong> 전화를 꼭 받아주세요.</p>

            <ul class="rent_info">
                <?php foreach($rental_list as $row) {?>
                    <li>
                        <a href="/mypage/rental_view.php?ID=<?=$row['od_id']?>">
                            <p><?=$row['product_family'] ?><span class="status01">해피콜 예정</span></p>
                            <dl>
                                <dt>모델명</dt><dd><?=$row['it_name'] ?></dd>
                            </dl>
                            <dl>
                                <dt>계약기간</dt><dd>-</dd>
                            </dl>
                        </a>
                    </li>

                <?php } ?>
                <?php foreach($list as $row) {
                    ?>
                    <li>
                        <a href="/mypage/contract_view.php?ID=<?=$row['ID']?>">
                            <p><?=$row['PRODUCT_FAMILY']?><span class="<?=$row['css_class']?>"><?=$row['type_name']?></span></p>
                            <dl>
                                <dt>모델명</dt><dd><?=$row['DEVICE_MODEL_NAME']?></dd>
                            </dl>
                            <dl>
                                <dt>계약기간</dt><dd><?=$row['REAL_START_DATE']?> ~ <?=$row['REAL_EXPIRE_DATE']?></dd>
                            </dl>
                        </a>
                    </li>
                <?php } ?>
            </ul>

        </div>

        <div class="frame">
            <h3 class="line m_inner">이번달 청구 금액</h3>
            <div class="bill m_inner">
                <dl>
                    <dt>렌탈 제품의 <?=$year_mon?> 청구 금액입니다.</dt>
                    <dd>청구금액 <strong><?=number_format($invoice['PATIENT_PAYABLE'])?>원</strong> <a href="<?=$invoice_link?>" class="button">조회하기</a></dd>
                </dl>
            </div>
        </div>

    </div>
</div>

<script>

</script>