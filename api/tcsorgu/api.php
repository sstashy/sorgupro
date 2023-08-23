<?php
include_once('../class/datatable.php');

use apiZ\System;

header('Content-Type: application/json; charset=utf-8');

ini_set("display_errors", 0);
error_reporting(0);

if (isset($_POST)) {
    $tc = System::filter($_POST["tc"]);

    $sql1 = "TC = ?";
    $sql2 = [$tc];

    $res = System::table('101m')->where("TC", $tc)->get();
    // $res = System::table('101m')->whereRaw($sql1, $sql2)->get();

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