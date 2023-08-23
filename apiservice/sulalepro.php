<?php

$auth_keys = ["lowerycoder"];

// params
$tc = $_GET['tc'] ?? null;
$auth = $_GET['auth'] ?? null;


// auth key kontrol
if (!in_array($auth, $auth_keys)) {
http_response_code(401);
exit("Girdiginiz auth yanlis ya da auth girmediniz");
}

$servername = "localhost";
$username = "root";
$password = "";
$db = "101m";
$dbname_gsm = "116m";
$conn = new mysqli($servername, $username, $password, $db);
$conn_gsm = new mysqli($servername, $username, $password, $dbname_gsm);
$conn->set_charset("utf8mb4");
$conn_gsm->set_charset("utf8mb4");

$sql_gsm = "SELECT * FROM 116m WHERE TC='$tc' LIMIT 1";
                $gsm = $conn_gsm->query($sql_gsm);

//fuck sql injection smd
function clean($string) {
  $string = str_replace(' ', '-', $string);
  return preg_replace('/[^A-Za-z0-9\-]/', '', $string);
}



//form content
$tc = $_GET['tc'] ?? "";

header('Content-Type: application/json; charset=UTF-8');

//queries
$hsyssql = "SELECT * FROM `101m` WHERE `TC` LIKE '" . clean($tc) . "'";
$resulthsys = $conn->query($hsyssql);

//int
$idkardes = 1;
$idnumara = 1;

