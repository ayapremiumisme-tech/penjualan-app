<?php

session_start();

require_once '../config/config.php';
require_once '../config/database.php';

include '../includes/header.php';
include 'navbar.php';

/*
|--------------------------------------------------------------------------
| INIT WISHLIST
|--------------------------------------------------------------------------
*/

if(!isset($_SESSION['wishlist'])){
    $_SESSION['wishlist'] = [];
}

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

/* TITLE */

.page-title{
    font-size:42px;
    font-weight:700;
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

    box-shadow:
    0 12px 35px rgba(0,0,0,0.3);
}

/* PRODUCT IMAGE */

.product-image{
    width:100%;
    height:240px;

    object-fit:cover;
}

/* PRODUCT BODY */

.product-body{
    padding:20px;
}

/* PRODUCT TITLE */

.product-title{
    font-size:20px;
    font-weight:600;
}

/* PRICE */

.product-price{
    color:#ffe082;

    font-size:24px;

    font-weight:bold;
}

/* BUTTON */

.btn-modern{
    border:none;

    border-radius:14px;

    padding:12px 18px;

    font-weight:600;

    transition:0.3s;
}

.btn-cart{
    background:white;

    color:#6c63ff;
}

.btn-cart:hover{
    background:#f3f4f6;
}

.btn-delete{
    background:#ef4444;

    color:white;
}

.btn-delete:hover{
    background:#dc2626;

    color:white;
}

/* EMPTY */

.empty-box{
    text-align:center;

    padding:80px 20px;
}

.empty-icon{
    font-size:90px;
}

/* NAVBAR */

.navbar{
    background:transparent !important;
}

.navbar a{
    color:white !important;
}

</style>

<div class="container py-5">

    <!-- HEADER -->

    <div class="mb-5">

        <h1 class="page-title">

            Wishlist Saya

        </h1>

        <p class="text-light">

            Daftar produk favorit anda

        </p>

    </div>

    <!-- WISHLIST -->

    <?php if(count($_SESSION['wishlist']) > 0): ?>

        <div class="row">

            <?php foreach($_SESSION['wishlist'] as $item): ?>

                <div class="col-md-4 mb-4">

                    <div class="glass-card h-100">

                        <!-- IMAGE -->

                        <img
                            src="../uploads/products/<?= $item['image'] ?? 'netflix.jpg'; ?>"
                            class="product-image">

                        <!-- BODY -->

                        <div class="product-body">

                            <!-- TITLE -->

                            <div class="product-title mb-2">

                                <?= htmlspecialchars($item['name']); ?>

                            </div>

                            <!-- PRICE -->

                            <div class="product-price mb-4">

                                Rp <?= number_format($item['price']); ?>

                            </div>

                            <!-- BUTTON -->

                            <div class="d-grid gap-2">

                                <!-- DETAIL -->

                                <a href="product-detail.php?id=<?= $item['id']; ?>"
                                    class="btn btn-modern btn-cart">

                                    Detail Produk

                                </a>

                                <!-- CART -->

                                <a href="add-cart.php?id=<?= $item['id']; ?>"
                                    class="btn btn-modern btn-cart">

                                    Tambah ke Keranjang

                                </a>

                                <!-- DELETE -->

                                <a href="remove-wishlist.php?id=<?= $item['id']; ?>"
                                    class="btn btn-modern btn-delete">

                                    Hapus Wishlist

                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

    <?php else: ?>

        <!-- EMPTY -->

        <div class="glass-card empty-box">

            <div class="empty-icon mb-4">

                ❤️

            </div>

            <h2 class="fw-bold mb-3">

                Wishlist Kosong

            </h2>

            <p class="text-light mb-4">

                Belum ada produk favorit yang anda simpan

            </p>

            <a href="products.php"
                class="btn btn-modern btn-cart">

                Mulai Belanja

            </a>

        </div>

    <?php endif; ?>

</div>

<?php include '../includes/footer.php'; ?>