<?php

require_once '../../config/database.php';

$query = mysqli_query($conn,
    "SELECT * FROM products ORDER BY stock ASC"
);

include '../../includes/header.php';
?>

<div class="container mt-4">

    <h3>Management Stock</h3>

    <table class="table table-bordered">

        <thead>

            <tr>

                <th>Produk</th>
                <th>Stock</th>

            </tr>

        </thead>

        <tbody>

            <?php while($row = mysqli_fetch_assoc($query)) : ?>

            <tr>

                <td><?= $row['name']; ?></td>

                <td><?= $row['stock']; ?></td>

            </tr>

            <?php endwhile; ?>

        </tbody>

    </table>

</div>

<?php include '../../includes/footer.php'; ?>