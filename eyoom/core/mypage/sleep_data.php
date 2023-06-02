<?php
/**
 * core file : /eyoom/core/mypage/contract.php
 */
if (!defined('_EYOOM_')) exit;


include_once G5_LIB_PATH. "/MediUtil.php";

/**
 * 회원체크
 */
if (!$is_member) alert('회원만 접근하실 수 있습니다.',G5_URL);


$before_7day = date("Y-m-d", strtotime("-7 day", time()));
$today = date("Y-m-d");


$fr_date = isset($_REQUEST['fr_date']) ? preg_replace('/[^0-9 :\-]/i', '', $_REQUEST['fr_date']) : '';
$to_date = isset($_REQUEST['to_date']) ? preg_replace('/[^0-9 :\-]/i', '', $_REQUEST['to_date']) : '';


$sql = "select * from patients where  salesforce_id ='{$member['salesforce_id']}' ";


$patient = sql_fetch($sql);

if(!$patient) {
    alert("수면 데이타 정보가 없습니다.", G5_URL."/mypage/contract.php");
}

$sql_search = "";

if ($fr_date && $to_date) {
    $sql_search .= " and (from_date between '$fr_date' and '$to_date' OR to_date between '$fr_date' and '$to_date') ";
    $qstr .= "&amp;fr_date={$fr_date}&amp;to_date={$to_date}";
}

//수면 데이타
$sql = "select * 
from patient_report_history
where patient_id='{$patient['id']}' 
  and is_extract = 'y' 
order by seq desc 
limit 1";
$report = sql_fetch($sql);


$sql = "select * 
from patient_report_history
where patient_id='{$patient['id']}' 
  and is_extract = 'y' 
  {$sql_search}
order by seq desc 
";

$report_list = sql_fetch_all($sql);

$pdf_link = $report ? G5_DATA_URL."/downloads/".$report['pdf_filename'] : "";
$pdf_file = G5_DATA_PATH."/downloads/".$report['pdf_filename'];
if(is_file($pdf_file)) {
    $report['pdf_link'] = $pdf_link;
}

include_once(G5_PLUGIN_PATH.'/jquery-ui/datepicker.php');

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/mypage/sleep_data.php');

/**
 * HTML 출력
 */
include_once($eyoom_skin_path['mypage'].'/sleep_data.skin.html.php');