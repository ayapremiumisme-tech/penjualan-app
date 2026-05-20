<?php
require_once '../config/config.php';
require_once '../config/database.php';

include '../includes/header.php';
include 'navbar.php';
?>

<div class="container mt-4">
    <h3 class="fw-bold mb-4">Daftar Produk</h3>

    <div class="row">
        <?php
        $products = mysqli_query($conn, "SELECT * FROM products ORDER BY id DESC");
        while($row = mysqli_fetch_assoc($products)):
        ?>
        <div class="col-md-3 mb-4">
            <div class="card h-100 shadow-sm rounded-4">
                <img src="../uploads/products/<?= $row['image']; ?>" class="card-img-top rounded-top-4" style="height:220px; object-fit:cover;">
                <div class="card-body d-flex flex-column">
                    <h5><?= $row['name']; ?></h5>
                    <p class="text-primary fw-bold">Rp <?= number_format($row['price']); ?></p>
                    <a href="product-detail.php?id=<?= $row['id']; ?>" class="btn btn-primary w-100 mt-auto rounded-3">Detail Produk</a>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>

<?php include '../includes/footer.php'; ?>