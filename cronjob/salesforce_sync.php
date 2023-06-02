<?php

ini_set('memory_limit','256M');

$cmd = $argv && count($argv) > 1 ? $argv[1] : "";


echo "cmd : {$cmd} \n";

$document_dir = dirname(__DIR__);
chdir($document_dir);

define('_GNUBOARD_', true);

error_reporting( E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_ERROR | E_WARNING | E_PARSE | E_USER_ERROR | E_USER_WARNING );
ini_set('display_errors', '1');

include_once dirname(__DIR__) . "/custom_db_config.php";
include_once dirname(__DIR__) . "/lib/SimpleDB.php";
include_once dirname(__DIR__) . "/lib/SalesForceSync.php";

$db_host = G5_MYSQL_HOST;
$db_user = G5_MYSQL_USER;
$db_password = G5_MYSQL_PASSWORD;
$db_name = G5_MYSQL_DB;


$pdo_db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"));
$pdo_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo_db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

unset($db_host);
unset($db_user);
unset($db_password);
unset($db_name);

$db = new SimpleDB($pdo_db);

$salesforce_sync = new SalesForceSync($pdo_db);

$before = 1;
$from = date("Ymd", strtotime("-{$before} day", time()));
$to = date(date("Ymd"));

$users = $db->query("select mb_id, salesforce_id from g5_member where (salesforce_id is not null and salesforce_id <> '') ");

if(!$cmd) {
    $cmd = "prescription";
}
//contract
if($cmd == "contract") {
    foreach ($users as $user) {
        $response = $salesforce_sync->get_contract($user['salesforce_id']);
        $jsonData = json_decode($response, true);


        if (!is_array($jsonData)) { //정상응답
            continue;
        }

        if ($jsonData['STATUS_CODE'] != 'Success') {
            continue;
        }

        foreach ($jsonData['CONTRACT_LIST'] as $row) {
            //print_r($row);
            $salesforce_sync->insertOrUpdateContract($user['salesforce_id'], $row);
            unset($row['CONTRACT_PDF']);

            print_r($row);
        }

        $db->query("update sleep_config set salesforce_contract_sync_datetime=now() where 1=1 limit 1 ");


    }
}

if($cmd == "order") {
    //order
    foreach ($users as $user) {
        $response = $salesforce_sync->get_order($user['salesforce_id']);
        $jsonData = json_decode($response, true);

        if (!is_array($jsonData)) { //정상응답
            continue;
        }

        if ($jsonData['STATUS_CODE'] != 'Success') {
            continue;
        }

        foreach ($jsonData['ORDER_LIST'] as $row) {
            $salesforce_sync->insertOrUpdateOrder($user['salesforce_id'], $row);
            print_r($row);
        }
    }
}

if($cmd == "invoice") { //청구 조회
    //invoice
    foreach ($users as $user) {
        $response = $salesforce_sync->get_invoice($user['salesforce_id']);
        $jsonData = json_decode($response, true);

        if (!is_array($jsonData)) { //정상응답
            continue;
        }

        if ($jsonData['STATUS_CODE'] != 'Success') {
            continue;
        }

        foreach ($jsonData['INVOICE_LIST'] as $row) {
            $salesforce_sync->insertOrUpdateInvoice($user['salesforce_id'], $row);
            print_r($row);
        }
    }
}

if($cmd == "payment") {

    //invoice
    foreach ($users as $user) {
        $response = $salesforce_sync->get_payment($user['salesforce_id']);
        $jsonData = json_decode($response, true);

        if (!is_array($jsonData)) { //정상응답
            continue;
        }

        if ($jsonData['STATUS_CODE'] != 'Success') {
            continue;
        }

        foreach ($jsonData['PAYMENT_LIST'] as $row) {
            print_r($row);
            $salesforce_sync->insertOrUpdatePayment($user['salesforce_id'], $row);
        }
    }
}


if($cmd == "prescription") { //처방정보
    //todo 계약 정보가 유효한 건만 조회하여 호출하도록 한다.
    $contracts = $db->query("select * from SF_CONTRACT ");

    foreach ($contracts as $contract) {
        $response = $salesforce_sync->get_prescription($contract['ID']);
        $jsonData = json_decode($response, true);


        if (!is_array($jsonData)) { //정상응답
            continue;
        }

        if ($jsonData['STATUS_CODE'] != 'Success') {
            continue;
        }

        foreach ($jsonData['PRESCRIPTION_LIST'] as $row) {
            $row['PRESCRIPTION_VALUE'] = $row['VALUE']; //파라메타명 보정
            unset($row['VALUE']);
            $salesforce_sync->insertOrUpdatePrescription($contract['ID'], $row);
            unset($row['PRESCRIPTION_PDF']);
            unset($row['INSPECTION_PDF']);
            print_r($row);
        }
    }
}





