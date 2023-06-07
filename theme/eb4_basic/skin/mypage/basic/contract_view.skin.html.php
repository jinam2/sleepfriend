
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

    <div class="my_right inner">

        <div class="frame">
            <h3>계약상품 정보</h3>
            <ul class="table01">
                <li>계약상태<span>유효</span></li>
                <li>상품종류<span><?=$contract['PRODUCT_FAMILY']?></span></li>
                <li>보험구분<span><?=$contract['TYPE_OF_INSURANCE']?></span></li>
                <li>최초계약일<span><?=$contract['START_DATE']?></span></li>
                <li>이용기간<span><?=$contract['REAL_START_DATE']?> ~ <?=$contract['REAL_EXPIRE_DATE']?></span></li>
                <li>요금 납부방법<span><?=$contract['payment']['METHOD']?></span></li>
                <!--li>요금 납부일<span><?=$contract['RENTAL_FEE_PAYDAY']?></span></li-->
            </ul>

            <ul class="table01">
                <li>계약서<span><?=$contract['pdf_link']?></span></li>
                <li>타입<span><?=$contract['OPERATION_TYPE']?></span></li>
                <li>처방기관<span><?=$contract['PRESCRIPTION_HOSPITAL']?></span></li>
                <!--li>계약만료<span><?=$contract['EXPIRE_DATE']?></span></li-->
                <!--li>최근 소모품 지급일<span><?=$contract['MASK_ORDER_DATE']?></span></li-->
                <li>계좌정보<span><?=$contract['payment']['BANKCARD_NAME']?> <?=$contract['payment']['BANKCARD_NUMBER']?> </span></li>
                <!--li>납부금액<span><?=number_format($contract['invoice']['PATIENT_PAYABLE'])?>원</span></li-->
                <li>반납사유<span><?=$contract['RETURN_DATE']?></span></li>
                <li>반납일<span><?=$contract['RETURN_DATE']?></span></li>
            </ul>

            <div class="desc">
                처방전 사진을 업로드해주세요!<br>
                슬립프랜드 Specialist가 검토 후 계약연장을 <span></span>진행해드립니다.<br>
                신청결과는 카카오톡으로 받아볼 수 있습니다.
                <style>


                </style>
                <form name="fupload" method="POST" action="/mypage/upload_prescription.php"  enctype="multipart/form-data">
                    <input id="upload_file" data-id="<?=$contract['ID']?>" type="file" name="file"/>
                    <a href="javascript:;"><label for="upload_file">처방전 등록하기</label></a>
                </form>
            </div>
        </div>

        <?php if(count($contract['prescription_files']) > 0) :?>
        <div class="frame">
            <h3 class="line">처방전 등록내역</h3>

            <table class="table01">
                <tr>
                    <th>등록일</th>
                    <th>등록한 처방전</th>
                    <th>신청결과</th>
                </tr>

                <?php foreach($contract['prescription_files'] as $row) : ?>
                <tr>
                    <td><?=substr($row['bf_datetime'], 0, 10)?></td>
                    <td><a href="<?=G5_DATA_URL?>/<?=$row['bf_file']?>" class="view">보기</a></td>
                    <td><?=$row['bf_status']?></td>
                </tr>
                <?php endforeach;?>
            </table>
        </div>
        <?php endif;?>

        <div class="frame">
            <h3 class="line">처방 내역</h3>
            <table class="table01 wide">
                <tr>
                    <th>요양기관</th>
                    <th>진료과</th>
                    <th>주치의</th>
                    <th>발행일</th>
                    <th>시작일</th>
                    <th>만료일</th>
                    <th>처방값</th>
                    <th>보기</th>
                </tr>

                <?php foreach($contract['PRESCRIPTION'] as $row) { ?>
                <tr>
                    <td><?=$row['HOSPITAL']?></td>
                    <td><?=$row['MEDICAL_DEPARTMENT']?></td>
                    <td><?=$row['DOCTOR']?></td>
                    <td><?=$row['ISSUE_DATE']?></td>
                    <td><?=$row['START_DATE']?></td>
                    <td><?=$row['END_DATE']?></td>
                    <td><?=$row['PRESCRIPTION_VALUE']?>
                    <td><?=$row['pdf_link']?>
                    </td>
                </tr>
                <?php } ?>
            </table>

            <ul class="table02 mob">
                <?php foreach($contract['PRESCRIPTION'] as $row) { ?>
                <li>
                    <dl><dt>요양기관</dt><dd><?=$row['HOSPITAL']?></dd></dl>
                    <dl><dt>진료과</dt><dd><?=$row['MEDICAL_DEPARTMENT']?></dd></dl>
                    <dl><dt>주치의</dt><dd><?=$row['DOCTOR']?></dd></dl>
                    <dl><dt>발행일</dt><dd><?=$row['ISSUE_DATE']?></dd></dl>
                    <dl><dt>시작일</dt><dd><?=$row['START_DATE']?></dd></dl>
                    <dl><dt>만료일</dt><dd><?=$row['END_DATE']?></dd></dl>
                    <dl><dt>처방값</dt><dd><?=$row['PRESCRIPTION_VALUE']?></dd></dl>
                    <dl><dt>보기</dt><dd><?=$row['pdf_link']?></dd></dl>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>

<script>
    $(function() {
        $(document).on("change", "input[name^='file']", function() {
            var formData = new FormData();
            var ID =$(this).data("id");
            formData.append("file", $(this)[0].files[0]);
            formData.append("ID", ID);
            $.ajax({
                url: "/mypage/ajax.prescription_upload.php",
                type: 'POST',
                dataType: 'json',
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                data: formData,
                async: false,
                success: function (response) {
                    if(response['code'] != '200') {
                        alert(response['message']);
                        return;
                    }
                    location.reload();
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr);
                    alert("업로드 오류");
                }
            });
        });
    });
</script>
