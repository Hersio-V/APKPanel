<?php
$db = "";
// Required Files
require_once __DIR__ . '/header.php';
use Apkpanel\Login;


if (isset($_POST['log-in'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user = new Login($db, $username, $password);
    $loginStatus = $user->login();
    header("Location: ../../$loginStatus[redirect].php?status=$loginStatus[status]");
}