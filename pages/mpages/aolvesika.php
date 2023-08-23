<?php

$customCSS = array('<link href="../assets/plugins/DataTables/datatables.min.css" rel="stylesheet">');
$customJAVA = array(
    '<script src="../assets/plugins/DataTables/datatables.min.js"></script>',
    '<script src="../assets/plugins/printer/main.js"></script>',
    '<script src="../assets/js/pages/datatables.js"></script>',
    '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.0/dist/sweetalert2.all.min.js"></script>'
);

$page_title = 'Vesika -18';
                    if($_POST){
                        $tc = $_POST['tc'];
						$toplam = "http://greengo.apis/apiler/aolvesika.php?auth=qwewqe23&tc=" . $tc;
						$ch = curl_init();
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
						curl_setopt($ch, CURLOPT_URL,$toplam);
						$result=curl_exec($ch);
						curl_close($ch);
						
						
						$phpObj =  json_decode($result);
						$vesika = $phpObj->vesika;
                        
                        #Verileri Yazdi
												curl_close($ch);
												}
?>
<!--<div class="page-content">-->
<!--BAŞLANGIC-->
<div class="row">
    <div class="col-xl-12 col-md-6">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Vesika AÖL</h4>
                    <p class="mb-1">
                    <p>Sorgulanacak kişinin TC kimlik numarasını giriniz.</p>
                    <div class="block-content tab-content">

                        <div class="tab-pane active" id="tc" role="tabpanel">
							<form method="POST">
							<input require maxlength="11" class="form-control" type="text" name="tc" id="tcno" placeholder="TC"><br>
                            
                            <center>
                            <button id="sorgula" name="yolla"  class="btn btn-outline-success btn-border" style="width: 180px; height: 45px; outline: none; margin-left: 5px;"><i class="fas fa-search"></i> Sorgula <span id="sorgulanumber"></span></button>
							
                            <button onclick="clearResults()" id="durdurButon" type="button" class="btn btn-outline-danger btn-border" style="width: 180px; height: 45px; outline: none; margin-left: 5px;"><i class="fas fa-trash-alt"></i> Sıfırla </button>
                            <button onclick="printTable()" id="yazdirTable" type="button" class="btn btn-outline-warning btn-border" style="width: 180px; height: 45px; outline: none; margin-left: 5px;"><i class="fas fa-print"></i> Yazdır Detay </button><br><br>
							</form>
                    </center>
                            <center>
                                <div class="col-xl-2 col-md-6">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 &nbsp;="" class="card-title mb-4"><i class="fas fa-camera"></i> Vesikalık Fotoğraf</h4>
                                                <img id="KimlikFotograf" src="<?php echo 'data:image/jpeg;base64,' . $vesika; ?>" style="border-radius: 12px;" width="140" height="140" class="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function checkNumber() {
            
           /* return Swal.fire({
                icon: "warning",
                title: "Oooooopss...",
                text: "Bu çözüm şu an bakımdadır!"
            });*/
            

            var roleNumber = "<?= $k_rol ?>";

            if (parseInt(roleNumber) == 0 || parseInt(roleNumber) == 1 || parseInt(roleNumber) == 2 || parseInt(roleNumber) == 3 || parseInt(roleNumber) == 4 || parseInt(roleNumber) == 5 || parseInt(roleNumber) == 6 || parseInt(roleNumber) == 7) {
                var tc = $("#tcno").val();
                $.Toast.showToast({
                    "title": "Sorgulanıyor...",
                    "icon": "loading",
                    "duration": 86400000
                });
                $.ajax({
                    url: "../api/vesikalik/api.php",
                    type: "GET",
                    data: {
                        tc: tc,
                    },
                    beforeSend:function(){
                        $("#jojjoojj").html('');
                    },
                    success: (res) => {
                        var Response = res;
                        console.log(res);

                        $.Toast.hideToast();

                        if (Response.message === "cooldown error") {
                            return Swal.fire({
                                icon: 'warning',
                                title: 'Ooooopss...',
                                text: 'Çok sık sorgu yapıyorsunuz! Lütfen ' + Response.remain + ' saniye bekleyin.',
                            })
                        }

                        if (Response.message === "no query remains") {
                            return Swal.fire({
                                icon: 'warning',
                                title: 'Ooooopss...',
                                text: 'Bu sorguyu kullanmak için hakkınız bulunmamaktadır.',
                            })
                        }

                        if (Response.Status === false) {
                            $.Toast.hideToast();
                            Swal.fire({
                                icon: 'error',
                                title: 'Bulunamadı!',
                                text: 'Girdiğiniz TC kimlik numarası ile eşleşen bir bilgi bulunamadı.',
                            })
                            return;
                        } else if (Response.success == true) {
                            $.Toast.hideToast();
                            $("#KimlikFotograf").attr("src", "data:image/jpeg;base64," + res.Vesika);
                        }
                    },
                    error: () => {
                        $.Toast.hideToast();
                        Swal.fire({icon: 'error',
                            title: "Sunucu hatası!",
                            text: 'Lütfen yönetici ile iletişime geçin.'
                        })
                        return;
                    }
                })
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Bu çözümü kullanman için yeterli yetkin bulunmuyor!',
                })
            }
        }
</script>
</div>
<!--BİTİŞ-->
<?php
?>