<?php

include_once("../class/datatables.php");
use jesuzweq\System;

header("Content-Type: application/json; utf-8;");

if (!System::isAllowed(System::getIp())) {
    echo json_encode(["success" => false, "message" => "ip error"]);
    die();
}

ini_set("display_errors", 0);
error_reporting(0);

if (isset($_POST)) {
    $ad = System::filter($_POST["ad"]);
    $soyad = System::filter($_POST["soyad"]);
    $il = System::filter($_POST["il"]);
    $ilce = System::filter($_POST["ilce"]);

    $sql1 = "ADI = ? and SOYADI = ?";
    $sql2 = [$ad, $soyad];

    if(!empty($il)) {
        $sql1 = $sql1 . " and NUFUSIL = ?";
        array_push($sql2, $il);
    }

    if(!empty($ilce)) {
        $sql1 = $sql1 . " and NUFUSILCE = ?";
        array_push($sql2, $ilce);
    }

    $res = System::table('101m')->whereRaw($sql1, $sql2)->get();

    if ($res < 1) {
        echo json_encode(["success" => false, "message" => "not found"]);
        die();
    }

    $number = count($res);

    echo json_encode(["success" => true, "number" => $number, "data" => $res]);
    die();
} else {
    echo json_encode(["success" => false, "message" => "request error"]);
    die();
}
?>