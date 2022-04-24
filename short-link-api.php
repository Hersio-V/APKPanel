<?php
$db = "";
// Header
include __DIR__ . "/header.php";
$account = new \Apkpanel\Account($db, $_SESSION['username']);
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
                                            <label for="email-input"
                                                   class=" form-control-label">API Id</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" id="email-input" name="api_id"
                                                   class="form-control">
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="email-input"
                                                   class=" form-control-label">API Key</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" id="email-input" name="api_key"
                                                   class="form-control">
                                        </div>
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
