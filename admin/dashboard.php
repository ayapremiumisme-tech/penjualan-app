<?php

require_once '../config/config.php';
require_once '../config/database.php';
require_once '../includes/middleware.php';

isLogin();
isAdmin();

include '../includes/header.php';
include '../includes/navbar.php';

$totalProducts = mysqli_num_rows(
    mysqli_query($conn, "SELECT id FROM products")
);

$totalUsers = mysqli_num_rows(
    mysqli_query($conn, "SELECT id FROM users")
);

$totalTransactions = mysqli_num_rows(
    mysqli_query($conn, "SELECT id FROM transactions")
);

?>

<div class="container-fluid">

    <div class="row">

        <div class="col-md-2 p-0">

            <?php include '../includes/sidebar.php'; ?>

        </div>

        <div class="col-md-10">

            <div class="content-wrapper">

                <h3 class="page-title">
                    Dashboard Admin
                </h3>

                <div class="row">

                    <div class="col-md-4">

                        <div class="dashboard-card">

                            <div class="dashboard-icon text-primary">
                                <i class="fas fa-box"></i>
                            </div>

                            <div class="dashboard-title">
                                Total Produk
                            </div>

                            <div class="dashboard-value">
                                <?= $totalProducts; ?>
                            </div>

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="dashboard-card">

                            <div class="dashboard-icon text-success">
                                <i class="fas fa-users"></i>
                            </div>

                            <div class="dashboard-title">
                                Total User
                            </div>

                            <div class="dashboard-value">
                                <?= $totalUsers; ?>
                            </div>

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="dashboard-card">

                            <div class="dashboard-icon text-danger">
                                <i class="fas fa-shopping-cart"></i>
                            </div>

                            <div class="dashboard-title">
                                Total Transaksi
                            </div>

                            <div class="dashboard-value">
                                <?= $totalTransactions; ?>
                            </div>

                        </div>

                    </div>

                </div>

                <div class="card mt-4">

                    <div class="card-body">

                        <h5>Grafik Penjualan</h5>

                        <canvas id="salesChart"></canvas>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<script>

document.addEventListener("DOMContentLoaded", function(){

    salesChart(
        'salesChart',
        ['Jan', 'Feb', 'Mar', 'Apr'],
        [12, 19, 8, 15]
    );

});

</script>

<?php include '../includes/footer.php'; ?>