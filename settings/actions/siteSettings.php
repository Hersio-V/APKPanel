<?php
$db = "";
$url = "";
// Required Files
require_once __DIR__ . '/header.php';
require_once __DIR__ . '/../../../wordpress/wp-load.php';
require_once __DIR__ . '/../../../wordpress/wp-includes/class-IXR.php';
require_once __DIR__ . '/../../../wordpress/wp-includes/class-wp-http-ixr-client.php';
require_once __DIR__ . '/../../../wordpress/wp-includes/IXR/class-IXR-server.php';
require_once __DIR__ . '/../../../wordpress/wp-includes/IXR/class-IXR-base64.php';
require_once __DIR__ . '/../../../wordpress/wp-includes/IXR/class-IXR-client.php';
require_once __DIR__ . '/../../../wordpress/wp-includes/IXR/class-IXR-clientmulticall.php';
require_once __DIR__ . '/../../../wordpress/wp-includes/IXR/class-IXR-date.php';
require_once __DIR__ . '/../../../wordpress/wp-includes/IXR/class-IXR-error.php';
require_once __DIR__ . '/../../../wordpress/wp-includes/IXR/class-IXR-introspectionserver.php';
require_once __DIR__ . '/../../../wordpress/wp-includes/IXR/class-IXR-message.php';
require_once __DIR__ . '/../../../wordpress/wp-includes/IXR/class-IXR-request.php';
require_once __DIR__ . '/../../../wordpress/wp-includes/IXR/class-IXR-value.php';
require_once __DIR__ . '/../../../wordpress/wp-includes/class-wp-xmlrpc-server.php';

use Apkpanel\Site;

if (isset($_POST['s_shortlink_status'])) {
    $values = [
        's_url' => $_POST['s_url'],
        's_username' => $_POST['s_username'],
        's_password' => $_POST['s_password'],
        's_theme' => $_POST['s_theme'],
        's_language' => $_POST['s_language'],
        's_shortlink_status' => 1
    ];
} else {
    $values = [
        's_url' => $_POST['s_url'],
        's_username' => $_POST['s_username'],
        's_password' => $_POST['s_password'],
        's_theme' => $_POST['s_theme'],
        's_language' => $_POST['s_language'],
        's_shortlink_status' => 0
    ];
}

$site = new Site($db, $_SESSION['username'], $values);
if (isset($_POST['addSite'])) {
    $status = $site->setSite();
}

if (isset($status)) {
    header("Location: $url" . "$status[redirect].php?status=$status[status]");
}