<?php
$db = "";
$url = "";
// Header
include __DIR__ . "/header.php";
$account = new \Apkpanel\Account($db, $_SESSION['username']);
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
                                <strong class="card-title">Hesap Ayarları</strong>
                            </div>
                            <div class="card-body">
                                <form action="<?php echo $url; ?>settings/actions/userSettings.php" method="post" class="form-horizontal">
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label class=" form-control-label">Kullanıcı Adı</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <p class="form-control-static"><?php echo $account->getUser("u_username"); ?></p>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="email-input"
                                                   class=" form-control-label">Email</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="email" id="email-input" name="mail"
                                                   value="<?php echo $account->getUser("u_mail"); ?>"
                                                   placeholder="Enter Email" class="form-control">
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="password-input"
                                                   class=" form-control-label">Şifre</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="password" id="password-input" name="password"
                                                   value="**************" disabled="" class="form-control">
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="disabled-input" class=" form-control-label">Site
                                                Limiti</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" id="disabled-input" name="site_limit"
                                                   value="<?php echo $account->getUser("u_site_limit"); ?>"
                                                   placeholder="" disabled="" class="form-control">
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="disabled-input"
                                                   class=" form-control-label">Lisans</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" id="disabled-input" name="license"
                                                   value="<?php echo $account->getUser("u_license"); ?>"
                                                   placeholder="" disabled="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="disabled-input"
                                                   class=" form-control-label">Bildirim [Mail]</label>
                                        </div>
                                        <label class="switch switch-3d switch-info mr-3">
                                            <?php if ($account->getUser("u_notify")) { ?>
                                                <input type="checkbox" name="notify" class="switch-input"
                                                       checked="true">
                                            <?php } else { ?>
                                                <input type="checkbox" name="notify" class="switch-input"
                                                       checked="false">
                                            <?php } ?>
                                            <span class="switch-label"></span>
                                            <span class="switch-handle"></span>
                                        </label>
                                    </div>

                                    <button id="saveSettings" name="saveSettings" type="submit" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Kaydet</button>
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
