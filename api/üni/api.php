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

$url = "http://13.80.116.110/lexper/universite.php?tc=$Idenity&auth=lexperbabapro31";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
$response = curl_exec($ch);
curl_close($ch);

if($response == "")
{
    $output = array(
        "success" => false,
        "Message" => "İşleminiz gerçekleştirilemiyor, yöneticiye bildirin!"
    );
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    die();
} else {
    $response;
    die();
} 
?>