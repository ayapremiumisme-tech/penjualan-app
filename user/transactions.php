<?php
session_start();

require_once '../config/config.php';
require_once '../config/database.php';

include '../includes/header.php';
include 'navbar.php';

// Cek login
if(!isset($_SESSION['user_id']))
{
    header("Location: ../auth/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Ambil transaksi user
$query = mysqli_query(
    $conn,
    "SELECT *
    FROM transactions
    WHERE user_id='$user_id'
    ORDER BY id DESC"
);

?>

<div class="container mt-5">

    <!-- TITLE -->

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold">

                Riwayat Transaksi

            </h2>

            <p class="text-muted mb-0">

                Semua transaksi pembelian anda

            </p>

        </div>

        <a href="products.php"
            class="btn btn-primary rounded-3">

            <i class="fas fa-shopping-bag"></i>

            Belanja Lagi

        </a>

    </div>

    <!-- CARD -->

    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-body">

            <?php if(mysqli_num_rows($query) > 0) : ?>

                <div class="table-responsive">

                    <table class="table align-middle table-hover">

                        <thead class="table-light">

                            <tr>

                                <th>No</th>
                                <th>Invoice</th>
                                <th>Total</th>
                                <th>Metode</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th width="180">Aksi</th>

                            </tr>

                        </thead>

                        <tbody>

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

                                        <?= htmlspecialchars(
                                            $row['invoice_number']
                                            ?? 'INV-000'
                                        ); ?>

                                    </span>

                                </td>

                                <!-- TOTAL -->

                                <td>

                                    Rp <?= number_format(
                                        $row['total_amount']
                                        ?? 0
                                    ); ?>

                                </td>

                                <!-- PAYMENT METHOD -->

                                <td>

                                    <?= htmlspecialchars(
                                        $row['payment_method']
                                        ?? '-'
                                    ); ?>

                                </td>

                                <!-- STATUS -->

                                <td>

                                    <?php
                                    $status =
                                        $row['payment_status']
                                        ?? 'pending';
                                    ?>

                                    <?php if($status == 'paid') : ?>

                                        <span class="badge bg-success">

                                            Paid

                                        </span>

                                    <?php elseif($status == 'pending') : ?>

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

                                    <?php
                                    $date =
                                        $row['created_at']
                                        ?? date('Y-m-d');
                                    ?>

                                    <?= date(
                                        'd M Y',
                                        strtotime($date)
                                    ); ?>

                                </td>

                                <!-- ACTION -->

                                <td>

                                    <div class="d-flex gap-1">

                                        <!-- DETAIL -->

                                        <a href="invoice.php?id=<?= $row['id']; ?>"
                                            class="btn btn-primary btn-sm rounded-3">

                                            <i class="fas fa-eye"></i>

                                        </a>

                                        <!-- PRINT -->

                                        <a href="invoice.php?id=<?= $row['id']; ?>"
                                            target="_blank"
                                            class="btn btn-dark btn-sm rounded-3">

                                            <i class="fas fa-print"></i>

                                        </a>

                                    </div>

                                </td>

                            </tr>

                            <?php endwhile; ?>

                        </tbody>

                    </table>

                </div>

            <?php else : ?>

                <!-- EMPTY -->

                <div class="text-center py-5">

                    <i class="fas fa-shopping-cart
                        fa-4x text-muted mb-3"></i>

                    <h5 class="fw-bold">

                        Belum Ada Transaksi

                    </h5>

                    <p class="text-muted">

                        Silahkan lakukan pembelian produk terlebih dahulu

                    </p>

                    <a href="products.php"
                        class="btn btn-primary rounded-3">

                        Mulai Belanja

                    </a>

                </div>

            <?php endif; ?>

        </div>

    </div>

</div>

<?php include '../includes/footer.php'; ?>