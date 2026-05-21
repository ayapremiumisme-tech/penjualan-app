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

$products = mysqli_query($conn,
    "SELECT * FROM products ORDER BY id DESC LIMIT 8"
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
}

/* HERO */

.hero-section{
    text-align:center;
    padding:80px 20px;
    color:white;
}

.hero-title{
    font-size:55px;
    font-weight:700;
}

.hero-subtitle{
    font-size:18px;
    opacity:0.9;
}

/* GLASS CARD */

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
}

/* PRODUCT IMAGE */

.product-image{
    width:100%;
    height:230px;
    object-fit:cover;
}

/* PRODUCT BODY */

.product-body{
    padding:20px;
    color:white;
}

.product-title{
    font-size:18px;
    font-weight:600;
}

.product-price{
    color:#ffe082;
    font-size:20px;
    font-weight:bold;
}

/* BUTTON */

.btn-modern{
    width:100%;

    border:none;

    border-radius:12px;

    background:white;

    color:#6c63ff;

    font-weight:600;

    padding:12px;

    transition:0.3s;
}

.btn-modern:hover{
    background:#f3f4f6;
}

/* SECTION TITLE */

.section-title{
    color:white;
    font-size:35px;
    font-weight:700;
}

/* NAVBAR FIX */

.navbar{
    background:transparent !important;
}

.navbar a{
    color:white !important;
}

</style>

<div class="container py-5">

    <!-- HERO -->

    <div class="hero-section">

        <h1 class="hero-title">

            Penjualan App

        </h1>

        <p class="hero-subtitle">

            Sistem Informasi Penjualan Modern
            Dengan Tampilan Premium

        </p>

    </div>

    <!-- TITLE -->

    <div class="mb-4">

        <h2 class="section-title">

            Produk Terbaru

        </h2>

    </div>

    <!-- PRODUCTS -->

    <div class="row">

        <?php while($row = mysqli_fetch_assoc($products)) : ?>

        <div class="col-md-3 mb-4">

            <div class="glass-card h-100">

                <img
                    src="../uploads/products/<?= $row['image']; ?>"
                    class="product-image">

                <div class="product-body">

                    <div class="product-title mb-2">

                        <?= $row['name']; ?>

                    </div>

                    <div class="product-price mb-3">

                        Rp <?= number_format($row['price']); ?>

                    </div>

                    <a href="product-detail.php?id=<?= $row['id']; ?>"
                        class="btn btn-modern">

                        Detail Produk

                    </a>

                </div>

            </div>

        </div>

        <?php endwhile; ?>

    </div>

</div>

<?php include '../includes/footer.php'; ?>