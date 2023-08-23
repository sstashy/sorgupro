<!DOCTYPE html>
<?php
?>
<html>
<head>
    <title>Vesika Sorgu</title>
    <!-- Ek olarak kullanılan jQuery kütüphanesi -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container-fluid">
        <!-- sayfa başlık kısmı -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Vesika Sorgu</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="/panel">SorguPro</a></li>
                            <li class="breadcrumb-item active">Okul No</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- sayfa başlık kısmı sonu -->
        <!-- ============================================================== -->
        <!-- BURA -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Vesika Sorgu</h4>
                    </div><!-- kart başlık kısmı sonu -->

                    <div class="card-body">
                        <h5 class="fs-14 mb-3 text-muted">Sorgulanacak kişinin TC Kimlik numarasını giriniz.</h5>
                        <form action="#">
                            <div class="mt-0">
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="mb-2">
                                            <label for="tcInput" class="form-label">TC</label>
                                            <input type="text" id="tcInput" maxlength="11" class="form-control" id="tcInput">
                                        </div>
                                    </div><!-- sütun sonu -->

                                    <div class="col-xl-12">
                                        <div class="mt-0">
                                            <button type="button" onclick="kontrolEt()" class="btn w-sm btn-primary waves-effect waves-light">Sorgula</button>
                                            <button type="button" onclick="clearRow('#tcInput', '#tbody')" class="btn w-sm btn-light waves-effect waves-light">Temizle</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form><!-- form sonu -->
                    </div><!-- kart gövde kısmı sonu -->
                </div><!-- kart sonu -->
            </div>
            <!-- sütun sonu -->
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Sonuç:</h5>
                    </div>
                    <div class="card-body">
                        <table id="dTable" class="table nowrap align-middle" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Tc</th>
                                    <th>Ad</th>
                                    <th>Soyad</th>
                                    <th>Vesika</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                <!-- TBODY -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
    </div>

    <script>
        function kontrolEt() {
            checkRow('tcInput');
            $.ajax({
                url: "api/eokul/api.php",
                type: "POST",
                data: {
                    tc: $('#tcInput').val(),
                },
                success: function(res) {
                    if (res && res.data) {
                        let tc = res.data.tc || "Bulunamadı";
                        let ad = res.data.ad || "Bulunamadı";
                        let soyad = res.data.soyad || "Bulunamadı";
                        let image = res.data.image || "Bulunamadı";

                        // Şimdi tabloyu çekilen verilerle doldurabiliriz:
                        let result = `<tr>
                            <td>${tc}</td>
                            <td>${ad}</td>
                            <td>${soyad}</td>
          <td><img src="data:image/jpeg;base64,${image}" alt="Kullanıcı Resmi" width="135" height="150"></td>
                        </tr>`;
                        $('#tbody').html(result);
                        showAlert("Sonuç bulundu.", "success");
                    } else {
                        showAlert("Bir sonuç bulunamadı!", "danger");
                    }
                    hideToast(); // Sorgulanıyor yazısını kaldırma
                },
                error: function(xhr, status, error) {
                    hideToast();
                    showAlert("Bir hata oluştu! Lütfen yetkili biri ile iletişime geçin.", "danger");
                    console.error(xhr, status, error);
                }
            });
        }

        // Diğer fonksiyonları buraya ekleyin
        function checkRow(id) {
            // checkRow fonksiyonu
        }

        function clearRow(inputId, tableBodyId) {
            // clearRow fonksiyonu
        }

        function showAlert(message, type) {
            // showAlert fonksiyonu
        }

        function hideToast() {
            // hideToast fonksiyonu
        }
    </script>
</body>
</html>
