<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/sleep/userprescriptionlist.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid-theme.min.css" type="text/css" media="screen">',0);
?>

<style>
    .admin-shop-orderlist .orderlist-img img {display:block;width:100% \9;max-width:100%;height:auto}
</style>

<div class="admin-shop-orderlist">
    <form id="fsearch" name="fsearch" class="eyoom-form" method="get">
        <input type="hidden" name="doc" value="<?php echo $doc; ?>">
        <input type="hidden" name="sort1" value="<?php echo $sort1; ?>">
        <input type="hidden" name="sort2" value="<?php echo $sort2; ?>">
        <input type="hidden" name="page" value="<?php echo $page; ?>">
        <input type="hidden" name="save_search" value="<?php echo $search; ?>">
        <input type="hidden" name="dir" value="<?php echo $dir; ?>" id="dir">
        <input type="hidden" name="pid" value="<?php echo $pid; ?>" id="pid">
        <input type="hidden" name="token" value="">

        <div class="adm-headline">
            <h3>사용자 업로드 처방 목록</h3>
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=sleep&pid=store_form" class="btn-e btn-e-red btn-e-lg"><i class="fas fa-plus"></i> 주소 추가</a>
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
                                                <option value="mb_name" <?php echo get_selected($sel_field, 'mb_name'); ?>>이름</option>
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

    <form name="fboardlist" id="fboardlist"  action="<?php echo $action_url1; ?>" method="post" onsubmit="return fboardlist_submit(this);" method="post" autocomplete="off" class="eyoom-form">
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

        <div id="store-list"></div>

        <div class="margin-bottom-30"></div>

        <?php if ($is_admin == 'super') { ?>
            <div class="margin-top-20">
                <input type="submit" name="act_button" value="선택삭제" class="btn-e btn-e-xs btn-e-dark" onclick="document.pressed=this.value">
            </div>
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
                <h4 class="modal-title">처방전 상태 수정</h4>
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

    window.closeModal = function(){
        $('.admin-iframe-modal').modal('hide');
    };
    <?php } ?>


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
                    체크: "<input type='hidden' name='fid[<?php echo $i; ?>]' value='<?php echo $list[$i]['fid']; ?>' id='fid_<?php echo $i; ?>'><label for='chk_<?php echo $i; ?>' class='checkbox'><input type='checkbox' name='chk[]' value='<?php echo $i; ?>' id='chk_<?php echo $i; ?>'><i></i></label>",
                    이름: "<?php echo $list[$i]['mb_name']?>",
                    CONTRACT_ID: "<?php echo $list[$i]['contract_id']?>",
                    파일명: "<span class='ellipsis'><a <?php if (!(G5_IS_MOBILE || $wmode)) { ?>href='<?php echo G5_ADMIN_URL; ?>/?dir=sleep&pid=userprescription_form&fid=<?php echo $list[$i]['fid']; ?>&w=u&amp;wmode=1' onclick='eb_modal(this.href); return false;'<?php } else { ?>href='javascript:void(0);'<?php } ?> ><i class='fas fa-external-link-alt color-light-grey margin-right-5 hidden-xs'></i><strong><?php echo $list[$i]['bf_source']; ?></strong></a></span>",
                    용량: "<?php echo $list[$i]['bf_filesize']?>",
                    상태: "<?php echo $list[$i]['bf_status']?>",
                    보기: "<?php echo $list[$i]['file_link']?>",
                    날짜: "<?php echo $list[$i]['bf_datetime']?>",
                    기타: "",
                },
                <?php } ?>
            ]
    }();

    $(document).ready(function(){
        $("#store-list").jsGrid({
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
                { name: "이름", type: "text", align: "center", width: 150 },
                { name: "CONTRACT_ID", type: "text", align: "center", width: 150 },
                { name: "파일명", type: "text", align: "center", width: 250 },
                { name: "용량", type: "text", align: "center", width: 80 },
                { name: "상태", type: "text", align: "center", width: 80 },
                { name: "보기", type: "text", align: "center", width: 80 },
                { name: "날짜", type: "text", align: "center", width: 150 },
                { name: "기타", type: "text", align: "left",  width: '' },
            ]
        })

        var $chk = $(".jsgrid-table th:first-child");
        if ($chk.text() == '체크') {
            var html = '<label for="chkall" class="checkbox"><input type="checkbox" name="chkall" id="chkall" value="1" onclick="check_all(this.form)"><i></i></label>';
            $chk.html(html);
        }
    });


    function fboardlist_submit(f) {
        if (!is_checked("chk[]")) {
            alert(document.pressed+" 하실 항목을 하나 이상 선택하세요.");
            return false;
        }

        if(document.pressed == "선택삭제") {
            if(!confirm("선택한 자료를 정말 삭제하시겠습니까?")) {
                return false;
            }
        }

        return true;
    }
</script>
