<?php

use jesuzweq\System;

$user = System::table('users')->where('userAuthKey', $_SESSION['authKey'])->first();
$userCount = count(System::table('users')->get());
$ann = System::table('announcement')->orderby(["id", "DESC"])->get();
$services = System::table('services')->get();
$svCount = count($services);

$username = $user->userName;

$userRoleInt = $user->userRole;
$userRole;
if($userRoleInt == 1) {
    $userRole = "Admin";
} elseif($userRoleInt == 2) {
    $userRole = "Haftalık";
} elseif($userRoleInt == 3) {
    $userRole = "Aylık";
} elseif($userRoleInt == 4) {
    $userRole = "Yıllık";
   
}
$userTime = $user->userTime;
if($userRoleInt == 1) {
    $userTime = "Sınırsız";
}



?>

<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0"><?= $title ?></h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="">SorguPro</a></li>
                        <li class="breadcrumb-item active"><?= $title ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <!-- ============================================================== -->
    <!-- BURA -->

    <div class="row dash-nft">
        <div class="col-xxl-12">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card overflow-hidden">
                        <div class="card-body bg-marketplace d-flex">
                            <div class="flex-grow-1">
                                <h4 class="fs-18 lh-base mb-0">
                                    <?php
                                    $greetingsmsg;
                                    date_default_timezone_set("Europe/Istanbul");
                                    $hour = date("H");

                                    if ($hour >= 21) {
                                        $greetingsmsg = "İyi Geceler";
                                    } elseif ($hour > 17) {
                                        $greetingsmsg = "İyi Akşamlar";
                                    } elseif ($hour >= 12) {
                                        $greetingsmsg = "Tünaydın";
                                    } elseif ($hour < 12) {
                                        $greetingsmsg = "Günaydın";
                                    }

                                    echo $greetingsmsg; ?>, <span class="text-success"><?= $username ?>.</span>
                                </h4>
                                <p class="mb-0 mt-2 pt-1 text-muted">Üyelik Bitiş Tarihi: <span
                                        class="text-success"><?= $userTime ?></span></p>
                                <div class="d-flex gap-3 mt-4">
                                    <a href="https://t.me/SorguProDuyuru" class="btn btn-primary">Telegram
                                    </a>
                                </div>
                            </div>
                            <img src="<?=SITEURL?>assets/images/bbs.png" width="150" height="150" alt="" id="small-logo"
                                class="img-fluid" />
                            <style>
                                #small-logo:hover {
                                    transition: 500ms;
                                    transform: scale(1.5);
                                    filter: brightness(1);
                                    /* width: 155px;
                                            height: 157px; */
                                }

                                #small-logo {
                                    transition: 500ms;
                                    filter: brightness(0.7);
                                    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=40)";
                                    -webkit-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=40)";
                                    transform: scale(1);
                                }
                            </style>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="fw-medium text-muted mb-0">Kayıtlı Kulanıcılar</p>
                            <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value"
                                    data-target="<?= $userCount ?>"></span> Kulanıcı</h2>
                        </div>
                        <div>
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-primary rounded-circle fs-2">
                                    <i data-feather="users"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="fw-medium text-muted mb-0">Aktif Hizmetler</p>
                            <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value"
                                    data-target="16"></span> Aktif Hizmet</h2>
                        </div>
                        <div>
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-danger rounded-circle fs-2">
                                    <i data-feather="activity"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="fw-medium text-muted mb-0">Üyelik Bilgisi</p>
                            <h2 class="mt-4 ff-secondary fw-semibold"><?= $userRole ?></h2>
                        </div>
                        <div>
                            <div class="avatar-sm">
                                <span class="ri-admin-fill avatar-title bg-success rounded-circle fs-2"></span>
                                <!-- <i data-feather=""></i> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-12 col-md-6">
        <div class="card card-height-820">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Duyurular</h4>
            </div>

            <div class="card-body">
                <div class="col-12">
                    <div class="d-flex mb-2">
                        <div class="flex-grow-1">
                            <p class="text-truncate text-muted fs-14 mb-0">Duyuru İçeriği</p>
                        </div>
                        <div class="flex-shrink-0">
                            <p class="text-truncate text-muted fs-14 mb-0">Yayın Tarihi</p>
                        </div>
                    </div><!-- end -->
                </div><!-- end col -->

                <?php
                $annCount = count($ann);
                if(!$annCount == null) {
                    for ($i = 0; $i < $annCount; $i++) {
                        $content = $ann[$i]->annContent;
                        $time = $ann[$i]->annTime;
                        $priority = $ann[$i]->annPriority;
                        $color = $ann[$i]->annPriorityColor;
    
                        $colorName;
                        if($color == 0) {
                            $colorName = "danger";
                        } elseif($color == 1) {
                            $colorName = "warning";
                        } elseif($color == 2) {
                            $colorName = "success";
                        } elseif($color == 3) {
                            $colorName = "secondary";
                        } elseif($color == 4) {
                            $colorName = "primary";
                        }
    
                        echo '
                        <div class="d-flex mb-2" id="annxd">
                            <div class="flex-grow-1">
                                <p class="text-truncate text-muted fs-14 mb-0"><span
                                        class="badge rounded-pill badge-soft-'.$colorName.'">' . $priority . '</span></i>
                                    '.$content.'
                                </p>
                            </div>
                            <div class="flex-shrink-0">
                                <p class="mb-0">'.$time.'</p>
                            </div>
                        </div><!-- end -->
                        ';
                    }
                } else {
                    echo "Duyuru bulunamadı!";
                }
                ?>

                <style>
                    #annxd:hover{
                        transition: 500ms;
                        filter: brightness(1);
                    }
                    #annxd {
                        transition: 500ms;
                        filter: brightness(0.7);
                    }
                </style>

            </div><!-- end card body -->
        </div><!-- end card -->
    </div><!-- end col -->
</div>