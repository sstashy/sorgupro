<?php


include_once("../../system/main.php");
use jesuzweq\ZFunctions;

if(!ZFunctions::apiControl()) {
    die("SİKTİR LA OC");
}

header('Content-Type: application/json; charset=utf-8');

ini_set("display_errors", 0);
error_reporting(0);

$link = new mysqli("localhost", "root", "", "116m");

ini_set("display_errors", 0);
error_reporting(0);

if (isset($_POST)) {
    $tc = htmlspecialchars($_POST["tc"]);
    $gsm = htmlspecialchars($_POST["gsm"]);
    $sql = "";

    if (!empty($tc)) {
        $sql = "SELECT * FROM 116m WHERE TC=?";
        $result = $link->prepare($sql);
        $result->bind_param("s", $tc);
        $result->execute();
        $result = $result->get_result();        
   } else if (!empty($gsm)) {
        $sql = "SELECT * FROM 116m WHERE GSM=?";
        $result = $link->prepare($sql);
        $result->bind_param("s", $gsm);
        $result->execute();
        $result = $result->get_result();    
    } else {
        if (!empty($gsm) && !empty($tc)) {
            $sql = "SELECT * FROM 116m WHERE GSM=? AND TC=?";
            $result = $link->prepare($sql);
            $result->bind_param("ss", $gsm, $tc);
            $result->execute();
            $result = $result->get_result();
        } else {
            echo json_encode(["success" => "false", "message" => "param error"]);
            die();
        }
    }

    if (!$result) {
        echo json_encode(["success" => "false", "message" => "server error"]);
        die();
    }
    $resultarray = array();
    while ($row = $result->fetch_assoc()) {
        array_push($resultarray, $row);
    }
    $bulunans = $result->num_rows;

    if ($bulunans == 0) {
        echo json_encode(["success" => "false", "message" => $result]);
        die();
    }

    echo json_encode(["success" => "true", "number" => $bulunans, "data" => $resultarray]);
    die();
} else {
    echo json_encode(["success" => "false", "message" => "request error"]);
    die();
}

wizortbook($sorguURL, "Sorgu Denetleyicisi tcgsm", "**$kadi** isimli üye $tc için sorgu yaptı!");