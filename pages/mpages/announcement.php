<?php
use jesuzweq\System;
use jesuzweq\ZFunctions;
$ann = System::table('announcement')->get();

if(@$_POST['deleteBtn']) {
    $id = System::filter($_POST['deleteBtn']);

    System::table('announcement')->where('id', $id)->delete();
    header("Location: /announcement");
    return exit();
}

if(@$_POST['shareBtn'] == "1") {
    $content = System::filter($_POST['annContentBox']);
    $prContent = System::filter($_POST['annContentPrBox']);
    $color = System::filter($_POST['colorSelect']);

    if(!$content) {
        $content = "Belirtilmemiş";
    } 
    if (!$prContent) {
        $prContent = "Duyuru";
    }

    System::table('announcement')->create([
        'annContent' => $content,
        'annTime' => date("Y-m-d"),
        'annPriority' => $prContent,
        'annPriorityColor' => $color
    ]);

    header("Location: /announcement");
    return exit();
}

ZFunctions::adminControl();

?>

<div class="container-fluid">
                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0"><?=$title?></h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="https://discord.gg/lexas">Lexas</a></li>
                                        <li class="breadcrumb-item active"><?=$title?></li>
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
                            <!-- succesfully deleted -->
                            <?php if(@$alert == "deleted") {?>
                                <div class="alert alert-success alert-top-border alert-dismissible shadow fade show" role="alert">
                                    <i class="ri-error-warning-fill me-3 align-middle fs-16 text-success"></i><strong>Başarılı</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php } ?>

                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">Duyuru İçeriği Paylaş</h4>
                                </div><!-- end card header -->

                                <div class="card-body">
                                    <form method="POST">
                                        <div class="row">

                                            <div class="col-xl-12">
                                                <div class="mb-3">
                                                    <label for="cleave-ccard" class="form-label">İçerik</label>
                                                    <input type="text" name="annContentBox" class="form-control" id="cleave-ccard" placeholder="Çok önemli duyuru" oninvalid="this.setCustomValidity('Lütfen boş bırakmayınız...')" oninput="this.setCustomValidity('')">
                                                </div>
                                            </div><!-- end col -->

                                            <div class="col-xl-12">
                                                <div class="mb-3">
                                                    <label for="cleave-ccard" class="form-label">Başlık</label>
                                                    <input type="text" name="annContentPrBox" class="form-control" id="cleave-ccard" placeholder="Duyuru" oninvalid="this.setCustomValidity('Lütfen boş bırakmayınız...')" oninput="this.setCustomValidity('')">
                                                </div>
                                            </div><!-- end col -->

                                            <div class="col-xl-12">
                                                <div class="mb-3">
                                                    <label for="cleave-ccard" class="form-label">Renk</label>
                                                    <select name="colorSelect" class="form-select form-select-sm  mb-12" aria-label=".form-select-sm example">
                                                        <!-- <option selected>Kırmızı</option> -->
                                                        <option value="0">Kırmızı</option>
                                                        <option value="1">Sarı</option>
                                                        <option value="2">Yeşil</option>
                                                        <option value="3">Mavi</option>
                                                        <option value="4">Mor</option>
                                                    </select>
                                                </div>
                                                <button type="submit" name="shareBtn" value="1" class="btn btn-primary waves-effect waves-light">Paylaş</button>
                                            </div><!-- end col -->
                                        </div><!-- end row -->
                                    </form><!-- end form -->
                                </div><!-- end card-body -->
                            </div><!-- end card -->
                        </div>
                        <!-- end col -->
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

                                <form method="POST">
                                <?php
                                $annCount = count($ann);
                                if(!$annCount == null) {
                                    for ($i = 0; $i < $annCount; $i++) {
                                        $content = $ann[$i]->annContent;
                                        $id = $ann[$i]->id;
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
                                                <p class="text-truncate text-muted fs-14 mb-0">
                                                <p class="text-truncate text-muted fs-14 mb-0"><button type="submit" name="deleteBtn" class="btn btn-danger btn-sm btn-icon waves-effect waves-light" value="'.$id.'"><i class="ri-delete-bin-5-line"></i></button>
                                                <span
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
                                </form>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                </div>
                <!-- ============================================================== -->