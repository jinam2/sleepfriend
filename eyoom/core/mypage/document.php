<?php
/**
 * core file : /eyoom/core/mypage/contract.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 회원체크
 */
if (!$is_member) alert('회원만 접근하실 수 있습니다.',G5_URL);

$doc_type = filter_input(INPUT_GET, 'doc_type', FILTER_VALIDATE_INT);

if(!$doc_type) {
    $doc_type = 1;
}

$list=[];

if($doc_type == 1) {
    //  jinam23 - 230524 edited ORDER BY 
    $sql = "SELECT * FROM SF_CONTRACT WHERE PATIENT_ID='{$member['salesforce_id']}' AND CONTRACT_PDF is not null ORDER BY REAL_EXPIRE_DATE DESC";
    $rows = sql_fetch_all($sql);

    foreach($rows as $row) {
        $download_link = '<a href="/mypage/contract_pdf.php?ID='.$row['ID'].'">다운로드 <img src="/images/my_icon_down.png"></a>';
        if(is_mobile()) {
            $view_link = '<a href="/mypage/contract_pdf.php?ID='.$row['ID'].'">바로보기 <img src="/images/my_icon_zoom.png"/></a>';
        } else {
            $pdf_file = G5_DATA_PATH."/downloads/".$row['ID'].".pdf";
            $view_url = "/data/downloads/".$row['ID'].".pdf";
            $decoded = base64_decode($row['CONTRACT_PDF']);
            file_put_contents($pdf_file, $decoded);
            $view_link = '<a href="'.$view_url.'" target="_blank">바로보기 <img src="/images/my_icon_zoom.png"></a>';
        }
        //$view_link = '<a href="/mypage/contract_pdf.php?ID='.$row['ID'].'&view=1">바로보기 <img src="/images/my_icon_zoom.png"></a>';
        /*
        if(is_mobile()) {
            $view_link = '<a href="'.$view_url.'">바로보기 <img src="/images/my_icon_zoom.png"/></a>';
        } else {
            $view_link = '<a href="'.$view_url.'" target="_blank">바로보기 <img src="/images/my_icon_zoom.png"></a>';
        }
        */
        $doc_title = $row['TYPE_OF_INSURANCE']." ".$row['REAL_START_DATE']."-".$row['REAL_EXPIRE_DATE'];
        $category = '표준계약서';
        $list[] = [
            'category' => $category,
            'doc_title' => $doc_title,
            'download_link' => $download_link,
            'view_link' => $view_link,
        ];
    }
} else if($doc_type == 2) {
    //  $sql = "SELECT * FROM g5_shop_rental WHERE mb_id='{$member['mb_id']}' AND od_file4 <> '' ORDER BY od_datetime DESC";
    //  jinam23 - 230524 edited  , INSPECTION_PDF -> PRESCRIPTION_PDF, prescription_png.php 처방전으로 테스트
    
    $sql = "SELECT 
            sfp.ID, sfc.TYPE_OF_INSURANCE, sfp.MEDICAL_DEPARTMENT, sfp.INSPECTION_PDF
        FROM 
            SF_CONTRACT sfc,
            SF_PRESCRIPTION sfp
        WHERE
            sfc.PATIENT_ID = '{$member['salesforce_id']}' AND
            sfc.PATIENT_ID = sfp.PATIENT_ID AND 
            sfp.INSPECTION_PDF is not null  
        ORDER BY
            sfp.update_datetime DESC" ;
    $rows = sql_fetch_all($sql);
    foreach($rows as $row) {
       
        $download_link = "<a href='/mypage/inspection_pdf.php?ID={$row['ID']}'>다운로드 <img src='/images/my_icon_down.png'></a>" ;
        if(is_mobile()) {
            $view_link = "<a href='/mypage/inspection_pdf.php?ID={$row['ID']}'>바로보기 <img src='/images/my_icon_zoom.png'/></a>";
        } else {
            $pdf_file = G5_DATA_PATH."/downloads/".$row['ID'].".pdf";
            $view_url = "/data/downloads/".$row['ID'].".pdf";    
            $decoded = base64_decode($row['INSPECTION_PDF']);
            file_put_contents($pdf_file, $decoded);
            $view_link = '<a href="'.$view_url.'" target="_blank">바로보기 <img src="/images/my_icon_zoom.png"></a>';
        }
        $doc_title = $row['MEDICAL_DEPARTMENT'];
        $category = $row['TYPE_OF_INSURANCE'];
        $list[] = [
            'category' => $category,
            'doc_title' => $doc_title,
            'download_link' => $download_link,
            'view_link' => $view_link,
        ];
    }

} else if($doc_type == 3) {
    //  230602 - jinam23, 미구현코드 작업
    $sql = "SELECT 
            sfp.ID, sfc.TYPE_OF_INSURANCE, sfp.MEDICAL_DEPARTMENT, sfp.PRESCRIPTION_PDF
        FROM 
            SF_CONTRACT sfc,
            SF_PRESCRIPTION sfp
        WHERE
            sfc.PATIENT_ID = '{$member['salesforce_id']}' AND
            sfc.PATIENT_ID = sfp.PATIENT_ID AND 
            sfp.PRESCRIPTION_PDF is not null  
        ORDER BY
            sfp.update_datetime DESC" ;
    $rows = sql_fetch_all($sql);
    foreach($rows as $row) {
        //var_dump($row) ;
        $download_link = "<a href='/mypage/prescription_pdf.php?ID={$row['ID']}'>다운로드 <img src='/images/my_icon_down.png'></a>" ;
        if(is_mobile()) {
            $view_link = "<a href='/mypage/prescription_pdf.php?ID={$row['ID']}'>바로보기 <img src='/images/my_icon_zoom.png'></a>";
        } else {
            $pdf_file = G5_DATA_PATH."/downloads/".$row['ID'].".pdf";
            $view_url = "/data/downloads/".$row['ID'].".pdf";
    
            $decoded = base64_decode($row['PRESCRIPTION_PDF']);
            file_put_contents($pdf_file, $decoded);
            $view_link = '<a href="'.$view_url.'" target="_blank">바로보기 <img src="/images/my_icon_zoom.png"></a>';
        }
        $doc_title = $row['MEDICAL_DEPARTMENT'];
        $category = $row['TYPE_OF_INSURANCE'];
        $list[] = [
            'category' => $category,
            'doc_title' => $doc_title,
            'download_link' => $download_link,
            'view_link' => $view_link,
        ];
    }
} else if($doc_type == 4) {
    $sql = "select * from patients where  salesforce_id ='{$member['salesforce_id']}' ";

    $patient = sql_fetch($sql);

    $sql = "select * 
            from patient_report_history
            where patient_id='{$patient['id']}' 
              and is_extract = 'y' 
            order by seq desc 
            ";
    $rows = sql_fetch_all($sql);
    foreach($rows as $row) {

        $pdf_link = "/data/downloads/".$row['pdf_filename'];
        $pdf_file = G5_DATA_PATH."/downloads/".$row['pdf_filename'];

        //$down = G5_URL."/mypage/download.php?type=report&id={$row['seq']}"; //다운로드는 download.php 파일이 필요할듯.
        $download_link = '<a href="'.$pdf_link.'" target="_blank">다운로드 <img src="/images/my_icon_down.png"></a>';
        if(is_mobile()) {
            $view_link = '<a href="'.$pdf_link.'">바로보기 <img src="/images/my_icon_zoom.png"></a>';
        } else {
            $view_link = '<a href="'.$pdf_link.'" target="_blank">바로보기 <img src="/images/my_icon_zoom.png"></a>';
        }
        $doc_title = $row['pdf_filename'];
        $category = "데이타 리포트";
        $list[] = [
            'category' => $category,
            'doc_title' => $doc_title,
            'download_link' => $download_link,
            'view_link' => $view_link,
        ];
    }

}



/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/mypage/document.php');

/**
 * HTML 출력
 */
include_once($eyoom_skin_path['mypage'].'/document.skin.html.php');