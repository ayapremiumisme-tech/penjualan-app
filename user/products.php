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
    "SELECT * FROM products ORDER BY id DESC"
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

/* PAGE TITLE */

.page-title{
    font-size:45px;
    font-weight:700;
}

.page-subtitle{
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

    box-shadow:
    0 12px 35px rgba(0,0,0,0.3);
}

/* IMAGE */

.product-image{
    width:100%;
    height:240px;
    object-fit:cover;
}

/* BODY */

.product-body{
    padding:20px;
}

/* TITLE */

.product-title{
    font-size:18px;
    font-weight:600;
}

/* PRICE */

.product-price{
    color:#ffe082;
    font-size:22px;
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

/* NAVBAR */

.navbar{
    background:transparent !important;
}

.navbar a{
    color:white !important;
}

/* SEARCH */

.search-box{
    background:
    rgba(255,255,255,0.15);

    border:none;

    border-radius:15px;

    padding:14px 20px;

    color:white;
}

.search-box::placeholder{
    color:#e5e7eb;
}

.search-box:focus{
    outline:none;

    box-shadow:none;

    background:
    rgba(255,255,255,0.2);

    color:white;
}

</style>

<div class="container py-5">

    <!-- HEADER -->

    <div class="text-center mb-5">

        <h1 class="page-title">

            Produk Premium

        </h1>

        <p class="page-subtitle">

            Temukan produk terbaik pilihan anda

        </p>

    </div>

    <!-- SEARCH -->

    <div class="row justify-content-center mb-5">

        <div class="col-md-6">

            <input
                type="text"
                id="searchInput"
                class="form-control search-box"
                placeholder="Cari produk...">

        </div>

    </div>

    <!-- PRODUCTS -->

    <div class="row"
        id="productContainer">

        <?php while($row = mysqli_fetch_assoc($products)) : ?>

        <div class="col-md-3 mb-4 product-item">

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

                    <div class="product-price mb-3">

                        Rp <?= number_format($row['price']); ?>

                    </div>

                    <!-- BUTTON -->

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

<!-- SEARCH SCRIPT -->

<script>

document
.getElementById('searchInput')
.addEventListener('keyup', function(){

    let value =
        this.value.toLowerCase();

    let items =
        document.querySelectorAll(
            '.product-item'
        );

    items.forEach(function(item){

        item.style.display =
            item.innerText
            .toLowerCase()
            .includes(value)
            ? ''
            : 'none';

    });

});

</script>

<?php include '../includes/footer.php'; ?>