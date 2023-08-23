<?php
use jesuzweq\ZFunctions;

$allUsers = ZFunctions::table('users')->get();
$userCount = count($allUsers);

if (@$_POST['saveBtn']) {
    ZFunctions::updateUser();
    $allUsers = ZFunctions::table('users')->get();
    $userCount = count($allUsers);
}

if (@$_POST['deleteUser']) {
    $id = ZFunctions::filter($_POST['deleteUser']);
    $delete = ZFunctions::table('users')->where('id', $id)->delete();
    if ($delete) {
        $alert = "Kullanıcı başarıyla silindi.";
        $allUsers = ZFunctions::table('users')->get();
        $userCount = count($allUsers);
    } else {
        $alert = "Kullanıcı silinirken bir hata oluştu.";
    }
}

if (@$_POST['createUser']) {
    ZFunctions::createuser();
    $alert = "Başarıyla oluşturuldu!";
    $allUsers = ZFunctions::table('users')->get();
    $userCount = count($allUsers);
}

ZFunctions::adminControl();

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">
                    <?= $title ?>
                </h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="https://t.me/SorguProDuyuru">SorguPro</a></li>
                        <li class="breadcrumb-item active">
                            <?= $title ?>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <!-- content -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Sistemde Kayıtlı Kullanıcılar</h5>
                </div>
                <button type="submit" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target='#createUser'>Kullanıcı Oluştur</button>
                <div class="modal fade" id="createUser" tabindex="-1" aria-labelledby="exampleModalgridLabel"
                    aria-modal="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalgridLabel">Kullanıcı Oluştur</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="post">
                                    <div class="row g-3">
                                        <div class="col-xxl-12">
                                            <div>
                                                <label for="firstName" class="form-label">Kullanıcı Adı</label>
                                                <input type="text" class="form-control" id="firstName" name="userName"
                                                    placeholder="Kullanıcı adı giriniz.">
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-lg-12">
                                            <label for="genderInput" class="form-label">Üyelik Tipi</label>
                                            <div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="uyelikTipi"
                                                        id="inlineRadio1" value="2" checked>
                                                    <label class="form-check-label" for="inlineRadio1">Haftalık</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="uyelikTipi"
                                                        id="inlineRadio2" value="3">
                                                    <label class="form-check-label" for="inlineRadio2">Aylık</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="uyelikTipi"
                                                        id="inlineRadio3" value="4">
                                                    <label class="form-check-label" for="inlineRadio3">Yıllık</label>
                                                </div>
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-xxl-12">
                                            <div>
                                                <label for="firstName" class="form-label">Üyeliği Oluşturan</label>
                                                <input readonly type="text" class="form-control" id="firstName" name="userModerator" value="<?=$userInfo['userName']?>">
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-xxl-12">
                                            <button type="submit" name="createUser" value="create"
                                                class="btn btn-primary">Oluştur</button>
                                        </div>
                                    </div><!--end row-->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <table id="alternative-pagination"
                        class="table nowrap dt-responsive align-middle table-hover table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Kullanıcı Adı</th>
                                <th>Kullanıcı IP</th>
                                <th>Tarayıcı</th>
                                <th>İşletim Sistemi</th>
                                <th>Üyelik Bitiş Tarihi</th>
                                <th>Üyelik Durumu</th>
                                <th>Üyeliğini Oluşturan</th>
                                <th>Aksiyon</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            for ($i = 0; $i < $userCount; $i++) {
                                echo "<tr>";
                                echo "<td>" . $allUsers[$i]->id . "</td>";
                                echo "<td>" . $allUsers[$i]->userName . "</td>";
                                echo "<td>" . $allUsers[$i]->userLog . "</td>";
                                echo "<td>" . $allUsers[$i]->userBrowser . "</td>";
                                echo "<td>" . $allUsers[$i]->userOS . "</td>";
                                echo "<td>" . $allUsers[$i]->userTime . "</td>";
                                $status = $allUsers[$i]->userVerified;
                                $st;
                                if ($status == 1) {
                                    $st = "<span class='badge bg-success'>Aktif</span>";
                                }
                                if ($status == 0) {
                                    $st = "<span class='badge bg-danger'>Deaktif</span>";
                                }
                                echo "<td>" . $st . "</td>";
                                echo "<td>" . $allUsers[$i]->userModerator . "</td>";

                                echo "<td><button class='btn btn-sm btn-soft-primary' data-bs-toggle='modal' data-bs-target='#modal$i''>Kullanıcıyı Düzenle</button>\n";
                                if ($allUsers[$i]->userAuthKey == $_SESSION['authKey']) {
                                    $asd = "disabled";
                                } else {
                                    $asd = "";
                                }
                                echo "<button $asd class='btn btn-sm btn-danger remove-item-btn' data-bs-toggle='modal' data-bs-target='.bs-example-modal-center$i'>Kullanıcıyı Sil</button></td>";
                                echo "</tr>";
                                ?>

                                <div class="modal fade bs-example-modal-center<?= $i ?>" tabindex="-1" role="dialog"
                                    aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body text-center p-5">
                                                <lord-icon src="https://cdn.lordicon.com/hrqwmuhr.json" trigger="loop"
                                                    colors="primary:#121331,secondary:#08a88a"
                                                    style="width:120px;height:120px">
                                                </lord-icon>
                                                <form method="POST">
                                                    <div class="mt-4">
                                                        <h4 class="mb-3">Bunu yapmak istediğine eminmisin?</h4>
                                                        <p class="text-muted mb-4">
                                                            <?= $allUsers[$i]->userName ?> Adlı
                                                            kullanıcıyı silmek istediğinden emin misin?
                                                        </p>
                                                        <div class="hstack gap-2 justify-content-center">
                                                            <button type="submit" class="btn btn-light"
                                                                data-bs-dismiss="modal">İptal</button>
                                                            <button name="deleteUser" value="<?= $allUsers[$i]->id ?>"
                                                                class="btn btn-danger">Sil</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->

                                <div class="modal fade" id="modal<?= $i ?>" tabindex="-1"
                                    aria-labelledby="exampleModalgridLabel" aria-modal="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalgridLabel">
                                                    <?= $allUsers[$i]->userName ?> Adlı Kullanıcıyı Düzenliyorsunuz
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST">
                                                    <div class="row g-3">
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label for="firstName" class="form-label">Kullanıcı
                                                                    Adı</label>
                                                                <input type="text" class="form-control" id="username"
                                                                    name="userNameM" value="<?= $allUsers[$i]->userName ?>">
                                                            </div>
                                                        </div><!--end col-->
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label for="firstName" class="form-label">Anahtar</label>
                                                                <input type="text" class="form-control" name="anahtarKey" id="username" value="<?=$allUsers[$i]->userAuthKey?>">
                                                            </div>
                                                        </div><!--end col-->
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label for="firstName" class="form-label">Yetki
                                                                    Durumu</label>
                                                                <select class="form-select" name="membership"
                                                                    id="validationDefault04" required>
                                                                    <option <?php if ($allUsers[$i]->userRole == 0) {
                                                                        echo "selected";
                                                                    } ?> value="0">Free</option>
                                                                    <option <?php if ($allUsers[$i]->userRole == 1) {
                                                                        echo "selected";
                                                                    } ?> value="1">Admin</option>
                                                                    <option <?php if ($allUsers[$i]->userRole == 2) {
                                                                        echo "selected";
                                                                    } ?> value="2">Haftalık</option>
                                                                    <option <?php if ($allUsers[$i]->userRole == 3) {
                                                                        echo "selected";
                                                                    } ?> value="3">Aylık</option>
                                                                    <option <?php if ($allUsers[$i]->userRole == 4) {
                                                                        echo "selected";
                                                                    } ?> value="4">Yıllık</option>
                                                                </select>
                                                            </div>
                                                        </div><!--end col-->

                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label for="firstName" class="form-label">Multi-Secure?</label>
                                                                <select class="form-select" name="multisecureCheck" id="validationDefault04" required>
                                                                    <option <?php if($allUsers[$i]->multiCheck == 0) {
                                                                    echo "selected";
                                                                }?> value="0">Aktif</option>
                                                                    <option <?php if($allUsers[$i]->multiCheck == 1) {
                                                                    echo "selected";
                                                                }?> value="1">Pasif</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label for="firstName" class="form-label">Hesap
                                                                    Durumu</label>
                                                                <select class="form-select" name="status"
                                                                    id="validationDefault04" required>
                                                                    <option <?php if ($allUsers[$i]->userVerified == 0) {
                                                                        echo "selected";
                                                                        ;
                                                                    } ?> value="0">Pasif</option>
                                                                    <option <?php if ($allUsers[$i]->userVerified == 1) {
                                                                        echo "selected";
                                                                    } ?> value="1">Aktif</option>
                                                                </select>
                                                            </div>
                                                        </div><!--end col-->

                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label for="firstName" class="form-label">Bitiş
                                                                    Tarihi</label>
                                                                <input type="date" class="form-control" name="endTime"
                                                                    id="endTime" value="<?= $allUsers[$i]->userTime ?>">
                                                            </div>
                                                        </div><!--end col-->

                                                        <div class="col-lg-12">
                                                            <div class="hstack gap-2 justify-content-end">
                                                                <button type="button" class="btn btn-light"
                                                                    data-bs-dismiss="modal">Kapat</button>
                                                                <button type="submit" name="saveBtn" value="<?=$allUsers[$i]->id?>"
                                                                    class="btn btn-primary">Kaydet</button>
                                                            </div>
                                                        </div><!--end col-->
                                                        <div class="col-lg-12">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="resetIp" id="inlineRadio1" value="1">
                                                                <label class="form-check-label" for="inlineRadio1">IP Sıfırla</label>
                                                            </div>
                                                            <button type="button" onclick="copy('Kullanıcı Adı: <?= $allUsers[$i]->userName ?>\nAnahtar: <?= $allUsers[$i]->userAuthKey ?>\nÜyelik Tipi: <?= ZFunctions::converRoleViaInt($allUsers[$i]->userRole); ?>');" class="btn btn-primary waves-effect waves-light ri-file-copy-fill"></button>
                                                            <script>
                                                                function copy(text) {
                                                                    navigator.clipboard.writeText(text);
                                                                }
                                                            </script>
                                                        </div><!--end col-->
                                                    </div><!--end row-->
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php } ?>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
<!--end row-->
</div>

<body>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


    <!--datatable js-->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
</body>