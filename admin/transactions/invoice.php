<?php

require_once '../../config/config.php';
require_once '../../config/database.php';
require_once '../../includes/middleware.php';

isLogin();
isAdmin();

if(!isset($_GET['id']))
{
    header("Location: index.php");
    exit;
}

$id = intval($_GET['id']);

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

            <div class="card border-0 shadow rounded-4">

                <div class="card-body">

                    <div class="d-flex justify-content-between mb-4">

                        <div>

                            <h3 class="fw-bold">

                                Invoice

                            </h3>

                            <p class="text-muted">

                                <?= $transaction['invoice_number']; ?>

                            </p>

                        </div>

                        <a href="index.php"
                            class="btn btn-secondary">

                            Kembali

                        </a>

                    </div>

                    <hr>

                    <div class="row">

                        <div class="col-md-6">

                            <h5>User</h5>

                            <p>

                                <?= $transaction['user_name']; ?>
                                <br>
                                <?= $transaction['user_email']; ?>

                            </p>

                        </div>

                        <div class="col-md-6 text-end">

                            <h5>Status</h5>

                            <span class="badge bg-success">

                                <?= ucfirst($transaction['payment_status']); ?>

                            </span>

                        </div>

                    </div>

                    <table class="table mt-4">

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

                                Total

                            </th>

                            <td>

                                Rp <?= number_format($transaction['total']); ?>

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Tanggal

                            </th>

                            <td>

                                <?= date('d M Y H:i',
                                    strtotime($transaction['created_at'])); ?>

                            </td>

                        </tr>

                    </table>

                    <a href="print.php?id=<?= $transaction['id']; ?>"
                        target="_blank"
                        class="btn btn-dark">

                        <i class="fas fa-print"></i>

                        Print Invoice

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

<?php include '../../includes/footer.php'; ?>