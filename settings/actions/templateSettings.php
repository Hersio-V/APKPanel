<?php
$db = "";
$url = "";
// Required Files
require_once __DIR__ . '/header.php';

use Apkpanel\Account;

$account = new Account($db, $_SESSION['username']);
if (isset($_POST['change'])) {
    if ($_POST['t_name'] !== "0") {
        $t_name = $_POST['t_name'];
        $template = $account->getTemplate($t_name);
        header("Content-type: application/json; charset=UTF-8");
        print_r(json_encode($template));
    }
}
if (isset($_POST['saveTemplate'])) {
    $values = ['t_name' => $_POST['templateName'], 't_title' => $_POST['templateTitle'], 't_content' => $_POST['templateContent']];
    if ($_POST['selectTemplate'] == "0") {
        $status = $account->setTemplate($values);
        header("Location: $url" . "$status[redirect].php?status=$status[status]");
    } elseif ($_POST['selectTemplate'] !== "0") {
        $status = $account->updateTemplate($values, $_POST['selectTemplate']);
        header("Location: $url" . "$status[redirect].php?status=$status[status]");
    }
}
if (isset($_POST['deleteTemplate'])) {
    $t_name = $_POST['templateName'];
    if ($_POST['selectTemplate'] !== "0") {
        $status = $account->deleteTemplate($t_name);
        header("Location: $url" . "$status[redirect].php?status=$status[status]");
    }
}