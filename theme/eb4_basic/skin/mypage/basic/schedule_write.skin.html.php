<?php
// GET으로 넘겨 받은 year값이 있다면 넘겨 받은걸 year변수에 적용하고 없다면 현재 년도
$year = isset($_GET['year']) ? $_GET['year'] : date('Y');
// GET으로 넘겨 받은 month값이 있다면 넘겨 받은걸 month변수에 적용하고 없다면 현재 월
$month = isset($_GET['month']) ? $_GET['month'] : date('m');

$is_this_month = date("Y-m") == $year."-".$month; //현재달이면,

$date = "$year-$month-01"; // 현재 날짜
$time = strtotime($date); // 현재 날짜의 타임스탬프

$prev_mon_link = sprintf("/mypage/schedule.php?year=%s&month=%s", date("Y", strtotime("-1 month", $time)), date("m", strtotime("-1 month", $time)));
$next_mon_link = sprintf("/mypage/schedule.php?year=%s&month=%s", date("Y", strtotime("+1 month", $time)), date("m", strtotime("+1 month", $time)));

$start_week = date('w', $time); // 1. 시작 요일
$total_day = date('t', $time); // 2. 현재 달의 총 날짜
$total_week = ceil(($total_day + $start_week) / 7);  // 3. 현재 달의 총 주차

$start_day_time = strtotime(date("Y-m")."-01"); //1일에 대한 time값
$end_day_time = strtotime(date("Y-m")."-".$total_day); //1일에 대한 time값
$today_day = date("j"); //오늘 날자의 일

$end_week_day = date('w', $end_day_time); // 1. 시작 요일


?>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/eyoom-form/plugins/jquery-timepicker/jquery.timepicker.min.js"></script>

<!-- 페이지 타이틀 -->
<div class="page_navi">
    <div><span><a href="/">홈</a></span><span><a href="/mypage/contract.php">마이페이지</a></span><span>My 슬립케어</span><span>진료 일정 등록</span></div>
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
    <h2 class="wide">병원진료일정</h2>
    <h2 class="mob">My 슬립케어 <div id="btn_nav"><a href="javascript:;" class="open"></a></div></h2>
    <div class="menu mob">
        <div>
            <a href="/mypage/sleep_data.php">수면데이터</a>
            <!--a href="#">수면매니저</a-->
            <a href="/mypage/contract.php">계약정보</a>
            <!--a href="#">처방정부</a-->
            <a href="/mypage/schedule.php" class="active">병원진료일정</a>
            <a href="/mypage/invoice.php">납부내역</a>
            <a href="/mypage/document.php">문서보관함</a>
        </div>
    </div>
</div>

