<?php

?>
<!-- 페이지 타이틀 -->
<div class="page_navi">
    <div><span><a href="/">홈</a></span><span><a href="/mypage/contract.php">마이페이지</a></span><span>주문/배송조회</span><span>주문내역</span></div>
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
    <h2 class="wide">주문내역</h2>
    <h2 class="mob">주문/배송조회 <div id="btn_nav"><a href="javascript:;" class="open"></a></div></h2>
    <div class="menu mob">
        <div>
            <a href="/mypage/myorder.php" class="active">주문내역</a>
            <!--a href="#">취소/교환/반품</a-->
            <a href="/mypage/inquiry.php">상품 문의</a>
            <a href="/mypage/review.php">내가 남긴 리뷰</a>
        </div>
    </div>
</div>

<div id="mypage" class="order1">
    <div class="my_left">
        <ul>
            <li><a href="/mypage/sleep_data.php">My 슬립케어</a></li>
            <li><a href="/mypage/reservation.php">예약 내역</a></li>
            <li><a href="/mypage/myinfo.php">나의 정보</a></li>
            <li class="active"><a href="/mypage/myorder.php">주문/배송조회</a>
                <ul>
                    <li class="on"><a href="/mypage/myorder.php">주문내역</a></li>
                    <li><!--a href="#">취소/교환/반품</a--></li>
                    <li><a href="/mypage/inquiry.php">상품 문의</a></li>
                    <li><a href="/mypage/review.php">내가 남긴 리뷰</a></li>
                </ul>
            </li>
        </ul>
    </div>

    <div class="my_right inner">
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
            <span>총 <?=$total_count?>건</span>
        </div>
        </form>

        <?php foreach($list as $row) {?>
            <div class="order_info">
                <div class="tag"><span class="<?=$row['od_status_class']?>"><?=$row['od_status']?></span></div>
                <a href="/mypage/myorder_view.php?od_id=<?=$row['od_id']?>" class="title"><span>[ <?=$row['od_it_brand']?> ]</span><?=$row['od_it_name']?></a>
                <dl>
                    <dt>주문일</dt><dd><?=substr($row['od_time'], 0, 10)?></dd>
                    <dt>수량</dt><dd><?=$row['od_cart_count']?>개</dd>
                    <dt>결제금액</dt><dd><?=number_format($row['od_price'])?>원</dd>
                    <dt>상태</dt><dd><span><?=$row['od_status']?></span>
                    </dd>
                    <dt>청구상태</dt><dd class="status"></dd>
                </dl>
            </div>
        <?php } ?>

        <?php if($total_count == 0) {?>
            <!-- 데이타가 없을 경우 -->
            <p class="empty">주문내역이 없습니다.</p>
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
