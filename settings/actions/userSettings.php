<?php
$db = "";
$url = "";
// Required Files
require_once __DIR__ . '/header.php';
use Apkpanel\Account;

$username = $_SESSION['username'];
$user = new Account($db, $username);


if (isset($_POST['saveShortLinkSettings'])) {
    $values = ['u_short_api_key' => $_POST['u_short_api_key'],'u_short_api_id' => $_POST['u_short_api_id']];
    $status = $user->setShortLinkApi($values);
    header("Location: $url" . "$status[redirect].php?status=$status[status]");
}