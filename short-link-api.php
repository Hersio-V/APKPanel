<?php
$db = "";
$url = "";

// Header
include __DIR__ . "/header.php";

use Apkpanel\Account;

$username = $_SESSION['username'];
$account = new Account($db,$username);
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
                                                    Ayarlarınız kaydedilemedi.
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
                                                    Ayarlarınız kaydedildi.
                                             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                             <span aria-hidden="true">×</span>
                                                                                     </button>
                                                                                                          </div>';
                        break;
                }

                ?>
                <div class="row">
                    <div class="col-lg-10">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Kısa Link API (BC.VC)</strong>
                            </div>
                            <div class="card-body">
                                <form action="<?php echo $url; ?>settings/actions/userSettings.php" method="post" class="form-horizontal">
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="u_short_api_id"
                                                   class=" form-control-label">API Id</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" id="u_short_api_id" value="<?php echo $account->getUser('u_short_api_id'); ?>" name="u_short_api_id"
                                                   class="form-control">
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="u_short_api_key"
                                                   class=" form-control-label">API Key</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" id="u_short_api_key" value="<?php echo $account->getUser('u_short_api_key'); ?>" name="u_short_api_key"
                                                   class="form-control">
                                        </div>
                                    </div>
                                    <button id="saveShortLinkSettings" name="saveShortLinkSettings" type="submit" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Kaydet</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
// Footer
include __DIR__ . "/footer.php";
