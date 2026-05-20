<?php

require_once '../../config/config.php';
require_once '../../config/database.php';
require_once '../../includes/middleware.php';

isLogin();
isAdmin();

/*
|--------------------------------------------------------------------------
| CREATE TRANSACTION
|--------------------------------------------------------------------------
*/

if(isset($_POST['submit']))
{
    $user_id       = mysqli_real_escape_string($conn, $_POST['user_id']);
    $invoice       = 'INV-' . time();
    $total         = mysqli_real_escape_string($conn, $_POST['total']);
    $status        = mysqli_real_escape_string($conn, $_POST['payment_status']);

    $insert = mysqli_query(
        $conn,
        "INSERT INTO transactions
        (
            user_id,
            invoice_number,
            total,
            payment_status,
            created_at
        )
        VALUES
        (
            '$user_id',
            '$invoice',
            '$total',
            '$status',
            NOW()
        )"
    );

    if($insert)
    {
        $_SESSION['success'] =
            "Transaksi berhasil ditambahkan";

        header("Location: index.php");
        exit;
    }
    else
    {
        $_SESSION['error'] =
            "Transaksi gagal ditambahkan";
    }
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

            <!-- PAGE HEADER -->

            <div class="d-flex justify-content-between align-items-center mb-4">

                <div>

                    <h3 class="fw-bold">

                        Tambah Transaksi

                    </h3>

                    <p class="text-muted mb-0">

                        Tambahkan transaksi baru

                    </p>

                </div>

                <a href="index.php"
                    class="btn btn-secondary rounded-3">

                    <i class="fas fa-arrow-left"></i>

                    Kembali

                </a>

            </div>

            <!-- ALERT -->

            <?php if(isset($_SESSION['error'])) : ?>

                <div class="alert alert-danger">

                    <?= $_SESSION['error']; ?>

                </div>

                <?php unset($_SESSION['error']); ?>

            <?php endif; ?>

            <!-- CARD -->

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body">

                    <!-- FORM -->

                    <form method="POST">

                        <!-- USER -->

                        <div class="mb-3">

                            <label class="form-label">

                                Pilih User

                            </label>

                            <select
                                name="user_id"
                                class="form-control"
                                required>

                                <option value="">

                                    -- Pilih User --

                                </option>

                                <?php

                                $users = mysqli_query(
                                    $conn,
                                    "SELECT * FROM users ORDER BY name ASC"
                                );

                                while($user = mysqli_fetch_assoc($users)) :
                                ?>

                                    <option value="<?= $user['id']; ?>">

                                        <?= $user['name']; ?>
                                        -
                                        <?= $user['email']; ?>

                                    </option>

                                <?php endwhile; ?>

                            </select>

                        </div>

                        <!-- TOTAL -->

                        <div class="mb-3">

                            <label class="form-label">

                                Total Transaksi

                            </label>

                            <input
                                type="number"
                                name="total"
                                class="form-control"
                                placeholder="Masukkan total transaksi"
                                required>

                        </div>

                        <!-- STATUS -->

                        <div class="mb-3">

                            <label class="form-label">

                                Status Pembayaran

                            </label>

                            <select
                                name="payment_status"
                                class="form-control"
                                required>

                                <option value="pending">

                                    Pending

                                </option>

                                <option value="paid">

                                    Paid

                                </option>

                                <option value="failed">

                                    Failed

                                </option>

                            </select>

                        </div>

                        <!-- BUTTON -->

                        <button
                            type="submit"
                            name="submit"
                            class="btn btn-primary rounded-3">

                            <i class="fas fa-save"></i>

                            Simpan Transaksi

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<?php include '../../includes/footer.php'; ?>