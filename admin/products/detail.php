<?php

require_once '../../config/database.php';

$id = $_GET['id'];

$product = mysqli_fetch_assoc(
    mysqli_query($conn,
        "SELECT * FROM products WHERE id='$id'")
);

include '../../includes/header.php';
?>

<div class="container mt-4">

    <div class="card">

        <div class="card-body">

            <img src="../../uploads/products/<?= $product['image']; ?>"
                width="200"
                class="mb-3">

            <h3><?= $product['name']; ?></h3>

            <p>
                Harga:
                Rp <?= number_format($product['price']); ?>
            </p>

            <p>
                Stock:
                <?= $product['stock']; ?>
            </p>

        </div>

    </div>

</div>

<?php include '../../includes/footer.php'; ?>