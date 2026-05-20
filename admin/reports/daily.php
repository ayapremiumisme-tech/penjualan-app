<?php

require_once '../../config/config.php';
require_once '../../config/database.php';
require_once '../../includes/middleware.php';

isLogin();
isAdmin();

include '../../includes/header.php';
include '../../includes/navbar.php';

/*
|--------------------------------------------------------------------------
| GET REPORT DATA
|--------------------------------------------------------------------------
*/

$query = mysqli_query(
    $conn,
    "SELECT transactions.*, users.name AS user_name
    FROM transactions
    LEFT JOIN users
    ON transactions.user_id = users.id
    ORDER BY transactions.id DESC"
);

?>

<div class="container-fluid">

    <div class="row">

        <!-- SIDEBAR -->

        <div class="col-md-2 p-0">

            <?php include '../../includes/sidebar.php'; ?>

        </div>

        <!-- CONTENT -->

        <div class="col-md-10 p-4">

            <!-- HEADER -->

            <div class="d-flex justify-content-between align-items-center mb-4">

                <div>

                    <h3 class="fw-bold">

                        Laporan Penjualan

                    </h3>

                    <p class="text-muted mb-0">

                        Data seluruh laporan transaksi penjualan

                    </p>

                </div>

                <div class="d-flex gap-2">

                    <a href="export-pdf.php"
                        class="btn btn-danger rounded-3">

                        <i class="fas fa-file-pdf"></i>

                        PDF

                    </a>

                    <a href="export-excel.php"
                        class="btn btn-success rounded-3">

                        <i class="fas fa-file-excel"></i>

                        Excel

                    </a>

                </div>

            </div>

            <!-- CARD -->

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body">

                    <!-- SEARCH -->

                    <div class="row mb-3">

                        <div class="col-md-4">

                            <input
                                type="text"
                                id="searchInput"
                                class="form-control"
                                placeholder="Cari invoice...">

                        </div>

                    </div>

                    <!-- TABLE -->

                    <div class="table-responsive">

                        <table
                            class="table table-hover align-middle"
                            id="reportTable">

                            <thead class="table-dark">

                                <tr>

                                    <th>No</th>
                                    <th>Invoice</th>
                                    <th>User</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>

                                </tr>

                            </thead>

                            <tbody>

                                <?php if(mysqli_num_rows($query) > 0) : ?>

                                    <?php
                                    $no = 1;

                                    while($row = mysqli_fetch_assoc($query)) :
                                    ?>

                                    <tr>

                                        <!-- NO -->

                                        <td>

                                            <?= $no++; ?>

                                        </td>

                                        <!-- INVOICE -->

                                        <td>

                                            <span class="fw-semibold text-primary">

                                                <?= $row['invoice_number']; ?>

                                            </span>

                                        </td>

                                        <!-- USER -->

                                        <td>

                                            <?= $row['user_name'] ?? 'Guest'; ?>

                                        </td>

                                        <!-- TOTAL -->

                                        <td>

                                            <span class="fw-bold text-success">

                                                Rp <?= number_format($row['total'], 0, ',', '.'); ?>

                                            </span>

                                        </td>

                                        <!-- STATUS -->

                                        <td>

                                            <?php if($row['payment_status'] == 'paid') : ?>

                                                <span class="badge bg-success">

                                                    Paid

                                                </span>

                                            <?php elseif($row['payment_status'] == 'pending') : ?>

                                                <span class="badge bg-warning text-dark">

                                                    Pending

                                                </span>

                                            <?php else : ?>

                                                <span class="badge bg-danger">

                                                    Failed

                                                </span>

                                            <?php endif; ?>

                                        </td>

                                        <!-- DATE -->

                                        <td>

                                            <?= date('d M Y', strtotime($row['created_at'])); ?>

                                        </td>

                                    </tr>

                                    <?php endwhile; ?>

                                <?php else : ?>

                                    <tr>

                                        <td colspan="6"
                                            class="text-center py-4 text-muted">

                                            Tidak ada data laporan

                                        </td>

                                    </tr>

                                <?php endif; ?>

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- REALTIME SEARCH -->

<script>

document
.getElementById('searchInput')
.addEventListener('keyup', function(){

    let value = this.value.toLowerCase();

    let rows = document.querySelectorAll(
        '#reportTable tbody tr'
    );

    rows.forEach(function(row){

        row.style.display =
            row.innerText.toLowerCase().includes(value)
            ? ''
            : 'none';

    });

});

</script>

<?php include '../../includes/footer.php'; ?>