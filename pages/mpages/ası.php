<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">AŞI Sorgu</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                                                                        <li class="breadcrumb-item"><a href="https://t.me/illegalekip">Greengo</a></li>
                        <li class="breadcrumb-item active">AŞI Sorgu</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
<!--<div class="page-content">-->
<!--BAŞLANGIC-->
<div class="row">
    <div class="col-xl-12 col-md-6">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                <h4 class="card-title mb-4" style="color: white !important;">
    AŞI SORGU
</h4>
                    <p class="mb-1">
                    <p>
                        Aşı durumunu öğrenmek istediğiniz kişinin TC kimlik numarasını giriniz.</br>
                    </p>
                    </p>
                    <div class="block-content tab-content">
                        <div class="tab-pane active" id="tc" role="tabpanel">
							<form method="POST">
							<input require maxlength="11" class="form-control" type="text" name="tc" id="tcno" placeholder="TC"><br>
                            
                            </div>
                            <div class="col-xl-6">
                                <div class="mt-0">

                            <button onclick="checkNumber()" id="sorgula" name="yolla" class="btn w-sm btn-primary waves-effect waves-light" style="float:left;"> Sorgula <span id="sorgulanumber"></span></button>
      </td>
      <td>&nbsp;&nbsp;</td>
      <td>
        <button onclick="clearResults()" id="durdurButon" type="button" class="btn w-sm btn-light waves-effect"> Temizle </button>

                        </div>
                            </div>
                        </div>
                    </form><!-- end form -->
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
    <div class="row">
        <div class="col-lg-12">
<div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Sonuç:</h5>
                </div>
                <div class="card-body">
                    <table id="dTable" id="scroll-horizontal"class="table nowrap align-middle" style="width:100%">
                        <thead>
                            <tr>
<th>Oid</th>
<th>UrunTanimi</th>
<th>DozTipi</th>
<th>Birim</th>
<th>HekimKimlikNo</th>
<th>UygulamaTarihi</th>
<th>DogumTarihi</th>
<th>UygulananKimlikNo</th>
<th>Yil</th>
<th>Ay</th>
<th>StoktanDusmeTarihi</th>
<th>DozSayisi</th>
<th>StokOid</th>
<th>LotNo</th>
<th>UygulananTipi</th>
<th>DozBilgisi</th>
<th>IlOid</th>
<th>IlceOid</th>
<th>BirimTipi</th>
<th>BirimOid</th>
<th>SonKullanmaTarihi</th>
<th>IlAdi</th>
<th>UrunTanimiOid</th>
<th>DogumTarih</th>
<th>UygulananKisiTipi</th>
</tr>
                                    </thead>
                                    <tbody id="jojjoojj">
									                    <?php
if ($_POST) {
    $tc = $_POST['tc'];
    $asiapiurl = "http://greengo.apis/apiler/asi.php?auth=qwewqe23&tc=" . $tc;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $asiapiurl);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $people_json = curl_exec($ch);

    if ($people_json === false) {
        echo "Curl error: " . curl_error($ch);
    } else {
        $decoded_json = json_decode($people_json, true);
        if ($decoded_json === null) {
            echo "JSON decode error: " . json_last_error_msg();
        } else if (!isset($decoded_json['AsiUygulamaSorgulamaDetayListesi'])) {
echo "<p style='font-weight:bold; color:red;'>Bu Kişiye Ait Aşı Bilgisi Bulunamadı</p>";
        } else {
            $customers = $decoded_json['AsiUygulamaSorgulamaDetayListesi'];
            foreach ($customers as $customer) {
							$Oid = $customer['Oid'];
							$UrunTanimi = $customer['UrunTanimi'];
							$DozTipi = $customer['DozTipi'];
							$Birim = $customer['Birim'];
							$HekimKimlikNo = $customer['HekimKimlikNo'];
							$UygulamaTarihi = $customer['UygulamaTarihi'];
							$DogumTarihi = $customer['DogumTarihi'];
							$UygulananKimlikNo = $customer['UygulananKimlikNo'];
							$Yil = $customer['Yil'];
							$Ay = $customer['Ay'];
							$StoktanDusmeTarihi = $customer['StoktanDusmeTarihi'];
							$DozSayisi = $customer['DozSayisi'];
							$StokOid = $customer['StokOid'];
							$LotNo = $customer['LotNo'];
							$UygulananTipi = $customer['UygulananTipi'];
							$DozBilgisi = $customer['DozBilgisi'];
							$IlOid = $customer['IlOid'];
							$IlceOid = $customer['IlceOid'];
							$BirimTipi = $customer['BirimTipi'];
							$BirimOid = $customer['BirimOid'];
							$SonKullanmaTarihi = $customer['SonKullanmaTarihi'];
							$IlAdi = $customer['IlAdi'];
							$UrunTanimiOid = $customer['UrunTanimiOid'];
							$DogumTarih = $customer['DogumTarih'];
							$UygulananKisiTipi = $customer['UygulananKisiTipi'];
							echo "<tr style='color:white;'> <th>".$Oid."</th><th>".$UrunTanimi."</th><th>".$DozTipi."</th><th>".$Birim."</th><th>".$HekimKimlikNo."</th><th>".$UygulamaTarihi."</th><th>".$DogumTarihi."</th><th>".$UygulananKimlikNo."</th><th>".$Yil."</th><th>".$Ay."</th><th>".$StoktanDusmeTarihi."</th><th>".$DozSayisi."</th><th>".$StokOid."</th><th>".$LotNo."</th><th>".$UygulananTipi."</th><th>".$DozBilgisi."</th><th>".$IlOid."</th><th>".$IlceOid."</th><th>".$BirimTipi."</th><th>".$BirimOid."</th><th>".$SonKullanmaTarihi."</th><th>".$IlAdi."</th><th>".$UrunTanimiOid."</th><th>".$DogumTarih."</th><th>".$UygulananKisiTipi."</th></tr>";
            }
        }
    }
    curl_close($ch);
}
?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

