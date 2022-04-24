<?php
$db = "";
// Required Files
require_once __DIR__ . '/header.php';
use Apkpanel\Account;


if (isset($_POST['saveSettings'])) {
    $username = $_SESSION['username'];
    $user = new Account($db, $username);
    $values = ['mail' => $_POST['mail'],'notify' => $_POST['notify']];
    $status = $user->setUserSettings($values);
    header("Location: $url" . "$status[redirect].php?status=$status[status]");
}