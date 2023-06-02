<?php
/**
 * core file : /eyoom/core/mypage/contract.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 회원체크
 */
if (!$is_member) alert('회원만 접근하실 수 있습니다.',G5_URL);


$sql_common = " from `{$g5['g5_shop_item_qa_table']}` a left join `{$g5['g5_shop_item_table']}` b on (a.it_id=b.it_id) ";
$sql_search = " where (1) ";


if (!$sst) {
    $sst  = "a.iq_id";
    $sod = "desc";
}

$sql_order = " order by $sst $sod ";


if(!$is_admin) {
    $sql_search .= " and mb_id = '{$member['mb_id']}' ";
}

$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];


$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select a.*, b.it_name
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";

$result = sql_query($sql);

$list = array();
$num = $total_count - ($page - 1) * $page_rows;
for($i=0; $row=sql_fetch_array($result); $i++) {
    $list[$i] = $row;

    $list[$i]['subject'] = conv_subject($row['iq_subject'], $subject_len, '…');

    if ($stx) {
        $list[$i]['subject'] = search_font($stx, $list[$i]['subject']);
    }

    $list[$i]['qa_status'] = !trim($list[$i]['iq_answer']) ? 0 : 1;

    $list[$i]['view_href'] = G5_URL.'/mypage/inquiry_view.php?iq_id='.$row['iq_id'].$qstr;

    //$list[$i]['name'] = get_sideview($row['mb_id'], $row['qa_name']);
    $list[$i]['date'] = substr($row['iq_time'], 0, 10);

    $list[$i]['num'] = $num - $i;

    if($row['od_id']) { //주문건이면, 상품명 조회
        // 주문상품
        $sql = " select it_name, ct_option
                        from {$g5['g5_shop_cart_table']}
                        where od_id = '{$row['od_id']}'
                        order by io_type, ct_id
                        limit 1 ";
        $ct = sql_fetch($sql);
        $ct_name = cut_str(get_text($ct['it_name']), 20, "...");

        $list[$i]['it_name'] = $ct_name;
    }
}

$list_href = G5_URL.'/mypage/inquiry.php';
$write_href = G5_URL.'/mypage/inquiry_write.php';

$list_pages = preg_replace('/(\.php)(&amp;|&)/i', '$1?', get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, './qalist.php'.$qstr.'&amp;page='));

/**
 * 페이징
 */
$paging = $eb->set_paging('/mypage/inquiry', '', $qstr);



$stx = get_text(stripslashes($stx));
/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/mypage/inquiry.php');

/**
 * HTML 출력
 */
include_once($eyoom_skin_path['mypage'].'/inquiry.skin.html.php');