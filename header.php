<?php

use Apkpanel\Config;

ob_start();
session_start();
$url = "";
// Required Files
include __DIR__ . '/settings/config/db.php';
include __DIR__ . '/settings/config/settings.php';
include __DIR__ . '/vendor/autoload.php';
// SESSION Check
$config = new Config();
if (!isset($_SESSION[$config->getSessionName()])) {
    header("Location:" . $url . "index.php");
}
?>
<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="APKPanel ile tek tıkla sitene içerik gir">
    <meta name="author" content="Hersio">
    <meta name="keywords" content="APKPanel">

    <!-- Title Page-->
    <title>Ana Sayfa</title>

    <!-- Fontfaces CSS-->
    <link href="<?php echo $url; ?>css/font-face.css" rel="stylesheet" media="all">
    <link href="<?php echo $url; ?>vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="<?php echo $url; ?>vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="<?php echo $url; ?>vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="<?php echo $url; ?>vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="<?php echo $url; ?>vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="<?php echo $url; ?>vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="<?php echo $url; ?>vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="<?php echo $url; ?>vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="<?php echo $url; ?>vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="<?php echo $url; ?>vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="<?php echo $url; ?>vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="<?php echo $url; ?>css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
<div class="page-wrapper">
    <!-- HEADER MOBILE-->
    <header class="header-mobile d-block d-lg-none">
        <div class="header-mobile__bar">
            <div class="container-fluid">
                <div class="header-mobile-inner">
                    <a class="logo" href="<?php echo $url; ?>dashboard.php">
                        <img src="<?php echo $url; ?>images/icon/logo.png" alt="CoolAdmin" />
                    </a>
                    <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                    </button>
                </div>
            </div>
        </div>
        <nav class="navbar-mobile">
            <div class="container-fluid">
                <ul class="navbar-mobile__list list-unstyled">
                    <li class="has-sub">
                        <a class="js-arrow" href="<?php echo $url . 'dashboard.php'; ?>">
                            <i class="fas fa-tachometer-alt"></i>Ana Sayfa</a>
                    </li>
                    <li class="has-sub">
                        <a class="js-arrow open" href="#">
                            <i class="fas fa-gear"></i>Ayarlar</a>
                        <ul class="list-unstyled navbar__sub-list js-sub-list" style="">
                            <li>
                                <a href="<?php echo $url . 'settings.php'; ?>">Hesap</a>
                            </li>
                            <li>
                                <a href="<?php echo $url . 'templates.php'; ?>">İçerik Taslakları</a>
                            </li>
                            <li>
                                <a href="<?php echo $url . 'short-link-api.php'; ?>">Kısa Link API</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- END HEADER MOBILE-->

    <!-- MENU SIDEBAR-->
    <aside class="menu-sidebar d-none d-lg-block">
        <div class="logo">
            <a href="#">
                <img src="<?php echo $url; ?>images/icon/logo.png" alt="Cool Admin" />
            </a>
        </div>
        <div class="menu-sidebar__content js-scrollbar1">
            <nav class="navbar-sidebar">
                <ul class="list-unstyled navbar__list">
                    <li class="has-sub">
                        <a class="js-arrow" href="<?php echo $url . 'dashboard.php'; ?>">
                            <i class="fas fa-tachometer-alt"></i>Ana Sayfa</a>
                    </li>
                    <li class="has-sub">
                        <a class="js-arrow open" href="#">
                            <i class="fas fa-gear"></i>Ayarlar</a>
                        <ul class="list-unstyled navbar__sub-list js-sub-list" style="">
                            <li>
                                <a href="<?php echo $url . 'settings.php'; ?>">Hesap</a>
                            </li>
                            <li>
                                <a href="<?php echo $url . 'templates.php'; ?>">İçerik Taslakları</a>
                            </li>
                            <li>
                                <a href="<?php echo $url . 'short-link-api.php'; ?>">Kısa Link API</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>
    <!-- END MENU SIDEBAR-->

    <!-- PAGE CONTAINER-->
    <div class="page-container">
        <!-- HEADER DESKTOP-->
        <header class="header-desktop">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="header-wrap">
                        <div class="header-button">

                            <div class="account-wrap">
                                <div class="account-item clearfix js-item-menu">
                                    <div class="content">
                                        <a class="js-acc-btn" href="#"><?php echo $_SESSION['username']; ?></a>
                                    </div>
                                    <div class="account-dropdown js-dropdown">
                                        <div class="info clearfix">
                                            <div class="content">
                                                <h5 class="name">
                                                    <a href="#"><?php echo $_SESSION['username']; ?></a>
                                                </h5>
                                                <span class="email"><?php echo $_SESSION['mail']; ?></span>
                                            </div>
                                        </div>
                                        <div class="account-dropdown__body">
                                            <div class="account-dropdown__item">
                                                <a href="<?php echo $url . "settings.php";  ?>">
                                                    <i class="zmdi zmdi-settings"></i>Ayarlar</a>
                                            </div>
                                        </div>
                                        <div class="account-dropdown__footer">
                                            <a href="#">
                                                <i class="zmdi zmdi-power"></i>Logout</a>
                                        </div>


                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- HEADER DESKTOP-->