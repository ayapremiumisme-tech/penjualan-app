<?php

session_start();

require_once '../config/config.php';
require_once '../config/database.php';

include '../includes/header.php';
include 'navbar.php';

/*
|--------------------------------------------------------------------------
| GET PRODUCTS
|--------------------------------------------------------------------------
*/

$products = mysqli_query(
    $conn,
    "SELECT * FROM products
    ORDER BY id DESC
    LIMIT 6"
);

?>

<style>

body{
    background:
    linear-gradient(
        135deg,
        #6c8cff,
        #7b4dbe
    );

    min-height:100vh;

    font-family:'Poppins', sans-serif;

    color:white;
}

/* HERO */

.hero-section{
    text-align:center;

    padding:100px 20px 80px;
}

.hero-title{
    font-size:65px;

    font-weight:700;

    margin-bottom:20px;
}

.hero-subtitle{
    font-size:20px;

    opacity:0.9;

    margin-bottom:35px;
}

/* BUTTON */

.btn-modern{
    border:none;

    border-radius:14px;

    background:white;

    color:#6c63ff;

    font-weight:600;

    padding:14px 28px;

    transition:0.3s;
}

.btn-modern:hover{
    background:#f3f4f6;
}

/* GLASS */

.glass-card{
    background:
    rgba(255,255,255,0.15);

    backdrop-filter:blur(12px);

    border:
    1px solid rgba(255,255,255,0.2);

    border-radius:25px;

    overflow:hidden;

    transition:0.3s;

    box-shadow:
    0 8px 30px rgba(0,0,0,0.2);
}

.glass-card:hover{
    transform:translateY(-5px);

    box-shadow:
    0 12px 35px rgba(0,0,0,0.3);
}

/* PRODUCT */

.product-image{
    width:100%;
    height:240px;

    object-fit:cover;
}

.product-body{
    padding:20px;
}

.product-title{
    font-size:20px;

    font-weight:600;
}

.product-price{
    color:#ffe082;

    font-size:24px;

    font-weight:bold;
}

/* SECTION */

.section-title{
    font-size:40px;

    font-weight:700;
}

/* FEATURE */

.feature-box{
    text-align:center;

    padding:30px;
}

.feature-icon{
    font-size:50px;

    margin-bottom:20px;
}

/* NAVBAR */

.navbar{
    background:transparent !important;
}

.navbar a{
    color:white !important;
}

</style>

<div class="container">

    <!-- HERO -->

    <div class="hero-section">

        <h1 class="hero-title">

            Penjualan App

        </h1>

        <p class="hero-subtitle">

            Sistem Informasi Penjualan Modern
            Dengan Tampilan Premium Dan Elegan

        </p>

        <div class="d-flex justify-content-center gap-3 flex-wrap">

            <a href="products.php"
                class="btn btn-modern">

                Belanja Sekarang

            </a>

            <a href="../auth/register.php"
                class="btn btn-modern">

                Register

            </a>

        </div>

    </div>

    <!-- FEATURES -->

    <div class="row mb-5">

        <div class="col-md-4 mb-4">

            <div class="glass-card feature-box h-100">

                <div class="feature-icon">

                    ⚡

                </div>

                <h4 class="fw-bold mb-3">

                    Fast Process

                </h4>

                <p>

                    Proses transaksi cepat
                    dan mudah digunakan

                </p>

            </div>

        </div>

        <div class="col-md-4 mb-4">

            <div class="glass-card feature-box h-100">

                <div class="feature-icon">

                    🔒

                </div>

                <h4 class="fw-bold mb-3">

                    Secure Payment

                </h4>

                <p>

                    Pembayaran aman
                    menggunakan QRIS & Bank

                </p>

            </div>

        </div>

        <div class="col-md-4 mb-4">

            <div class="glass-card feature-box h-100">

                <div class="feature-icon">

                    💎

                </div>

                <h4 class="fw-bold mb-3">

                    Premium Product

                </h4>

                <p>

                    Produk berkualitas premium
                    dengan harga terbaik

                </p>

            </div>

        </div>

    </div>

    <!-- PRODUCT -->

    <div class="mb-5">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h2 class="section-title">

                    Produk Terbaru

                </h2>

                <p class="text-light">

                    Produk pilihan terbaik untuk anda

                </p>

            </div>

            <a href="products.php"
                class="btn btn-modern">

                Lihat Semua

            </a>

        </div>

        <div class="row">

            <?php while($row = mysqli_fetch_assoc($products)) : ?>

                <div class="col-md-4 mb-4">

                    <div class="glass-card h-100">

                        <!-- IMAGE -->

                        <img
                            src="../uploads/products/<?= $row['image']; ?>"
                            class="product-image">

                        <!-- BODY -->

                        <div class="product-body">

                            <div class="product-title mb-2">

                                <?= $row['name']; ?>

                            </div>

                            <div class="product-price mb-4">

                                Rp <?= number_format($row['price']); ?>

                            </div>

                            <a href="product-detail.php?id=<?= $row['id']; ?>"
                                class="btn btn-modern w-100">

                                Detail Produk

                            </a>

                        </div>

                    </div>

                </div>

            <?php endwhile; ?>

        </div>

    </div>

</div>

<?php include '../includes/footer.php'; ?>