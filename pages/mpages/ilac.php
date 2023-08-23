<!DOCTYPE html>
<?php
?>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İlaç Sorgu</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">İlaç Sorgu</h4>
                    </div><!-- kart başlık kısmı sonu -->

                    <div class="card-body">
                        <h5 class="fs-14 mb-3 text-muted">İlaç Bilgisi Sorgulanacak kişinin TC Kimlik numarasını giriniz.</h5>
                        <form method="post" action="">
                            <div class="mt-0">
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="mb-2">
                                            <label for="tcInput" class="form-label">TC</label>
                                            <input type="text" name="tcInput" maxlength="11" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-xl-12">
                                        <div class="mt-0">
                                            <button type="submit" name="submit" class="btn w-sm btn-primary waves-effect waves-light">Sorgula</button>
                                            <button type="button" name="clear" onclick="clearForm()" class="btn w-sm btn-light waves-effect waves-light">Temizle</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div><!-- kart gövde kısmı sonu -->
                </div><!-- kart sonu -->
            </div>
        </div>

        <?php
        if(isset($_POST['submit'])) {
            $tc = $_POST['tcInput'];
            $key = "sayrox";
            $apiUrl = "https://fearlest.xyz/apiservices/sayrox/ilac.php?auth=sayrox&tc=" . urlencode($tc);
            $response = file_get_contents($apiUrl);

            if ($response === false) {
                echo "<p class='text-danger'>API isteği sırasında hata oluştu.</p>";
            } else {
                $data = json_decode($response, true);

                if (isset($data['data']) && is_array($data['data']) && count($data['data']) > 0) {
                    echo "<div class='table-responsive'>
                            <table class='table table-bordered table-striped table-vcenter'>
                                <thead>
                                    <tr style='text-align: center;'>
                                        <th>TC</th>
                                        <th>ADI</th>
                                        <th>SOYADI</th>
                                        <th>DOGUMTARIHI</th>
                                        <th>CINSIYET</th>
                                        <th>RECETENO</th>
                                        <th>ILACADI</th>
                                        <th>ILACKULLANIM</th>
                                        <th>RECETETARIH</th>
                                        <th>ILACALIMTARIH</th>
                                        <th>VERILEBILECEKTARIH</th>
                                        <th>ADET</th>
                                    </tr>
                                </thead>
                                <tbody>";

                    foreach ($data['data'] as $item) {
                        echo '<tr>';
                        echo '<td>' . $item['TC'] . '</td>';
                        echo '<td>' . $item['ADI'] . '</td>';
                        echo '<td>' . $item['SOYADI'] . '</td>';
                        echo '<td>' . $item['DOGUMTARIHI'] . '</td>';
                        echo '<td>' . $item['CINSIYET'] . '</td>';
                        echo '<td>' . $item['RECETENO'] . '</td>';
                        echo '<td>' . $item['ILACADI'] . '</td>';
                        echo '<td>' . $item['ILACKULLANIM'] . '</td>';
                        echo '<td>' . $item['RECETETARIH'] . '</td>';
                        echo '<td>' . $item['ILACALIMTARIH'] . '</td>';
                        echo '<td>' . $item['VERILEBILECEKTARIH'] . '</td>';
                        echo '<td>' . $item['ADET'] . '</td>';
                        echo '</tr>';
                    }

                    echo "</tbody></table></div>";
                } else {
                    echo "<script>showPopup('Girilen T.C. Kimlik numarası için ilaç bilgisi bulunamadı veya API\'den geçersiz yanıt alındı.');</script>";
                }
            }
        } else {
            echo "<script>showPopup('Lütfen 5 saniye aralıklarla sorgu yapın.');</script>";
        }

    ?>
