<?php

require_once '../../config/config.php';
require_once '../../config/database.php';
require_once '../../includes/middleware.php';

isLogin();
isAdmin();

/*
|--------------------------------------------------------------------------
| CHECK ID
|--------------------------------------------------------------------------
*/

if(!isset($_GET['id']))
{
    header("Location: index.php");
    exit;
}

$id = intval($_GET['id']);

/*
|--------------------------------------------------------------------------
| GET TRANSACTION DETAIL
|--------------------------------------------------------------------------
*/

$query = mysqli_query(
    $conn,
    "SELECT transactions.*, users.name AS user_name,
    users.email AS user_email
    FROM transactions
    LEFT JOIN users
    ON transactions.user_id = users.id
    WHERE transactions.id='$id'
    LIMIT 1"
);

if(mysqli_num_rows($query) == 0)
{
    $_SESSION['error'] =
        "Transaksi tidak ditemukan";

    header("Location: index.php");
    exit;
}

$transaction = mysqli_fetch_assoc($query);

include '../../includes/header.php';
include '../../includes/navbar.php';

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

                        Detail Transaksi

                    </h3>

                    <p class="text-muted mb-0">

                        Informasi lengkap transaksi

                    </p>

                </div>

                <a href="index.php"
                    class="btn btn-secondary rounded-3">

                    <i class="fas fa-arrow-left"></i>

                    Kembali

                </a>

            </div>

            <!-- DETAIL CARD -->

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body">

                    <div class="row">

                        <!-- LEFT -->

                        <div class="col-md-6">

                            <table class="table">

                                <tr>

                                    <th width="200">

                                        Invoice

                                    </th>

                                    <td>

                                        <?= $transaction['invoice_number']; ?>

                                    </td>

                                </tr>

                                <tr>

                                    <th>

                                        Nama User

                                    </th>

                                    <td>

                                        <?= $transaction['user_name']; ?>

                                    </td>

                                </tr>

                                <tr>

                                    <th>

                                        Email User

                                    </th>

                                    <td>

                                        <?= $transaction['user_email']; ?>

                                    </td>

                                </tr>

                                <tr>

                                    <th>

                                        Total Transaksi

                                    </th>

                                    <td>

                                        Rp <?= number_format($transaction['total']); ?>

                                    </td>

                                </tr>

                            </table>

                        </div>

                        <!-- RIGHT -->

                        <div class="col-md-6">

                            <table class="table">

                                <tr>

                                    <th width="200">

                                        Status Pembayaran

                                    </th>

                                    <td>

                                        <?php if($transaction['payment_status'] == 'paid') : ?>

                                            <span class="badge bg-success">

                                                Paid

                                            </span>

                                        <?php elseif($transaction['payment_status'] == 'pending') : ?>

                                            <span class="badge bg-warning">

                                                Pending

                                            </span>

                                        <?php else : ?>

                                            <span class="badge bg-danger">

                                                Failed

                                            </span>

                                        <?php endif; ?>

                                    </td>

                                </tr>

                                <tr>

                                    <th>

                                        Tanggal

                                    </th>

                                    <td>

                                        <?= date(
                                            'd M Y H:i',
                                            strtotime($transaction['created_at'])
                                        ); ?>

                                    </td>

                                </tr>

                                <tr>

                                    <th>

                                        Transaction ID

                                    </th>

                                    <td>

                                        #TRX<?= $transaction['id']; ?>

                                    </td>

                                </tr>

                            </table>

                        </div>

                    </div>

                    <!-- ACTION -->

                    <div class="mt-4 d-flex gap-2">

                        <a href="edit.php?id=<?= $transaction['id']; ?>"
                            class="btn btn-warning rounded-3">

                            <i class="fas fa-edit"></i>

                            Edit

                        </a>

                        <a href="invoice.php?id=<?= $transaction['id']; ?>"
                            class="btn btn-primary rounded-3">

                            <i class="fas fa-file-invoice"></i>

                            Invoice

                        </a>

                        <a href="print.php?id=<?= $transaction['id']; ?>"
                            class="btn btn-dark rounded-3"
                            target="_blank">

                            <i class="fas fa-print"></i>

                            Print

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<?php include '../../includes/footer.php'; ?>