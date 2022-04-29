<?php
$db = "";
$url = "";

use Apkpanel\Account;

// Header
include __DIR__ . "/header.php";
$account = new Account($db, $_SESSION['username']);
?>
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
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
                                    <th>
                                        <label class="au-checkbox">
                                            <input type="checkbox">
                                            <span class="au-checkmark"></span>
                                        </label>
                                    </th>
                                    <th>URL</th>
                                    <th>Tema</th>
                                    <th>DIL</th>
                                    <th>LINK KISALTMA</th>
                                    <th>DURUM</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>

                                <tr class="spacer"></tr>
                                <tr class="tr-shadow">
                                    <td>
                                        <label class="au-checkbox">
                                            <input type="checkbox">
                                            <span class="au-checkmark"></span>
                                        </label>
                                    </td>
                                    <td>Lori Lynch</td>
                                    <td>
                                        <span class="block-email">doe@example.com</span>
                                    </td>
                                    <td class="desc">Camera C430W 4k</td>
                                    <td>2018-09-24 19:10</td>
                                    <td>
                                        <span class="status--process">Processed</span>
                                    </td>
                                    <td>
                                        <div class="table-data-feature">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Send">
                                                <i class="zmdi zmdi-mail-send"></i>
                                            </button>
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                                <i class="zmdi zmdi-edit"></i>
                                            </button>
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete">
                                                <i class="zmdi zmdi-delete"></i>
                                            </button>
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="" data-original-title="More">
                                                <i class="zmdi zmdi-more"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
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
