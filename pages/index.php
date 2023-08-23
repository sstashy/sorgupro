<?php
ob_start();
session_start();
include_once('../system/main.php');

define('SITEURL', $site_url);
define('MPAGE', 'mpages/');
define('INC', 'include/');

use jesuzweq\ZFunctions;

$userInfo = ZFunctions::getUserViaSession();

if(@!$_SESSION['authKey']) {
    header("Location: /login");
    exit();
}

ZFunctions::roleControl();
ZFunctions::authControl();
?>
<!doctype html>
<html lang="tr" data-layout="vertical" data-layout-style="default" data-topbar="light" data-sidebar="dark"
    data-sidebar-size="lg" data-sidebar-image="none" data-layout-mode="dark" data-layout-position="fixed">

<head>
    <meta charset="utf-8" />
    <title>
        <?= $title ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= SITEURL ?>assets/images/lexas-logo.ico">

    <!-- Layout config Js -->
    <script src="<?= SITEURL ?>assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="<?= SITEURL ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?= SITEURL ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?= SITEURL ?>assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="<?= SITEURL ?>assets/css/custom.min.css" rel="stylesheet" type="text/css" />

    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

    <!-- Sweet Alert css-->
    <link href="<?= SITEURL ?>assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

    <!-- toast js css -->
    <link href="<?= SITEURL ?>assets/css/jquery.toast.css" rel="stylesheet" type="text/css" />

</head>

<body>
    <?= include_once(INC . 'header.php') ?>
    <?= include_once(INC . 'sidebar.php') ?>

    <!-- Begin page -->
    <div id="layout-wrapper">
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>
        <div class="main-content">
            <div class="page-content">
                <?php
                if ($_GET && !empty($_GET["sayfa"])) {
                    $sayfa = $_GET['sayfa'] . ".php";
                    if (file_exists(MPAGE . $sayfa)) {
                        include_once(MPAGE . $sayfa);
                    } else {
                        include_once(MPAGE . "body.php");
                    }
                } else {
                    include_once(MPAGE . "body.php");
                }

                ?>
            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
    </div>
    <!-- end main content-->
    <?= include_once(INC . 'footer.php') ?>

    <!-- JAVASCRIPT -->
    <script src="<?= SITEURL ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= SITEURL ?>assets/libs/simplebar/simplebar.min.js"></script>
    <script src="<?= SITEURL ?>assets/libs/node-waves/waves.min.js"></script>
    <script src="<?= SITEURL ?>assets/libs/feather-icons/feather.min.js"></script>
    <script src="<?= SITEURL ?>assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="<?= SITEURL ?>assets/js/plugins.js"></script>

    <!-- App js -->
    <script src="<?= SITEURL ?>assets/js/app.js"></script>

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

    <script src="<?=SITEURL?>assets/js/pages/datatables.init.js"></script>
    
    <!-- prismjs plugin -->
    <script src="<?=SITEURL?>assets/libs/prismjs/prism.js"></script>

    <!-- notifications init -->
    <script src="<?=SITEURL?>assets/js/pages/notifications.init.js"></script>

    <!-- Sweet Alerts js -->
    <script src="<?=SITEURL?>assets/libs/sweetalert2/sweetalert2.min.js"></script>

    <!-- Sweet alert init js-->
    <script src="<?=SITEURL?>assets/js/pages/sweetalerts.init.js"></script>

    <!-- toast alert init js -->
    <script src="<?=SITEURL?>assets/js/pages/jquery.toast.js"></script>

    <script type="text/javascript">

        function showAlert(text = "Tanımlanmamış.", color = "4b38b3", duration = 1500) {
            switch (color) {
                case "danger":
                    color = "#f06548";
                    break;
                case "success":
                    color = "#a08ccf";
                    break;
                case "primary":
                    color = "#4b38b3";
                    break;
                case "info":
                    color = "#3577f1";
                    break;
                case "warning":
                    color = "#ffbe0b";
                    break;
            }
            Toastify({
                text,
                backgroundColor: color,
                duration,
                newWindow: true,
                close: false,
                gravity: "top",
                position: "right",
                stopOnFocus: true,
                onClick: function(){}
            }).showToast();
        }

        function showLoading(text = "Sorgulanıyor...", duration = 864000) {
            $.Toast.showToast({
                "title": "Sorgulanıyor",
                "icon": "loading",
                "duration": duration
            });
        }

        function checkAdSoyad() {
            if(document.getElementById("adInput").value === "" || document.getElementById("soyadInput").value === "") {
                Toastify({
                    text: "Lütfen en az bir isim ve soyad giriniz!",
                    backgroundColor: "#f06548",
                    duration: 1500,
                    newWindow: true,
                    close: false,
                    gravity: "top",
                    position: "right",
                    stopOnFocus: true,
                    onClick: function(){}
                }).showToast();
                throw false;
                return;
            } else {
                $.Toast.showToast({ 
                    "title": "Sorgulanıyor",
                    "icon": "loading",
                    "duration": 86400000
                });
            }
        }

        function clearAdSoyad(input1, input2, input3, input4, dtable) {
            $(input1).val("");
            $(input2).val("");
            $(input3).val("");
            $(input4).val("");
            $(dtable).html('<td valign="top" colspan="10" class="dataTables_empty"></td>');
            showAlert("Başarıyla temizlendi.", "success");
        }

        function clearDtable(dtable) {
            var table = $(dtable).DataTable();
            table
                .clear()
                .draw();
        }

        function checkRow(input) {
            if(document.getElementById(input).value === "") {
                showAlert("Lütfen en az bir TC numarası giriniz!", "danger");
                throw false;
            } else {
                showLoading();
            }
        }

        function clearRow(input, dtable) {
            $(input).val("");
            $(dtable).html('<td valign="top" colspan="10" class="dataTables_empty"></td>');
            showAlert("Başarıyla temizlendi.", "success");
        }

        function hideToast() {
            $.Toast.hideToast();
        }

        function copyText(text) {
            navigator.clipboard.writeText(text);
        }
    </script>

</body>
</html>