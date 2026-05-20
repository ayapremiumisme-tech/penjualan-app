<?php

require_once '../config/config.php';
require_once '../config/database.php';

include '../includes/header.php';
include 'navbar.php';

?>

<div class="container mt-4">

    <h3>Home</h3>

</div>

<?php include '../includes/footer.php'; ?>

<div class="container mt-4">
    <div class="card shadow-sm rounded-4 p-4">
        <h3 class="fw-bold">Selamat Datang!</h3>
        <p>Belanja produk terbaik dengan mudah dan cepat.</p>
    </div>

    <!-- Banner Carousel -->
    <div id="bannerCarousel" class="carousel slide mt-4" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php
            $banners = mysqli_query($conn, "SELECT * FROM banners ORDER BY id DESC");
            $active = true;
            while($banner = mysqli_fetch_assoc($banners)):
            ?>
            <div class="carousel-item <?= $active ? 'active' : ''; ?>">
                <img src="../uploads/banners/<?= $banner['image']; ?>" class="d-block w-100 rounded" style="height:400px; object-fit:cover;">
            </div>
            <?php $active = false; endwhile; ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    <!-- Produk Terbaru -->
    <h3 class="mt-5 fw-bold">Produk Terbaru</h3>
    <div class="row">
        <?php
        $products = mysqli_query($conn, "SELECT * FROM products ORDER BY id DESC LIMIT 8");
        while($row = mysqli_fetch_assoc($products)):
        ?>
        <div class="col-md-3 mb-4">
            <div class="card h-100 shadow-sm rounded-4">
                <img src="../uploads/products/<?= $row['image']; ?>" class="card-img-top rounded-top-4" style="height:220px; object-fit:cover;">
                <div class="card-body d-flex flex-column">
                    <h5 class="fw-semibold"><?= $row['name']; ?></h5>
                    <p class="text-primary fw-bold">Rp <?= number_format($row['price']); ?></p>
                    <a href="product-detail.php?id=<?= $row['id']; ?>" class="btn btn-primary w-100 mt-auto rounded-3">Detail Produk</a>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>

<?php include '../includes/footer.php'; ?>