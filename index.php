<!DOCTYPE html>
<html lang="tr">

<head>
    <!-- PHP Files -->
    <?php require_once __DIR__ . '/settings/config/settings.php'; ?>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="APKPANEL">
    <meta name="author" content="Hersio">
    <meta name="keywords" content="">

    <!-- Title Page-->
    <title>Giriş Yap</title>

    <!-- Fontfaces CSS-->
    <link href="<?php echo $url; ?>css/font-face.css" rel="stylesheet" media="all">
    <link href="<?php echo $url; ?>vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="<?php echo $url; ?>vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="<?php echo $url; ?>vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet"
          media="all">

    <!-- Bootstrap CSS-->
    <link href="<?php echo $url; ?>vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="<?php echo $url; ?>vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="<?php echo $url; ?>vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet"
          media="all">
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
    <div class="page-content--bge5">
        <div class="container">
            <div class="login-wrap">
                <?php

                switch (@$_GET['status']) {
                    case 'error':
                        echo ' <div class="alert alert-danger" role="alert">
            Kullanıcı adı veya şifre hatalı!
        </div>';
                        break;
                    case 'server-error':
                        echo '<div class="alert alert-warning" role="alert">
            Hata! lütfen daha sonra tekrar deneyin.
        </div>';
                        break;
                }

                ?>
                <div class="login-content">
                    <div class="login-form">
                        <form action="<?php echo $url; ?>settings/actions/login.php" method="POST">
                            <div class="form-group">
                                <label for="username">Kullanıcı adı</label>
                                <input id="username" class="au-input au-input--full" type="text" name="username"
                                       placeholder="Username">
                            </div>
                            <div class="form-group">
                                <label for="password">Şifre</label>
                                <input id="password" class="au-input au-input--full" type="password" name="password"
                                       placeholder="Password">
                            </div>
                            <button name="log-in" class="au-btn au-btn--block au-btn--green m-b-20" type="submit">Giriş
                                Yap
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Jquery JS-->
<script src="<?php echo $url; ?>vendor/jquery-3.2.1.min.js"></script>
<!-- Bootstrap JS-->
<script src="<?php echo $url; ?>vendor/bootstrap-4.1/popper.min.js"></script>
<script src="<?php echo $url; ?>vendor/bootstrap-4.1/bootstrap.min.js"></script>
<!-- Vendor JS       -->
<script src="<?php echo $url; ?>vendor/slick/slick.min.js">
</script>
<script src="<?php echo $url; ?>vendor/wow/wow.min.js"></script>
<script src="<?php echo $url; ?>vendor/animsition/animsition.min.js"></script>
<script src="<?php echo $url; ?>vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
</script>
<script src="<?php echo $url; ?>vendor/counter-up/jquery.waypoints.min.js"></script>
<script src="<?php echo $url; ?>vendor/counter-up/jquery.counterup.min.js">
</script>
<script src="<?php echo $url; ?>vendor/circle-progress/circle-progress.min.js"></script>
<script src="<?php echo $url; ?>vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="<?php echo $url; ?>vendor/chartjs/Chart.bundle.min.js"></script>
<script src="<?php echo $url; ?>vendor/select2/select2.min.js">
</script>

<!-- Main JS-->
<script src="<?php echo $url; ?>js/main.js"></script>

</body>

</html>
<!-- end document-->