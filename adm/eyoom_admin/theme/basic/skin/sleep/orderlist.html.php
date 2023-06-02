<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/sleep/contractlist.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid-theme.min.css" type="text/css" media="screen">',0);


add_javascript('<script src="'.G5_JS_URL.'/jquery.buttonloadingindicator.js"></script>', 10);

?>

<style>
    .admin-shop-orderlist .orderlist-img img {display:block;width:100% \9;max-width:100%;height:auto}
</style>

<div class="admin-shop-orderlist">
    <form id="frmcontractlist" name="frmcontractlist" class="eyoom-form" method="get">
        <input type="hidden" name="doc" value="<?php echo $doc; ?>">
        <input type="hidden" name="sort1" value="<?php echo $sort1; ?>">
        <input type="hidden" name="sort2" value="<?php echo $sort2; ?>">
        <input type="hidden" name="page" value="<?php echo $page; ?>">
        <input type="hidden" name="save_search" value="<?php echo $search; ?>">
        <input type="hidden" name="dir" value="<?php echo $dir; ?>" id="dir">
        <input type="hidden" name="pid" value="<?php echo $pid; ?>" id="pid">

        <div class="adm-headline">
            <h3>주문내역</h3>
            <a href="javascript:;" id="btn_reload_order" class="btn-e btn-e-red btn-e-lg"><i class="fas fa-refresh"></i> salesforce 주문 내역 갱신</a>
        </div>

        <div class="adm-table-form-wrap adm-search-box">
            <div class="table-list-eb">
                <?php if (!G5_IS_MOBILE) { ?>
                <div class="table-responsive">
                    <?php } ?>
                    <table class="table">
                        <tbody>
                        <tr>
                            <th class="table-form-th">
                                <label class="label">검색어</label>
                            </th>
                            <td colspan="3">
                                <div <?php if (!G5_IS_MOBILE) { ?>class="inline-group"<?php } ?>>
                                    <div class="margin-bottom-5">
                                        <label class="select form-width-150px">
                                            <select name="sel_field" id="sel_field">
                                                <option value="mb_name" <?php echo get_selected($sel_field, 'mb_name'); ?>>회원이름</option>
                                                <option value="mb_hp" <?php echo get_selected($sel_field, 'mb_hp'); ?>>연락처</option>
                                                <option value="ID" <?php echo get_selected($sel_field, 'ID'); ?>>주문ID</option>
                                                <option value="NAME" <?php echo get_selected($sel_field, 'NAME'); ?>>주문번호</option>
                                            </select><i></i>
                                        </label>
                                    </div>
                                    <span>
                                    <label class="input form-width-250px">
                                        <input type="text" name="search" value="<?php echo $search; ?>" id="search"  autocomplete="off">
                                    </label>
                                </span>
                                </div>
                            </td>
                        </tr>


                        <tr>
                            <th class="table-form-th">
                                <label class="label">계약기간</label>
                            </th>
                            <td colspan="3">
                                <div class="inline-group">
                            <span>
                                <label class="input form-width-150px">
                                    <input type="text" id="fr_date" name="fr_date" value="<?php echo $fr_date; ?>" maxlength="10">
                                </label>
                            </span>
                                    <span> - </span>
                                    <span>
                                <label class="input form-width-150px">
                                    <input type="text" id="to_date" name="to_date" value="<?php echo $to_date; ?>" maxlength="10">
                                </label>
                            </span>
                                    <span class="search-btns">
                                <button type="button" onclick="javascript:set_date('오늘');" class="btn-e btn-e-sm btn-e-default">오늘</button>
                                <button type="button" onclick="javascript:set_date('어제');" class="btn-e btn-e-sm btn-e-default">어제</button>
                                <button type="button" onclick="javascript:set_date('이번주');" class="btn-e btn-e-sm btn-e-default">이번주</button>
                                <button type="button" onclick="javascript:set_date('이번달');" class="btn-e btn-e-sm btn-e-default">이번달</button>
                                <button type="button" onclick="javascript:set_date('지난주');" class="btn-e btn-e-sm btn-e-default">지난주</button>
                                <button type="button" onclick="javascript:set_date('지난달');" class="btn-e btn-e-sm btn-e-default">지난달</button>
                                <button type="button" onclick="javascript:set_date('전체');" class="btn-e btn-e-sm btn-e-default">전체</button>
                            </span>
                                </div>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                    <?php if (!G5_IS_MOBILE) { ?>
                </div>
            <?php } ?>
            </div>
        </div>

        <?php echo $frm_submit;?>

    </form>

    <div class="margin-bottom-30"></div>

    <form name="forderlist" id="forderlist" onsubmit="return forderlist_submit(this);" method="post" autocomplete="off" class="eyoom-form">
        <input type="hidden" name="search_od_status" value="<?php echo $od_status; ?>">

        <div class="row">
            <div class="col-sm-8">
                <div class="margin-bottom-5 clearfix">
                <span class="font-size-12 color-grey">
                    <a href="<?php echo G5_ADMIN_URL; ?>/?dir=<?php echo $dir; ?>&amp;pid=<?php echo $pid; ?>">[전체목록]</a><span class="margin-left-10 margin-right-10">|</span>전체 계약내역 <?php echo number_format($total_count); ?>건
                </span>
                    <?php if ($od_status == '준비' && $total_count > 0) {?>
                        <span class="margin-left-10">
                    <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=orderdelivery&amp;wmode=1" onclick="eb_modal_excel(this.href); return false;" class="btn-e btn-e-sm btn-e-green">엑셀배송처리</a>
                </span>
                    <?php } ?>
                </div>
            </div>
        </div>

        <?php if (G5_IS_MOBILE) {?>
            <p class="font-size-11 color-grey text-right margin-bottom-5"><i class="fas fa-info-circle"></i> Note! 좌우스크롤 가능 (<i class="fas fa-arrows-alt-h"></i>)</p>
        <?php } ?>

        <div id="order-list"></div>

        <div class="margin-bottom-30"></div>

        <?php if (($od_status == '' || $od_status == '완료' || $od_status == '전체취소' || $od_status == '부분취소') == false) {?>
            <div class="adm-headline">
                <h3>주문상태변경</h3>
            </div>

            <p>
                <input type="checkbox" name="od_status" value="<?php echo $change_status; ?>"> <?php echo $od_status; ?> 상태에서 <strong><?php echo $change_status; ?></strong> 상태로 변경합니다.
                <?php if ($od_status == '주문' || $od_status == '준비') {?>
                    <input type="checkbox" name="od_send_mail" value="1" id="od_send_mail" checked="checked">
                    <label for="od_send_mail"><?php echo $change_status; ?> 안내 메일</label>
                    <input type="checkbox" name="send_sms" value="1" id="od_send_sms" checked="checked">
                    <label for="od_send_sms"><?php echo $change_status; ?>안내 SMS</label>
                <?php } ?>

                <?php if ($od_status == '준비') {?>
                    <input type="checkbox" name="send_escrow" value="1" id="od_send_escrow">
                    <label for="od_send_escrow">에스크로배송등록</label>
                <?php } ?>

                <input type="submit" value="선택수정" class="btn-e btn-e-xs btn-e-red" onclick="document.pressed=this.value">
                <?php if ($od_status == '주문') {?>
                    <span>주문상태에서만 삭제가 가능합니다.</span>
                    <input type="submit" value="선택삭제" class="btn-e btn-e-xs btn-e-red" onclick="document.pressed=this.value">
                <?php } ?>
            </p>
        <?php } ?>


    </form>

