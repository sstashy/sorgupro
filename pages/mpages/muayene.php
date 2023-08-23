<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Muayene Sorgu</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="/panel">SorguPro</a></li>
                        <li class="breadcrumb-item active">Muayene Sorgu</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <!-- ============================================================== -->
    <!-- BURA -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Muayene Sorgu</h4>
                </div><!-- end card header -->

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
                                </div><!-- end col -->

                                <div class="col-xl-12">
                                    <div class="mt-0">
                                        <button type="button" onclick="kontrolEt()" class="btn w-sm btn-primary waves-effect waves-light">Sorgula</button>
                                        <button type="button" onclick="clearRow('#tcInput', '#tbody')" class="btn w-sm btn-light waves-effect waves-light">Temizle</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form><!-- end form -->
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
        <!-- end col -->
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
                                <th>TC</th>
                                <th>Ad</th>
                                <th>Soyad</th>
                                <th>Doğum Tarihi</th>
                                <th>Cinsiyet</th>
                                <th>Takip No</th>
                                <th>Hastane Adı</th>
                                <th>Kılinik Adı</th>
                                <th>Takip Tarihi</th>
                                <th>Reçete No</th>
                                <th>Tahsis Edildimi</th>
                                <th>Katılım Ücreti</th>
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
            url: "api/muayene/api.php",
            type: "POST",
            data: {
                tc: $('#tcInput').val(),
            },
            success: function(res) {
                if (res && res.data) {
                    let result;
                    res.data.forEach(element => {
                        let TC = element.TC || "Bulunamadı";
                        let ADI = element.ADI || "Bulunamadı";
                        let SOYADI = element.SOYADI || "Bulunamadı";
                        let DOGUMTARIHI = element.DOGUMTARIHI || "Bulunamadı";
                        let CINSIYET = element.CINSIYET || "Bulunamadı";
                        let TAKIPNO = element.TAKIPNO || "Bulunamadı";
                        let TESISADI = element.TESISADI || "Bulunamadı";
                        let KLINIKADI = element.KLINIKADI || "Bulunamadı";
                        let TAKIPTARIHI = element.TAKIPTARIHI || "Bulunamadı";
                        let RECETENO = element.RECETENO || "Bulunamadı";
                        let TAHSISEDILDIMI = element.TAHSISEDILDIMI || "Bulunamadı";
                        let KATILIMUCRETI = element.KATILIMUCRETI || "Bulunamadı";
                        result += `<tr>
            <td>${TC}</td>
            <td>${ADI}</td>
            <td>${SOYADI}</td>
            <td>${DOGUMTARIHI}</td>
            <td>${CINSIYET}</td>
            <td>${TAKIPNO}</td>
            <td>${TESISADI}</td>
            <td>${KLINIKADI}</td>
            <td>${TAKIPTARIHI}</td>
            <td>${RECETENO}</td>
            <td>${TAHSISEDILDIMI}</td>
            <td>${KATILIMUCRETI}</td>
        </tr>`;
                    });

                    $('#tbody').html(result);
                    showAlert("Sonuç bulundu.", "success");
                } else {
                    hideToast();
                    showAlert("Bir sonuç bulunamadı!", "danger");
                }
                hideToast();
            },
            error: function(res) {
                hideToast();
                showAlert("Bir hata oluştu! Lütfen yetkili biri ile iletişime geçin.", "danger");
            }
        });
    }
</script>