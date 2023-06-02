
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
    function boxOpen() {
        document.getElementById('dropmenu').style.display = "block";
        document.getElementById('btn_nav').innerHTML="<a href=\"javascript:boxClose();\" class=\"close\"></a>";
    }
    function boxClose() {
        document.getElementById('dropmenu').style.display = "none";
        document.getElementById('btn_nav').innerHTML="<a href=\"javascript:boxOpen();\" class=\"open\"></a>";
    }
</script>

<div class="page_title">
    <h2 class="wide">납부내역</h2>
    <h2 class="mob">My 슬립케어 <div id="btn_nav"><a href="javascript:boxOpen();" class="open"></a></div></h2>
    <div class="menu mob">
        <div>
            <a href="/mypage/sleep_data.php">수면데이터</a>
            <!--a href="#">수면매니저</a-->
            <a href="/mypage/contract.php">계약정보</a>
            <!--a href="#">처방정부</a-->
            <a href="/mypage/schedule.php">병원진료일정</a>
            <a href="/mypage/invoice.php" class="active">납부내역</a>
            <a href="/mypage/document.php">문서보관함</a>
        </div>
    </div>
</div>

<div id="mypage" class="mycare6">
    <div class="my_left">
        <ul>
            <li class="active"><a href="mycare1.html">My 슬립케어</a>
                <ul>
                    <ul>
                        <li><a href="/mypage/sleep_data.php">수면데이터</a></li>
                        <!--li><a href="#">수면매니저</a></li-->
                        <li><a href="/mypage/contract.php">계약정보</a></li>
                        <!--li><a href="#">처방정보</a></li-->
                        <li><a href="/mypage/schedule.php">병원진료일정</a></li>
                        <li class="on"><a href="/mypage/invoice.php">납부내역</a></li>
                        <li><a href="/mypage/document.php">문서보관함</a></li>
                    </ul>
                </ul>
            </li>
            <li><a href="/mypage/reservation.php">예약 내역</a></li>
            <li><a href="/mypage/myinfo.php">나의 정보</a></li>
            <li><a href="/mypage/myorder.php">주문/배송조회</a></li>
        </ul>
    </div>

    <div class="my_right inner">

        <h3 class="line">월별 청구내역</h3>

        <!-- search -->
        <div class="date_search">
            <div class="radio">
                <input type="radio" id="radio1" name="date_search" value='1주일' checked><label for="radio1" class="m0">최근 1주일</label>
                <input type="radio" id="radio2" name="date_search" value='1개월'><label for="radio2">1개월</label>
                <input type="radio" id="radio3" name="date_search" value='3개월'><label for="radio3">3개월</label>
                <input type="radio" id="radio4" name="date_search" value='전체'><label for="radio4">전체</label>
            </div>
            <div class="input">
                <div><input type="text"><img src="<?php echo $eyoom_skin_url['mypage']; ?>/images/my_icon_cal.png"></div>
                <div><input type="text"><img src="<?php echo $eyoom_skin_url['mypage']; ?>/images/my_icon_cal.png"></div>
                <button class="button">조회하기</button>
            </div>
        </div>

        <div class="table_top">
            <div class="sort">
                청구상태
                <select>
                    <option>선택하세요</option>
                </select>
            </div>
            <span>총 4건</span>
        </div>

        <table class="table01 wide">
            <tr>
                <th>청구제품</th>
                <th>청구시작일</th>
                <th>청구종료일</th>
                <th>본인부담금</th>
                <th>청구상태</th>
            </tr>

            <tr>
                <td>Airsense 10 <br>Autoset 3g</td>
                <td>2021-02-15</td>
                <td>2021-02-15</td>
                <td>완료</td>
                <td><span class="status01">대기</span></td>
            </tr>

            <tr>
                <td>Airsense 10 <br>Autoset 3g</td>
                <td>2021-02-15</td>
                <td>2021-02-15</td>
                <td>완료</td>
                <td><span class="status02">접수</span></td>
            </tr>

            <tr>
                <td>Airsense 10 <br>Autoset 3g</td>
                <td>2021-02-15</td>
                <td>2021-02-15</td>
                <td>완료</td>
                <td><span class="status03">반려</span></td>
            </tr>

            <tr>
                <td>Airsense 10 <br>Autoset 3g</td>
                <td>2021-02-15</td>
                <td>2021-02-15</td>
                <td>완료</td>
                <td><span class="status04">완료</span></td>
            </tr>
        </table>

        <ul class="table02 mob">
            <li>
                <dl><dt>청구제품</dt><dd>Airsense 10 Autoset 3g</dd></dl>
                <dl><dt>청구시작일</dt><dd>2021-02-15</dd></dl>
                <dl><dt>청구종료일</dt><dd>2021-02-15</dd></dl>
                <dl><dt>본인부담금</dt><dd>완료</dd></dl>
                <dl><dt>청구상태</dt><dd><span class="status01">대기</span></dd></dl>
            </li>

            <li>
                <dl><dt>청구제품</dt><dd>Airsense 10 Autoset 3g</dd></dl>
                <dl><dt>청구시작일</dt><dd>2021-02-15</dd></dl>
                <dl><dt>청구종료일</dt><dd>2021-02-15</dd></dl>
                <dl><dt>본인부담금</dt><dd>완료</dd></dl>
                <dl><dt>청구상태</dt><dd><span class="status02">접수</span></dd></dl>
            </li>

            <li>
                <dl><dt>청구제품</dt><dd>Airsense 10 Autoset 3g</dd></dl>
                <dl><dt>청구시작일</dt><dd>2021-02-15</dd></dl>
                <dl><dt>청구종료일</dt><dd>2021-02-15</dd></dl>
                <dl><dt>본인부담금</dt><dd>완료</dd></dl>
                <dl><dt>청구상태</dt><dd><span class="status03">반려</span></dd></dl>
            </li>

            <li>
                <dl><dt>청구제품</dt><dd>Airsense 10 Autoset 3g</dd></dl>
                <dl><dt>청구시작일</dt><dd>2021-02-15</dd></dl>
                <dl><dt>청구종료일</dt><dd>2021-02-15</dd></dl>
                <dl><dt>본인부담금</dt><dd>완료</dd></dl>
                <dl><dt>청구상태</dt><dd><span class="status04">완료</span></dd></dl>
            </li>
        </ul>

    </div>
</div>
