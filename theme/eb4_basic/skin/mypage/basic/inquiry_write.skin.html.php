<?php


?>
<style>

    /*  주문상세 */
    .order3 .order_top {overflow:hidden; position:relative; width:100%; border-radius:5px; background:#fff; padding:10px; border:1px solid #141751; margin:0 0 60px;}
    .order3 .order_top dl {overflow:hidden;}
    .order3 .order_top dl dt {float:left; width:100px; text-align:center; line-height:30px;  font-weight:600;}
    .order3 .order_top dl dd {float:left; padding:0 40px 0 10px; line-height:30px; color:#5f5f5f;font-weight:400 !important;}
    .order3 .order_view {width:100%; border-radius:5px; background:#fff; padding:20px; border:1px solid #141751; margin:0 0 60px;}
    .order3 .order_view li {overflow:hidden; padding-bottom:20px;}
    .order3 .order_view li + li {margin:20px 0 0; border-top:1px solid #dadada; padding-top:30px;}
    .order3 .order_view li .img {float:left; width:132px; position:relative;}
    .order3 .order_view li .img img {width:100%;}
    .order3 .order_view li .img span {position:absolute; left:50%; bottom:-10px; margin-left:-40px; display:block; width:80px; height:23px; line-height:21px; text-align:center; font-size:12px; font-weight:400; border-radius:20px;}
    .order3 .order_view li .img span.status01 {background:#141751; color:#fff; border:1px solid #141751;} /* 구매 */
    .order3 .order_view li .img span.status02 {background:#ffede5; color:#FD4F00; border:1px solid #FD4F00;} /* 보험렌탈 */
    .order3 .order_view li .img span.status03 {background:#FD4F00; color:#fff; border:1px solid #FD4F00;} /* 비보험렌탈 */
    .order3 .order_view li .desc {float:left; width:calc(100% - 140px); padding-left:20px;}
    .order3 .order_view li .desc table {height:130px;}
    .order3 .order_view li .desc table td {text-align:center; padding:0 10px; word-break:keep-all;}
    .order3 .order_view li .desc table td.title {font-weight:600; line-height:140%;}
    .order3 .order_view li .desc table td.title span {font-weight:400;}
    .order3 .order_view li .desc table td span {display:block;}
    .order3 .order_view li .desc table td .price {color:#141751; font-weight:600;}

    .order3 .order_view .wide {}
    .order3 .order_view .mob {height:auto; display:none;}
    .order3 .order_view .mob th {text-align:left; line-height:25px; word-break:keep-all;}
    .order3 .order_view .mob td {text-align:left !important; line-height:25px; color:#5f5f5f; font-size:13px;}
    .order3 .order_view .mob td.title {text-align:left !important; line-height:120%; font-size:15px; padding-left:0; font-weight:600; padding:0 0 10px; color:#3a3a3a;}
    .order3 .order_view .mob td.title span {font-size:12px; font-weight:400; color:#999;}


    @media all and (max-width:767px) {
        .order3 .order_top {margin:0 0 40px;}
        .order3 .order_top dl dt {width:70px;}
        .order3 .order_top dl dd {padding:0 20px 0 10px;}

        .order3 .order_view li {padding-bottom:10px;}
        .order3 .order_view li .desc table {height:auto;}

        .order3 .order_view .wide {display:none;}
        .order3 .order_view .mob {display:block;}

        .order3 .order_view .mob td.title {font-size:14px;}
        .order3 .order_view .mob td.title span {display:inline-block; font-size:14px; margin:0 6px 0 0;}
    }

    @media all and (max-width:480px) {
        .order3 .order_top dl dt {width:80px;}
        .order3 .order_top dl dd {width:calc(100% - 80px); padding:0;}

    }

</style>
<!-- 페이지 타이틀 -->
<div class="page_navi">
    <div><span><a href="/">홈</a></span><span><a href="/mypage/contract.php">마이페이지</a></span><span>주문/배송조회</span><span>상품 문의</span></div>
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
    <h2 class="wide">상품 문의</h2>
    <h2 class="mob">주문/배송조회 <div id="btn_nav"><a href="javascript:;" class="open"></a></div></h2>
    <div class="menu mob">
        <div>
            <a href="/mypage/myorder.php" >주문내역</a>
            <!--a href="#">취소/교환/반품</a-->
            <a href="/mypage/inquiry.php" class="active">상품 문의</a>
            <a href="/mypage/review.php">내가 남긴 리뷰</a>
        </div>
    </div>
</div>

<div id="mypage" class="order3">
    <div class="my_left">
        <ul>
            <li><a href="/mypage/sleep_data.php">My 슬립케어</a></li>
            <li><a href="/mypage/reservation.php">예약 내역</a></li>
            <li><a href="/mypage/myinfo.php">나의 정보</a></li>
            <li class="active"><a href="/mypage/myorder.php">주문/배송조회</a>
                <ul>
                    <li><a href="/mypage/myorder.php">주문내역</a></li>
                    <li><!--a href="#">취소/교환/반품</a--></li>
                    <li class="on"><a href="/mypage/inquiry.php">상품 문의</a></li>
                    <li><a href="/mypage/review.php">내가 남긴 리뷰</a></li>
                </ul>
            </li>
        </ul>
    </div>

    <div class="my_right inner">

        <h3 class="line">상품 문의</h3>

        <form name="fitemqa" id="fitemqa" method="post" action="<?php echo $action_url ?>" onsubmit="return fitemqa_submit(this);" autocomplete="off">
        <input type="hidden" name="w" value="<?php echo $w ?>">
        <input type="hidden" name="it_id" value="<?php echo $it_id; ?>">
        <input type="hidden" name="od_id" value="<?php echo $od_id; ?>">
        <input type="hidden" name="iq_id" value="<?php echo $iq_id; ?>">
        <input type="hidden" name="iq_category" value="<?php echo $iq_category; ?>">
        <input type="hidden" name="iq_email" value="<?php echo $member['mb_email']; ?>">
        <input type="hidden" name="token" value="0">

        <?php if(!$iq_category || $iq_category == "상품 문의") {?>
        <ul class="order_view">
            <li>
                <div class="img">
                    <a href="/shop/item.php?it_id=<?php echo $qa['it_id']; ?>"><?php echo $qa['it_image']; ?></a>
                </div>
                <div class="desc">
                    <p class="category"><?php echo $qa['ca_name']; ?></p>
                    <p class="name">[ <?php echo $qa['it_brand']; ?> ] <?php echo $qa['it_name']; ?></p>
                    <p><?php echo $qa['it_basic']; ?></p>
                </div>
            </li>
        </ul>
        <?php } else if($iq_category == "주문취소 요청" || $iq_category == "교환/환불 요청")  {?>
            <h3>주문상세정보</h3>
            <div class="order_top">
                <dl>
                    <dt>주문일자</dt><dd><?=substr($od['od_time'], 0, 10)?></dd>
                    <dt>주문번호</dt><dd><?=$od_id?></dd>
                </dl>
            </div>

            <p class="s_title">상품정보</p>
            <ul class="order_view">
                <?php for ($i=0; $i<$order_count; $i++) { ?>
                    <?php foreach ($order[$i]['option'] as $k => $opt) { ?>
                        <?php if ($k==0) { ?><?php } ?>
                        <li>
                            <div class="img">
                                <div class="tag"><span class="<?=$status_class_arr[$opt['ct_status']]?>"><?=$opt['ct_status']?></span></div>
                                <a href="/shop/item.php?it_id=<?php echo $order[$i]['it_id']; ?>"><?php echo $order[$i]['image']; ?></a>
                            </div>
                            <div class="desc">
                                <table class="wide">
                                    <tr>
                                        <td class="title"><span>[ <?php echo $order[$i]['it_brand']; ?> ]</span><?php echo $order[$i]['it_name']; ?></td>
                                        <td>수량  <?php echo number_format($opt['ct_qty']); ?>개</td>
                                        <td>구매가격<span><?php echo number_format($opt['opt_price']); ?>원</span></td>
                                        <td>결제가격<span class="price"><?php echo number_format($opt['sell_price']); ?>원</span></td>
                                        <td>배송비<span><?php echo number_format($opt['ct_send_cost']); ?>원</span></td>
                                    </tr>
                                </table>

                                <table class="mob">
                                    <tr>
                                        <td colspan="2" class="title"><span>[ <?php echo $order[$i]['it_brand']; ?>  ]</span><?php echo $order[$i]['it_name']; ?></td>
                                    </tr>

                                    <tr>
                                        <th>수량</th>
                                        <td><?php echo number_format($opt['ct_qty']); ?>개</td>
                                    </tr>

                                    <tr>
                                        <th>구매가격</th>
                                        <td><span><?php echo number_format($opt['opt_price']); ?>원</span></td>
                                    </tr>

                                    <tr>
                                        <th>결제가격</th>
                                        <td><span class="price"><?php echo number_format($opt['sell_price']); ?>원</span></td>
                                    </tr>

                                    <tr>
                                        <th>배송비</th>
                                        <td><span><?php echo number_format($opt['ct_send_cost']); ?>원</span></td>
                                    </tr>
                                </table>
                            </div>
                        </li>
                    <?php } ?>
                <?php } ?>
            </ul>

        <?php } ?>
        <table class="write">
            <tr>
                <th>분류</th>
                <td>

                    <select name="iq_category_name" disabled>
                        <?php foreach($iq_category_type_names as $key => $value) {
                            ?>
                            <option value="$value" <?=$qa['iq_category'] == $value ? "selected" : ""?>><?=$value?></option>
                        <? } ?>
                    </select>
                </td>
            </tr>

            <tr>
                <th>문의 제목</th>
                <td><input type="text" name="iq_subject" value="<?php echo get_text($qa['iq_subject']); ?>" id="iq_subject" required maxlength="255" placeholder="제목"></td>
            </tr>
            <tr>
                <th>문의 내용</th>
                <td> <?php echo $editor_html; ?></td>
            </tr>
        </table>

        <div class="write_btn">
            <input type="submit" value="저장" class="button"/>
        </div>
        </form>
    </div>
</div>

<script>
    function fitemqa_submit(f)
    {
        <?php echo $editor_js; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>

        var subject = "";
        var content = "";
        $.ajax({
            url: g5_bbs_url+"/ajax.filter.php",
            type: "POST",
            data: {
                "subject": f.iq_subject.value,
                "content": f.iq_question.value
            },
            dataType: "json",
            async: false,
            cache: false,
            success: function(data, textStatus) {
                subject = data.subject;
                content = data.content;
            }
        });

        if (subject) {
            alert("제목에 금지단어('"+subject+"')가 포함되어있습니다");
            f.iq_subject.focus();
            return false;
        }

        if (content) {
            alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
            if (typeof(ed_iq_question) != "undefined")
                ed_iq_question.returnFalse();
            else
                f.iq_question.focus();
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

    var sel_group = "<?=$write['qa_group'] ? $write['qa_group'] : $sel_group?>";
    var qa_group1 = <?=json_encode($category_group_names1, JSON_UNESCAPED_UNICODE)?>;
    var qa_group2 = <?=json_encode($category_group_names2, JSON_UNESCAPED_UNICODE)?>;
    $(function() {

        $("select[name=qa_category]").change(function(e) {
            $("select[name=qa_group]").html('');
            $("select[name=qa_group]").append('<option value="">분류선택</option>');
            if($(this).val() == "매장방문") {
                qa_group1.forEach(function(element, index) {
                    $("select[name=qa_group]").append('<option value="' + element + '" ' + (element == sel_group ? "selected" : "" ) +'>' + element + '</option>');
                });
            } else if($(this).val() == "서비스예약") {
                qa_group2.forEach(function(element, index) {
                    $("select[name=qa_group]").append('<option value="' + element + '" ' + (element == sel_group ? "selected" : "" ) +'>' + element + '</option>');
                });
            } else {

            }
        });

        $("select[name=qa_category]").trigger('change');

       $("#btn_save").click(function (e) {
           var params = {
               action: 'qa_write',
           }

           category = $("select[name=category]").val();
           group = $("select[name=group]").val();
           subject = $("input[name=subject]").val();
           content = $("textarea[name=content]").val();

           params['action'] = 'update_shop_hours';
           params['category'] = category;
           params['group'] = group;
           params['subject'] =  subject ;
           params['content'] =  content ;

           $.ajax({
               url: "/mypage/inquiry.ajax.php",
               type: "POST",
               cache: false,
               dataType: "json",
               data: params,
               success: function (response) {
                   if (response.code != 200) {
                       alert(response.message);
                       return;
                   }
                   alert("등록되었습니다.");
                   location.href="/mypage/inquiry.php";
               },
               error: function (xhr, ajaxOptions, thrownError) {
               }
           });
       });
    });
</script>