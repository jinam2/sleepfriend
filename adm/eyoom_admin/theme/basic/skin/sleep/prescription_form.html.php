<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/sleep/prescription_form.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$prescription['schedule_date'] = $prescription['next_doctor_datetime'] ? substr($prescription['next_doctor_datetime'], 0, 10) : "";
$prescription['schedule_time'] = $prescription['next_doctor_datetime'] ? date("H:i A", strtotime($prescription['next_doctor_datetime'])) : "";
$prescription['schedule_time']  = str_replace(['AM', 'PM'], ['오전', '오후'], $prescription['schedule_time'] );

?>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/eyoom-form/plugins/jquery-timepicker/jquery.timepicker.min.js"></script>

<div class="admin-member-form">
    <div class="adm-headline">
        <h3>처방 내역 정보</h3>
    </div>

    <form name="fwrite" id="fwrite" method="post" action="<?php echo $action_url1; ?>" onsubmit="return fwrite_submit(this);" class="eyoom-form">
        <input type="hidden" name="w" value="<?php echo $w ?>">
        <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
        <input type="hidden" name="stx" value="<?php echo $stx ?>">
        <input type="hidden" name="sst" value="<?php echo $sst ?>">
        <input type="hidden" name="sod" value="<?php echo $sod ?>">
        <input type="hidden" name="page" value="<?php echo $page ?>">
        <input type="hidden" name="wmode" value="<?php echo $wmode ?>">
        <input type="hidden" name="fid" value="<?php echo $fid ?>">
        <input type="hidden" name="token" value="">

        <div class="adm-table-form-wrap margin-bottom-30">
            <header><strong><i class="fas fa-caret-right"></i> 슬립프렌드 계약 정보</strong></header>
            <div class="table-list-eb">
                <?php if (!G5_IS_MOBILE) { ?>
                <div class="table-responsive">
                    <?php } ?>
                    <table class="table">
                        <tbody>
                        <tr>
                            <th class="table-form-th">
                                사용자 정보
                            </th>
                            <td>
                                [<?=$mem['mb_name']?>] <?=$prescription['PATIENT_ID']?>
                            </td>
                            <th class="table-form-th border-left-th">
                                보험구분
                            </th>
                            <td>
                                <?=$contract['TYPE_OF_INSURANCE']?>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                계약제품
                            </th>
                            <td>
                                [<?=$contract['PRODUCT_FAMILY']?>] <?=$contract['DEVICE_MODEL_NAME']?>
                            </td>
                            <th class="table-form-th border-left-th">
                                종류/타입
                            </th>
                            <td>
                                <?=$contract['OPERATION_TYPE']?>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                실제계약기간
                            </th>
                            <td>
                                <?=$contract['REAL_START_DATE']?> ~ <?=$contract['REAL_EXPIRE_DATE']?>
                            </td>

                            <th class="table-form-th border-left-th">
                                처방-요양기관명
                            </th>
                            <td>
                                <?=$contract['PRESCRIPTION_HOSPITAL']?>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                    <?php if (!G5_IS_MOBILE) { ?>
                </div>
            <?php } ?>
            </div>
        </div>


        <div class="adm-table-form-wrap margin-bottom-30">
            <header><strong><i class="fas fa-caret-right"></i> 슬립프렌드 처방 정보</strong></header>
            <div class="table-list-eb">
                <?php if (!G5_IS_MOBILE) { ?>
                <div class="table-responsive">
                    <?php } ?>
                    <table class="table">
                        <tbody>
                        <tr>
                            <th class="table-form-th">
                                요양기관 / 진료과목
                            </th>
                            <td>
                                <?=$prescription['HOSPITAL']?> / <?=$prescription['MEDICAL_DEPARTMENT']?>
                            </td>
                            <th class="table-form-th border-left-th">
                                주치의
                            </th>
                            <td>
                                <?=$prescription['DOCTOR']?>
                            </td>
                        </tr>

                        <tr>
                            <th class="table-form-th">
                                처방일자
                            </th>
                            <td>
                                <?=$prescription['ISSUE_DATE']?>
                            </td>
                            <th class="table-form-th border-left-th">
                                처방번호
                            </th>
                            <td>
                                <?=$prescription['PRESCRIPTION_NUMBER']?> <a href="/mypage/prescription_png.php?ID=<?=$prescription['ID']?>" target="_blank"><i class='fas fa-download margin-right-5 hidden-xs'></i></a>
                            </td>
                        </tr>

                        <tr>
                            <th class="table-form-th">
                                처방시작 ~ 만료일
                            </th>
                            <td>
                                <?=$prescription['START_DATE']?> ~  <?=$prescription['END_DATE']?>
                            </td>
                            <th class="table-form-th border-left-th">
                                처방상태
                            </th>
                            <td>
                                <?=$prescription['PRESCRIPTION_STATUS']?>
                            </td>
                        </tr>

                        <tr>
                            <th class="table-form-th">

                            </th>
                            <td colspan="3">

                            </td>
                        </tr>

                        <tr>
                            <th class="table-form-th">
                                순응도 보고서 크롤링
                            </th>
                            <td colspan="3">
                                <div class="inline-group">
                                    <span>
                                         <label class="input form-width-250px">
                                            <i class="icon-append far fa-calendar-alt"></i>
                                            <input type="text" name="from_date" id="from_date" value="" readonly>
                                        </label>
                                    </span>
                                    <span>
                                         <label class="input form-width-250px">
                                            <i class="icon-append far fa-calendar-alt"></i>
                                            <input type="text" name="to_date" id="to_date" value="" readonly>
                                        </label>
                                    </span>

                                    <span>
                                        <input type="button" name="btn_crawling_airview" value="순응도 보고서 생성" class="btn-e btn-e-lg btn-e-green" accesskey="s" onclick="document.pressed=this.value">
                                    </span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">순응도 보고서 생성 내역</th>
                            <td colspan="3">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>순번</th>
                                        <th>파일명</th>
                                        <th>사용량</th>
                                        <th>평균사용</th>
                                        <th>누출-중간값</th>
                                        <th>무호흡지수-중앙</th>
                                        <th>생성목적</th>
                                        <th>삭제</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($report_list as $row) {
                                        $pdf_values = MediUtil::extractComplianceValues($row['pdf_data']);
                                        $row['pdf_values'] = $pdf_values;

                                        $row['pdf_link'] =  G5_DATA_URL."/downloads/".$row['pdf_filename'];
                                        $row['total_avg_used_hourmin']  = $row['total_avg_used_minute'] <=60 ?  $row['total_avg_used_minute']."분" : sprintf(" %d시간 %d분", floor($row['total_avg_used_minute'] / 60), $row['total_avg_used_minute'] % 60);
                                     ?>
                                    <tr>
                                        <td style="text-align: center"><?=$row['seq']?></td>
                                        <td style="text-align: center"><a href='<?=$row['pdf_link']?>' target='_blank'><strong><?=$row['pdf_filename']?></strong><i class='fas fa-download margin-right-5 hidden-xs'></i></a></td>
                                        <td style="text-align: center"><?=$row['pdf_values']['사용량']?></td>
                                        <td style="text-align: center"><?=$row['total_avg_used_hourmin']?></td>
                                        <td style="text-align: center"><?=$row['leak_median_value']?></td>
                                        <td style="text-align: center"><?=$row['ahi_median_value']?></td>
                                        <td style="text-align: center"><?=$row['creation_purpose']?></td>
                                        <td style="text-align: center"><a href="javascript:;" class="btn_delete_report" data-seq="<?=$row['seq']?>">삭제</a></td>
                                    </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                    <?php if (!G5_IS_MOBILE) { ?>
                </div>
            <?php } ?>
            </div>
        </div>

        <div class="adm-table-form-wrap margin-bottom-30">
            <header><strong><i class="fas fa-caret-right"></i>  다음 방문일정</strong></header>
            <div class="table-list-eb">
                <?php if (!G5_IS_MOBILE) { ?>
                <div class="table-responsive">
                    <?php } ?>
                    <table class="table">
                        <tbody>
                        <tr>
                            <th class="table-form-th">
                                <label for="schedule_date" class="label">방문일정</label>
                            </th>
                            <td colspan="3">
                                <div class="inline-group">
                                    <span>
                                         <label class="input form-width-250px">
                                            <i class="icon-append far fa-calendar-alt"></i>
                                            <input type="text" name="schedule_date" id="schedule_date" value="<?php echo $prescription['schedule_date']; ?>">
                                        </label>
                                    </span>
                                    <span>
                                        <label class="input">
                                            <i class="icon-append far fa-clock"></i>
                                            <input type="text" name="schedule_time" id="schedule_time" class="ui-timepicker-input"  value="<?php echo $prescription['schedule_time'];?>" autocomplete="off">
                                        </label>
                                    </span>
                                    <span>
                                        <input type="button" name="btn_update_schedule" value="방문일정 변경" class="btn-e btn-e-lg btn-e-yellow" accesskey="s" onclick="document.pressed=this.value">
                                    </span>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <th class="table-form-th">
                                메모
                            </th>
                            <td>
                                <?=$prescription['schedule_memo']?>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                    <?php if (!G5_IS_MOBILE) { ?>
                </div>
            <?php } ?>
            </div>
        </div>

        <?php echo $frm_submit; ?>

    </form>
</div>

<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/eyoom-form/plugins/jquery-maskedinput/jquery.maskedinput.min.js"></script>
<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/eyoom-form/plugins/jquery-chained/jquery.chained.remote.min.js"></script>

<script>
    $(document).ready(function() {
        $('#schedule_date').datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd',
            minDate: 0,
            prevText: '<i class="fas fa-angle-left"></i>',
            nextText: '<i class="fas fa-angle-right"></i>',
            showMonthAfterYear: true,
            monthNames: ['년 1월', '년 2월', '년 3월', '년 4월', '년 5월', '년 6월', '년 7월', '년 8월', '년 9월', '년 10월', '년 11월', '년 12월'],
            monthNamesShort: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
            dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
        });

        $('#from_date').datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd',
            prevText: '<i class="fas fa-angle-left"></i>',
            nextText: '<i class="fas fa-angle-right"></i>',
            showMonthAfterYear: true,
            monthNames: ['년 1월', '년 2월', '년 3월', '년 4월', '년 5월', '년 6월', '년 7월', '년 8월', '년 9월', '년 10월', '년 11월', '년 12월'],
            monthNamesShort: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
            dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
            onSelect: function(selectedDate) {
                $('#to_date').datepicker('option', 'minDate', selectedDate);
            }
        });


        $('#to_date').datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd',
            prevText: '<i class="fas fa-angle-left"></i>',
            nextText: '<i class="fas fa-angle-right"></i>',
            showMonthAfterYear: true,
            monthNames: ['년 1월', '년 2월', '년 3월', '년 4월', '년 5월', '년 6월', '년 7월', '년 8월', '년 9월', '년 10월', '년 11월', '년 12월'],
            monthNamesShort: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
            dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
        });
    });

    $('input[name=schedule_time]').timepicker({
        timeFormat: 'h:i A',
        interval: 30,
        minTime : '09:00',
        lang : {
            am: '오전', pm: '오후', AM: '오전', PM: '오후', decimal: '.', mins: 'mins', hr: 'hr', hrs: 'hrs'
        }
    });


    $(".btn_delete_report").click(function(e) {
        if(!confirm("보고서를 삭제하시겠습니까?")) {
            return;
        }
        var params = {
            action: 'delete_report',
        }
        params['seq'] = $(this).data("seq");
        $.ajax({
            url: "/adm/ajax.salesforce.php",
            type: "POST",
            cache: false,
            dataType: "json",
            data: params,
            success: function (response) {
                if (response.code != 200) {
                    alert(response.message);
                    return;
                }
                alert("삭제되었습니다.");
                location.reload();
            },
            error: function (xhr, ajaxOptions, thrownError) {
            }
        });

    });

    $("input[name=btn_update_schedule]").click(function(e) {
        var params = {
            action: 'update_schedule',
        }

        schedule_date = $("input[name=schedule_date]").val();

        temp = $('#schedule_time').timepicker('getTime');

        schedule_hour = temp.getHours();
        schedule_minute = temp.getMinutes();

        params['ID'] = "<?=$prescription['ID']?>";
        params['schedule_date'] = schedule_date;
        params['schedule_hour'] =  schedule_hour;
        params['schedule_minute'] =  schedule_minute;

        $.ajax({
            url: "/adm/ajax.salesforce.php",
            type: "POST",
            cache: false,
            dataType: "json",
            data: params,
            success: function (response) {
                if (response.code != 200) {
                    alert(response.message);
                    return;
                }
                alert("다음 방문일정이 변경 되었습니다.");
            },
            error: function (xhr, ajaxOptions, thrownError) {
            }
        });
    });

    $("input[name=btn_crawling_airview]").click(function(e) {

        $(this).prop('disabled', true);
        var params = {
            action: 'crawling_airview',
        }

        from_date = $("input[name=from_date]").val();
        to_date = $("input[name=to_date]").val();

        if(!from_date || !to_date) {
            alert("사용량을 조회할 날짜 범위를 선택하세요.");
            return;
        }

        params['ID'] = "<?=$prescription['ID']?>";
        params['from_date'] = from_date;
        params['to_date'] =  to_date;

        $.ajax({
            url: "/adm/ajax.salesforce.php",
            type: "POST",
            cache: false,
            dataType: "json",
            data: params,
            success: function (response) {
                if (response.code != 200) {
                    alert(response.message);
                    return;
                }
                alert(response.message);
                location.reload();
            },
            error: function (xhr, ajaxOptions, thrownError) {
            }
        });
    });

</script>

