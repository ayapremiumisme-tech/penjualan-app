<?php

require_once __DIR__ . '/../config/config.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <!-- ===================================== -->
    <!-- META TAG -->
    <!-- ===================================== -->

    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible"
        content="IE=edge">

    <!-- ===================================== -->
    <!-- SEO -->
    <!-- ===================================== -->

    <title><?= APP_NAME; ?></title>

    <meta name="description"
        content="Sistem Informasi Penjualan Modern Berbasis Web">

    <meta name="keywords"
        content="POS, kasir, toko, penjualan, dashboard admin">

    <meta name="author"
        content="Penjualan App">

    <!-- ===================================== -->
    <!-- FAVICON -->
    <!-- ===================================== -->

    <link rel="shortcut icon"
        href="<?= APP_URL; ?>/assets/images/logo/logo.png"
        type="image/png">

    <!-- ===================================== -->
    <!-- GOOGLE FONT -->
    <!-- ===================================== -->

    <link rel="preconnect"
        href="https://fonts.googleapis.com">

    <link rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- ===================================== -->
    <!-- BOOTSTRAP CSS -->
    <!-- ===================================== -->

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <!-- ===================================== -->
    <!-- FONT AWESOME -->
    <!-- ===================================== -->

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- ===================================== -->
    <!-- DATATABLES -->
    <!-- ===================================== -->

    <link rel="stylesheet"
        href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">

    <!-- ===================================== -->
    <!-- ANIMATE CSS -->
    <!-- ===================================== -->

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <!-- ===================================== -->
    <!-- AOS ANIMATION -->
    <!-- ===================================== -->

    <link rel="stylesheet"
        href="https://unpkg.com/aos@2.3.1/dist/aos.css">

    <!-- ===================================== -->
    <!-- SWEET ALERT -->
    <!-- ===================================== -->

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-4/bootstrap-4.min.css">

    <!-- ===================================== -->
    <!-- CUSTOM CSS -->
    <!-- ===================================== -->

    <link rel="stylesheet"
        href="<?= APP_URL; ?>/assets/css/style.css">

    <link rel="stylesheet"
        href="<?= APP_URL; ?>/assets/css/dashboard.css">

    <link rel="stylesheet"
        href="<?= APP_URL; ?>/assets/css/auth.css">

    <link rel="stylesheet"
        href="<?= APP_URL; ?>/assets/css/sidebar.css">

    <link rel="stylesheet"
        href="<?= APP_URL; ?>/assets/css/navbar.css">

    <link rel="stylesheet"
        href="<?= APP_URL; ?>/assets/css/cards.css">

    <link rel="stylesheet"
        href="<?= APP_URL; ?>/assets/css/tables.css">

    <link rel="stylesheet"
        href="<?= APP_URL; ?>/assets/css/darkmode.css">

    <link rel="stylesheet"
        href="<?= APP_URL; ?>/assets/css/responsive.css">

    <link rel="stylesheet"
        href="<?= APP_URL; ?>/assets/css/animation.css">

    <link rel="stylesheet"
        href="<?= APP_URL; ?>/assets/css/loader.css">

    <!-- ===================================== -->
    <!-- CUSTOM INLINE STYLE -->
    <!-- ===================================== -->

    <style>

        body{
            overflow-x:hidden;
        }

        .main-wrapper{
            min-height:100vh;
        }

        .content-wrapper{
            padding:20px;
        }

        .page-title{
            font-size:24px;
            font-weight:600;
            margin-bottom:20px;
        }

        .cursor-pointer{
            cursor:pointer;
        }

    </style>

</head>

<body>

<!-- ===================================== -->
<!-- LOADER -->
<!-- ===================================== -->

<div id="loader"
    style="
    display:none;
    position:fixed;
    z-index:99999;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background:rgba(255,255,255,0.7);
">

    <div class="d-flex
        justify-content-center
        align-items-center
        h-100">

        <div class="loader"></div>

    </div>

</div>

<!-- ===================================== -->
<!-- MAIN WRAPPER -->
<!-- ===================================== -->

<div class="main-wrapper">

<!-- ===================================== -->
<!-- FLASH MESSAGE -->
<!-- ===================================== -->

<?php if(isset($_SESSION['success'])) : ?>

    <script>

        document.addEventListener("DOMContentLoaded", function(){

            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '<?= $_SESSION['success']; ?>',
                timer: 2500,
                showConfirmButton: false
            });

        });

    </script>

    <?php unset($_SESSION['success']); ?>

<?php endif; ?>


<?php if(isset($_SESSION['error'])) : ?>

    <script>

        document.addEventListener("DOMContentLoaded", function(){

            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '<?= $_SESSION['error']; ?>',
                timer: 2500,
                showConfirmButton: false
            });

        });

    </script>

    <?php unset($_SESSION['error']); ?>

<?php endif; ?>