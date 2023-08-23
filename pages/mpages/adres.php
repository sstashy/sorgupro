
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Adres Sorgu</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="/panel">SorguPro</a></li>
                        <li class="breadcrumb-item active">Adres Sorgu</li>
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
                    <h4 class="card-title mb-0">Adres Sorgu</h4>
                </div><!-- end card header -->

                <div class="card-body">
                    <h5 class="fs-14 mb-3 text-muted">Adres Sorgulanacak kişinin TC Kimlik numarasını giriniz.</h5>
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
                                <th>İkametgah</th>
                                <th>Ad Soyad</th>
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
        url: "api/adres/api.php",
        type: "POST",
        data: {
            tc: $('#tcInput').val(),
        },
     success: function(res) {
    let data = res;

    if (Object.keys(data).length > 0) {
        let ikametgah = data.Ikametgah || "Bulunamadı";
        let isimSoyisim = data.IsimSoyisim || "Bulunamadı";

        // Assuming there are other attributes available in the data object, you can access them in a similar way.

        // Now you can populate the table with the extracted data:
        let result = `<tr>
            <td>${ikametgah}</td>
            <td>${isimSoyisim}</td>
            <!-- Add other attributes to the table as needed -->
        </tr>`;
        $('#tbody').html(result);
        showAlert("Sonuç bulundu.", "success");
    } else {
                hideToast();
                showAlert("Bir sonuç bulunamadı!", "danger");
            }
            hideToast(); // Sorgulanıyor yazısını kaldırma
        },
        error: function(res) {
            hideToast();
            showAlert("Bir hata oluştu! Lütfen yetkili biri ile iletişime geçin.", "danger");
        }
    });
}
</script>
