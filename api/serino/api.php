<?php

include_once("../class/datatable.php");
include_once("../../system/main.php");
use jesuzweq\ZFunctions;

if(!ZFunctions::apiControl()) {
    die("SİKTİR LA OC");
}

header('Content-Type: application/json; charset=utf-8');

ini_set("display_errors", 0);
error_reporting(0);

$Idenity = strip_tags($_POST['tc']);
$Idenity = htmlspecialchars($Idenity);
$birth = strip_tags($_POST['birth']);
$birth = htmlspecialchars($birth);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://2.59.119.232/query.php?tc=$Idenity&birth=$birth&key=ipauth");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

if($response == "null")
{
    $output = array(
        "Status" => false,
        "Message" => "İşleminiz gerçekleştirilemiyor, yöneticiye bildirin!"
    );
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
} else
{
    echo $response;
} 
?>