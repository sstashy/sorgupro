<?php

$customCSS = array('<link href="../assets/plugins/DataTables/datatables.min.css" rel="stylesheet">');
$customJAVA = array(
    '<script src="../assets/plugins/DataTables/datatables.min.js"></script>',
    '<script src="../assets/plugins/printer/main.js"></script>',
    '<script src="../assets/js/pages/datatables.js"></script>'

);

$page_title = '';
?>
<!--BAŞLANGIC-->
<div class="row">
    <div class="col-xl-12 col-md-6">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4"><img style="width: 30px;height: auto;" src="/assets/img/turkey.png" alt=""> Telefon Sorgulama</h4>
                    <p class="mb-1">
                    <p>
                        Bilgilerini istediğiniz kişinin telefon numarasını girin.</br>
                    </p>
                    </p>
                    <div class="block-content tab-content">
                        <form action="gsmtc" method="POST">
                            <div class="tab-pane active" id="tc" role="tabpanel">
                                <input class="form-control" autocomplete="off" type="text" name="gsmno" id="gsmno" minlength="10" maxlength="10" placeholder="5327151653"><br>
                            </div>
                            <center class="nw">
                                <button onclick="checkNumber()" id="sorgula" name="Sorgula" type="submit" class="btn waves-effect waves-light btn-rounded btn-outline-primary" style="font-weight: 400;font-family: Poppins;;width: 180px; height: 45px; outline: none; margin-left: 5px;"> Sorgula </button>
                                <button onclick="clearAll()" id="durdurButon" type="button" class="btn waves-effect waves-light btn-rounded btn-outline-danger" style="font-weight: 400;font-family: Poppins;;width: 180px; height: 45px; outline: none; margin-left: 5px;"> Sıfırla </button>
                                <button onclick="copyTable()" id="copy_btn" type="button" class="btn waves-effect waves-light btn-rounded btn-outline-info" style="font-weight: 400;font-family: Poppins;width: 180px; height: 45px; outline: none; margin-left: 5px;"> Kopyala </button>
                                <button onclick="printTable()" id="yazdirTable" type="button" class="btn waves-effect waves-light btn-rounded btn-outline-warning" style="font-weight: 400;font-family: Poppins;;width: 180px; height: 45px; outline: none; margin-left: 5px;"> Yazdır</button><br><br>
                            </center>
                        </form>
                        <div class="table-responsive">
                            <table id="01000001" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>TC</th>
                                        <th>Adı</th>
                                        <th>Soyadı</th>
                                        <th>Doğum Tarihi</th>
                                        <th>İl</th>
                                        <th>İlçe</th>
                                        <th>Anne Adı</th>
                                        <th>Baba Adı</th>
                                        <th>Numara</th>
                                    </tr>
                                </thead>
                                <tbody id="00001010">
                                    <?php

                                    if (isset($_POST['Sorgula'])) {  echo "<script>toastr.success('Sorgu başarıyla tamamlandı!');</script>";

                                        $gsm = htmlspecialchars(strip_tags($_POST['gsmno']));

                                        $db = new PDO("mysql:host=localhost;dbname=116m;charset=utf8", "root", "");

                                        $query = $db->query("SELECT * FROM 116m WHERE GSM = '$gsm' ORDER BY TC DESC");

                                        while ($data = $query->fetch()) {
                                            $getTc = $data['TC'];
                                            $getGsm = $data['GSM'];
                                        }

                                        $db2 = new PDO("mysql:host=localhost;dbname=101m;charset=utf8", "root", "");

                                        $query2 = $db2->query("SELECT * FROM 101m WHERE TC = '$getTc'");

                                        while ($data2 = $query2->fetch()) {

                                    ?>
                                            <tr>
                                                <td> <?php echo $data2['TC']; ?> </td>
                                                <td> <?php echo $data2['ADI']; ?> </td>
                                                <td> <?php echo $data2['SOYADI']; ?> </td>
                                                <td> <?php echo $data2['DOGUMTARIHI']; ?> </td>
                                                <td> <?php echo $data2['NUFUSIL']; ?> </td>
                                                <td> <?php echo $data2['NUFUSILCE']; ?> </td>
                                                <td> <?php echo $data2['ANNEADI']; ?> </td>
                                                <td> <?php echo $data2['BABAADI']; ?> </td>
                                                <th><?= $getGsm ?></th>
                                            </tr>
                                    <?php
                                        }
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

    <script>
        function clearResults() {
            $("#01000001").html(' <tr class="odd"><td valign="top" colspan="11" class="dataTables_empty">No data available in table</td></tr>');
        }

        function clearValues() {
            document.getElementById("gsmno").value = "";
        }

        function clearAll() {
            clearResults()
            clearValues()
        }

        function checkNumber() {
            $.Toast.showToast({
                "title": "Sorgulanıyor...",
                "icon": "loading",
                "duration": 60000
            });
        }
    </script>

</div>
<!--BİTİŞ-->
<?php
?>