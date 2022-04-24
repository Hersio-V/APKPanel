<?php
include __DIR__ . '/header.php';
?>
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <?php

                switch (@$_GET['status']) {
                    case 'success':
                        echo '<div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                                    <span class="badge badge-pill badge-success">Başarılı</span>
                                                    Giriş yapıldı.
                                             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                             <span aria-hidden="true">×</span>
                                                                                     </button>
                                                                                                          </div>';
                        break;
                }

                ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="overview-wrap">
                            <h2 class="title-1">Hoşgeldin, <?php echo $_SESSION['username']; ?> </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
include __DIR__ . '/footer.php';