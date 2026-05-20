<?php
session_start();

require_once '../config/config.php';
require_once '../config/database.php';

include '../includes/header.php';
include 'navbar.php';

// Cek cart
if(!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0){
    $_SESSION['error'] = "Keranjang masih kosong";
    header("Location: cart.php");
    exit;
}

$total = 0;
?>

<div class="container mt-4">

    <h3 class="fw-bold mb-4">

        Checkout

    </h3>

    <div class="row">

        <!-- FORM CHECKOUT -->

        <div class="col-md-7">

            <div class="card shadow-sm border-0 rounded-4">

                <div class="card-body">

                    <h5 class="mb-4">

                        Data Pembeli

                    </h5>

                    <form action="payment.php" method="POST">

                        <div class="mb-3">

                            <label class="form-label">

                                Nama Lengkap

                            </label>

                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">

                                Email

                            </label>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">

                                No HP

                            </label>

                            <input
                                type="text"
                                name="phone"
                                class="form-control"
                                required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">

                                Catatan

                            </label>

                            <textarea
                                name="note"
                                class="form-control"
                                rows="4"></textarea>

                        </div>

                        <button
                            type="submit"
                            class="btn btn-success w-100 rounded-3">

                            Bayar Sekarang

                        </button>

                    </form>

                </div>

            </div>

        </div>

        <!-- DETAIL PESANAN -->

        <div class="col-md-5">

            <div class="card shadow-sm border-0 rounded-4">

                <div class="card-body">

                    <h5 class="mb-4">

                        Detail Pesanan

                    </h5>

                    <?php foreach($_SESSION['cart'] as $item): ?>

                        <?php
                        $name  = $item['name'] ?? 'Produk';
                        $price = isset($item['price'])
                            ? floatval($item['price'])
                            : 0;

                        $qty = isset($item['qty'])
                            ? intval($item['qty'])
                            : 1;

                        $subtotal = $price * $qty;

                        $total += $subtotal;
                        ?>

                        <div class="d-flex justify-content-between mb-3">

                            <div>

                                <div class="fw-semibold">

                                    <?= htmlspecialchars($name); ?>

                                </div>

                                <small class="text-muted">

                                    <?= $qty; ?> x
                                    Rp <?= number_format($price); ?>

                                </small>

                            </div>

                            <div class="fw-bold">

                                Rp <?= number_format($subtotal); ?>

                            </div>

                        </div>

                    <?php endforeach; ?>

                    <hr>

                    <div class="d-flex justify-content-between">

                        <h5>Total</h5>

                        <h5 class="text-success">

                            Rp <?= number_format($total); ?>

                        </h5>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<?php include '../includes/footer.php'; ?>