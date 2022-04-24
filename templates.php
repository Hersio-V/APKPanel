<?php
$db = "";
// Header
include __DIR__ . "/header.php";
$account = new \Apkpanel\Account($db, $_SESSION['username']);
$templates = $account->getTemplates('t_name');

?>
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-10">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">İçerik Taslakları</strong>
                            </div>
                            <div class="card-body">
                                <form action="" method="post" class="form-horizontal">
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="selectSm" class="form-control-label">Taslak
                                                Seç</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <select name="selectTemplate" id="SelectLm"
                                                    class="form-control-sm form-control" onchange="getTemplate(this.value)">
                                                <option value="0">Yeni Ekle</option>
                                                <?php  foreach ($templates as $template) { ?>
                                               <option value="<?php echo $template; ?>"><?php echo $template; ?></option>
<?php }  ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="text-input" class=" form-control-label">Taslak
                                                Adı</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" id="templateName" name="name"
                                                   placeholder="Taslak Adı" class="form-control">
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="text-input" class=" form-control-label">Yazı Başlığı
                                                Taslağı</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" id="templateTitle" name="title"
                                                   placeholder="Başlık Taslağı" class="form-control">
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="textarea-input" class=" form-control-label">Yazı
                                                İçeriği Taslağı</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                                        <textarea name="content" id="templateContent" rows="9"
                                                                  placeholder="Taslağınız.." class="form-control"
                                                                  spellcheck="false"></textarea>
                                        </div>
                                    </div>

                                    <button id="saveTemplate" name="saveTemplate" type="submit" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Kaydet</button>
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
function getTemplate(t_name) {
            $.ajax({
                type: "POST",
                url: "<?php echo $url . "settings/actions/changeTemplate.php"; ?>",
                data: "t_name=" + t_name + "&change=true",
                success: function (response) {
                    $("#templateName").val(response.t_name);
                    $("#templateTitle").val(response.t_title);
                    $("#templateContent").val(response.t_content);
                },
                error: function () {
                } // Eğer ki kontrolAjax.php ile iletişim kuramazsa hata olduğunu belirtecek
            });


}
</script>
<?php
// Footer
include __DIR__ . "/footer.php";
