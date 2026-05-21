<?php

session_start();

require_once '../config/config.php';
require_once '../config/database.php';

include '../includes/header.php';
include 'navbar.php';

/*
|--------------------------------------------------------------------------
| VALIDASI ID
|--------------------------------------------------------------------------
*/

if(!isset($_GET['id'])){

    header("Location: products.php");
    exit;

}

$id = intval($_GET['id']);

/*
|--------------------------------------------------------------------------
| GET PRODUCT
|--------------------------------------------------------------------------
*/

$query = mysqli_query(
    $conn,
    "SELECT * FROM products
    WHERE id='$id'
    LIMIT 1"
);

if(mysqli_num_rows($query) == 0){

    echo "
    <div class='container py-5 text-white'>
        Produk tidak ditemukan
    </div>
    ";

    exit;

}

$product = mysqli_fetch_assoc($query);

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

/* GLASS */

.glass-card{
    background:
    rgba(255,255,255,0.15);

    backdrop-filter:blur(12px);

    border:
    1px solid rgba(255,255,255,0.2);

    border-radius:25px;

    box-shadow:
    0 8px 30px rgba(0,0,0,0.2);
}

/* IMAGE */

.product-image{
    width:100%;
    height:500px;

    object-fit:cover;

    border-radius:20px;
}

/* TITLE */

.product-title{
    font-size:40px;
    font-weight:700;
}

/* PRICE */

.product-price{
    color:#ffe082;

    font-size:35px;

    font-weight:bold;
}

/* DESC */

.product-description{
    line-height:1.9;

    color:#f3f4f6;
}

/* BUTTON */

.btn-modern{
    border:none;

    border-radius:14px;

    padding:14px 20px;

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

.btn-buy{
    background:#22c55e;

    color:white;
}

.btn-buy:hover{
    background:#16a34a;

    color:white;
}

/* BADGE */

.badge-modern{
    background:
    rgba(255,255,255,0.2);

    padding:10px 18px;

    border-radius:12px;

    font-size:14px;
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

    <div class="glass-card p-4 p-lg-5">

        <div class="row align-items-center">

            <!-- IMAGE -->

            <div class="col-lg-6 mb-4">

                <img
                    src="../uploads/products/<?= $product['image']; ?>"
                    class="product-image">

            </div>

            <!-- DETAIL -->

            <div class="col-lg-6">

                <!-- CATEGORY -->

                <div class="mb-3">

                    <span class="badge-modern">

                        Produk Premium

                    </span>

                </div>

                <!-- TITLE -->

                <h1 class="product-title mb-3">

                    <?= $product['name']; ?>

                </h1>

                <!-- PRICE -->

                <div class="product-price mb-4">

                    Rp <?= number_format($product['price']); ?>

                </div>

                <!-- DESCRIPTION -->

                <div class="product-description mb-4">

                    <?= !empty($product['description'])
                        ? nl2br($product['description'])
                        : 'Produk premium berkualitas tinggi dengan pelayanan terbaik dan proses cepat. Cocok untuk kebutuhan digital anda.'; ?>

                </div>

                <!-- BUTTON -->

                <div class="d-flex gap-3 flex-wrap">

                    <!-- CART -->

                    <a href="add-cart.php?id=<?= $product['id']; ?>"
                        class="btn btn-modern btn-cart">

                        🛒 Tambah Keranjang

                    </a>

                    <!-- BUY -->

                    <a href="checkout.php?id=<?= $product['id']; ?>"
                        class="btn btn-modern btn-buy">

                        ⚡ Beli Sekarang

                    </a>

                    <!-- WISHLIST -->

                    <a href="add-wishlist.php?id=<?= $product['id']; ?>"
                        class="btn btn-modern btn-cart">

                        ❤️ Wishlist

                    </a>

                </div>

                <!-- INFO -->

                <div class="mt-5">

                    <div class="row">

                        <div class="col-6 mb-3">

                            <div class="glass-card p-3 text-center">

                                <h5 class="fw-bold">

                                    Premium

                                </h5>

                                <small>

                                    Kualitas Terbaik

                                </small>

                            </div>

                        </div>

                        <div class="col-6 mb-3">

                            <div class="glass-card p-3 text-center">

                                <h5 class="fw-bold">

                                    Fast Process

                                </h5>

                                <small>

                                    Proses Cepat

                                </small>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<?php include '../includes/footer.php'; ?>