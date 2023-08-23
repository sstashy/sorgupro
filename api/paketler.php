<?php
error_reporting(0);

require_once "../config.php";


$tc = $_GET['tc'];
$url = 'http://greengo.apis/apiler/vesika18.php?auth=qwewqe23&tc='.$_GET['tc'];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array( 'Content-Type: application/json'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
$people_json = curl_exec($ch);
$data = json_decode($people_json, true);
$success = $data['success'];
$vesika = $data['vesika'];

$response = curl_exec($ch);
curl_close($ch);

$data = json_decode($response, true);

echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

ini_set("display_errors", 0);
error_reporting(0);
header("Content-Type: application/json; utf-8;");
?>