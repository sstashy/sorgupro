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

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://141.98.112.105/apiservice/sulalepro.php?auth=lowerycoder&tc=$Idenity");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, array(
    'tc' => $Idenity
));
$response = curl_exec($ch);
curl_close($ch);

echo $response;

?>