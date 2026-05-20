<?php

require_once '../config/database.php';

include '../includes/header.php';

$query = mysqli_query($conn,
    "SELECT * FROM categories"
);

?>

<div class="container mt-4">

    <h3>Kategori Produk</h3>

    <div class="list-group">

        <?php while($row = mysqli_fetch_assoc($query)) : ?>

        <a href="products.php?category=<?= $row['id']; ?>"
            class="list-group-item list-group-item-action">

            <?= $row['name']; ?>

        </a>

        <?php endwhile; ?>

    </div>

</div>

<?php include '../includes/footer.php'; ?>