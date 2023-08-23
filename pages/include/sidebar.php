<?php
include_once("../system/main.php");

use jesuzweq\ZFunctions;

$userInfo = ZFunctions::getUserViaSession();

?>

<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index.html" class="logo logo-dark">
            <span class="logo-sm">
                <img src="<?= SITEURL ?>assets/images/bbs.png" alt="" height="10">
            </span>
            <span class="logo-lg">
                <img src="<?= SITEURL ?>assets/images/bbs.png" alt="" height="13">
            </span>
        </a>
        <!-- Light Logo-->
        <a class="logo logo-light">
            <span class="logo-sm">
                <img src="<?= SITEURL ?>assets/images/bbs.png" alt="" height="40">
            </span>
            <span class="logo-lg">
                <style>
                    .logo-lg:hover {
                        transition: 500ms;
                        filter: brightness(0.7);
                        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=40)";
                        -webkit-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=40)";
                    }

                    .logo-lg {
                        width: 100%;
                        transition: 500ms;
                    }
                </style>
                <img src="<?= SITEURL ?>assets/images/bbs.png" alt="120" height="120">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">

        <div class="container-fluid">
            <div data-simplebar>

                <!-- Sorgu Menu Start -->
                <div id="two-column-menu">
                </div>
                <ul class="navbar-nav" id="navbar-nav">
                    <li class="menu-title"><span data-key="t-sorgu"style="color: #ff0000; font-weight: bolder; text-shadow: 0px 0px 10px #ff0000;">SorguPro</span></li>
                    <li class="nav-item">

                        <a class="nav-link menu-link" href="panel">
                            <i class="ri-home-6-fill" scope="col" style="color: #ff0000; font-weight: bolder; text-shadow: 0px 0px 10px #ff0000;"></i> <span data-key="t-panel" scope="col" style="color: white; font-weight: bolder; text-shadow: 0px 0px 10px white;">Ana Sayfa <span class="badge rounded-pill badge-soft-light">v2</span></span>
                        </a>
                    </li> <!-- end Sorgu Menu -->

                    <li class="menu-title"><span data-key="t-sorgular"style="color: #ff0000; font-weight: bolder; text-shadow: 0px 0px 10px #ff0000;">SorguPro Sorgu Paneli</span></li>


                     <!-- SORGULAR SECTION -->
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarSorgular" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarDashboards">
                            <i class="ri-user-6-fill" scope="col" style="color: #ff0000; font-weight: bolder; text-shadow: 0px 0px 10px #ff0000;"></i> <span data-key="adsoyad" scope="col" style="color: white; font-weight: bolder; text-shadow: 0px 0px 10px white;">Mernis 2023</span>
                        </a>

                        <div class="collapse menu-dropdown" id="sidebarSorgular">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="adsoyad" class="nav-link" data-key="t-adsoyad">Ad Soyad Sorgu <span class="badge rounded-pill badge-soft-success">2023</span></a>
                                </li>
                            </ul>
                                <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="tcsorgu" class="nav-link" data-key="t-tcsorgu">TC Sorgu<span class="badge rounded-pill badge-soft-success">2023</span> </a>
                                </li>
                            </ul>
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="tcdetay" class="nav-link" data-key="t-tcdetay">TC Sorgu Pro<span class="badge rounded-pill badge-soft-success">Detaylı</span> </a>
                                </li>       
                            </ul>
							 <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="adres" class="nav-link" data-key="t-adres">Adres Sorgu<span class="badge rounded-pill badge-soft-success">2023</span> </a>
                                </li>
                            </ul>
                             <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="okulno" class="nav-link" data-key="t-eokulno">E-Okul No Sorgu<span class="badge rounded-pill badge-soft-success">2023</span> </a>
                                </li>
                            </ul>
							 <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="ilac" class="nav-link" data-key="t-ilac">İlac Sorgu<span class="badge rounded-pill badge-soft-success">2023</span> </a>
                                </li>
                            </ul> 
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="muayene" class="nav-link" data-key="t-muayene">Muayene Sorgu<span class="badge rounded-pill badge-soft-success">2023</span> </a>
                                </li>
                            </ul> 
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="esnaf" class="nav-link" data-key="t-esnaf">Esnaf Sorgu<span class="badge rounded-pill badge-soft-success">2023</span> </a>
                                </li>
                            </ul> 
							 <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="ayakno" class="nav-link" data-key="t-ayakno">Ayak No Sorgu<span class="badge rounded-pill badge-soft-success">2023</span> </a>
                                </li>
                            </ul>
                            
                        </div>

                    </li>

                                         <!-- AİLE SECTION -->
                                         <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebaraile" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarDashboards">
                            <i class="ri-attachment-line" scope="col" style="color: #ff0000; font-weight: bolder; text-shadow: 0px 0px 10px #ff0000;"></i> <span data-key="ailesorgu" scope="col" style="color: white; font-weight: bolder; text-shadow: 0px 0px 10px white;">Aile Çözümleri</span>
                        </a>

                        <div class="collapse menu-dropdown" id="sidebaraile">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="aile" class="nav-link" data-key="t-aile">Aile Sorgu<span class="badge rounded-pill badge-soft-success">2023</span></a>
                                </li>
                            </ul>
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="sulale" class="nav-link" data-key="t-sulale">Sülale Sorgu<span class="badge rounded-pill badge-soft-success">Pro</span></a>
                                </li>
                            </ul>
							
                        </div>
						

                    </li>

						 <!-- GSM -->
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarGSM" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebaradres">
                            <i class="ri-phone-fill" scope="col" style="color: #ff0000; font-weight: bolder; text-shadow: 0px 0px 10px #ff0000;"></i> <span data-key="sidebarGSM" scope="col" style="color: white; font-weight: bolder; text-shadow: 0px 0px 10px white;">GSM Çözümleri</span>
                        </a>

                        <div class="collapse menu-dropdown" id="sidebarGSM">
                        <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="gsmtc" class="nav-link" data-key="t-sidebargsmtc">GSM'den TC<span class="badge rounded-pill badge-soft-success">2023</span></a>
                                </li>
                            </ul>
							 <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="tcgsm" class="nav-link" data-key="t-tcgsm">TC'den GSM<span class="badge rounded-pill badge-soft-success">2023</span></a>
                                </li>
                            </ul>

                        </div>

                    </li>

                    </li>
                    <!-- ARAÇLAR -->
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebararaclar" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebararaclar">
                            <i class="ri-tools-fill" scope="col" style="color: #ff0000; font-weight: bolder; text-shadow: 0px 0px 10px #ff0000;"></i> <span data-key="sidebarvesikalik" scope="col" style="color: white; font-weight: bolder; text-shadow: 0px 0px 10px white;">Vesikalık Çözümleri</span>
                        </a>

                        <div class="collapse menu-dropdown" id="sidebararaclar">
                        <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="eokulvesika" class="nav-link" data-key="t-eokulvesika">E-Okul Vesika<span class="badge rounded-pill badge-soft-success">2023</span> </a>
                                </li>
                            </ul>
							 

                        </div>

                    </li>

                    </li>
					<!-- ARAÇLAR -->
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebararaclar" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebararaclar">
                            <i class="ri-tools-fill" scope="col" style="color: #ff0000; font-weight: bolder; text-shadow: 0px 0px 10px #ff0000;"></i> <span data-key="sidebararaclar" scope="col" style="color: white; font-weight: bolder; text-shadow: 0px 0px 10px white;">Diğer Araçlar</span>
                        </a>

                        <div class="collapse menu-dropdown" id="sidebararaclar">
                        <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="ipsorgu" class="nav-link" data-key="t-ipsorgu">İp Sorgu<span class="badge rounded-pill badge-soft-success">2023</span> </a>
                                </li>
                            </ul>
                            <div class="collapse menu-dropdown" id="sidebararaclar">
                        <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="kimlikolusturucu" class="nav-link" data-key="t-kimlikolusturucu">Kimlik Oluşturucu<span class="badge rounded-pill badge-soft-success">2023</span> </a>
                                </li>
                            </ul>

                        </div>

                    </li>

                    </li>
                    <!-- ARAÇLAR -->
                    
                    <!-- VESIKA SECTION END -->
                    <?php if($userInfo['userRole'] == 1) {?>
                    <!-- ADMIN SECTION -->
                    <li class="nav-item">
                    <li class="menu-title"><span data-key="t-adminSidebar"style="color: #ff0000; font-weight: bolder; text-shadow: 0px 0px 10px #ff0000;">Yönetici</span></li>
                    <a class="nav-link menu-link" href="#sidebarAdmin" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarDashboards">
                         <i class="ri-vip-diamond-fill" scope="col" style="color: #ff0000; font-weight: bolder; text-shadow: 0px 0px 10px #ff0000;"></i> <span data-key="t-adminSidebar" scope="col" style="color: white; font-weight: bolder; text-shadow: 0px 0px 10px white;">Admin</span>
                    </a>

                    <div class="collapse menu-dropdown" id="sidebarAdmin">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="announcement" class="nav-link" data-key="t-announcementPost"> Duyuru Paylaşımı
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="users" class="nav-link" data-key="t-Kullanıcılar"> Kullanıcılar </a>
                            </li>
                        </ul>
                    </div>
                    </li>

                    <?php } ?>
                    <!-- ADMIN SECTION END -->
                </ul>
            </div>
            <!-- Sidebar -->
        </div>
    </div>
    <div class="sidebar-background"></div>
</div>
<div class="vertical-overlay"></div>