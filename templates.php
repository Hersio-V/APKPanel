<?php

use Apkpanel\Account;

$db = "";
$url = "";
// Header
include __DIR__ . "/header.php";
$account = new Account($db, $_SESSION['username']);
$templates = $account->getTemplates('t_name');

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
                                <strong class="card-title">İçerik Taslakları</strong>
                            </div>
                            <div class="card-body">
                                <form action="<?php echo $url . "settings/actions/templateSettings.php"; ?>"
                                      method="post" class="form-horizontal">
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="selectTemplate" class="form-control-label">Taslak
                                                Seç</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <select name="selectTemplate" id="selectTemplate"
                                                    class="form-control-sm form-control"
                                                    onchange="getTemplate(this.value)">
                                                <option value="0">Yeni Ekle</option>
                                                <?php foreach ($templates as $template) { ?>
                                                    <option value="<?php echo $template; ?>"><?php echo $template; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="templateName" class=" form-control-label">Taslak
                                                Adı</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" id="templateName" name="templateName"
                                                   placeholder="Taslak Adı" class="form-control">
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="templateTitle" class=" form-control-label">Yazı Başlığı
                                                Taslağı</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" id="templateTitle" name="templateTitle"
                                                   placeholder="Başlık Taslağı" class="form-control">
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="templateContent" class=" form-control-label">Yazı
                                                İçeriği Taslağı</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                                        <textarea name="templateContent" id="templateContent" rows="9"
                                                                  placeholder="Taslağınız.." class="form-control"
                                                                  spellcheck="false"></textarea>
                                        </div>
                                    </div>

                                    <button id="saveTemplate" name="saveTemplate" type="submit"
                                            class="btn btn-success btn-sm"><i class="fa fa-check"></i> Kaydet
                                    </button>
                                    <button id="deleteTemplate" disabled name="deleteTemplate" type="submit"
                                            class="btn btn-danger btn-sm"><i class="fa fa-times-circle"></i> Sil
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- getTemplate -->
    <script type="text/javascript">

        $( document ).ready(function() {
            document.getElementById("deleteTemplate").disabled = $("#selectTemplate").val() === "0";
        });
        function getTemplate(t_name) {
            document.getElementById("deleteTemplate").disabled = $("#selectTemplate").val() === "0";
            $.ajax({
                type: "POST",
                url: "<?php echo $url . "settings/actions/templateSettings.php"; ?>",
                data: "t_name=" + t_name + "&change=true",
                success: function (response) {
                    $('#templateName').val(response.t_name);
                    $('#templateTitle').val(response.t_title);
                    $('#templateContent').val(response.t_content);
                }
            })}

    </script>

<?php
// Footer
include __DIR__ . "/footer.php";
