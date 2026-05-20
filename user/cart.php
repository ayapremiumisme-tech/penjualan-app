<?php
session_start();

require_once '../config/config.php';
require_once '../config/database.php';

include '../includes/header.php';
include 'navbar.php';

// BUAT SESSION CART JIKA BELUM ADA
if(!isset($_SESSION['cart']))
{
    $_SESSION['cart'] = [];
}

?>

<div class="container py-5">

    <!-- TITLE -->

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold">

                Keranjang Belanja

            </h2>

            <p class="text-muted mb-0">

                Daftar produk yang ingin anda beli

            </p>

        </div>

        <a href="products.php"
            class="btn btn-outline-primary rounded-3">

            <i class="fas fa-shopping-bag"></i>

            Belanja Lagi

        </a>

    </div>

    <!-- ALERT -->

    <?php if(isset($_SESSION['success'])) : ?>

        <div class="alert alert-success alert-dismissible fade show rounded-3">

            <?= $_SESSION['success']; ?>

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"></button>

        </div>

        <?php unset($_SESSION['success']); ?>

    <?php endif; ?>

    <!-- CEK CART -->

    <?php if(count($_SESSION['cart']) > 0): ?>

        <div class="row">

            <!-- CART -->

            <div class="col-lg-8">

                <div class="card border-0 shadow-sm rounded-4">

                    <div class="card-body p-4">

                        <form action="update-cart.php"
                            method="POST">

                            <div class="table-responsive">

                                <table class="table align-middle">

                                    <thead class="table-light">

                                        <tr>

                                            <th>Produk</th>
                                            <th>Harga</th>
                                            <th width="120">Qty</th>
                                            <th>Subtotal</th>
                                            <th width="100">Aksi</th>

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

                                            $image =
                                                $item['image']
                                                ?? 'default.png';

                                            $subtotal =
                                                $price * $qty;

                                            $total += $subtotal;

                                            ?>

                                            <tr>

                                                <!-- PRODUCT -->

                                                <td>

                                                    <div class="d-flex align-items-center">

                                                        <!-- IMAGE -->

                                                        <img
                                                            src="../uploads/products/<?= $image; ?>"
                                                            alt="<?= htmlspecialchars($name); ?>"
                                                            width="80"
                                                            height="80"
                                                            class="rounded-3 border me-3"
                                                            style="object-fit:cover;">

                                                        <!-- INFO -->

                                                        <div>

                                                            <div class="fw-semibold mb-1">

                                                                <?= htmlspecialchars($name); ?>

                                                            </div>

                                                            <small class="text-muted">

                                                                Product ID:
                                                                <?= $item['id']; ?>

                                                            </small>

                                                        </div>

                                                    </div>

                                                </td>

                                                <!-- PRICE -->

                                                <td>

                                                    <span class="fw-semibold text-primary">

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
                                                        class="form-control rounded-3">

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
                                                        class="btn btn-danger btn-sm rounded-3"
                                                        onclick="return confirm('Hapus produk dari keranjang?')">

                                                        <i class="fas fa-trash"></i>

                                                    </a>

                                                </td>

                                            </tr>

                                        <?php endforeach; ?>

                                    </tbody>

                                </table>

                            </div>

                            <!-- UPDATE BUTTON -->

                            <div class="d-flex justify-content-end mt-3">

                                <button
                                    type="submit"
                                    class="btn btn-primary rounded-3">

                                    <i class="fas fa-sync-alt"></i>

                                    Update Keranjang

                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

            <!-- SUMMARY -->

            <div class="col-lg-4">

                <div class="card border-0 shadow-sm rounded-4">

                    <div class="card-body p-4">

                        <h5 class="fw-bold mb-4">

                            Ringkasan Belanja

                        </h5>

                        <!-- TOTAL PRODUK -->

                        <div class="d-flex justify-content-between mb-3">

                            <span>Total Produk</span>

                            <span class="fw-semibold">

                                <?= count($_SESSION['cart']); ?>

                            </span>

                        </div>

                        <!-- TOTAL -->

                        <div class="d-flex justify-content-between mb-3">

                            <span>Total Harga</span>

                            <span class="fw-bold text-success">

                                Rp <?= number_format($total); ?>

                            </span>

                        </div>

                        <hr>

                        <!-- CHECKOUT -->

                        <div class="d-grid">

                            <a href="checkout.php"
                                class="btn btn-success btn-lg rounded-3">

                                <i class="fas fa-credit-card"></i>

                                Checkout Sekarang

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    <?php else: ?>

        <!-- EMPTY -->

        <div class="card border-0 shadow-sm rounded-4">

            <div class="card-body text-center py-5">

                <i class="fas fa-shopping-cart
                    fa-4x text-muted mb-4"></i>

                <h4 class="fw-bold">

                    Keranjang Kosong

                </h4>

                <p class="text-muted mb-4">

                    Belum ada produk di keranjang anda

                </p>

                <a href="products.php"
                    class="btn btn-primary rounded-3">

                    Mulai Belanja

                </a>

            </div>

        </div>

    <?php endif; ?>

</div>

<?php include '../includes/footer.php'; ?>