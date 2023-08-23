<?php
$tc = $_GET['tc'];

if (!is_numeric($tc) || strlen($tc) != 11) {
    $response = [
        'error' => 'TC Kimlik Numarası Bulunmadı'
    ];
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    exit;
}

$birth_date = DateTime::createFromFormat('dmY', substr($tc, 4, 4) . substr($tc, 2, 2) . substr($tc, 0, 2));

$month = $birth_date->format('m');
$day = $birth_date->format('d');

if (($month == 3 && $day >= 21) || ($month == 4 && $day <= 19)) {
    $burc = 'Koç';
} elseif (($month == 4 && $day >= 20) || ($month == 5 && $day <= 20)) {
    $burc = 'Boğa';
} elseif (($month == 5 && $day >= 21) || ($month == 6 && $day <= 21)) {
    $burc = 'İkizler';
} elseif (($month == 6 && $day >= 22) || ($month == 7 && $day <= 22)) {
    $burc = 'Yengeç';
} elseif (($month == 7 && $day >= 23) || ($month == 8 && $day <= 22)) {
    $burc = 'Aslan';
} elseif (($month == 8 && $day >= 23) || ($month == 9 && $day <= 22)) {
    $burc = 'Başak';
} elseif (($month == 9 && $day >= 23) || ($month == 10 && $day <= 22)) {
    $burc = 'Terazi';
} elseif (($month == 10 && $day >= 23) || ($month == 11 && $day <= 21)) {
    $burc = 'Akrep';
} elseif (($month == 11 && $day >= 22) || ($month == 12 && $day <= 21)) {
    $burc = 'Yay';
} elseif (($month == 12 && $day >= 22) || ($month == 1 && $day <= 21)) {
    $burc = 'Oğlak';
} elseif (($month == 1 && $day >= 22) || ($month == 2 && $day <= 19)) {
    $burc = 'Kova';
} else {
    $burc = 'Balık';
}

$response = [
    'message' => 'LoweryCoder',
    'tc' => $tc,
    'burc' => $burc
];
echo json_encode($response, JSON_UNESCAPED_UNICODE);
?>

