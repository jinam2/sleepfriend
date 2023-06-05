<?php
/**
 * page file : /theme/THEME_NAME/page/aboutus.html.php
 */
if (!defined('_EYOOM_')) exit;


$it_id = filter_input(INPUT_GET, 'it_id', FILTER_VALIDATE_INT);
$rental_type = "insurance";

$item = get_shop_item($it_id);

if(!$item) {
    alert("렌탈 상품을 선택하세요.", G5_SHOP_URL);
}

?>

<div class="sub-page page-rental1">

	<dl>
		<dt>렌탈 서비스 신청</dt>
		<dd>
			<h4>개인정보 조회 및 제공 동의</h4>
			<p>렌탈 서비스 이용을 위한 개인(신용)정보 조회 및 제공에 동의합니다.</p>

			<ul>
				<li>조회/제공의 목적 : 상거래 설정 유지 및 채권추심을 위한 신용정보 조회, 신용도 평가, 연체 시 채무불이행등록</li>
				<li>조회/제공 대상 기관 : NICE신용평가정보(주)</li>
				<li>조회/제공할 개인(신용)정보 : 성명, 법정생일, 성별, 연락처, 인증번호, 신용평점정보</li>
				<li>등의의 효력(보유 및 이용기간) : 동의일로부터 계약종료일까지</li>
				<li>신용정보를 조회한 기록은 타 금융기관 등에 제공될 수 있으며, 본 계약에 따른 신용정보조회는 신용등급에 영향을 주지 않습니다.</li>
				<li>개인(신용) 조회 및 제공에 동의하지 않을 권리가 있으나, 동의 거부 시 주문이 불가합니다.</li>
			</ul>
		</dd>
	</dl>

	<dl>
		<dt>렌탈 서류 등록</dt>
		<dd>
			<h4>렌탈 서비스 신청 서류 등록</h4>
			<p>렌탈 서비스 이용을 위해 다음 서류를 꼭 등록해주세요. <br>서류 확인 후, 계약 진행을 위해 해피콜 전화를 드립니다. 해피콜 완료 후 결제 및 배송되오니 1670-3171 전화를 꼭 받아주세요.</p>

			<h5>보험 렌탈 신청 서류</h5>

            <form name="fupload" method="POST" action="/shop/ajax.rental.php"  enctype="multipart/form-data">
                <input type="hidden" name="it_id" value="<?=$item['it_id']?>"/>
                <input type="hidden" name="rental_type" value="<?=$rental_type?>"/>
                <table style='table-layout: auto; width: 100%; table-layout: fixed;'>
                    <tr>
                        <th>신분증</th>
                        <td>
                            <input type="file" name="file1" data-name="신분증">
                        </td>
                    </tr>
                    <tr>
                        <th>처방전</th>
                        <td>
                            <input type="file" name="file2" data-name="처방전">
                        </td>
                    </tr>
                    <tr>
                        <th>등록신청서</th>
                        <td>
                            <input type="file" name="file3" data-name="등록신청서">
                        </td>
                    </tr>
                    <tr>
                        <th>수면다원검사결과지</th>
                        <td>
                            <input type="file" name="file4" data-name="수면다원검사결과지">
                        </td>
                    </tr>
                </table>
            </form>

		</dd>
	</dl>

    <div class="act-btn">
        <a id="btn_rental_request" onclick="upload_file(event)">완료</a>
    </div>
</div>

<!-- 모달 -->
<div id="myModal" class="modal modal_rent">
	<div class="modal-content">
		<div class="modal-body">
			<h4>렌탈 접수 완료</h4>

			<div class="product">
				<div class="img">
                    <a href="<?php echo shop_item_url($item['it_id']); ?>"><?php echo get_it_image($item['it_id'], 160, 160)?></a>
				</div>
				<div class="desc">
                    <a href="<?php echo shop_item_url($item['it_id']); ?>">
                        <span>[<?php echo $item['it_brand']?>]</span>
                        <?php echo $item['it_name']?>
					</a>
					<p><!-- it_basic -->
                        <?php echo $item['it_basic']?>
					</p>
				</div>
			</div>
    <?php   /**  230602 - jinam23, Myclose 링크적용  */ ?>
            <div class="btn">
                <a href='/shop/item.php?it_id=<?php echo $item['it_id']; ?>' class="myclose">확인</a>
                <a href="/mypage/contract.php" class="go">계약 목록 보러가기</a>
            </div>

		</div>
	</div>
</div>


<script>

    $(function() {
        $(".myclose").click(function(e) {
            $(this).closest(".modal").fadeOut("fast");
        });
        $(document).click(function(event) {
            if(event.target.id == "myModal") {
                $("#myModal").fadeOut("fast");
            }
        });
    });
    function upload_file(e) {
        //처방 파일 업로드
        // e.preventDefault();
        //debugger;
        var formData = new FormData();
        var it_id =$("input[name='it_id']").val();
        var rental_type =$("input[name='rental_type']").val();

        if( !$("input[name='file1']")[0].files[0] ) {
            alert("신분증을 업로드 하세요") ;
            return false ;
        }
        formData.append("it_id", it_id);
        formData.append("rental_type", rental_type);
        formData.append("file1", $("input[name='file1']")[0].files[0]);
        formData.append("file2", $("input[name='file2']")[0].files[0]);
        formData.append("file3", $("input[name='file3']")[0].files[0]);
        formData.append("file4", $("input[name='file4']")[0].files[0]);

        $.ajax({
            url: "/shop/ajax.rental.php",
            type: 'POST',
            dataType: 'json',
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
            data: formData,
            async: false,
            success: function (response) {
                console.log( response) ;
                if(response['code'] != '200') {
                    alert(response['message']);
                    return;
                }
                //location.reload();
                $("#myModal").fadeIn("fast");
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr);
                alert("업로드 오류");
            }
        });
    }
</script>
