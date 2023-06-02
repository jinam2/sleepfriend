
<!-- 페이지 타이틀 -->
<div class="page_navi">
    <div><span><a href="/">홈</a></span><span><a href="/mypage/sleep_data.php">마이페이지</a></span><span>나의 정보</span><span>결제정보</span></div>
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
    <h2 class="wide">결제정보</h2>
    <h2 class="mob">나의 정보 <div id="btn_nav"><a href="javascript:;" class="open"></a></div></h2>
    <div class="menu mob">
        <div>
            <a href="/mypage/myinfo.php">개인정보</a>
            <a href="/mypage/payinfo.php" class="active">결제정보</a>
        </div>
    </div>
</div>

<div id="mypage" class="myinfo2">
    <div class="my_left">
        <ul>
            <ul>
                <li><a href="/mypage/sleep_data.php">My 슬립케어</a></li>
                <li><a href="/mypage/reservation.php">예약 내역</a></li>
                <li class="active"><a href="/mypage/myinfo.php">나의 정보</a>
                    <ul>
                        <li><a href="/mypage/myinfo.php">개인정보</a></li>
                        <li class="on"><a href="/mypage/payinfo.php">결제정보</a></li>
                    </ul>
                </li>
                <li><a href="/mypage/myorder.php">주문/배송조회</a></li>
            </ul>
        </ul>
    </div>

    <div class="my_right inner">

        <!--  계좌이체에서 계좌이체로 변경할 경우 -->
        <?php if($payment['METHOD'] == "계좌이체") { ?>
        <h3>현재 자동이체 정보</h3>
        <ul class="table03-1">
            <li>
                <span>결제방법</span>
                <p>계좌이체</p>
            </li>

            <li>
                <span>은행명</span>
                <p><?=$payment['BANKCARD_NAME']?></p>
            </li>

            <li>
                <span>계좌번호</span>
                <p><?=$payment['BANKCARD_NUMBER']?></p>
            </li>

            <li>
                <span>예금주명</span>
                <p><?=$payment['ACCOUNT_NAME']?></p>
            </li>
        </ul>
        <?php } else if($payment['METHOD'] == "카드") { ?>
        <h3>현재 자동이체 정보</h3>
        <ul class="table03-1">
            <li>
                <span>결제방법</span>
                <p>신용카드</p>
            </li>

            <li>
                <span>카드사</span>
                <p><?=$payment['BANKCARD_NAME']?></p>
            </li>

            <li>
                <span>카드 소유자명</span>
                <p><?=$payment['ACCOUNT_NAME']?></p>
            </li>

            <li>
                <span>카드번호</span>
                <p><?=$payment['MASK_CARD_NUMBER']?> </p>
            </li>

            <li>
                <span>카드 유효기간</span>
                <p>20**년 **월</p>
            </li>

            <li>
                <span>설정일</span>
                <p>-</p>
            </li>
        </ul>
        <?php } ?>

    </div>
</div>
