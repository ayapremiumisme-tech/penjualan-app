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
| GET TRANSACTIONS
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

            <!-- PAGE HEADER -->

            <div class="d-flex justify-content-between align-items-center mb-4">

                <div>

                    <h3 class="fw-bold">

                        Data Transaksi

                    </h3>

                    <p class="text-muted mb-0">

                        Kelola seluruh transaksi penjualan

                    </p>

                </div>

                <a href="create.php"
                    class="btn btn-primary rounded-3">

                    <i class="fas fa-plus"></i>

                    Tambah Transaksi

                </a>

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
                                placeholder="Cari transaksi...">

                        </div>

                    </div>

                    <!-- TABLE -->

                    <div class="table-responsive">

                        <table
                            class="table table-hover align-middle"
                            id="transactionTable">

                            <thead class="table-dark">

                                <tr>

                                    <th>No</th>
                                    <th>Invoice</th>
                                    <th>User</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                    <th width="220">Aksi</th>

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

                                            <span class="fw-bold text-primary">

                                                <?= $row['invoice_number']; ?>

                                            </span>

                                        </td>

                                        <!-- USER -->

                                        <td>

                                            <?= $row['user_name'] ?? 'Guest'; ?>

                                        </td>

                                        <!-- TOTAL -->

                                        <td>

                                            <span class="fw-semibold text-success">

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

                                        <!-- ACTION -->

                                        <td>

                                            <div class="d-flex gap-1">

                                                <!-- DETAIL -->

                                                <a href="detail.php?id=<?= $row['id']; ?>"
                                                    class="btn btn-info btn-sm">

                                                    <i class="fas fa-eye"></i>

                                                </a>

                                                <!-- INVOICE -->

                                                <a href="invoice.php?id=<?= $row['id']; ?>"
                                                    class="btn btn-secondary btn-sm">

                                                    <i class="fas fa-file-invoice"></i>

                                                </a>

                                                <!-- PRINT -->

                                                <a href="print.php?id=<?= $row['id']; ?>"
                                                    class="btn btn-dark btn-sm"
                                                    target="_blank">

                                                    <i class="fas fa-print"></i>

                                                </a>

                                            </div>

                                        </td>

                                    </tr>

                                    <?php endwhile; ?>

                                <?php else : ?>

                                    <tr>

                                        <td colspan="7"
                                            class="text-center py-4 text-muted">

                                            Tidak ada data transaksi

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
        '#transactionTable tbody tr'
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