<?php
$db = "";
// Required Files
require_once __DIR__ . '/header.php';
use Apkpanel\Account;
if (isset($_POST['change'])) {
    if ($_POST['t_name'] !== "0") {
        $account = new Account($db, $_SESSION['username']);
        $t_name = $_POST['t_name'];
        $template = $account->getTemplate($t_name);
        header("Content-type: application/json; charset=UTF-8");
        print_r(json_encode($template));
    }
}