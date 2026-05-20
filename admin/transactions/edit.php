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
    "SELECT * FROM transactions
    WHERE id='$id'
    LIMIT 1"
);

if(mysqli_num_rows($query) == 0)
{
    header("Location: index.php");
    exit;
}

$transaction = mysqli_fetch_assoc($query);

if(isset($_POST['submit']))
{
    $total = mysqli_real_escape_string(
        $conn,
        $_POST['total']
    );

    $status = mysqli_real_escape_string(
        $conn,
        $_POST['payment_status']
    );

    mysqli_query(
        $conn,
        "UPDATE transactions SET

        total='$total',
        payment_status='$status'

        WHERE id='$id'"
    );

    $_SESSION['success'] =
        "Transaksi berhasil diupdate";

    header("Location: index.php");
    exit;
}

include '../../includes/header.php';
include '../../includes/navbar.php';

?>

<div class="container-fluid">

    <div class="row">

        <div class="col-md-2 p-0">

            <?php include '../../includes/sidebar.php'; ?>

        </div>

        <div class="col-md-10 p-4">

            <div class="card border-0 shadow rounded-4">

                <div class="card-body">

                    <div class="d-flex justify-content-between mb-4">

                        <div>

                            <h3 class="fw-bold">

                                Edit Transaksi

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

                    <form method="POST">

                        <div class="mb-3">

                            <label class="form-label">

                                Total

                            </label>

                            <input
                                type="number"
                                name="total"
                                class="form-control"
                                value="<?= $transaction['total']; ?>"
                                required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">

                                Status

                            </label>

                            <select
                                name="payment_status"
                                class="form-control">

                                <option value="pending"
                                    <?= ($transaction['payment_status'] == 'pending') ? 'selected' : ''; ?>>

                                    Pending

                                </option>

                                <option value="paid"
                                    <?= ($transaction['payment_status'] == 'paid') ? 'selected' : ''; ?>>

                                    Paid

                                </option>

                                <option value="failed"
                                    <?= ($transaction['payment_status'] == 'failed') ? 'selected' : ''; ?>>

                                    Failed

                                </option>

                            </select>

                        </div>

                        <button
                            type="submit"
                            name="submit"
                            class="btn btn-primary">

                            <i class="fas fa-save"></i>

                            Update

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<?php include '../../includes/footer.php'; ?>