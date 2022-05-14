<?php
$db = "";
$url = "";

use Apkpanel\Site;

// Header
include __DIR__ . "/header.php";
$siteClass = new Site($db, $_SESSION['username']);
$sites = $siteClass->getUserSites();
?>
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <?php

                switch (@$_GET['status']) {
                    case 'error':
                        echo ' <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Başarısız</span>
                                                    Site Limitiniz aşıldı!
                                             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                             <span aria-hidden="true">×</span>
                                                                                     </button>
                                                                                                          </div>';
                        break;
                    case 'server-error':
                        echo '<div class="alert alert-warning" role="alert">
            Hata! lütfen daha sonra tekrar deneyin.
        </div>';
                        break;

                    case 'success':
                        echo '<div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                                    <span class="badge badge-pill badge-success">Başarılı</span>
                                                    Site başarıyla eklendi!
                                             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                             <span aria-hidden="true">×</span>
                                                                                     </button>
                                                                                                          </div>';
                        break;
                }

                ?>
                <div class="row">
                    <div class="col-md-12">

                        <h3 class="title-5 m-b-35">Siteler</h3>
                        <div class="table-data__tool">
                            <div class="table-data__tool-left">
                                <a href="<?php echo $url . 'add-site.php'; ?>"><button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                        <i class="zmdi zmdi-plus"></i>yeni ekle</button></a>
                            </div>
                        </div>
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2">
                                <thead>
                                <tr>
                                    <th>URL</th>
                                    <th>Desteklenen Temalar</th>
                                    <th>DIL</th>
                                    <th>LINK KISALTMA</th>
                                    <th>DURUM</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php foreach ($sites as $site) { ?>
                                    <tr class="spacer"></tr>
                                    <tr class="tr-shadow">
                                        <td><?php echo $site['s_url']; ?></td>
                                        <td><?php echo $site['s_theme']; ?></td>
                                        <td><?php echo $site['s_language']; ?></td>
                                        <td><?php echo $site['s_shortlink_status'] ? '<button type="button" class="btn btn-success btn-sm">Aktif</button>' : '<button type="button" class="btn btn-danger btn-sm">Pasif</button>'; ?></td>
                                        <td><?php echo $site['s_status'] ? '<button type="button" class="btn btn-success btn-sm">Aktif</button>' : '<button type="button" class="btn btn-danger btn-sm">Pasif</button>'; ?></td>
                                        <td>
                                            <div class="table-data-feature">
                                                <button class="item" data-toggle="tooltip" data-placement="top" title=""
                                                        data-original-title="Edit">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </button>
                                                <button class="item" data-toggle="tooltip" data-placement="top" title=""
                                                        data-original-title="Delete">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </button>
                                                <button class="item" data-toggle="tooltip" data-placement="top" title=""
                                                        data-original-title="More">
                                                    <i class="zmdi zmdi-more"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php  }  ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
// Footer
include __DIR__ . "/footer.php";
