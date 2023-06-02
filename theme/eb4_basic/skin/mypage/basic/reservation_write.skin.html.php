<?php
$category_group_names1 = [
    "10" => '임대 상담',
    "11" => '구매 상담',
    "12" => 'A/S 상담',
    "13" => '체험서비스',
    "14" => '세척관리',
    "15" => '데이터 분석',
];

$category_group_names2 = [
    "20" => '신규 방문설치',
    "21" => '방문케어 서비스',
    "22" => '비대면슬립케어박스',
    "23" => '가정수면검사',
    "24" => '화상상담',
    "25" => '매장상담 예약'
];

$sel_group = $_GET['sel_group'];

//$write['reservation_time'] = "23:00";

?>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/eyoom-form/plugins/jquery-timepicker/jquery.timepicker.min.js"></script>
<!-- 페이지 타이틀 -->
<div class="page_navi">
    <div><span><a href="/">홈</a></span><span><a href="/mypage/reservation.php">예약 내역</a></span><span>상담 신청내역</span><span>수면데이터</span></div>
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
    <h2 class="wide">예약 내역</h2>
    <h2 class="mob">예약 내역 <div id="btn_nav"><a href="javascript:;" class="open"></a></div></h2>
</div>

<div id="mypage" class="reservation">
    <div class="my_left">
        <ul>
            <li><a href="/mypage/sleep_data.php">My 슬립케어</a></li>
            <li class="active"><a href="/mypage/reservation.php">예약 내역</a>
                <ul>
                    <li class="on"><a href="/mypage/reservation.php">상담 신청내역</a></li>
                </ul>
            </li>
            <li><a href="/mypage/myinfo.php">나의 정보</a></li>
            <li><a href="/mypage/myorder.php">주문/배송조회</a></li>
        </ul>
    </div>

    <div class="my_right inner">

        <h3 class="line">상담 신청하기</h3>
        <form name="fwrite" id="fwrite" action="<?php echo $action_url ?>" class="eyoom-form" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
        <input type="hidden" name="w" value="<?php echo $w ?>">
        <input type="hidden" name="qa_id" value="<?php echo $qa_id ?>">
        <input type="hidden" name="sca" value="<?php echo $sca ?>">
        <input type="hidden" name="stx" value="<?php echo $stx ?>">
        <input type="hidden" name="page" value="<?php echo $page ?>">
        <input type="hidden" name="token" value="<?php echo $token ?>">
        <input type="hidden" name="token" value="0">
        <input type="hidden" name="qa_subject" value="<?=$write['qa_subject']?>" />
        <input type="hidden" name="qa_email" value="<?=$member['mb_email']?>" />
        <input type="hidden" name="qa_email_recv" value="1" />
        <input type="hidden" name="qa_2" value="<?=$write['qa_2']?>" />
        <?php if(!is_mobile()) {?>
        <table class="write wide">
            <tr>
                <th>상담유형</th>
                <td>
                    <select name="qa_category" required >
                        <option value="">선택하세요</option>
                        <option <?=$write['qa_category'] == '매장방문' || substr($sel,0,1) == "1"  ? "selected" : ""?>>매장방문</option>
                        <option  <?=$write['qa_category'] == '서비스예약' || substr($sel,0,1) == "2" ? "selected" : ""?>>서비스예약</option>
                    </select>
                </td>
                <th>상담제품</th>
                <td>
                    <select name="qa_1" required >
                        <option value="">선택하세요</option>
                        <option <?=$write['qa_1'] == '양압기' ? "selected" : ""?>>양압기</option>
                    </select>
                </td>
            </tr>

            <tr>
                <th>날짜</th>
                <td><div><input type="text" id="reservation_date" name="reservation_date" value="<?=$write['reservation_date']?>" required  style="border:0 !important; background:none !important" ><img src="<?php echo $eyoom_skin_url['mypage']; ?>/images/my_icon_cal.png"></div></td>
                <th>시간</th>
                <td>
                    <input type="text" id="reservation_time" name="reservation_time" value="<?=$write['reservation_time']?>" class="ui-timepicker-input" autocomplete="off" required>
                </td>
            </tr>

            <tr>
                <th>상담분류</th>
                <td colspan="3">
                    <select name="qa_group" required>
                        <option value="">분류선택</option>
                    </select>
                </td>
            </tr>

            <tr>
                <th>상담내용</th>
                <td colspan="3"><?php echo $editor_html; ?></td>
            </tr>
        </table>
        <?php } ?>
        <?php if(is_mobile()) {?>
        <table class="write mob">
            <tr>
                <th>상담유형</th>
                <td>
                    <select name="qa_category" required >
                        <option value="">선택하세요</option>
                        <option <?=$write['qa_category'] == '매장방문' || substr($sel,0,1) == "1"  ? "selected" : ""?>>매장방문</option>
                        <option  <?=$write['qa_category'] == '서비스예약' || substr($sel,0,1) == "2" ? "selected" : ""?>>서비스예약</option>
                    </select>
                </td>
            </tr>

            <tr>
                <th>상담제품</th>
                <td>
                    <select name="qa_1" required >
                        <option value="">선택하세요</option>
                        <option <?=$write['qa_1'] == '양압기' ? "selected" : ""?>>양압기</option>
                    </select>
                </td>
            </tr>

            <tr>
                <th>날짜</th>
                <td><div><input type="text" id="reservation_date" name="reservation_date" value="<?=$write['reservation_date']?>" required  style="border:0 !important; background:none !important" ><img src="<?php echo $eyoom_skin_url['mypage']; ?>/images/my_icon_cal.png"></div></td>
            </tr>

            <tr>
                <th>시간</th>
                <td>
                    <input type="text" id="reservation_time" name="reservation_time" value="<?=$write['reservation_time']?>" class="ui-timepicker-input" autocomplete="off" required>
                </td>
            </tr>

            <tr>
                <th>상담분류</th>
                <td>
                    <select name="qa_group" required>
                        <option value="">분류선택</option>
                    </select>
                </td>
            </tr>

            <tr>
                <th>상담내용</th>
                <td><?php echo $editor_html; ?></td>
            </tr>
        </table>
        <?php } ?>
        <div class="btn">
            <button type="submit" class="button">저장</button>
        </div>
        </form>
    </div>

