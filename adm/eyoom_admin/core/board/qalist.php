<?php
/**
 * @file    /adm/eyoom_admin/core/board/contentlist.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "300550";

auth_check_menu($auth, $sub_menu, "r");

if (!isset($g5['content_table'])) {
    die('<meta charset="utf-8">/data/dbconfig.php 파일에 <strong>$g5[\'content_table\'] = G5_TABLE_PREFIX.\'content\';</strong> 를 추가해 주세요.');
}

$sql_common = " from {$g5['qa_content_table']} ";
$sql_search = " where qa_type=0 ";


if($qa_category) {
    $sql_search .= " and qa_category = '{$qa_category}' ";
}

if($qa_status) {
    $sql_search .= " and qa_status = '{$qa_status}' ";
}

if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case "qa_name" :
            $sql_search .= " ($sfl = '{$stx}') ";
            break;
        case "mb_id" :
            $sql_search .= " ($sfl = '{$stx}') ";
        default :
            $sql_search .= " ($sfl like '%$stx%') ";
            break;
    }
    $sql_search .= " ) ";
}

// 테이블의 전체 레코드수만 얻음
$sql = " select count(*) as cnt {$sql_common} {$sql_search}";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) {
    $page = 1;
} // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = "select * {$sql_common} {$sql_search} order by qa_id desc limit $from_record, $rows ";
$result = sql_query($sql);
$list = array();
for ($i=0; $row=sql_fetch_array($result); $i++) {
    if($row['qa_status'] == 0) {
        $row['status_text'] = "<span style='color:#FD4F00'>답변 예정</span>";
    } else {
        $row['status_text'] = "<span style='color:#141751'>답변 완료</span>";
    }
    $list[$i] = $row;
}

/**
 * 페이징
 */
$paging = $eb->set_paging('admin', $dir, $pid, $qstr);

/**
 * 검색버튼
 */
$frm_submit  = ' <div class="text-center margin-top-10 margin-bottom-10"> ';
$frm_submit .= ' <input type="submit" value="검색" class="btn-e btn-e-lg btn-e-dark" accesskey="s">' ;
$frm_submit .= '</div>';