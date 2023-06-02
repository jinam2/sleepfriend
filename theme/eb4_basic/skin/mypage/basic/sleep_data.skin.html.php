
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
    <h2 class="wide">수면데이터</h2>
    <h2 class="mob">My 슬립케어 <div id="btn_nav"><a href="javascript:;" class="open"></a></div></h2>
    <div class="menu mob">
        <div>
            <a href="/mypage/sleep_data.php" class="active">수면데이터</a>
            <!--a href="#">수면매니저</a-->
            <a href="/mypage/contract.php">계약정보</a>
            <!--a href="#">처방정부</a-->
            <a href="/mypage/schedule.php">병원진료일정</a>
            <a href="/mypage/invoice.php">납부내역</a>
            <a href="/mypage/document.php">문서보관함</a>
        </div>
    </div>
</div>

<div id="mypage" class="mycare1">
    <div class="my_left">
        <ul>
            <li class="active"><a href="/mypage/sleep_data.php">My 슬립케어</a>
                <ul>
                    <li class="on"><a href="/mypage/sleep_data.php">수면데이터</a></li>
                    <!--li><a href="#">수면매니저</a></li-->
                    <li><a href="/mypage/contract.php">계약정보</a></li>
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
        </form>

        <!-- status -->
        <div class="status">
            <?php
                $time_icon = MediUtil::getStatusByUseTime($report['total_avg_used_minute'], "icon", "large");
                $time_text = MediUtil::getStatusByUseTime($report['total_avg_used_minute'], "text", "large");
                $time_class = MediUtil::getStatusByUseTime($report['total_avg_used_minute'], "class", "large");
                if($time_icon) {
                    $time_img = "<img src ='{$eyoom_skin_url['mypage']}/images/{$time_icon}'>";
                } else {
                    $time_img = "";
                }

                $leak_icon = MediUtil::getStatusByLeak($report['leak_median_value'], "icon", "large");
                $leak_text = MediUtil::getStatusByLeak($report['leak_median_value'], "text", "large");
                $leak_class = MediUtil::getStatusByLeak($report['leak_median_value'], "class", "large");

                if($leak_icon) {
                    $leak_img = "<img src ='{$eyoom_skin_url['mypage']}/images/{$leak_icon}'>";
                } else {
                    $leak_img = "";
                }

                $ahi_icon = MediUtil::getStatusByAHI($report['ahi_median_value'], "icon", "large");
                $ahi_text = MediUtil::getStatusByAHI($report['ahi_median_value'], "text", "large");
                $ahi_class = MediUtil::getStatusByAHI($report['ahi_median_value'], "class", "large");

                if($ahi_icon) {
                    $ahi_img = "<img src ='{$eyoom_skin_url['mypage']}/images/{$ahi_icon}'>";
                } else {
                    $ahi_img = "";
                }
            ?>
            <ul>
                <li class="">
                    <p>사용시간</p>
                    <?=$time_img?>
                    <span class="<?=$time_class?>"><?=$time_text?></span>
                </li>
                <li class="">
                    <p>수면 무호흡지수</p>
                    <?=$ahi_img?>
                    <span class="<?=$ahi_class?>"><?=$ahi_text?></span>
                </li>
                <li class="">
                    <p>마스크 착용</p>
                    <?=$leak_img?>
                    <span class="<?=$leak_class?>"><?=$leak_text?></span>
                </li>
            </ul>
            <a href="<?=$report['pdf_link']?>"><img src="<?php echo $eyoom_skin_url['mypage']; ?>/images/my_btn_right.png"> 상세 데이터 보기</a>
        </div>

        <div class="analysis">
            <h3>상태 비교 분석</h3>
            <table class="table01">
                <tr>
                    <th>분석기간/체크항목</th>
                    <th>사용시간</th>
                    <th>AHI</th>
                    <th>Leak</th>
                    <th>보고서<br>(PDF)</th>
                </tr>
                <?php foreach($report_list as $row) {

                    $pdf_link = $row ? G5_DATA_URL."/downloads/".$row['pdf_filename'] : "";
                    $pdf_file = G5_DATA_PATH."/downloads/".$row['pdf_filename'];
                    if(is_file($pdf_file)) {
                        $row['pdf_link'] = $pdf_link;
                    }

                    $time_icon = MediUtil::getStatusByUseTime($row['total_avg_used_minute'], "icon");
                    if($time_icon) {
                        $time_img = "<img src ='{$eyoom_skin_url['mypage']}/images/{$time_icon}'>";
                    } else {
                        $time_img = "";
                    }

                    $leak_icon = MediUtil::getStatusByLeak($row['leak_median_value'], "icon");

                    if($leak_icon) {
                        $leak_img = "<img src ='{$eyoom_skin_url['mypage']}/images/{$leak_icon}'>";
                    } else {
                        $leak_img = "";
                    }

                    $ahi_icon = MediUtil::getStatusByAHI($row['ahi_median_value'], "icon");

                    if($ahi_icon) {
                        $ahi_img = "<img src ='{$eyoom_skin_url['mypage']}/images/{$ahi_icon}'>";
                    } else {
                        $ahi_img = "";
                    }

                ?>
                <tr>
                    <td><?=$row['from_date']?> ~ <br><?=$row['to_date']?></td>
                    <td class="icon"><?=$time_img?></td>
                    <td class="icon"><?=$ahi_img?></td>
                    <td class="icon"><?=$leak_img?></td>
                    <td><a href="<?=$row['pdf_link']?>" class="download"><span class="wide">다운로드</span><span class="mob"><img src="<?php echo $eyoom_skin_url['mypage']; ?>/images/my_icon_pdf.png"></span></a></td>
                </tr>
                <?php } ?>
            </table>

        </div>

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
        }

        $("form[name=fsearch]").submit();
    }
</script>
