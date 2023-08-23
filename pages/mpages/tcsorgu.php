<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">TC Sorgu</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="">SorguPro</a></li>
                        <li class="breadcrumb-item active">TC Sorgu</li>
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
                    <h4 class="card-title mb-0">TC Sorgu</h4>
                </div><!-- end card header -->

                <div class="card-body">
                    <h5 class="fs-14 mb-3 text-muted">Sorgulanacak kişinin TC Kimlik numarasını giriniz.</h5>
                    <form action="#">
                        <div class="mt-0">
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="mb-2">
                                        <label for="cleave-delimiters" class="form-label">TC</label>
                                        <input type="text" id="tcInput" maxlength="11" class="form-control" id="cleave-delimiters">
                                    </div>
                                </div><!-- end col -->

                                <div class="col-xl-12">
                                    <div class="mt-0">
                                        <button type="button" onclick="kontrolEt()"
                                            class="btn w-sm btn-primary waves-effect waves-light">Sorgula</button>
                                        <button type="button" onclick="clearRow('#tcInput', '#tbody')"
                                            class="btn w-sm btn-light waves-effect waves-light">Temizle</button>
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
                    <table id="dTable" id="scroll-horizontal"class="table nowrap align-middle" style="width:100%">
                        <thead>
                            <tr>
                                <th>TC</th>
                                <th>AD</th>
                                <th>SOYAD</th>
                                <th>DOĞUM TARİHİ</th>
                                <th>ANNE ADI</th>
                                <th>ANNE TC</th>
                                <th>BABA ADI</th>
                                <th>BABA TC</th>
                                <th>İL / İLÇE</th>
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
            url: "api/tcsorgu/api.php",
            type: "POST",
            data: {
                tc: $('#tcInput').val(),
            },
            success: (res) => {
                if(res.success == true) {
                    $.ajax({
                        url: "",
                        type: "POST",
                        timeout: 3000,
                        data: {
                            tc: $('#tcInput').val(),
                        },
                        success: (r) => {
                            let adres;
                            let d = r[0];
                            adres = d.Address || "Bulunamadı";

                            showAlert("Sonuç bulundu.", "success");
                            hideToast();
                            let array = [];
                            let data = res.data[0];
                            var numara = 1;
                            var tc = data.TC || "Bulunamadı";
                            var ad = data.ADI || "Bulunamadı";
                            var soyad = data.SOYADI || "Bulunamadı";
                            var anneadi = data.ANNEADI || "Bulunamadı";
                            var annetc = data.ANNETC || "Bulunamadı";
                            var babaadi = data.BABAADI || "Bulunamadı";
                            var babatc = data.BABATC || "Bulunamadı";
                            var dogumtarihi = data.DOGUMTARIHI || "Bulunamadı";
                            var il = data.NUFUSIL || "Bulunamadı";
                            var ilce = data.NUFUSILCE || "Bulunamadı";
                            var ililce = `${il} / ${ilce}`;
                            var result = `<tr >
                            <td>${$('#tcInput').val()}</td>
                                <td>${ad}</td>
                                <td>${soyad}</td>
                                <td>${dogumtarihi}</td>
                                <td>${anneadi}</td>
                                <td>${annetc}</td>
                                <td>${babaadi}</td>
                                <td>${babatc}</td>
                                <td>${ililce}</td>
                            </tr>`
                            array.push(result);
                            $('#tbody').html(array);
                    },
                        error: (ee) => {

                        }
                    })
                } else {
                    hideToast();
                    showAlert("Bir sonuç bulunamadı!", "danger");
                }
            },
            error: (res) => {
                hideToast();
                showAlert("Bir hata oluştu! Lütfen yetkili biri ile iletişime geçin.", "danger");
            }
        })
    }
</script>