<?php

require_once '../config/database.php';

$page  = $_GET['page'] ?? 1;
$limit = 8;

$page = intval($page);

$offset = ($page - 1) * $limit;

$query = mysqli_query($conn,
    "SELECT *
    FROM products
    LIMIT $offset, $limit"
);

?>

<div class="row">

    <?php while($row = mysqli_fetch_assoc($query)) : ?>

    <div class="col-md-3 mb-4">

        <div class="card h-100">

            <img src="../uploads/products/<?= $row['image']; ?>"
                class="card-img-top"
                style="height:220px; object-fit:cover;">

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