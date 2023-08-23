<?php

header('Content-Type: application/json; charset=utf-8');

$tckn = @htmlspecialchars($_GET["tc"]);
$auth_key = @htmlspecialchars($_GET['auth_key']);
$auth = "iMKEfDM4fS3kFjHAKIVhktUcB8Rr";

if ($auth_key != $auth) {
    $ar = array(
        "success" => false,
        "message" => "Authentication failed."
    );
    echo json_encode($ar);
    die();
}

$url = "http://2.59.119.249/api/apiyeni/lexas/adres.jsp?tc=$tckn&auth_key=zweqallah";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

$output = curl_exec($ch);

curl_close($ch);

echo $output;

?>