</div>

<?php /* 페이지 */ ?>
<?php echo eb_paging($eyoom['paging_skin']);?>

<div class="modal fade admin-iframe-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">회원 정보 수정</h4>
            </div>
            <div class="modal-body">
                <iframe id="modal-iframe" width="100%" frameborder="0"></iframe>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn-e btn-e-lg btn-e-dark" type="button"><i class="fas fa-times"></i> 닫기</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade admin-excel-iframe-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">엑셀 일괄배송처리</h4>
            </div>
            <div class="modal-body">
                <iframe id="modal-excel-iframe" width="100%" frameborder="0"></iframe>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn-e btn-e-lg btn-e-dark" type="button"><i class="fas fa-times"></i> 닫기</button>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/jsgrid/jsgrid.min.js"></script>
<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/js/jsgrid.js"></script>
<script>
    <?php if (!(G5_IS_MOBILE || $wmode)) { ?>
    function eb_modal(href) {
        $('.admin-iframe-modal').modal('show').on('hidden.bs.modal', function () {
            $("#modal-iframe").attr("src", "");
            $('html').css({overflow: ''});
        });
        $('.admin-iframe-modal').modal('show').on('shown.bs.modal', function () {
            $("#modal-iframe").attr("src", href);
            $('#modal-iframe').height(parseInt($(window).height() * 0.85));
            $('html').css({overflow: 'hidden'});
        });
        return false;
    }

    function eb_modal_excel(href) {
        $('.admin-excel-iframe-modal').modal('show').on('hidden.bs.modal', function () {
            $("#modal-excel-iframe").attr("src", "");
            $('html').css({overflow: ''});
        });
        $('.admin-excel-iframe-modal').modal('show').on('shown.bs.modal', function () {
            $("#modal-excel-iframe").attr("src", href);
            $('#modal-excel-iframe').height(parseInt($(window).height() * 0.65));
            $('html').css({overflow: 'hidden'});
        });
        return false;
    }

    window.closeModal = function(){
        $('.admin-iframe-modal').modal('hide');
    };
    <?php } ?>

    $(document).ready(function(){
        $('#fr_date').datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd',
            prevText: '<i class="fas fa-angle-left"></i>',
            nextText: '<i class="fas fa-angle-right"></i>',
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
            prevText: '<i class="fas fa-angle-left"></i>',
            nextText: '<i class="fas fa-angle-right"></i>',
            showMonthAfterYear: true,
            monthNames: ['년 1월','년 2월','년 3월','년 4월','년 5월','년 6월','년 7월','년 8월','년 9월','년 10월','년 11월','년 12월'],
            monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
            dayNamesMin: ['일','월','화','수','목','금','토'],
            onSelect: function(selectedDate){
                $('#fr_date').datepicker('option', 'maxDate', selectedDate);
            }
        });
    });

    !function () {
        var db = {
            deleteItem: function (deletingClient) {
                var clientIndex = $.inArray(deletingClient, this.clients);
                this.clients.splice(clientIndex, 1)
            },
            insertItem: function (insertingClient) {
                this.clients.push(insertingClient)
            },
            loadData  : function (filter) {
                return $.grep(this.clients, function (client) {
                    return !(filter.체크 && !(client.체크.indexOf(filter.체크) > -1) )
                })
            },
            updateItem: function (updatingClient) {}
        };
        window.db    = db,
            db.clients   = [
                <?php for ($i=0; $i<count((array)$list); $i++) { ?>
                {
                    체크: "<input type='hidden' name='order_id[<?php echo $i; ?>]' value='<?php echo $list[$i]['ID']; ?>' id='order_id_<?php echo $i; ?>'><label for='chk_<?php echo $i; ?>' class='checkbox'><input type='checkbox' name='chk[]' value='<?php echo $i; ?>' id='chk_<?php echo $i; ?>'><i></i></label>",
                    주문ID: "<?php echo $list[$i]['ID']?>",
                    주문번호: "<?php echo $list[$i]['NAME']; ?>",
                    환자ID: "<?php echo $list[$i]['PATIENT_ID']?>",
                    환자이름: "<?php echo $list[$i]['PATIENT']?>",
                    주문일자: "<?php echo $list[$i]['ORDER_DATE']?>",
                    제품: "<?php echo $list[$i]['PRODUCT']?>",
                    수량: "<?php echo $list[$i]['QUANTITY']?>",
                    단가: "<?php echo $list[$i]['PRICE']?>",
                    출고방법: "<?php echo $list[$i]['DELIVERY_METHOD']?>",
                    송장번호: "<?php echo $list[$i]['INVOICE_NUMBER'];?>",
                    입금수단: "<?php echo $list[$i]['PAYMENT_METHOD'];?>",
                },
                <?php } ?>
            ]
    }();

    $(document).ready(function(){
        $("#order-list").jsGrid({
            filtering      : false,
            editing        : false,
            sorting        : false,
            paging         : true,
            autoload       : true,
            controller     : db,
            deleteConfirm  : "정말로 삭제하시겠습니까?\n한번 삭제된 데이터는 복구할수 없습니다.",
            pageButtonCount: 5,
            pageSize       : <?php echo $config['cf_page_rows']; ?>,
            width          : "100%",
            height         : "auto",
            fields         : [
                { name: "체크", type: "text", width: 40 },
                { name: "환자이름", type: "text", align: "center", width: 100 },
                { name: "환자ID", type: "text", align: "center", width: 140 },
                { name: "주문ID", type: "text", align: "center", width: 150, },
                { name: "주문번호", type: "text", align: "center", width: 150 },
                { name: "주문일자", type: "text", align: "center",  width: 100 },
                { name: "제품", type: "text",  align: "left", width: '' },
                { name: "수량", type: "number", align: "center",  width: 100 },
                { name: "단가", type: "number", align: "right", width: 140 },
                { name: "출고방법", type: "text", align: "center",  width: 100 },
                { name: "송장번호", type: "text", width: 100 },
                { name: "입금수단", type: "text", width: 100 },
            ]
        })

        var $chk = $(".jsgrid-table th:first-child");
        if ($chk.text() == '체크') {
            var html = '<label for="chkall" class="checkbox"><input type="checkbox" name="chkall" id="chkall" value="1" onclick="check_all(this.form)"><i></i></label>';
            $chk.html(html);
        }
    });
