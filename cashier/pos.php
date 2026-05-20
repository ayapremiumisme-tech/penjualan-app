<?php

require_once '../config/config.php';
require_once '../config/database.php';

include '../includes/header.php';

$query = mysqli_query($conn,
    "SELECT * FROM products
    ORDER BY id DESC"
);

?>

<div class="container-fluid mt-4">

    <div class="row">

        <div class="col-md-8">

            <div class="card">

                <div class="card-body">

                    <h3>Point Of Sale</h3>

                    <div class="row">

                        <?php while($row = mysqli_fetch_assoc($query)) : ?>

                        <div class="col-md-4 mb-4">

                            <div class="card h-100">

                                <img src="../uploads/products/<?= $row['image']; ?>"
                                    class="card-img-top"
                                    style="height:200px; object-fit:cover;">

                                <div class="card-body">

                                    <h5>
                                        <?= $row['name']; ?>
                                    </h5>

                                    <p>
                                        Rp <?= number_format($row['price']); ?>
                                    </p>

                                    <a href="cart.php?id=<?= $row['id']; ?>"
                                        class="btn btn-primary w-100">

                                        Tambah Ke Keranjang

                                    </a>

                                </div>

                            </div>

                        </div>

                        <?php endwhile; ?>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card">

                <div class="card-body">

                    <h4>Keranjang</h4>

                    <a href="checkout.php"
                        class="btn btn-success w-100 mt-3">

                        Checkout

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

<?php include '../includes/footer.php'; ?>