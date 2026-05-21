<?php

require_once '../../config/config.php';
require_once '../../config/database.php';
require_once '../../includes/middleware.php';

isLogin();
isAdmin();

$id = $_GET['id'] ?? 0;

/*
|--------------------------------------------------------------------------
| GET TRANSACTION
|--------------------------------------------------------------------------
*/

$query = mysqli_query(
    $conn,
    "SELECT transactions.*, users.name AS user_name
    FROM transactions
    LEFT JOIN users
    ON transactions.user_id = users.id
    WHERE transactions.id='$id'
    LIMIT 1"
);

$row = mysqli_fetch_assoc($query);

if(!$row)
{
    header("Location: index.php");
    exit;
}

/*
|--------------------------------------------------------------------------
| SAVE ACCOUNT
|--------------------------------------------------------------------------
*/

if(isset($_POST['send_account']))
{
    $account_email =
        mysqli_real_escape_string(
            $conn,
            $_POST['account_email']
        );

    $account_password =
        mysqli_real_escape_string(
            $conn,
            $_POST['account_password']
        );

    $account_note =
        mysqli_real_escape_string(
            $conn,
            $_POST['account_note']
        );

    mysqli_query(
        $conn,
        "UPDATE transactions SET

        account_email='$account_email',
        account_password='$account_password',
        account_note='$account_note'

        WHERE id='$id'"
    );

    $_SESSION['success'] =
        "Akun berhasil dikirim";

    header("Location: detail.php?id=$id");
    exit;
}

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

            <!-- TITLE -->

            <div class="d-flex
                justify-content-between
                align-items-center
                mb-4">

                <div>

                    <h3 class="fw-bold">

                        Detail Transaksi

                    </h3>

                    <p class="text-muted">

                        Invoice:
                        <?= $row['invoice_number']; ?>

                    </p>

                </div>

                <a href="index.php"
                    class="btn btn-secondary">

                    Kembali

                </a>

            </div>

            <!-- ALERT -->

            <?php if(isset($_SESSION['success'])) : ?>

                <div class="alert alert-success">

                    <?= $_SESSION['success']; ?>

                </div>

                <?php unset($_SESSION['success']); ?>

            <?php endif; ?>

            <!-- DETAIL -->

            <div class="card border-0 shadow-sm rounded-4 mb-4">

                <div class="card-body p-4">

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <strong>User:</strong>

                            <br>

                            <?= $row['user_name']; ?>

                        </div>

                        <div class="col-md-6 mb-3">

                            <strong>Total:</strong>

                            <br>

                            Rp <?= number_format(
                                $row['total']
                            ); ?>

                        </div>

                        <div class="col-md-6 mb-3">

                            <strong>Status:</strong>

                            <br>

                            <?= strtoupper(
                                $row['payment_status']
                            ); ?>

                        </div>

                        <div class="col-md-6 mb-3">

                            <strong>Metode:</strong>

                            <br>

                            <?= $row['payment_method']; ?>

                        </div>

                    </div>

                </div>

            </div>

            <!-- PAYMENT PROOF -->

            <?php if(!empty($row['payment_proof'])) : ?>

                <div class="card border-0 shadow-sm rounded-4 mb-4">

                    <div class="card-body p-4">

                        <h4 class="fw-bold mb-4">

                            Bukti Pembayaran

                        </h4>

                        <img
                            src="../../uploads/payments/<?= $row['payment_proof']; ?>"
                            class="img-fluid rounded-4 shadow"
                            width="350">

                    </div>

                </div>

            <?php endif; ?>

            <!-- SEND ACCOUNT -->

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body p-4">

                    <h4 class="fw-bold mb-4">

                        Kirim Akun Netflix

                    </h4>

                    <form method="POST">

                        <!-- EMAIL -->

                        <div class="mb-3">

                            <label class="form-label">

                                Email Akun

                            </label>

                            <input
                                type="text"
                                name="account_email"
                                class="form-control"
                                value="<?= $row['account_email'] ?? ''; ?>"
                                required>

                        </div>

                        <!-- PASSWORD -->

                        <div class="mb-3">

                            <label class="form-label">

                                Password Akun

                            </label>

                            <input
                                type="text"
                                name="account_password"
                                class="form-control"
                                value="<?= $row['account_password'] ?? ''; ?>"
                                required>

                        </div>

                        <!-- NOTE -->

                        <div class="mb-4">

                            <label class="form-label">

                                Catatan

                            </label>

                            <textarea
                                name="account_note"
                                class="form-control"
                                rows="4"><?= $row['account_note'] ?? ''; ?></textarea>

                        </div>

                        <!-- BUTTON -->

                        <button
                            type="submit"
                            name="send_account"
                            class="btn btn-success">

                            <i class="fas fa-paper-plane"></i>

                            Kirim Akun

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<?php include '../../includes/footer.php'; ?>