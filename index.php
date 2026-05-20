<?php
session_start();

// Redirect berdasarkan role user
if (isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'admin') {
        header("Location: admin/dashboard.php");
        exit;
    }

    if ($_SESSION['role'] == 'cashier') {
        header("Location: cashier/index.php");
        exit;
    }

    if ($_SESSION['role'] == 'user') {
        header("Location: user/home.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penjualan App</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/vendor/fontawesome/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">

    <style>
        body{
            background: #f5f7fb;
            font-family: Arial, sans-serif;
        }

        .hero{
            min-height: 100vh;
            display:flex;
            align-items:center;
            justify-content:center;
        }

        .hero-content{
            text-align:center;
        }

        .hero-content h1{
            font-size:60px;
            font-weight:bold;
            color:#0d6efd;
        }

        .hero-content p{
            font-size:20px;
            color:#555;
        }

        .btn-custom{
            padding:12px 30px;
            border-radius:10px;
            font-size:18px;
        }
    </style>
</head>
<body>

<div class="container hero">
    <div class="hero-content">

        <h1>
            <i class="fas fa-store"></i>
            Penjualan App
        </h1>

        <p>
            Sistem Informasi Penjualan Modern Berbasis Web
        </p>

        <div class="mt-4">

            <a href="auth/login.php" class="btn btn-primary btn-custom">
                <i class="fas fa-sign-in-alt"></i>
                Login
            </a>

            <a href="auth/register.php" class="btn btn-outline-primary btn-custom">
                <i class="fas fa-user-plus"></i>
                Register
            </a>

        </div>

    </div>
</div>

<!-- Bootstrap JS -->
<script src="assets/vendor/bootstrap/bootstrap.bundle.min.js"></script>

</body>
</html>