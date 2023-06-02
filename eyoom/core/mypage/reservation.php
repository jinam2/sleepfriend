<?php
/**
 * core file : /eyoom/core/mypage/contract.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 회원체크
 */
if (!$is_member) alert('회원만 접근하실 수 있습니다.',G5_URL);

/**
 * 활동기록 정보
 */
$page = (int)$_GET['page'];
if (!$page) $page = 1;
if (!$page_rows) $page_rows = 20;
$from_record = ($page - 1) * $page_rows; // 시작 열을 구함


$sql_order = " order by qa_num ";


$status_names = [
    "0" => "상담 예정",
    "1" => "상담 완료",
    "2" => "상담 취소",
];

$status_class_names = [
    "0" => "status01",
    "1" => "status03",
    "2" => "status02",
];


$sql_common = " from {$g5['qa_content_table']} ";
$sql_search = " where qa_type = '0' ";

if(!$is_admin) {
    $sql_search .= " and mb_id = '{$member['mb_id']}' ";
}

if($sca) {
    if (preg_match("/[a-zA-Z]/", $sca))
        $sql_search .= " and INSTR(LOWER(qa_category), LOWER('$sca')) > 0 ";
    else
        $sql_search .= " and INSTR(qa_category, '$sca') > 0 ";
}


$sql = " select count(*) as cnt 
                $sql_common
                $sql_search ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$page_rows = G5_IS_MOBILE ? $qaconfig['qa_mobile_page_rows'] : $qaconfig['qa_page_rows'];
$total_page  = ceil($total_count / $page_rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $page_rows; // 시작 열을 구함

$sql = " select *
                $sql_common
                $sql_search
                $sql_order
                limit $from_record, $page_rows ";
$result = sql_query($sql);

$list = array();
$num = $total_count - ($page - 1) * $page_rows;
$subject_len = G5_IS_MOBILE ? $qaconfig['qa_mobile_subject_len'] : $qaconfig['qa_subject_len'];
for($i=0; $row=sql_fetch_array($result); $i++) {
    $list[$i] = $row;

    $list[$i]['category'] = get_text($row['qa_category']);
    $list[$i]['group'] =  get_text($row['qa_group']);
    $list[$i]['subject'] = conv_subject($row['qa_subject'], $subject_len, '…');

    if ($stx) {
        $list[$i]['subject'] = search_font($stx, $list[$i]['subject']);
    }

    $list[$i]['view_href'] = G5_URL.'/mypage/reservation_view.php?qa_id='.$row['qa_id'].$qstr;

    $list[$i]['icon_file'] = '';
    if(trim($row['qa_file1']) || trim($row['qa_file2'])) {
        $list[$i]['icon_file'] = '<img src="' . $qa_skin_url . '/img/icon_file.gif">';
    }

    $list[$i]['name'] = get_text($row['qa_name']);
    // 사이드뷰 적용시
    //$list[$i]['name'] = get_sideview($row['mb_id'], $row['qa_name']);
    $list[$i]['date'] = substr($row['qa_datetime'], 0, 10);

    $list[$i]['num'] = $num - $i;

    $list[$i]['status'] = $status_names[$row['qa_status']];
    $list[$i]['status_class'] = $status_class_names[$row['qa_status']];
    $list[$i]['reserve_time'] = $row['qa_2'] ? date("Y-m-d A g시 m분", strtotime($row['qa_2'])) : "";
    $list[$i]['reserve_time'] = str_replace(["AM", "PM"], ["오전", "오후"], $list[$i]['reserve_time']);
}

$is_checkbox = false;
$admin_href = '';
if($is_admin) {
    $is_checkbox = true;
    $admin_href = G5_ADMIN_URL.'/qa_config.php';
}



/**
 * 페이징
 */
$paging = $eb->set_paging('/mypage/reservation', '', $qstr);


$list_href = G5_URL.'/mypage/reservation.php';
$write_href = G5_URL.'/mypage/reservation_write.php';

$list_pages = preg_replace('/(\.php)(&amp;|&)/i', '$1?', get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, './qalist.php'.$qstr.'&amp;page='));

$stx = get_text(stripslashes($stx));

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/mypage/reservation.php');

/**
 * HTML 출력
 */
include_once($eyoom_skin_path['mypage'].'/reservation.skin.html.php');