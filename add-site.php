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
                                <strong class="card-title">Site Ekle</strong>
                            </div>
                            <div class="card-body">
                                <form action="<?php echo $url; ?>settings/actions/siteSettings.php" method="post" class="form-horizontal">

                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="s_url"
                                                   class=" form-control-label">Site URL</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" required id="s_url" name="s_url" placeholder="http://example.com" autocomplete="off" class="form-control">
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="s_username"
                                                   class=" form-control-label">Kullanıcı Adı</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input required type="text" id="s_username" autocomplete="off" name="s_username"
                                                   class="form-control">
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="s_password"
                                                   class="form-control-label">Şifre</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input  required type="password" autocomplete="off" id="s_password" name="s_password"
                                                   class="form-control">
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="s_theme" class="form-control-label">Tema</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <select name="s_theme" id="s_theme" class="form-control">
                                                <option value="default">Varsayılan</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="s_language" class=" form-control-label">Dil</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <select name="s_language" id="s_language" class="form-control">
                                                <option value="en">İngilizce</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="s_shortlink_status" class=" form-control-label">Link Kısaltma</label>
                                        </div>
                                    <label class="switch switch-3d switch-warning mr-3">
                                        <input id="s_shortlink_status" type="checkbox" name="s_shortlink_status" class="switch-input" checked="false">
                                        <span class="switch-label"></span>
                                        <span class="switch-handle"></span>
                                    </label>
                                    </div>



                                    <button id="addSite" name="addSite" type="submit" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Kaydet</button>
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
