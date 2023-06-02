<?php

define('_GNUBOARD_', true);

error_reporting( E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_ERROR | E_WARNING | E_PARSE | E_USER_ERROR | E_USER_WARNING );
ini_set('display_errors', '1');

include_once dirname(__DIR__) . "/custom_db_config.php";
include_once dirname(__DIR__) . "/lib/SimpleDB.php";
include_once dirname(__DIR__) . "/lib/MediSync.php";

$db_host = G5_MYSQL_HOST;
$db_user = G5_MYSQL_USER;
$db_password = G5_MYSQL_PASSWORD;
$db_name = G5_MYSQL_DB;

$pdo_db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"));
$pdo_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo_db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

if (!isset($pdo_db)) {
    die('DB connection error!');
}

if(!isset($cookie_file)) {
    $cookie_file = dirname(__DIR__) . "/data/medi_cookie.txt";
}

$options = [
    'cookie_file' => $cookie_file,
];

$sync = new MediSync($pdo_db, $options);

$sync->getJSESSIONID();
$sync->login();
$sync->getPatient();



