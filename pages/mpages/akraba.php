<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Sülale Sorgu</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="https://https://t.me/wsglobal/https://t.me/wsglobal">WS-CHECK</a></li>
                        <li class="breadcrumb-item active">Sülale Sorgu</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <!-- ============================================================== -->
    <!-- BURA -->
    <div class="row">
    <div class="col-xl-12 col-md-6">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4  class="card-title mb-4">
                        Akraba Sorgu
                    </h4>
                    <p class="mb-1">
                    <p>
                        Sorgulanacak Kisinin  T.C. Nosunu Giriniz.</br>
                    </p>
                    </p>
                    <div class="block-content tab-content">
                        <div class="tab-pane active" id="tc" role="tabpanel">
                            <input class="form-control" type="text" id="tcno" placeholder="TC"><br>

                        </div>
                        <center class="nw">
                            <button onclick="checkNumber()" id="sorgula" name="yolla" class="btn waves-effect waves-light btn-rounded btn-primary" style="width: 180px; height: 45px; outline: none; margin-left: 5px;"><i class="fas fa-search"></i> Sorgula <span id="sorgulanumber"></span></button>
                            <button onclick="clearAll()" id="durdurButon" type="button" class="btn waves-effect waves-light btn-rounded btn-danger" style="width: 180px; height: 45px; outline: none; margin-left: 5px;"><i class="fas fa-trash-alt"></i> Sifirla </button>
                            <button onclick="printTable()" id="yazdirTable" type="button" class="btn waves-effect waves-light btn-rounded btn-warning" style="width: 180px; height: 45px; outline: none; margin-left: 5px;"><i class="fas fa-print"></i> Yazdir Detay </button><br><br>
                        </center>
                        <div id="jojjoojj">

                        </div>
                        <div class="table-responsive">

                            <table id="zero-conf" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>

                                            <th>Yakinlik</th>
                                            <th>Kimlik No</th>
                                            <th>Ad</th>
                                            <th>Soyad</th>
                                            <th>Dogum Tarihi</th>
                                            <th>Nufus Il</th>
                                            <th>Nufus Ilce</th>
                                    </tr>
                                </thead>
                                <tbody id="sonuccc">
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
            $("#jojjoojj").html(' <tr class="odd"><td valign="top" colspan="11" class="dataTables_empty">No data available in table</td></tr>');
        }

        function clearValues() {
            document.getElementById("tcno").value = "";
            document.getElementById("sorgulanumber").innerHTML = "";
        }

        function clearAll() {
            clearResults()
            clearValues()
        }

        function checkNumber() {
            var tcno = $("#tcno").val();
            $.Toast.showToast({
                "title": "Sorgulaniyor...",
                "icon": "loading",
                "duration": 60000
            });
            $.ajax({
                url: "../api/sülale/api.php",
                type: "POST",
                data: {
                    tc: tcno,
                },
                success: (res) => {
                    clearResults();
                    $.Toast.hideToast();
                    let x = JSON.parse(res)
                    document.getElementById('sonuccc').innerHTML = ''
                    x.forEach(el=>{
                        document.getElementById('sonuccc').innerHTML += 
                    `
                        <tr>
                            <td>${el.YAKINLIK}</td>
                            <td>${el.TC}</td>
                            <td>${el.ADI}</td>
                            <td>${el.SOYADI}</td> 
                            <td>${el.DOGUMTARIHI}</td>    
                            <td>${el.NUFUSIL}</td> 
                            <td>${el.NUFUSILCE}</td>
                        </tr>

                    `
                })
                    

                },
                error: () => {
                    $.Toast.hideToast();
                    Swal.fire({
                        icon: 'error',
                        title: "Sunucu hatasi!",
                        text: 'L?tfen y?netici ile iletisime ge?in.'
                    })
                }
            })
        }
    </script>