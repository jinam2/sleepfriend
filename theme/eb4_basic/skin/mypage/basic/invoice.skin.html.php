
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
    <h2 class="wide">납부내역</h2>
    <h2 class="mob">My 슬립케어 <div id="btn_nav"><a href="javascript:;" class="open"></a></div></h2>
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
        <form name="fsearch">
        <div class="date_search">
            <div class="radio">
                <input type="radio" id="radio1" name="period" value='7' <?=$period=="7" ? "checked" : ""?> ><label for="radio1" class="m0">최근 1주일</label>
                <input type="radio" id="radio2" name="period" value='30' <?=$period=="30" ? "checked" : ""?> ><label for="radio2">1개월</label>
                <input type="radio" id="radio3" name="period" value='90' <?=$period=="90" ? "checked" : ""?> ><label for="radio3">3개월</label>
                <input type="radio" id="radio4" name="period" value='' <?=$period=="" ? "checked" : ""?> ><label for="radio4">전체</label>
            </div>
            <div class="input">
                <div><input type="text" name="fr_date" id="fr_date" value="<?=$fr_date?>"><img src="<?php echo $eyoom_skin_url['mypage']; ?>/images/my_icon_cal.png"></div>
                <div><input type="text" name="to_date" id="to_date" value="<?=$to_date?>"><img src="<?php echo $eyoom_skin_url['mypage']; ?>/images/my_icon_cal.png"></div>
                <button class="button" type="submit">조회하기</button>
            </div>
        </div>
        <div class="table_top">
            <div class="sort">
                청구상태
                <select name="status" id="status">
                    <option value="">전체</option>
                    <?php foreach($status_names as $key => $value) {?>
                        <option value="<?=$key?>" <?=$status == $key ? "selected" : ""?>><?=$value?></option>
                    <?php } ?>
                </select>
            </div>
            <span>총 <?=$total_count?>건</span>
        </div>
        </form>

        <table class="table01 wide">
            <tr>
                <th>청구제품</th>
                <th>청구시작일</th>
                <th>청구종료일</th>
                <th>본인부담금</th>
                <th>청구상태</th>
            </tr>

            <?php foreach($list as $row) {?>
            <tr>
                <td><?=$row['CONTRACT']['DEVICE_MODEL_NAME']?></td>
                <td><?=$row['START_DATE']?></td>
                <td><?=$row['END_DATE']?></td>
                <td><?=number_format($row['PATIENT_PAYABLE'])?>원</td>
                <td><span class="<?=$css_class_names[$row['STATUS']]?>"><?=$row['STATUS']?></span></td>
            </tr>
            <?php } ?>
        </table>

        <ul class="table02 mob">
            <?php foreach($list as $row) {?>
            <li>
                <dl><dt>청구제품</dt><dd><?=$row['CONTRACT']['DEVICE_MODEL_NAME']?></dd></dl>
                <dl><dt>청구시작일</dt><dd><?=$row['START_DATE']?></dd></dl>
                <dl><dt>청구종료일</dt><dd><?=$row['END_DATE']?></dd></dl>
                <dl><dt>본인부담금</dt><dd><?=number_format($row['PATIENT_PAYABLE'])?>원</dd></dl>
                <dl><dt>청구상태</dt><dd><span class="<?=$css_class_names[$row['STATUS']]?>"><?=$row['STATUS']?></span></dd></dl>
            </li>
            <?php } ?>
        </ul>

        <?php if($total_count == 0) {?>
            <!-- 데이타가 없을 경우 -->
            <p class="empty">청구내역이 없습니다.</p>
        <?php }  else { ?>

            <!--  페이징 -->
            <?php echo eb_paging(); ?>
        <?php } ?>


    </div>
</div>
<script>
    $(document).ready(function() {
        $('#fr_date').datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd',
            showMonthAfterYear: true,
            monthNames: ['년 1월','년 2월','년 3월','년 4월','년 5월','년 6월','년 7월','년 8월','년 9월','년 10월','년 11월','년 12월'],
            monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
            dayNamesMin: ['일','월','화','수','목','금','토'],
            onSelect: function(selectedDate){
                $('#to_date').datepicker('option', 'minDate', selectedDate);
            }
        });
        $('#to_date').datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd',
            showMonthAfterYear: true,
            monthNames: ['년 1월','년 2월','년 3월','년 4월','년 5월','년 6월','년 7월','년 8월','년 9월','년 10월','년 11월','년 12월'],
            monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
            dayNamesMin: ['일','월','화','수','목','금','토'],
            onSelect: function(selectedDate){
                $('#fr_date').datepicker('option', 'maxDate', selectedDate);
            }
        });

        $("input[name=period]").click(function(e) {
            set_date($(this).val());
        });
    });

    function set_date(period) {
        <?php
        $date_term = date('w', G5_SERVER_TIME);
        $week_term = $date_term + 7;
        $last_term = strtotime(date('Y-m-01', G5_SERVER_TIME));
        ?>
        if (period == "7") {
            document.getElementById("fr_date").value = "<?php echo $before_7day; ?>";
            document.getElementById("to_date").value = "<?php echo $today; ?>";
        } else if (period == "30") {
            document.getElementById("fr_date").value = "<?php echo date('Y-m-d', strtotime('-1 month', G5_SERVER_TIME)); ?>";
            document.getElementById("to_date").value = "<?php echo $today; ?>";
        } else if (period == "90") {
            document.getElementById("fr_date").value = "<?php echo date('Y-m-d', strtotime('-3 month', G5_SERVER_TIME)); ?>";
            document.getElementById("to_date").value = "<?php echo date('Y-m-d', G5_SERVER_TIME); ?>";
        } else if (period == "") {
            document.getElementById("fr_date").value = "";
            document.getElementById("to_date").value = "";
            document.getElementById("status").value = "";
        }

        $("form[name=fsearch]").submit();
    }
</script>
