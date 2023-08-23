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
    $tc = System::filter($_POST["tc"]);

    $sql1 = "TC = ?";
    $sql2 = [$tc];

    $res = System::table('101m')->whereRaw($sql1, $sql2)->get();

    if (!$res) {
        echo json_encode(["success" => false, "message" => "not found"]);
        die();
    }

    echo json_encode(["success" => true, "data" => $res]);
    die();
} else {
    echo json_encode(["success" => false, "message" => "request error"]);
    die();
}
?>