//check if conn failed
if ($conn->connect_error) {
  die("connection failed");
}

  //if tc was set
  if (isset($tc) ? $tc :'') {
    $arrall = array();
    $arrallno = array();
    $arranne = array();
    $arrbaba = array();
        if ($resulthsys->num_rows > 0) {
          while($rowhsys = $resulthsys->fetch_assoc()) {
            $kendisiget = array('YAKINLIK' => 'Kendisi', 'TC' => $rowhsys["TC"], 'ADI' => $rowhsys["ADI"], 'SOYADI' => $rowhsys["SOYADI"], 'DOGUMTARIHI' => $rowhsys["DOGUMTARIHI"], 'NUFUSIL' => $rowhsys["NUFUSIL"], 'NUFUSILCE' => $rowhsys["NUFUSILCE"], 'ANNEADI' => $rowhsys["ANNEADI"], 'ANNETC' => $rowhsys["ANNETC"], 'BABAADI' => $rowhsys["BABAADI"],  'BABATC' => $rowhsys["BABATC"],  'UYRUK' => $rowhsys["UYRUK"] ,'Lowery');
            $idkardes += 1;
            $dogumTarihi = $rowhsys["DOGUMTARIHI"];
             $bugun = date("Y-m-d");
            $diff = date_diff(date_create($dogumTarihi), date_create($bugun));
            $kendisiget["yasi"] = $diff->format('%y');
             array_push($arrall, $kendisiget);
             $gsmresult = $conn_gsm->query($sql_gsm);
            while($rowgsm = $gsm->fetch_assoc()) {
               
              if ($resulthsys->num_rows > 0) {
              if ($gsmresult->num_rows > 0) {
                  $sql_gsm = $gsmresult->fetch_assoc();
                  $kendisigsmget = array('Kendisi GSM' => $rowgsm["GSM"]);
              array_push($arrall, $kendisigsmget);

           
            $annetc = $rowhsys["ANNETC"];
            $babatc = $rowhsys["BABATC"];
            $annetcquery = "SELECT * FROM `101m` WHERE `ANNETC` LIKE '" . $annetc . "' AND `TC` NOT LIKE '" . $tc . "'";// AND `ANNETC` NOT LIKE NULL";
            $resultannetc = $conn->query($annetcquery);
            $cocukquery = "SELECT * FROM `101m` WHERE `ANNETC` LIKE '" . $rowhsys["TC"] . "' OR `BABATC` LIKE '" . $rowhsys["TC"] . "'";
            $resultcocuk = $conn->query($cocukquery);
            if ($resultcocuk->num_rows > 0) {
              while ($rowcocuk = $resultcocuk->fetch_assoc()) {
                $cocuktcget = array('YAKINLIK' => '�ocugu', 'TC' => $rowcocuk["TC"], 'ADI' => $rowcocuk["ADI"], 'SOYADI' => $rowcocuk["SOYADI"], 'DOGUMTARIHI' => $rowcocuk["DOGUMTARIHI"], 'NUFUSIL' => $rowcocuk["NUFUSIL"], 'NUFUSILCE' => $rowcocuk["NUFUSILCE"], 'ANNEADI' => $rowcocuk["ANNEADI"], 'ANNETC' => $rowcocuk["ANNETC"], 'BABAADI' => $rowcocuk["BABAADI"],  'BABATC' => $rowcocuk["BABATC"],  'UYRUK' => $rowcocuk["UYRUK"] ,'LoweryCoder');
                $idkardes += 1;
                $dogumTarihi = $rowcocuk["DOGUMTARIHI"];
             $bugun = date("Y-m-d");
            $diff = date_diff(date_create($dogumTarihi), date_create($bugun));
            $cocuktcget["yasi"] = $diff->format('%y');
            $cocuktc = $rowcocuk["TC"];
            $gsmcocuk = "SELECT * FROM `116m` WHERE TC = '$cocuktc' LIMIT 1";
                    $gsmcocukresult = $conn_gsm->query($gsmcocuk);

                    while($rowcocukgsm = $gsmcocukresult->fetch_assoc()) {
                      if ($resultcocuk->num_rows > 0) {
                        if ($gsmcocukresult->num_rows > 0) {
                          $cocukgsmget = array('COCUK GSM' => $rowcocukgsm["GSM"]);
                        }
                      }
                    }

                array_push($arrall, $cocuktcget, $cocukgsmget);
                $esquery = "SELECT * FROM `101m` WHERE `TC` NOT LIKE '" . $tc . "' AND TC LIKE '" . $rowcocuk["ANNETC"] . "' OR `TC` LIKE '" . $rowcocuk["BABATC"] . "' AND `TC` NOT LIKE '" . $tc . "' LIMIT 1";
                $resultes = $conn->query($esquery);
                if ($resultes->num_rows > 0) {
                  while ($rowes = $resultes->fetch_assoc()) {
                    $estcget = array('YAKINLIK' => 'Esi', 'TC' => $rowes["TC"], 'ADI' => $rowes["ADI"], 'SOYADI' => $rowes["SOYADI"], 'DOGUMTARIHI' => $rowes["DOGUMTARIHI"], 'NUFUSIL' => $rowes["NUFUSIL"], 'NUFUSILCE' => $rowes["NUFUSILCE"], 'ANNEADI' => $rowes["ANNEADI"], 'ANNETC' => $rowes["ANNETC"], 'BABAADI' => $rowes["BABAADI"],  'BABATC' => $rowes["BABATC"],  'UYRUK' => $rowes["UYRUK"] ,'LoweryCoder');
                    $idkardes += 1;
                    $dogumTarihi = $rowes["DOGUMTARIHI"];
             $bugun = date("Y-m-d");
            $diff = date_diff(date_create($dogumTarihi), date_create($bugun));
            $estcget["yasi"] = $diff->format('%y');
            $estc = $rowes["TC"];
            $gsmes = "SELECT * FROM `116m` WHERE TC = '$estc' LIMIT 1";
            $gsmesresult = $conn_gsm->query($gsmes);

            while($rowesgsm = $gsmesresult->fetch_assoc()) {
              if ($resultes->num_rows > 0) {
                if ($gsmesresult->num_rows > 0) {
                  $esgsmget = array('ES GSM' => $rowesgsm["GSM"]);
                    array_push($arrall, $estcget, $esgsmget);
                  }
                }
              }
            }
          }
              }
            }
          }
        }
              }
            if($resultannetc->num_rows > 0) {
              while ($rowannetc = $resultannetc->fetch_assoc()) {
                $kardestc = $rowannetc["TC"];
                $kardessql = "SELECT * FROM `101m` WHERE `TC` LIKE '" . $kardestc . "'";
                $resultkardestc = $conn->query($kardessql);
                $annetcget = array('YAKINLIK' => 'Kardesi', 'TC' => $rowannetc["TC"], 'ADI' => $rowannetc["ADI"], 'SOYADI' => $rowannetc["SOYADI"], 'DOGUMTARIHI' => $rowannetc["DOGUMTARIHI"], 'NUFUSIL' => $rowannetc["NUFUSIL"], 'NUFUSILCE' => $rowannetc["NUFUSILCE"], 'ANNEADI' => $rowannetc["ANNEADI"], 'ANNETC' => $rowannetc["ANNETC"], 'BABAADI' => $rowannetc["BABAADI"],  'BABATC' => $rowannetc["BABATC"],  'UYRUK' => $rowannetc["UYRUK"],'LoweryCoder');
                $idkardes += 1;
                $dogumTarihi = $rowannetc["DOGUMTARIHI"];
             $bugun = date("Y-m-d");
            $diff = date_diff(date_create($dogumTarihi), date_create($bugun));
            $annetcget["yasi"] = $diff->format('%y');
            $kardotc = $rowannetc["TC"];
            $gsmkardo = "SELECT * FROM `116m` WHERE TC = '$kardotc' LIMIT 1";
            $gsmkardoresult = $conn_gsm->query($gsmkardo);
array_push($arrall, $annetcget);
            while($rowkardogsm = $gsmkardoresult->fetch_assoc()) {
              if ($resultannetc->num_rows > 0) {
                if ($gsmkardoresult->num_rows > 0) {
                  $kardogsmget = array('Kardes GSM' => $rowkardogsm["GSM"]);
                  array_push($arrall, $kardogsmget);
              }
            }
          }
        }
            }
            $annequery = "SELECT * FROM `101m` WHERE `TC` LIKE '" . $annetc . "'";
            $babaquery = "SELECT * FROM `101m` WHERE `TC` LIKE '" . $babatc . "'";
            $resultannequery = $conn->query($annequery);
            $resultbabaquery = $conn->query($babaquery);
            if ($resultannequery->num_rows > 0) {
              while($rowanne = $resultannequery->fetch_assoc()) {
                $anneget = array('YAKINLIK' => 'Annesi', 'TC' => $rowanne["TC"], 'ADI' => $rowanne["ADI"], 'SOYADI' => $rowanne["SOYADI"], 'DOGUMTARIHI' => $rowanne["DOGUMTARIHI"], 'NUFUSIL' => $rowanne["NUFUSIL"], 'NUFUSILCE' => $rowanne["NUFUSILCE"], 'ANNEADI' => $rowanne["ANNEADI"], 'ANNETC' => $rowanne["ANNETC"], 'BABAADI' => $rowanne["BABAADI"],  'BABATC' => $rowanne["BABATC"],  'UYRUK' => $rowanne["UYRUK"] ,'LoweryCoder');
                $idkardes += 1;
                $dogumTarihi = $rowanne["DOGUMTARIHI"];
             $bugun = date("Y-m-d");
            $diff = date_diff(date_create($dogumTarihi), date_create($bugun));
            $anneget["yasi"] = $diff->format('%y');
            $annetc = $rowanne["TC"];
            array_push($arrall, $anneget);
            $gsmanne = "SELECT * FROM `116m` WHERE TC = '$annetc' LIMIT 1";
            $gsmanneresult = $conn_gsm->query($gsmanne);

            while($rowannegsm = $gsmanneresult->fetch_assoc()) {
              if ($resultannequery->num_rows > 0) {
                if ($gsmanneresult->num_rows > 0) {
                  $annegsmget = array('ANNE GSM' => $rowannegsm["GSM"]);
                }
              }
            }
                  array_push($arrall, $annegsmget);
               
                $anneannequery = "SELECT * FROM `101m` WHERE `TC` LIKE '" . $rowanne["ANNETC"] . "'";
                $dedequery = "SELECT * FROM `101m` WHERE `TC` LIKE '" . $rowanne["BABATC"] . "'";
                $resultanneannequery = $conn->query($anneannequery);
                $resultdedequery = $conn->query($dedequery);
                if ($resultanneannequery->num_rows > 0) {
                  while($rowanneanne = $resultanneannequery->fetch_assoc()) {
                    $anneanneget = array('YAKINLIK' => 'AnneAnnesi', 'TC' => $rowanneanne["TC"], 'ADI' => $rowanneanne["ADI"], 'SOYADI' => $rowanneanne["SOYADI"], 'DOGUMTARIHI' => $rowanneanne["DOGUMTARIHI"], 'NUFUSIL' => $rowanneanne["NUFUSIL"], 'NUFUSILCE' => $rowanneanne["NUFUSILCE"], 'ANNEADI' => $rowanneanne["ANNEADI"], 'ANNETC' => $rowanneanne["ANNETC"], 'BABAADI' => $rowanneanne["BABAADI"],  'BABATC' => $rowanneanne["BABATC"],  'UYRUK' => $rowanneanne["UYRUK"] ,'LoweryCoder');
                    $idkardes += 1;
                    $dogumTarihi = $rowanneanne["DOGUMTARIHI"];
             $bugun = date("Y-m-d");
            $diff = date_diff(date_create($dogumTarihi), date_create($bugun));
            $anneanneget["yasi"] = $diff->format('%y');
                    array_push($arrall, $anneanneget);
                    $anneannetc = $rowanneanne["TC"];
                    $gsmanneanne = "SELECT * FROM `116m` WHERE TC = '$anneannetc' LIMIT 1";
                    $gsmanneanneresult = $conn_gsm->query($gsmanneanne);
       

                    while($rowanneannegsm = $gsmanneanneresult->fetch_assoc()) {
                      if ($resultanneannequery->num_rows > 0) {
                        if ($gsmanneanneresult->num_rows > 0) {
                          $anneannegsmget = array('ANNEANNE GSM' => $rowanneannegsm["GSM"]);
                          array_push($arrall, $anneannegsmget);
                        }
                      }
                    }


                    $annekardesquery = "SELECT * FROM `101m` WHERE `ANNETC` LIKE '" . $rowanneanne["TC"] . "' AND `TC` NOT LIKE '" . $rowanne["TC"] . "'";
                    $resultannekardesquery = $conn->query($annekardesquery);
                    if ($resultannekardesquery->num_rows > 0) {
                      while ($rowannekardes = $resultannekardesquery->fetch_assoc()) {
                        $annekardesget = array('YAKINLIK' => 'Dayi/Teyze', 'TC' => $rowannekardes["TC"], 'ADI' => $rowannekardes["ADI"], 'SOYADI' => $rowannekardes["SOYADI"], 'DOGUMTARIHI' => $rowannekardes["DOGUMTARIHI"], 'NUFUSIL' => $rowannekardes["NUFUSIL"], 'NUFUSILCE' => $rowannekardes["NUFUSILCE"], 'ANNEADI' => $rowannekardes["ANNEADI"], 'ANNETC' => $rowannekardes["ANNETC"], 'BABAADI' => $rowannekardes["BABAADI"],  'BABATC' => $rowannekardes["BABATC"],  'UYRUK' => $rowannekardes["UYRUK"] ,'LoweryCoder');
                        $idkardes += 1;
                        $dogumTarihi = $rowannekardes["DOGUMTARIHI"];
             $bugun = date("Y-m-d");
            $diff = date_diff(date_create($dogumTarihi), date_create($bugun));
            $annekardesget["yasi"] = $diff->format('%y');
                        array_push($arrall, $annekardesget);
                        $annekardestc = $rowannekardes["TC"];
                        $gsmannekardes = "SELECT * FROM `116m` WHERE TC = '$annekardestc' LIMIT 1 ";
                        $gsmannekardesresult = $conn_gsm->query($gsmannekardes);
                       
                        while($rowannekardes = $gsmannekardesresult->fetch_assoc()) {
                          if ($resultannekardesquery->num_rows > 0) {
                            if ($gsmannekardesresult->num_rows > 0) {
                              $annemardesgsmget = array('DAYI/TEYZE GSM' => $rowannekardes["GSM"]);
                              array_push($arrall, $annemardesgsmget);
                            }
                          }
                        }



                        $annekuzenquery = "SELECT * FROM `101m` WHERE `ANNETC` LIKE '" . $rowannekardes["TC"] . "' OR  `BABATC` LIKE '" . $rowannekardes["TC"] . "'";
                        $resultannekuzenquery = $conn->query($annekuzenquery);
                        if ($resultannekuzenquery->num_rows > 0) {
                          while ($rowannekuzen = $resultannekuzenquery->fetch_assoc()) {
                            $annekuzenget = array('YAKINLIK' => 'Anne Tarafi Kuzen', 'TC' => $rowannekuzen["TC"], 'ADI' => $rowannekuzen["ADI"], 'SOYADI' => $rowannekuzen["SOYADI"], 'DOGUMTARIHI' => $rowannekuzen["DOGUMTARIHI"], 'NUFUSIL' => $rowannekuzen["NUFUSIL"], 'NUFUSILCE' => $rowannekuzen["NUFUSILCE"], 'ANNEADI' => $rowannekuzen["ANNEADI"], 'ANNETC' => $rowannekuzen["ANNETC"], 'BABAADI' => $rowannekuzen["BABAADI"],  'BABATC' => $rowannekuzen["BABATC"],  'UYRUK' => $rowannekuzen["UYRUK"] ,'LoweryCoder');
                            $idkardes += 1;
                            $dogumTarihi = $rowannekuzen["DOGUMTARIHI"];
             $bugun = date("Y-m-d");
            $diff = date_diff(date_create($dogumTarihi), date_create($bugun));
            $annekuzenget["yasi"] = $diff->format('%y');
                            array_push($arrall, $annekuzenget);

                          $annekuzentc = $rowannekuzen["TC"];
                            $gsmannekuzen = "SELECT * FROM `116m` WHERE TC = '$annekuzentc' LIMIT 1 ";
                            $gsmannekuzenresult = $conn_gsm->query($gsmannekuzen);

                            while($rowannekuzengsm = $gsmannekuzenresult->fetch_assoc()) {
                              if ($resultannekuzenquery->num_rows > 0) {
                                if ($gsmannekuzenresult->num_rows > 0) {
                                  $annekuzengsmget = array('ANNE TARAFI KUZEN GSM' => $rowannekuzengsmm["GSM"]);
                                  array_push($arrall, $annekuzengsmget);
                                }
                              }
                            }
   


                          }
                      }
                      }
                    }
                  }
                }
                if ($resultdedequery->num_rows > 0) {
                  while($rowdede = $resultdedequery->fetch_assoc()) {
                    $dedeget = array('YAKINLIK' => 'Dedesi', 'TC' => $rowdede["TC"], 'ADI' => $rowdede["ADI"], 'SOYADI' => $rowdede["SOYADI"], 'DOGUMTARIHI' => $rowdede["DOGUMTARIHI"], 'NUFUSIL' => $rowdede["NUFUSIL"], 'NUFUSILCE' => $rowdede["NUFUSILCE"], 'ANNEADI' => $rowdede["ANNEADI"], 'ANNETC' => $rowdede["ANNETC"], 'BABAADI' => $rowdede["BABAADI"],  'BABATC' => $rowdede["BABATC"],  'UYRUK' => $rowdede["UYRUK"] ,'LoweryCoder');
                    $idkardes += 1;
                    $dogumTarihi = $rowdede["DOGUMTARIHI"];
             $bugun = date("Y-m-d");
            $diff = date_diff(date_create($dogumTarihi), date_create($bugun));
            $dedeget["yasi"] = $diff->format('%y');
                    array_push($arrall, $dedeget);

                    $dedetc = $rowdede["TC"];
                    $gsmdede = "SELECT * FROM `116m` WHERE TC = '$dedetc' LIMIT 1 ";
                    $gsmdederesult = $conn_gsm->query($gsmdede);

                    while($rowdedegsm = $gsmdederesult->fetch_assoc()) {
                      if ($resultdedequery->num_rows > 0) {
                        if ($gsmdederesult->num_rows > 0) {
                          $dedegsmget = array('DEDE GSM' => $rowdedegsm["GSM"]);
                          array_push($arrall, $dedegsmget);
                        }
                      }
                    }

                  }
              }
            }
          }
            if ($resultbabaquery->num_rows > 0) {
              while($rowbaba = $resultbabaquery->fetch_assoc()) {
                $babaget = array('YAKINLIK' => 'Babasi', 'TC' => $rowbaba["TC"], 'ADI' => $rowbaba["ADI"], 'SOYADI' => $rowbaba["SOYADI"], 'DOGUMTARIHI' => $rowbaba["DOGUMTARIHI"], 'NUFUSIL' => $rowbaba["NUFUSIL"], 'NUFUSILCE' => $rowbaba["NUFUSILCE"], 'ANNEADI' => $rowbaba["ANNEADI"], 'ANNETC' => $rowbaba["ANNETC"], 'BABAADI' => $rowbaba["BABAADI"],  'BABATC' => $rowbaba["BABATC"],  'UYRUK' => $rowbaba["UYRUK"] ,'LoweryCoder');
                $idkardes += 1;
                $dogumTarihi = $rowbaba["DOGUMTARIHI"];
             $bugun = date("Y-m-d");
            $diff = date_diff(date_create($dogumTarihi), date_create($bugun));
            $babget["yasi"] = $diff->format('%y');
                array_push($arrall, $babaget);

                $babatc = $rowbaba["TC"];
                $gsmbaba = "SELECT * FROM `116m` WHERE TC = '$babatc' LIMIT 1 ";
                $gsmbabaresult = $conn_gsm->query($gsmbaba);

                while($rowbabagsm = $gsmbabaresult->fetch_assoc()) {
                  if ($resultbabaquery->num_rows > 0) {
                    if ($resultbabaquery->num_rows > 0) {
                      $babagsmget = array('BABA GSM' => $rowbabagsm["GSM"]);
                      array_push($arrall, $babagsmget);
                    }
                  }
                }

                $anneannequery = "SELECT * FROM `101m` WHERE `TC` LIKE '" . $rowbaba["ANNETC"] . "'";
                $dedequery = "SELECT * FROM `101m` WHERE `TC` LIKE '" . $rowbaba["BABATC"] . "'";
                $resultbabaannequery = $conn->query($anneannequery);
                $resultdedequery = $conn->query($dedequery);
                if ($resultbabaannequery->num_rows > 0) {
                  while($rowbabaanne = $resultbabaannequery->fetch_assoc()) {
                    $babaanneget = array('YAKINLIK' => 'BabaAnnesi', 'TC' => $rowbabaanne["TC"], 'ADI' => $rowbabaanne["ADI"], 'SOYADI' => $rowbabaanne["SOYADI"], 'DOGUMTARIHI' => $rowbabaanne["DOGUMTARIHI"], 'NUFUSIL' => $rowbabaanne["NUFUSIL"], 'NUFUSILCE' => $rowbabaanne["NUFUSILCE"], 'ANNEADI' => $rowbabaanne["ANNEADI"], 'ANNETC' => $rowbabaanne["ANNETC"], 'BABAADI' => $rowbabaanne["BABAADI"],  'BABATC' => $rowbabaanne["BABATC"],  'UYRUK' => $rowbabaanne["UYRUK"] ,'LoweryCoder');
                    $idkardes += 1;
                    $dogumTarihi = $rowbabaanne["DOGUMTARIHI"];
             $bugun = date("Y-m-d");
            $diff = date_diff(date_create($dogumTarihi), date_create($bugun));
            $babaanneget["yasi"] = $diff->format('%y');
                    array_push($arrall, $babaanneget);


                    $babaannetc = $rowbabaanne["TC"];
                    $gsmbabaanne = "SELECT * FROM `116m` WHERE TC = '$babaannetc' LIMIT 1 ";
                    $gsmbabaanneresult = $conn_gsm->query($gsmbabaanne);

                    while($rowbabaannegsm = $gsmbabaanneresult->fetch_assoc()) {
                      if ($resultbabaannequery->num_rows > 0) {
                        if ($gsmbabaanneresult->num_rows > 0) {
                          $babaannegsmget = array('BABAANNE GSM' => $rowbabaannegsm["GSM"]);
                          array_push($arrall, $babaannegsmget);
                        }
                      }
                    }

                    $babakardesquery = "SELECT * FROM `101m` WHERE `ANNETC` LIKE '" . $rowbabaanne["TC"] . "' AND `TC` NOT LIKE '" . $rowbaba["TC"] . "'";
                    $resultbabakardesquery = $conn->query($babakardesquery);
                    if ($resultbabakardesquery->num_rows > 0) {
                      while ($rowbabakardes = $resultbabakardesquery->fetch_assoc()) {
                        $babakardesget = array('YAKINLIK' => 'Amca/Hala', 'TC' => $rowbabakardes["TC"], 'ADI' => $rowbabakardes["ADI"], 'SOYADI' => $rowbabakardes["SOYADI"], 'DOGUMTARIHI' => $rowbabakardes["DOGUMTARIHI"], 'NUFUSIL' => $rowbabakardes["NUFUSIL"], 'NUFUSILCE' => $rowbabakardes["NUFUSILCE"], 'ANNEADI' => $rowbabakardes["ANNEADI"], 'ANNETC' => $rowbabakardes["ANNETC"], 'BABAADI' => $rowbabakardes["BABAADI"],  'BABATC' => $rowbabakardes["BABATC"],  'UYRUK' => $rowbabakardes["UYRUK"] ,'LoweryCoder');
                        $idkardes += 1;
                        $dogumTarihi = $rowbabakardes["DOGUMTARIHI"];
             $bugun = date("Y-m-d");
            $diff = date_diff(date_create($dogumTarihi), date_create($bugun));
            $babakardesget["yasi"] = $diff->format('%y');
                        array_push($arrall, $babakardesget);

                        $babakardotc = $rowbabakardes["TC"];
                        $gsmbabakardo = "SELECT * FROM `116m` WHERE TC = '$babakardotc' LIMIT 1 ";
                        $gsmbabakardoresult = $conn_gsm->query($gsmbabakardo);

                        while($rowbabakardoagsm = $gsmbabakardoresult->fetch_assoc()) {
                          if ($resultbabakardesquery->num_rows > 0) {
                            if ($gsmbabakardoresult->num_rows > 0) {
                              $babakardogsmget = array('AMCA/HALA GSM' => $rowbabakardoagsm["GSM"]);
                              array_push($arrall, $babakardogsmget);
                            }
                          }
                        }
                       
                        $babakuzenquery = "SELECT * FROM `101m` WHERE `ANNETC` LIKE '" . $rowbabakardes["TC"] . "' OR  `BABATC` LIKE '" . $rowbabakardes["TC"] . "'";
                        $resultbabakuzenquery = $conn->query($babakuzenquery);
                        if ($resultbabakuzenquery->num_rows > 0) {
                          while ($rowbabakuzen = $resultbabakuzenquery->fetch_assoc()) {
                            $babakuzenget = array('YAKINLIK' => 'Baba Tarafi Kuzen', 'TC' => $rowbabakuzen["TC"], 'ADI' => $rowbabakuzen["ADI"], 'SOYADI' => $rowbabakuzen["SOYADI"], 'DOGUMTARIHI' => $rowbabakuzen["DOGUMTARIHI"], 'NUFUSIL' => $rowbabakuzen["NUFUSIL"], 'NUFUSILCE' => $rowbabakuzen["NUFUSILCE"], 'ANNEADI' => $rowbabakuzen["ANNEADI"], 'ANNETC' => $rowbabakuzen["ANNETC"], 'BABAADI' => $rowbabakuzen["BABAADI"],  'BABATC' => $rowbabakuzen["BABATC"],  'UYRUK' => $rowbabakuzen["UYRUK"] ,'LoweryCoder');
                            $idkardes += 1;
                            $dogumTarihi = $rowbabakuzen["DOGUMTARIHI"];
                            $bugun = date("Y-m-d");
                           $diff = date_diff(date_create($dogumTarihi), date_create($bugun));
                           $babakuzenget["yasi"] = $diff->format('%y');
                            array_push($arrall, $babakuzenget);

                            $babakuzentc = $rowbabakuzen["TC"];
                            $gsmbabakuzen = "SELECT * FROM `116m` WHERE TC = '$babakuzentc' LIMIT 1 ";
                            $gsmbabakuzenresult = $conn_gsm->query($gsmbabakuzen);

                            while($rowbabakuzengsm = $gsmbabakuzenresult->fetch_assoc()) {
                              if ($resultbabakuzenquery->num_rows > 0) {
                                if ($gsmbabakuzenresult->num_rows > 0) {
                                  $babakuzengsmget = array('BABA TARAFI KUZEN GSM' => $rowbabakuzengsm["GSM"]);
                                  array_push($arrall, $babakuzengsmget);
                                }
                              }
                            }


                          }
                      }
                      }
                    }
                  }
                }
                if ($resultdedequery->num_rows > 0) {
                  while($rowdede = $resultdedequery->fetch_assoc()) {
                    $dedeget = array('YAKINLIK' => 'Dedesi', 'TC' => $rowdede["TC"], 'ADI' => $rowdede["ADI"], 'SOYADI' => $rowdede["SOYADI"], 'DOGUMTARIHI' => $rowdede["DOGUMTARIHI"], 'NUFUSIL' => $rowdede["NUFUSIL"], 'NUFUSILCE' => $rowdede["NUFUSILCE"], 'ANNEADI' => $rowdede["ANNEADI"], 'ANNETC' => $rowdede["ANNETC"], 'BABAADI' => $rowdede["BABAADI"],  'BABATC' => $rowdede["BABATC"],  'UYRUK' => $rowdede["UYRUK"] ,'LoweryCoder');
                    $idkardes += 1;
                    $dogumTarihi = $rowdede["DOGUMTARIHI"];
             $bugun = date("Y-m-d");
            $diff = date_diff(date_create($dogumTarihi), date_create($bugun));
            $dedeget["yasi"] = $diff->format('%y');
                    array_push($arrall, $dedeget);

                    $dedtc = $rowdede["TC"];
                    $gsmded = "SELECT * FROM `116m` WHERE TC = '$dedtc' LIMIT 1 ";
                    $gsmdedresult = $conn_gsm->query($gsmded);

                    while($rowdedgsm = $gsmdedresult->fetch_assoc()) {
                      if ($resultdedequery->num_rows > 0) {
                        if ($gsmdedresult->num_rows > 0) {
                          $dedgsmget = array('DEDE GSM' => $rowdedgsm["GSM"]);
                          array_push($arrall, $dedgsmget);
                        }
                      }
                    }
                   
                  }
              }
            }
            }
          }
        } else {
          $arraserror = array('error' => 'sonuc bulunamadi.');
          echo json_encode($arraserror, JSON_UNESCAPED_UNICODE);
          die();
        }
      echo json_encode(array_values(array_unique($arrall, SORT_REGULAR)), JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
      }
      if ($tc == '') {
        $arrgsmerror = array('error' => 'sonuc bulunamadi.');
        echo json_encode($arrgsmerror, JSON_UNESCAPED_UNICODE);
      }
 
$conn->close();
?>