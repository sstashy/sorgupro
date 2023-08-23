<?php
error_reporting(0);
header('Content-Type: application/json; charset=UTF-8');

include_once("../class/datatables.php");
use jesuzweq\System;

if (!System::isAllowed(System::getIp())) {
    echo json_encode(["success" => false, "message" => "ip error"]);
    die();
}

function kisiBilgileriGetir($Idenity) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "101m";
    $conn = new mysqli($servername, $username, $password, $dbname);

    $KimlikNo = strtoupper(mysqli_real_escape_string($conn, $Idenity));

    $sql = "SELECT * FROM 101m WHERE TC = '" . $KimlikNo . "'";

    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if ($result->num_rows > 0)
    {
        return array(
            "Status" => true,
            "KendiKimlikNo" => $row['TC'],
            "EşininKimlikNo" => $row['TC'],
            "AnneKimlikNo" => $row['ANNETC'],
            "BabaKimlikNo" => $row['BABATC']
        );
    } else
    {
        echo json_encode(array(
            'Status' => false,
            'Message' => 'Aradığınız kişiye ait aile bilgisi bulunamadı!'
        ), JSON_UNESCAPED_UNICODE);
        exit;
    }
}

function kisiAnneBabaGetir($Idenity)
{
    $kisibilgi = kisiBilgileriGetir($Idenity);
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "101m";
    $conn = new mysqli($servername, $username, $password, $dbname);

    $AnneKimlikNo = strtoupper(mysqli_real_escape_string($conn, $kisibilgi["AnneKimlikNo"]));
    $BabaKimlikNo = strtoupper(mysqli_real_escape_string($conn, $kisibilgi["BabaKimlikNo"]));

    $sql = "SELECT * FROM 101m WHERE TC = '" . $AnneKimlikNo . "'";

    $aileArray = array();
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $sql2 = "SELECT * FROM 101m WHERE TC = '" . $BabaKimlikNo . "'";

    $result2 = $conn->query($sql2);
    $row2 = $result2->fetch_assoc();

    if ($result->num_rows > 0)
    {
        array_push($aileArray, array(
            "Yakınlık" => "Annesi",
            "KimlikNo" => $row['TC'],
            "Isim" => $row['ADI'],
            "Soyisim" => $row['SOYADI'],
            "DogumTarihi" => $row['DOGUMTARIHI'],
            "NufusIl" => $row['NUFUSIL'],
            "NufusIlce" => $row['NUFUSILCE'],
            "AnneIsim" => $row['ANNEADI'],
            "AnneKimlikNo" => $row['ANNETC'],
            "BabaIsim" => $row['BABAADI'],
            "BabaKimlikNo" => $row['BABATC'],
            "Uyruk" => $row['UYRUK'],
        ));
    } else {
        return array(
            "Status" => false,
            "Message" => "Aradığınız kişiye ait aile bilgisi bulunamadı!"
        );
    }

    if($result2->num_rows > 0)
    {
        array_push($aileArray, array(
            "Yakınlık" => "Babası",
            "KimlikNo" => $row2['TC'],
            "Isim" => $row2['ADI'],
            "Soyisim" => $row2['SOYADI'],
            "DogumTarihi" => $row2['DOGUMTARIHI'],
            "NufusIl" => $row2['NUFUSIL'],
            "NufusIlce" => $row2['NUFUSILCE'],
            "AnneIsim" => $row2['ANNEADI'],
            "AnneKimlikNo" => $row2['ANNETC'],
            "BabaIsim" => $row2['BABAADI'],
            "BabaKimlikNo" => $row2['BABATC'],
            "Uyruk" => $row2['UYRUK'],
        ));
    } else {
        return array(
            "Status" => false,
            "Message" => "Aradığınız kişiye ait aile bilgisi bulunamadı!"
        );
    }
    return $aileArray;
}