<div id="mypage" class="mycare5">
    <div class="my_left">
        <ul>
            <li class="active"><a href="/mypage/sleep_data.php">My 슬립케어</a>
                <ul>
                    <li><a href="/mypage/sleep_data.php">수면데이터</a></li>
                    <!--li><a href="#">수면매니저</a></li-->
                    <li><a href="/mypage/contract.php">계약정보</a></li>
                    <!--li><a href="#">처방정보</a></li-->
                    <li class="on"><a href="/mypage/schedule.php">병원진료일정</a></li>
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

        <h3 class="line">진료 일정 등록</h3>
        <?php if(!is_mobile()) {?>
        <table class="write wide">
            <tr>
                <th>계약선택</th>
                <td colspan="3">

                    <select name="prescription_id" required>
                        <?php foreach($contract_list as $row) {
                        ?>
                        <option value="<?=$row['ID']?>" <?=$schedule['ID'] == $row['ID'] ? "selected" : ""?>>[<?=$row['PRODUCT_FAMILY']?>] <?=$row['DEVICE_MODEL_NAME']?> [<?=$row['START_DATE']?> ~ <?=$row['END_DATE']?>]</option>
                        <? } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th>병원</th>
                <td>
                    <div><span id="sel_hospital"><?=$schedule['HOSPITAL']?></span></div>
                </td>

                <th>진료과</th>
                <td>
                    <div><span id="sel_department"><?=$schedule['MEDICAL_DEPARTMENT']?></span></div>
                </td>
            </tr>

            <tr>
                <th>주치의</th>
                <td colspan="3">
                    <div><span id="sel_doctor"><?=$schedule['DOCTOR']?></span></div>
                </td>
            </tr>

            <tr>
                <th>날짜</th>
                <td><div><input type="text" id="schedule_date" name="schedule_date" value="<?=$schedule['schedule_date']?>" style="border:0 !important; background:none !important" /><img src="<?php echo $eyoom_skin_url['mypage']; ?>/images/my_icon_cal.png"></div></td>
                <th>시간</th>
                <td>
                    <div><input type="text" id="schedule_time" name="schedule_time" value="<?=$schedule['schedule_time']?>" /></div>
                </td>
            </tr>

            <tr>
                <th>메모</th>
                <td colspan="3"><textarea name="schedule_memo"><?=$schedule['schedule_memo']?></textarea></td>
            </tr>
        </table>
        <?php } ?>

        <?php if(is_mobile()) {?>
        <table class="write mob">
            <tr>
                <th>계약선택</th>
                <td>
                    <select name="prescription_id" required>
                        <option>선택하세요</option>
                        <?php foreach($contract_list as $row) {
                            ?>
                            <option value="<?=$row['ID']?>" <?=$schedule['ID'] == $row['ID'] ? "selected" : ""?>>[<?=$row['PRODUCT_FAMILY']?>] <?=$row['DEVICE_MODEL_NAME']?> [<?=$row['START_DATE']?> ~ <?=$row['END_DATE']?>]</option>
                        <? } ?>
                    </select>
                </td>
            </tr>

            <tr>
                <th>병원</th>
                <td>
                    <div><span id="sel_hospital"><?=$schedule['HOSPITAL']?></span></div>
                </td>
            </tr>

            <tr>
                <th>진료과</th>
                <td>
                    <div><span id="sel_department"><?=$schedule['MEDICAL_DEPARTMENT']?></span></div>
                </td>
            </tr>

            <tr>
                <th>주치의</th>
                <td>
                    <div><span id="sel_doctor"><?=$schedule['DOCTOR']?></span></div>
                </td>
            </tr>

            <tr>
                <th>날짜</th>
                <td><div><input type="text" id="schedule_date" name="schedule_date" value="<?=$schedule['schedule_date']?>" style="border:0 !important; background:none !important"><img src="<?php echo $eyoom_skin_url['mypage']; ?>/images/my_icon_cal.png"></div></td>
            </tr>

            <tr>
                <th>시간</th>
                <td>
                    <div><input type="text" id="schedule_time" name="schedule_time" value="<?=$schedule['schedule_time']?>" /></div>
                </td>
            </tr>

            <tr>
                <th>메모</th>
                <td><textarea name="schedule_memo"><?=$schedule['schedule_memo']?></textarea></td>
            </tr>
        </table>

        <?php } ?>
        <div class="btn">
            <a id="btn_save" data-id="<?=$schedule['ID']?>" href="javascript:;"  class="button" >저장</a>
        </div>

    </div>
</div>
<script>
$(function() {

    $('input[name=schedule_date]').datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd',
        showMonthAfterYear: true,
        minDate : 1,
        monthNames: ['년 1월','년 2월','년 3월','년 4월','년 5월','년 6월','년 7월','년 8월','년 9월','년 10월','년 11월','년 12월'],
        monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
        dayNamesMin: ['일','월','화','수','목','금','토'],
        onSelect: function(selectedDate){
            $('#to_date').datepicker('option', 'minDate', selectedDate);
        }
    });

    $('input[name=schedule_date]').attr('readonly', true);

    $('input[name=schedule_time]').timepicker({
        timeFormat: 'h:i A',
        disableTextInput : true,
        interval: 30,
        minTime : '09:00',
        lang : {
            am: '오전', pm: '오후', AM: '오전', PM: '오후', decimal: '.', mins: 'mins', hr: 'hr', hrs: 'hrs'
        }
    });

    $('#reservation_time').timepicker('getSecondsFromMidnight');

    $('#reservation_time').on('changeTime', function() {
        //$('#reservation_time').text($(this).val());
        temp = $('#reservation_time').timepicker('getTime');
    });


    $("select[name=prescription_id]").change(function(e) {
        location.href="/mypage/schedule_write.php?ID=" + $(this).val();
   });

    $("#btn_save").click(function(e) {
        var params = {
            action: 'update_schedule',
        }

        schedule_date = $("input[name=schedule_date]").val();

        temp = $('#schedule_time').timepicker('getTime');

        schedule_hour = temp.getHours();
        schedule_minute = temp.getMinutes();

        schedule_memo = $("textarea[name=schedule_memo]").val();
        params['ID'] = $("select[name=prescription_id]").val();
        params['schedule_date'] = schedule_date;
        params['schedule_hour'] =  schedule_hour;
        params['schedule_minute'] =  schedule_minute;
        params['schedule_memo'] =  schedule_memo ;

        $.ajax({
            url: "/mypage/ajax.schedule.php",
            type: "POST",
            cache: false,
            dataType: "json",
            data: params,
            success: function (response) {
                if (response.code != 200) {
                    alert(response.message);
                    return;
                }
                alert("다음 방문일정이 등록되었습니다.");
                location.href="/mypage/schedule.php";
            },
            error: function (xhr, ajaxOptions, thrownError) {
            }
        });
    });

});
</script>