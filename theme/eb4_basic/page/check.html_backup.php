<?php
/**
 * page file : /theme/THEME_NAME/page/aboutus.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
    .check_result {
        padding-top: 30px;
        display: none;
    }
    .self_result_msg {
        padding:5px;
        font-weight: 600;
        font-size : 1em;
    }
</style>
<div class="sub-page page-check">

	<div class="visual">
		<div class="slogan">
			<h3>나는 수면장애 환자인가?</h3>
			<p>우리나라 대부분의 국민들은 수면 무호흡을 가지고 있지만 <br>인지하지 못하는 환자들이 많습니다.</p>
		</div>
	</div>

	<div class="section section1">

		<h4>슬립프렌드 가정수면검사</h4>
		<p>가정수면검사로 쉽고 빠르고 저렴하게 확인해보세요! <br>진단, 검사, 치료부터 유지관리까지 슬립프렌드가 함께합니다.</p>

		<div class="sub_inc">
			<div class="img">
				<img src="/images/check_img1.png">
			</div>

			<div class="desc">
				<h5>가정수면검사란?<span>Home-Sleep Test</span></h5>
				<p>가정수면검사는 집에서 시행할 수 있는 간이수면검사로 <br><strong>코골이/수면무호흡 진단에 초점</strong>이 맞추어져 있습니다.</p>

				<div class="frame">
					<dl>
						<dt>검사체크항목</dt>
						<dd>
							<ul>
								<li>호흡노력</li>
								<li>호흡흐름</li>
								<li>코골이</li>
								<li>맥박</li>
								<li>산소포화도</li>
							</ul>
						</dd>
					</dl>

					<dl>
						<dt>가정수면검사 장점</dt>
						<dd>
							<ul>
								<li>원하는 날짜 조율 가능</li>
								<li>평소와 비슷한 수면환경</li>
								<li>부담 없고 간편한 검사방법</li>
							</ul>
						</dd>
					</dl>
				</div>

				<p class="q">혹시 나도 수면검사가 필요할까?</p>
			</div>
		</div>

	</div>

	<div class="section section2">
		<h5>혹시 나도 수면검사가 필요할까?</h5>
		<div class="button">
			<a href="javascript:void(0);" onclick="myFunction()"><img src="/images/icon_arrow_w.png">수면 무호흡 자가진단 해보기</a>
		</div>

		<script>
		  function myFunction() {
		  var x = document.getElementById("check");
		  if (x.style.display === "block") {
		x.style.display = "none";
		  } else {
		x.style.display = "block";
		  }
		}
		</script>

		<div id="check" class="check" style="display:none;">
			<h6>수면 설문지</h6>
			<p>각각의 질문을 읽고 '예' 또는 '아니오' 에 체크하십시오.</p>

			<div class="bar"></div>

			<table>
				<tr><th></th><th>예</th><th>아니오</th></tr>
				<tr><td colspan="3" class="bold">S (Snore - 코골이)</td></tr>
				<tr>
					<td>당신은 코골이가 있습니까?</td>
					<td><input type="radio" name="check1" value='yes' id="check1-1"><label for="check1-1"></label></td>
					<td><input type="radio" name="check1" value='no' id="check1-2"><label for="check1-2"></label></td>
				</tr>

				<tr><td colspan="3" class="bold">T (Tired - 피곤합)</td></tr>
				<tr>
					<td>당신은 낮 시간에 피곤합니까?</td>
					<td><input type="radio" name="check2" value='yes' id="check2-1"><label for="check2-1"></label></td>
					<td><input type="radio" name="check2" value='no' id="check2-2"><label for="check2-2"></label></td>
				</tr>

				<tr><td colspan="3" class="bold">O (Obstruction - 무호흡)</td></tr>
				<tr>
					<td>수면 중 호흡을 멈춘다는 말을 들어본 적이 있습니까?</td>
					<td><input type="radio" name="check3" value='yes' id="check3-1"><label for="check3-1"></label></td>
					<td><input type="radio" name="check3" value='no' id="check3-2"><label for="check3-2"></label></td>
                </tr>


				<tr><td colspan="3" class="bold">P (Pressure - 혈압)</td></tr>
				<tr>
					<td>고혈압 진단을 받거나 고혈압 약을 복용하고 있습니까?</td>
					<td><input type="radio" name="check4" value='yes' id="check4-1"><label for="check4-1"></label></td>
					<td><input type="radio" name="check4" value='no' id="check4-2"><label for="check4-2"></label></td>
				</tr>
			</table>
			<p>S.T.O.P 부분 질문 중 '예' 로 체크한 것이 2개 이상이라면 <u>'폐쇄성 수면 무호흡'</u> 가능성이 높습니다.</p>

			<div class="bar"></div>

			<table>
				<tr><th></th><th>예</th><th>아니오</th></tr>
				<tr><td colspan="3" class="bold">B (BMI - 체질량 지수)</td></tr>
				<tr><td colspan="3">
					<ul>
						<li>체중 <input type="text" name ="weight" size="10" style="text-align: center">(Kg) / 키 <input type="text" name="height" size="10" style="text-align: center">(cm)<sup>2</sup> = <input type="text" name='bmi' size="10" readonly style="text-align: center"></li>
					</ul>
				</td></tr>
				<tr><td>그 당신의 체질량 지수 (BMI) 는 28 보다 높습니까?</td>
					<td><input type="radio" name="check5" value='yes' id="check5-1"><label for="check5-1"></label></td>
					<td><input type="radio" name="check5" value='no' id="check5-2"><label for="check5-2"></label></td>
				</tr>

				<tr><td colspan="3" class="bold">A (Age - 나이)</td></tr>
				<tr><td>당신의 나이는 50세 이상 입니까?</td>
					<td><input type="radio" name="check6" value='yes' id="check8-1"><label for="check8-1"></label></td>
					<td><input type="radio" name="check6" value='no' id="check8-2"><label for="check8-2"></label></td></tr>

				<tr><td colspan="3" class="bold">N (Neck - 목둘레)</td></tr>
				<tr>
                    <td>당신의 목둘레가 16인치 이상 입니까? </td>
					<td><input type="radio" name="check7" value='yes' id="check9-1"><label for="check9-1"></label></td>
					<td><input type="radio" name="check7" value='no' id="check9-2"><label for="check9-2"></label></td>
				</tr>

				<tr><td colspan="3" class="bold">G (Gender - 성별)</td></tr>
				<tr><td>당신은 남성입니까?</td>
					<td><input type="radio" name="check8" value='yes' id="check11-1"><label for="check11-1"></label></td>
					<td><input type="radio" name="check8" value='no' id="check11-2"><label for="check11-2"></label></td>
				</tr>
			</table>
			<p>B.A.N.G 부분의 질문 중 '예'로 체크한 것이 2개 이상이라면 '중증도’ 이상의 <u>'폐쇄성 수면 무호흡'</u> 위험성이 높습니다.</p>
            <div class="button">
                <a href="javascript:;" class="btn_self_diagnosis"><img src="/images/icon_arrow_w.png">자가진단 결과보기</a>
            </div>

            <div class="check_result">
                <p class="self_result_msg">
                </p>
                <div class="button">
                    <a href="/page/?pid=service" class="btn_inquiry"><img src="/images/icon_arrow_w.png">문의하기</a>
                </div>
            </div>
		</div>


	</div>

	<div class="section section3">
		<h5>가정수면검사 절차 안내</h5>
		<ul>
			<li>
				<div class="img"><img src="/images/check_step1.png"></div>
				<div class="desc">
					<strong>STEP 1</strong>
					<p>슬립프렌드 회원가입 후 <br>가정수면검사 신청</p>
				</div>
			</li>

			<li>
				<div class="img"><img src="/images/check_step2.png"></div>
				<div class="desc">
					<strong>STEP 2</strong>
					<p>해피콜을 통한 <br>상담 후 예약 일자 확정</p>
				</div>
			</li>

			<li>
				<div class="img"><img src="/images/check_step3.png"></div>
				<div class="desc">
					<strong>STEP 3</strong>
					<p>검사 기기 수령 후 <br>자가 검사 진행</p>
				</div>
			</li>

			<li>
				<div class="img"><img src="/images/check_step4.png"></div>
				<div class="desc">
					<strong>STEP 4</strong>
					<p>1:1 수면 매니저 앱 <br>검사 데이터 리뷰</p>
				</div>
			</li>

			<li>
				<div class="img"><img src="/images/check_step5.png"></div>
				<div class="desc">
					<strong>STEP 5</strong>
					<p>가정수면검사 <br>결과지 및 솔루션 <br>발송</p>
				</div>
			</li>
		</ul>

		<div class="button">
			<a href="/mypage/reservation_write.php?sel=23"><img src="/images/icon_arrow_w.png">가정수면검사 신청하러가기</a>
		</div>
	</div>

</div>

<script>
function compute_bmi(weight, height) {

    if(weight == "" || height == "") return "";

    if(isNaN(parseFloat(height)) || parseFloat(height) == 0) return "0.0";
    if(isNaN(parseFloat(weight)) || parseFloat(weight) == 0) return "0.0";

    var bmi = parseFloat(weight) / Math.pow(parseFloat(height) / 100, 2);

    if(bmi == 0) {
        return 0.0;
    }

    bmi = Math.round(bmi * 100) / 100;
    return bmi;
}

$(function() {
    $('input[name="height"], input[name="weight"]').keyup(function(e) {
        if (/\D/g.test(this.value)) {
            // Filter non-digits from input value.
            this.value = this.value.replace(/\D/g, '');
        }
    });
    $('input[name="height"], input[name="weight"]').blur(function() {
        bmi = compute_bmi($('input[name="weight"]').val(), $('input[name="height"]').val());
        $('input[name="bmi"]').val(bmi);

        $("#check5-1").attr("checked", false);
        $("#check5-2").attr("checked", false);

        if(parseFloat(bmi) > 28.0) {
            $("#check5-1").attr("checked", true);
        } else if(parseFloat(bmi) > 0) {
            $("#check5-2").attr("checked", true);
        }
    });

    $(".btn_self_diagnosis").click(function(e) {
        $(".check_result").slideUp("fast");

        var yes_count = 0;
        var no_count = 0;
        for( i = 1; i <= 8; i++) {
            if(!$("input[name=check" + i + "]").is(":checked")) {
                alert("체크되지 않은 항목이 있습니다.");
                return;
            } else {
               var checked_value = $("input[name=check" + i + "]:checked").val();
               if(checked_value == 'yes') {
                   yes_count++;
               } else if(checked_value == 'no') {
                   no_count++;
               }
            }
        }


        if(yes_count <=2) { //OSA - Low Risk : Yes to 0 - 2 questions
            $(".self_result_msg").html("저위험군");
        } else if(yes_count >=3 && yes_count <=4) { //OSA - Intermediate Risk : Yes to 3 - 4 questions
            $(".self_result_msg").html("저위험군");
        } else if(yes_count >= 5) { //OSA - High Risk : Yes to 5 - 8 questions
            $(".self_result_msg").html("고위험군");
        }
        $(".check_result").slideDown("fast");
    });
});
</script>