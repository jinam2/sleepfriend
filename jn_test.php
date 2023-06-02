<?php
/**
 *  test -jinam23
 *  API -pdf > decode > save
 */
include_once('./_common.php');

$url = 'https://forcecom-2ce--sandbox2.sandbox.my.salesforce-sites.com/services/apexrest/IF_GET_PRESCRIPTION?contid=a032w00000RNQVnAAP' ;

$data = file_get_contents($url) ;
$jsondata = json_decode($data, true);

$data = $jsondata['PRESCRIPTION_LIST'][8] ;
//var_dump($data) ;
var_dump($data['PRESCRIPTION_PDF']) ;
//var_dump($data['INSPECTION_PDF']) ;
$pre_pdf = base64_decode($data['PRESCRIPTION_PDF']);
//$ins_pdf = base64_decode($data['INSPECTION_PDF']);

var_dump($pre_pdf) ;
//var_dump($ins_pdf) ;

unset($data['VALUE']);
unset($data['PRESCRIPTION_PDF']);
//unset($data['INSPECTION_PDF']);

?>