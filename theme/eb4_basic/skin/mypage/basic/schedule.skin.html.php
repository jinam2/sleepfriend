<?php
// GET으로 넘겨 받은 year값이 있다면 넘겨 받은걸 year변수에 적용하고 없다면 현재 년도
$year = isset($_GET['year']) ? $_GET['year'] : date('Y');
// GET으로 넘겨 받은 month값이 있다면 넘겨 받은걸 month변수에 적용하고 없다면 현재 월
$month = isset($_GET['month']) ? $_GET['month'] : date('m');

$sel_field = isset($_REQUEST['sel_field']) ? clean_xss_tags($_REQUEST['sel_field'], 1, 1) : '';
$search = isset($_GET['search']) ? get_search_string($_GET['search']) : '';

if($search) { //검색어가 있는 경우 해당 검색어로 일정이 있는 마지막달을 리턴한다.
   $sql =  "select next_doctor_datetime from SF_PRESCRIPTION where PATIENT_ID = '{$member['salesforce_id']}' and next_doctor_datetime is not null ";
   if($sel_field == "hospital") {
       $sql .= "and HOSPITAL like '%{$search}%' ";
   } else  if($sel_field == "department") {
       $sql .= "and MEDICAL_DEPARTMENT like '%{$search}%' ";
   } else  if($sel_field == "doctor") {
       $sql .= "and DOCTOR like '%{$search}%' ";
   } else {
       $sql .= "and (HOSPITAL like '%{$search}%' OR  MEDICAL_DEPARTMENT like '%{$search}%' OR  DOCTOR like '%{$search}%' ) ";
   }

   $sql .= " order by next_doctor_datetime desc limit 1 ";

   $row = sql_fetch($sql);

   if($row) {
       $year = date("Y", strtotime($row['next_doctor_datetime']));
       $month = date("m", strtotime($row['next_doctor_datetime']));
   }
}


$is_this_month = date("Y-m") == $year."-".$month; //현재달이면,

$schedule = [];
$sql = "select * from SF_PRESCRIPTION where PATIENT_ID = '{$member['salesforce_id']}' and next_doctor_datetime like '{$year}-{$month}%' ";

$result = sql_query($sql);

while($row = sql_fetch_array($result)) {
    $key = date("j", strtotime($row['next_doctor_datetime']));

    $row['schedule_view_time'] =  date("A H:i", strtotime($row['next_doctor_datetime']));
    $row['schedule_view_time'] =  str_replace(['AM', 'PM'], ['오전', '오후'], $row['schedule_view_time']);
    $schedule['event'][$key] = "<a href='/mypage/schedule_write.php?ID={$row['ID']}'>{$row['HOSPITAL']}<br>{$row['MEDICAL_DEPARTMENT']}<br>{$row['schedule_view_time']}</a>";
}

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

<!-- 페이지 타이틀 -->
<div class="page_navi">
    <div><span><a href="/">홈</a></span><span><a href="/mypage/contract.php">마이페이지</a></span><span>My 슬립케어</span><span>수면데이터</span></div>
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

        <div class="date">
            <span><a href="<?=$prev_mon_link?>"><img src="<?php echo $eyoom_skin_url['mypage']; ?>/images/my_calendar_left.png"></a></span>
            <?=$year?>. <?=$month?>
            <span><a href="<?=$next_mon_link?>"><img src="<?php echo $eyoom_skin_url['mypage']; ?>/images/my_calendar_right.png"></a></span>

            <div class="sort">

            </div>
        </div>

        <div class="calendar">
            <table>
                <tr>
                    <th class="sun">일</th>
                    <th>월</th>
                    <th>화</th>
                    <th>수</th>
                    <th>목</th>
                    <th>금</th>
                    <th class="sat">토</th>
                </tr>

                <!-- 총 주차를 반복합니다. -->
                <?php for ($n = 1, $i = 0; $i < $total_week; $i++): ?>
                    <tr>
                        <!-- 1일부터 7일 (한 주) -->
                        <?php for ($k = 0; $k < 7; $k++): ?>
                            <td>
                                <!-- 시작 요일부터 마지막 날짜까지만 날짜를 보여주도록 -->
                                <?php if ( ($n > 1 || $k >= $start_week) && ($total_day >= $n) ): ?>
                                    <!-- 현재 날짜를 보여주고 1씩 더해줌 -->
                                    <span class="<?= $is_this_month && $today_day == $n ? "today" : ""?><?= $k == 0 ? " sun" : ""?> <?= $k == 6 ? " sat" : ""?>"><?php echo $n;?></span>
                                    <?=$schedule['event'][$n]?>
                                    <?php $n++;?>
                                <?php elseif($k < $start_week) :  ?>
                                    <span class="close"><?php echo date("j", strtotime(($k-$start_week)." day", $start_day_time)) ?></span>
                                <?php elseif( $n > $total_day ) :  ?>
                                   <span class="close"><?php echo date("j", strtotime("+".($k - $end_week_day)." day", $end_day_time)) ?></span>
                                <?php endif; ?>
                            </td>
                        <?php endfor; ?>
                    </tr>
                <?php endfor; ?>
            </table>
        </div>

        <div class="search">
            <form name="fsearch">
            <select name="sel_field">
                <option value="" <?php if($sel_field == "") {echo "selected";} ?>>전체</option>
                <option value="hospital" <?php if($sel_field == "hospital") {echo "selected";} ?>>병원</option>
                <option value="department" <?php if($sel_field == "department") {echo "selected";} ?>>진료과</option>
                <option value="doctor" <?php if($sel_field == "doctor") {echo "selected";} ?>>주치의</option>
            </select>
            <div class="input"><input type="text" name="search" value="<?php echo $search?>"><button type="submit"><img src="<?php echo $eyoom_skin_url['mypage']; ?>/images/my_icon_search.png"></button></div>
            <a href="/mypage/schedule_write.php" class="write">일정등록</a>
            </form>
        </div>

    </div>
</div>