function cocukBilgisiGetirYetiskin($Idenity)
{
    $kisibilgi = kisiBilgileriGetir($Idenity);

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "101m";
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    $AnneKimlikNo = strtoupper(mysqli_real_escape_string($conn, $kisibilgi["KendiKimlikNo"]));

    $sql = "SELECT * FROM 101m WHERE ANNETC = '" . $AnneKimlikNo . "'";
    $result = $conn->query($sql);

    $cocukArray = array();
    if ($result->num_rows > 0)
    {
        while ($row = $result->fetch_assoc()) // Yetişkinin Cocuklarını getir.
        {
            array_push($cocukArray, array(
                "Yakınlık" => "Çocuğu",
                "KimlikNo" => $row['TC'],
                "Isim" => $row['ADI'],
                "Soyisim" => $row['SOYADI'],
                "DogumTarihi" => $row['DOGUMTARIHI'],
                "NufusIl" => $row['NUFUSIL'],
                "NufusIlce" => $row['NUFUSILCE'],
                "AnneIsim" => $row['ANNEADI'],
                "AnneKimlikNo" => $row['ANNETC'],
                "BabaIsim" => $row['BABAADI'],
                "BabaKimlikNo" => $row['BABATC'],
                "Uyruk" => $row['UYRUK'],
            ));
        }
        return $cocukArray;
    } else
    {
        return array(
            "KisininCocuguVarmı" => false
        );
    }
}

function kisiAileBilgisiGetir($Idenity)
{
    $kisibilgi = kisiBilgileriGetir($Idenity);
    $annebababilgi = kisiAnneBabaGetir($Idenity);
    $cocukbilgi = cocukBilgisiGetirYetiskin($Idenity);

    if($kisibilgi["Status"] == true)
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "101m";
        $conn = new mysqli($servername, $username, $password, $dbname);
    
        $AnneKimlikNo = strtoupper(mysqli_real_escape_string($conn, $kisibilgi["AnneKimlikNo"]));
        $BabaKimlikNo = strtoupper(mysqli_real_escape_string($conn, $kisibilgi["BabaKimlikNo"]));
    
        $sql = "SELECT * FROM 101m WHERE ANNETC = '" . $AnneKimlikNo . "' AND BABATC = '" . $BabaKimlikNo . "'";
        $result = $conn->query($sql);

        $aileArray = array();
        if ($result->num_rows > 0)
        {
            while ($row = $result->fetch_assoc()) // Anne Baba TCLERİ UYUŞANLAR
            {
                if($row["TC"] == $kisibilgi["KendiKimlikNo"])
                {
                    $Yakınlık = "Kendisi";
                } else 
                {
                    $Yakınlık = "Kardeşi";
                }

                array_push($aileArray, array(
                    "Yakınlık" => $Yakınlık,
                    "KimlikNo" => $row['TC'],
                    "Isim" => $row['ADI'],
                    "Soyisim" => $row['SOYADI'],
                    "DogumTarihi" => $row['DOGUMTARIHI'],
                    "NufusIl" => $row['NUFUSIL'],
                    "NufusIlce" => $row['NUFUSILCE'],
                    "AnneIsim" => $row['ANNEADI'],
                    "AnneKimlikNo" => $row['ANNETC'],
                    "BabaIsim" => $row['BABAADI'],
                    "BabaKimlikNo" => $row['BABATC'],
                    "Uyruk" => $row['UYRUK'],
                ));
            }
            foreach($annebababilgi as $key ){ // Kardeşleri içeri aktar
                $aileArray[] = $key;
            }

            if(!isset($cocukbilgi["KisininCocuguVarmı"]))
            {
                foreach($cocukbilgi as $key ){ // Cocuklarını içeri aktar
                    $aileArray[] = $key;
                }
            }
            
            echo json_encode($aileArray, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        } else
        {
            $data = array(
                'Status' => false,
                'Message' => 'Aradığınız kişiye ait aile bilgisi bulunamadı!'
            );
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        }
    } else if($kisibilgi["Status"] == false)
    {
        $data = array(
            'Status' => false,
            'Message' => 'Aradığınız kişiye ait aile bilgisi bulunamadı!'
        );
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
}
$tc = System::filter($_GET["tc"]);
$result = kisiAileBilgisiGetir($tc);
?>