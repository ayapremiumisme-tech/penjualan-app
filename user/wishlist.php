<?php

session_start();

require_once '../config/config.php';
require_once '../config/database.php';

include '../includes/header.php';
include 'navbar.php';

?>

<div class="container mt-4">

    <h3 class="fw-bold mb-4">

        Wishlist

    </h3>

    <?php if(
        isset($_SESSION['wishlist']) &&
        count($_SESSION['wishlist']) > 0
    ) : ?>

    <div class="row">

        <?php

        foreach($_SESSION['wishlist'] as $productId) :

            $query = mysqli_query(
                $conn,
                "SELECT * FROM products
                WHERE id='$productId'
                LIMIT 1"
            );

            if(mysqli_num_rows($query) > 0) :

                $product = mysqli_fetch_assoc($query);

        ?>

        <div class="col-md-3 mb-4">

            <div class="card h-100 shadow-sm rounded-4">

                <!-- IMAGE -->

                <img
                    src="../uploads/products/<?= $product['image']; ?>"
                    class="card-img-top rounded-top-4"
                    style="height:220px; object-fit:cover;">

                <!-- BODY -->

                <div class="card-body d-flex flex-column">

                    <h5 class="fw-semibold">

                        <?= $product['name']; ?>

                    </h5>

                    <p class="text-primary fw-bold">

                        Rp <?= number_format($product['price']); ?>

                    </p>

                    <div class="mt-auto">

                        <a
                            href="product-detail.php?id=<?= $product['id']; ?>"
                            class="btn btn-primary w-100 rounded-3">

                            Detail Produk

                        </a>

                    </div>

                </div>

            </div>

        </div>

        <?php
            endif;
        endforeach;
        ?>

    </div>

    <?php else : ?>

    <div class="alert alert-warning rounded-3">

        Wishlist kosong

    </div>

    <?php endif; ?>

</div>

<?php include '../includes/footer.php'; ?>