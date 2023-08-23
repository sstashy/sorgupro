<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Ölüm Tarihi Sorgu</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="https://https://t.me/illegalekip/https://t.me/illegalekip">Greengo</a></li>
                        <li class="breadcrumb-item active">Ölüm Tarihi Sorgu</li>
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
                    <h4 class="card-title mb-0">Ölüm Tarihi Sorgu</h4>
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
                                <th>CİNSİYETİ</th>
                                <th>YAŞ</th>
                                <th>ÖLÜM TARİHİ</th>
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
            url: "api/ölüm/api.php",
            type: "POST",
            data: {
                tc: $('#tcInput').val(),
            },
            success: (res) => {
                if(!res.includes("Input")) {
                    hideToast();
                    showAlert("Sonuç bulundu.", "success");
                    let d = res[0];
                    let array = [];
                    let tc = d.TC || "Bulunamadı";
                    let ad = d.ADI || "Bulunamadı";
                    let soyad = d.SOYADI || "Bulunamadı";
                    let cinsiyet = d.CINSIYET || "Bulunamadı";
                    let yas = d.YAS || "Bulunamadı";
                    let olumtarihi = d.OLUMTARIHI || "Bulunamadı";
                    var result = `<tr>
                        <td>${tc}</td>
                        <td>${ad}</td>
                        <td>${soyad}</td>
                        <td>${cinsiyet}</td>
                        <td>${yas}</td>
                        <td>${olumtarihi}</td>
                    </tr>`
                    array.push(result);
                    $('#tbody').html(array);
                } else {
                    hideToast();
                    showAlert("Adam Daha Ölmedi Amk Ölünce Gel", "danger");
                }
            },
            error: (res) => {
                hideToast();
                showAlert("Adam Daha Ölmedi Amk Ölünce Gel", "danger");
            }
        })
    }
</script>