</script>

<script>
    $(function(){

        $("#btn_reload_order").click(function(e) {
            if(!confirm('주문 내역을 다시 불러오시겠습니까?')) {
                return;
            }
            e.preventDefault();

            $that = $(this);
            $that.startLoading();

            $.ajax({
                url: "/adm/ajax.salesforce.php",
                type: "POST",
                cache: false,
                dataType: "json",
                data: {action: 'order'},
                success: function (response) {
                    if (response.code != 200) {
                        $that.stopLoading();
                        return;
                    }
                    $that.stopLoading();
                    location.reload();
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    $that.stopLoading();
                }
            });
        });

        // 주문상품보기
        $(".orderitem").on("click", function() {
            var $this = $(this);
            var od_id = $this.text().replace(/[^0-9]/g, "");

            if($this.next("#orderitemlist").size())
                return false;

            $("#orderitemlist").remove();

            $.post(
                "<?php echo G5_ADMIN_URL; ?>/shop_admin/ajax.orderitem.php",
                { od_id: od_id },
                function(data) {
                    $this.after("<div id=\"orderitemlist\"><div class=\"itemlist\"></div></div>");
                    $("#orderitemlist .itemlist")
                        .html(data)
                        .append("<div id=\"orderitemlist_close\" class=\"text-right\"><button type=\"button\" id=\"orderitemlist-x\" class=\"btn-e btn-e-sm btn-e-dark\">닫기</button></div>");
                }
            );

            return false;
        });

        // 상품리스트 닫기
        $("#sodr_list").on("click", "#orderitemlist-x", function(e) {
            $("#orderitemlist").remove();
        });

        $("body").on("click", function(e) {
            if ($(e.target).closest("#orderitemlist").length === 0){
                $("#orderitemlist").remove();
            }
        });

        // 엑셀배송처리창
        $("#order_delivery").on("click", function() {
            var opt = "width=600,height=450,left=10,top=10";
            window.open(this.href, "win_excel", opt);
            return false;
        });
    });

    function forderlist_submit(f) {
        if (!is_checked("chk[]")) {
            alert(document.pressed+" 하실 항목을 하나 이상 선택하세요.");
            return false;
        }

        /*
        switch (f.od_status.value) {
            case "" :
                alert("변경하실 주문상태를 선택하세요.");
                return false;
            case '주문' :

            default :

        }
        */

        if(document.pressed == "선택삭제") {
            if(confirm("선택한 자료를 정말 삭제하시겠습니까?")) {
                f.action = "<?php echo G5_ADMIN_URL; ?>/?dir=shop&pid=orderlistdelete&smode=1";
                return true;
            }
            return false;
        }

        var change_status = f.od_status.value;

        if (f.od_status.checked == false) {
            alert("주문상태 변경에 체크하세요.");
            return false;
        }

        var chk = document.getElementsByName("chk[]");

        for (var i=0; i<chk.length; i++)
        {
            if (chk[i].checked)
            {
                var k = chk[i].value;
                var current_settle_case = f.elements['current_settle_case['+k+']'].value;
                var current_status = f.elements['current_status['+k+']'].value;

                switch (change_status)
                {
                    case "입금" :
                        if (!(current_status == "주문" && current_settle_case == "무통장")) {
                            alert("'주문' 상태의 '무통장'(결제수단)인 경우에만 '입금' 처리 가능합니다.");
                            return false;
                        }
                        break;

                    case "준비" :
                        if (current_status != "입금") {
                            alert("'입금' 상태의 주문만 '준비'로 변경이 가능합니다.");
                            return false;
                        }
                        break;

                    case "배송" :
                        if (current_status != "준비") {
                            alert("'준비' 상태의 주문만 '배송'으로 변경이 가능합니다.");
                            return false;
                        }

                        var invoice      = f.elements['od_invoice['+k+']'];
                        var invoice_time = f.elements['od_invoice_time['+k+']'];
                        var delivery_company = f.elements['od_delivery_company['+k+']'];

                        if ($.trim(invoice_time.value) == '') {
                            alert("배송일시를 입력하시기 바랍니다.");
                            invoice_time.focus();
                            return false;
                        }

                        if ($.trim(delivery_company.value) == '') {
                            alert("배송업체를 입력하시기 바랍니다.");
                            delivery_company.focus();
                            return false;
                        }

                        if ($.trim(invoice.value) == '') {
                            alert("운송장번호를 입력하시기 바랍니다.");
                            invoice.focus();
                            return false;
                        }

                        break;
                }
            }
        }

        if (!confirm("선택하신 주문서의 주문상태를 '"+change_status+"'상태로 변경하시겠습니까?"))
            return false;

        f.action = "<?php echo G5_ADMIN_URL; ?>/?dir=shop&pid=orderlistupdate&smode=1";
        return true;
    }

    function set_date(today) {
        <?php
        $date_term = date('w', G5_SERVER_TIME);
        $week_term = $date_term + 7;
        $last_term = strtotime(date('Y-m-01', G5_SERVER_TIME));
        ?>
        if (today == "오늘") {
            document.getElementById("fr_date").value = "<?php echo G5_TIME_YMD; ?>";
            document.getElementById("to_date").value = "<?php echo G5_TIME_YMD; ?>";
        } else if (today == "어제") {
            document.getElementById("fr_date").value = "<?php echo date('Y-m-d', G5_SERVER_TIME - 86400); ?>";
            document.getElementById("to_date").value = "<?php echo date('Y-m-d', G5_SERVER_TIME - 86400); ?>";
        } else if (today == "이번주") {
            document.getElementById("fr_date").value = "<?php echo date('Y-m-d', strtotime('-'.($date_term + 6).' days', G5_SERVER_TIME)); ?>";
            document.getElementById("to_date").value = "<?php echo date('Y-m-d', G5_SERVER_TIME); ?>";
        } else if (today == "이번달") {
            document.getElementById("fr_date").value = "<?php echo date('Y-m-01', G5_SERVER_TIME); ?>";
            document.getElementById("to_date").value = "<?php echo date('Y-m-d', G5_SERVER_TIME); ?>";
        } else if (today == "지난주") {
            document.getElementById("fr_date").value = "<?php echo date('Y-m-d', strtotime('-'.$week_term.' days', G5_SERVER_TIME)); ?>";
            document.getElementById("to_date").value = "<?php echo date('Y-m-d', strtotime('-'.($week_term - 6).' days', G5_SERVER_TIME)); ?>";
        } else if (today == "지난달") {
            document.getElementById("fr_date").value = "<?php echo date('Y-m-01', strtotime('-1 Month', $last_term)); ?>";
            document.getElementById("to_date").value = "<?php echo date('Y-m-t', strtotime('-1 Month', $last_term)); ?>";
        } else if (today == "전체") {
            document.getElementById("fr_date").value = "";
            document.getElementById("to_date").value = "";
        }
    }
</script>