</div>

<script>
    function fwrite_submit(f)
    {
        <?php echo $editor_js; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>

        debugger;
        var subject = "";
        var content = "";
        var qa_group = $("select[name=qa_group").val();

        var reservation_date = $("#reservation_date").val();
        var reservation_time = $("#reservation_date").val();

        temp = $('#reservation_time').timepicker('getTime');

        var hour = temp.getHours() < 10 ? '0' + temp.getHours() :  temp.getHours() + '';
        var minute = temp.getMinutes() < 10 ? '0' + temp.getMinutes() :  temp.getMinutes() + '';

        $("input[name=qa_subject]").val(qa_group);

        $("input[name=qa_2]").val(reservation_date + " " + hour + ":" + minute + ":00");

        $.ajax({
            url: g5_bbs_url+"/ajax.filter.php",
            type: "POST",
            data: {
                "subject": f.qa_subject.value,
                "content": f.qa_content.value
            },
            dataType: "json",
            async: false,
            cache: false,
            success: function(data, textStatus) {
                subject = data.subject;
                content = data.content;
            }
        });

        if (content) {
            alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
            if (typeof(ed_qa_content) != "undefined")
                ed_qa_content.returnFalse();
            else
                f.qa_content.focus();
            return false;
        }


        $.ajax({
            type: "POST",
            url: g5_bbs_url+"/ajax.write.token.php",
            data: { 'token_case' : 'qa_write' },
            cache: false,
            async: false,
            dataType: "json",
            success: function(data) {
                if (typeof data.token !== "undefined") {
                    token = data.token;

                    if(typeof f.token === "undefined")
                        $(f).prepend('<input type="hidden" name="token" value="">');

                    $(f).find("input[name=token]").val(token);
                }
            }
        });

        document.getElementById("btn_submit").disabled = "disabled";

        return true;
    }

</script>

<script>

    var sel_key = "<?=$sel?>";
    var sel_group = "<?=$write['qa_group'] ? $write['qa_group'] : $sel_group?>";
    var qa_group1 = <?=json_encode($category_group_names1, JSON_UNESCAPED_UNICODE)?>;
    var qa_group2 = <?=json_encode($category_group_names2, JSON_UNESCAPED_UNICODE)?>;
    $(function() {

        $('#reservation_date').datepicker({
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

        $('#reservation_date').attr('readonly', true);

        $('#reservation_time').timepicker({
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

        $("select[name=qa_category]").change(function(e) {
            $("select[name=qa_group]").html('');
            $("select[name=qa_group]").append('<option value="">분류선택</option>');
            if($(this).val() == "매장방문") {
                $.each(qa_group1, function(key, value){
                    console.log(key, value);
                    $("select[name=qa_group]").append('<option value="' + value + '" ' + (key == sel_key || value == sel_group ? "selected" : "" ) +'>' + value + '</option>');
                });
            } else if($(this).val() == "서비스예약") {
                $.each(qa_group2, function(key, value){
                    console.log(key, value);
                    $("select[name=qa_group]").append('<option value="' + value + '" ' + (key == sel_key || value == sel_group ? "selected" : "" ) +'>' + value + '</option>');
                });
            }
        });

        $("select[name=qa_group]").html('');
        $("select[name=qa_group]").append('<option value="">분류선택</option>');
        if($("select[name=qa_category]").val() == "매장방문") {
            $.each(qa_group1, function(key, value){
                console.log(key, value);
                $("select[name=qa_group]").append('<option value="' + value + '" ' + (key == sel_key || value == sel_group ? "selected" : "" ) +'>' + value + '</option>');
            });
        } else if($("select[name=qa_category]").val() == "서비스예약") {
            $.each(qa_group2, function(key, value){
                console.log(key, value);
                $("select[name=qa_group]").append('<option value="' + value + '" ' + (key == sel_key || value == sel_group ? "selected" : "" ) +'>' + value + '</option>');
            });
        }
    });

</script>

