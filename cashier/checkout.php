<?php

require_once '../config/config.php';

include '../includes/header.php';

$cart = $_SESSION['cart'] ?? [];

$total = 0;

?>

<div class="container mt-4">

    <div class="card">

        <div class="card-body">

            <h3>Checkout</h3>

            <table class="table table-bordered">

                <thead>

                    <tr>

                        <th>Produk</th>
                        <th>Qty</th>
                        <th>Harga</th>
                        <th>Subtotal</th>

                    </tr>

                </thead>

                <tbody>

                    <?php foreach($cart as $item) : ?>

                    <?php
                    $subtotal = $item['price'] * $item['qty'];
                    $total += $subtotal;
                    ?>

                    <tr>

                        <td><?= $item['name']; ?></td>

                        <td><?= $item['qty']; ?></td>

                        <td>
                            Rp <?= number_format($item['price']); ?>
                        </td>

                        <td>
                            Rp <?= number_format($subtotal); ?>
                        </td>

                    </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

            <h4 class="mt-3">

                Total:
                Rp <?= number_format($total); ?>

            </h4>

            <a href="payment.php"
                class="btn btn-success">

                Bayar Sekarang

            </a>

        </div>

    </div>

</div>

<?php include '../includes/footer.php'; ?>