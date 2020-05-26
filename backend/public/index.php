<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require $_SERVER['DOCUMENT_ROOT'] . "/../vendor/autoload.php";

use AlexKratky\db;

// cors
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');
}

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])) {
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    }

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])) {
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
    }

    exit(0);
}

db::connect('localhost', 'root', '', 'db');

$search = '%' . ($_GET["q"] ?? '') . '%';

header('Content-Type: application/json');

echo json_encode(
    db::multipleSelect("SELECT `name`, `url`, `IDproduct` FROM tb_product WHERE `description` LIKE ? OR `name` LIKE ? OR `variantName` LIKE ? OR `url` LIKE ? LIMIT 10", array($search, $search, $search, $search))
    //db::multipleSelect("SELECT * FROM tb_product LIMIT 15")
);