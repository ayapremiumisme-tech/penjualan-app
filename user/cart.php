<?php

session_start();

require_once '../config/config.php';
require_once '../config/database.php';

include '../includes/header.php';
include 'navbar.php';

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
    font-size:40px;
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

    box-shadow:
    0 8px 30px rgba(0,0,0,0.2);
}

/* TABLE */

.table{
    color:white;
}

.table thead{
    background:
    rgba(255,255,255,0.15);
}

/* IMAGE */

.product-image{
    width:80px;
    height:80px;

    object-fit:cover;

    border-radius:15px;
}

/* BUTTON */

.btn-modern{
    border:none;

    border-radius:12px;

    padding:12px 18px;

    font-weight:600;

    transition:0.3s;
}

/* PRIMARY */

.btn-primary-modern{
    background:white;

    color:#6c63ff;
}

.btn-primary-modern:hover{
    background:#f3f4f6;
}

/* SUCCESS */

.btn-success-modern{
    background:#22c55e;

    color:white;
}

.btn-success-modern:hover{
    background:#16a34a;

    color:white;
}

/* DANGER */

.btn-danger-modern{
    background:#ef4444;

    color:white;
}

.btn-danger-modern:hover{
    background:#dc2626;

    color:white;
}

/* INPUT */

.form-control{
    border:none;

    border-radius:12px;

    padding:10px;
}

/* SUMMARY */

.summary-price{
    color:#ffe082;

    font-size:30px;

    font-weight:bold;
}

/* EMPTY */

.empty-icon{
    font-size:80px;
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

    <div class="d-flex justify-content-between align-items-center mb-5">

        <div>

            <h1 class="page-title">

                Keranjang Belanja

            </h1>

            <p class="text-light">

                Produk yang ingin anda beli

            </p>

        </div>

        <a href="products.php"
            class="btn btn-modern btn-primary-modern">

            ← Lanjut Belanja

        </a>

    </div>

    <!-- ALERT -->

    <?php if(isset($_SESSION['success'])) : ?>

        <div class="alert alert-success rounded-4">

            <?= $_SESSION['success']; ?>

        </div>

        <?php unset($_SESSION['success']); ?>

    <?php endif; ?>

    <!-- CART -->

    <?php if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>

        <div class="row">

            <!-- TABLE -->

            <div class="col-lg-8 mb-4">

                <div class="glass-card p-4">

                    <div class="table-responsive">

                        <form action="update-cart.php"
                            method="POST">

                            <table class="table align-middle">

                                <thead>

                                    <tr>

                                        <th>Produk</th>
                                        <th>Harga</th>
                                        <th width="120">Qty</th>
                                        <th>Subtotal</th>
                                        <th>Aksi</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    <?php
                                    $total = 0;
                                    ?>

                                    <?php foreach($_SESSION['cart'] as $index => $item): ?>

                                        <?php

                                        $name =
                                            $item['name']
                                            ?? 'Produk';

                                        $price =
                                            isset($item['price'])
                                            ? floatval($item['price'])
                                            : 0;

                                        $qty =
                                            isset($item['qty'])
                                            ? intval($item['qty'])
                                            : 1;

                                        $subtotal =
                                            $price * $qty;

                                        $total += $subtotal;

                                        ?>

                                        <tr>

                                            <!-- PRODUCT -->

                                            <td>

                                                <div class="d-flex align-items-center">

                                                    <img
                                                        src="../uploads/products/<?= $item['image'] ?? 'netflix.jpg'; ?>"
                                                        class="product-image me-3">

                                                    <div>

                                                        <div class="fw-bold">

                                                            <?= htmlspecialchars($name); ?>

                                                        </div>

                                                        <small class="text-light">

                                                            ID:
                                                            <?= $item['id']; ?>

                                                        </small>

                                                    </div>

                                                </div>

                                            </td>

                                            <!-- PRICE -->

                                            <td>

                                                <span class="fw-bold text-warning">

                                                    Rp <?= number_format($price); ?>

                                                </span>

                                            </td>

                                            <!-- QTY -->

                                            <td>

                                                <input
                                                    type="number"
                                                    name="qty[<?= $index; ?>]"
                                                    value="<?= $qty; ?>"
                                                    min="1"
                                                    class="form-control">

                                                <input
                                                    type="hidden"
                                                    name="id[<?= $index; ?>]"
                                                    value="<?= $item['id']; ?>">

                                            </td>

                                            <!-- SUBTOTAL -->

                                            <td>

                                                <span class="fw-bold text-success">

                                                    Rp <?= number_format($subtotal); ?>

                                                </span>

                                            </td>

                                            <!-- DELETE -->

                                            <td>

                                                <a href="delete-cart.php?id=<?= $item['id']; ?>"
                                                    class="btn btn-modern btn-danger-modern btn-sm">

                                                    Hapus

                                                </a>

                                            </td>

                                        </tr>

                                    <?php endforeach; ?>

                                </tbody>

                            </table>

                            <!-- UPDATE -->

                            <div class="text-end mt-3">

                                <button
                                    type="submit"
                                    class="btn btn-modern btn-primary-modern">

                                    Update Keranjang

                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

            <!-- SUMMARY -->

            <div class="col-lg-4">

                <div class="glass-card p-4">

                    <h4 class="fw-bold mb-4">

                        Ringkasan Belanja

                    </h4>

                    <div class="d-flex justify-content-between mb-3">

                        <span>Total Produk</span>

                        <span>

                            <?= count($_SESSION['cart']); ?>

                        </span>

                    </div>

                    <div class="d-flex justify-content-between mb-4">

                        <span>Total Harga</span>

                        <span class="summary-price">

                            Rp <?= number_format($total); ?>

                        </span>

                    </div>

                    <a href="checkout.php"
                        class="btn btn-modern btn-success-modern w-100">

                        Checkout Sekarang

                    </a>

                </div>

            </div>

        </div>

    <?php else: ?>

        <!-- EMPTY -->

        <div class="glass-card p-5 text-center">

            <div class="empty-icon mb-4">

                🛒

            </div>

            <h2 class="fw-bold">

                Keranjang Kosong

            </h2>

            <p class="text-light mb-4">

                Belum ada produk di keranjang anda

            </p>

            <a href="products.php"
                class="btn btn-modern btn-primary-modern">

                Mulai Belanja

            </a>

        </div>

    <?php endif; ?>

</div>

<?php include '../includes/footer.php'; ?>