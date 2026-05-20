<?php

require_once '../config/database.php';

$keyword = $_GET['keyword'] ?? '';

$keyword = mysqli_real_escape_string($conn, $keyword);

$query = mysqli_query($conn,
    "SELECT * FROM products
    WHERE name LIKE '%$keyword%'
    ORDER BY id DESC"
);

?>

<?php if(mysqli_num_rows($query) > 0) : ?>

    <div class="row">

        <?php while($row = mysqli_fetch_assoc($query)) : ?>

        <div class="col-md-3 mb-4">

            <div class="card h-100">

                <img src="../uploads/products/<?= $row['image']; ?>"
                    class="card-img-top"
                    style="height:200px; object-fit:cover;">

                <div class="card-body">

                    <h5><?= $row['name']; ?></h5>

                    <p>
                        Rp <?= number_format($row['price']); ?>
                    </p>

                </div>

            </div>

        </div>

        <?php endwhile; ?>

    </div>

<?php else : ?>

    <div class="alert alert-warning">
        Produk tidak ditemukan
    </div>

<?php endif; ?>