<?php
session_start();

require_once '../config/config.php';
require_once '../config/database.php';

include '../includes/header.php';
include 'navbar.php';

// CEK ID
if(!isset($_GET['id']) || !is_numeric($_GET['id']))
{
    $_SESSION['error'] = "Invoice tidak ditemukan";
    header("Location: transactions.php");
    exit;
}

$id = intval($_GET['id']);

// AMBIL TRANSAKSI
$query = mysqli_query(
    $conn,
    "SELECT * FROM transactions
    WHERE id='$id'
    LIMIT 1"
);

if(mysqli_num_rows($query) == 0)
{
    $_SESSION['error'] = "Data transaksi tidak ditemukan";
    header("Location: transactions.php");
    exit;
}

$transaction = mysqli_fetch_assoc($query);

// AMBIL DETAIL TRANSAKSI
$details = mysqli_query(
    $conn,
    "SELECT *
    FROM transaction_details
    WHERE transaction_id='$id'"
);

?>

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-10">

            <!-- CARD -->

            <div class="card border-0 shadow-lg rounded-4">

                <div class="card-body p-5">

                    <!-- HEADER -->

                    <div class="d-flex justify-content-between align-items-center mb-4">

                        <div>

                            <h2 class="fw-bold text-primary">

                                Invoice

                            </h2>

                            <p class="text-muted mb-0">

                                Detail transaksi pembelian

                            </p>

                        </div>

                        <div>

                            <button
                                onclick="window.print()"
                                class="btn btn-dark rounded-3">

                                <i class="fas fa-print"></i>

                                Print

                            </button>

                        </div>

                    </div>

                    <hr>

                    <!-- INFO -->

                    <div class="row mb-4">

                        <!-- LEFT -->

                        <div class="col-md-6">

                            <h6 class="fw-bold mb-3">

                                Informasi Invoice

                            </h6>

                            <p class="mb-1">

                                <strong>Invoice :</strong>

                                <?= htmlspecialchars(
                                    $transaction['invoice_number']
                                    ?? 'INV-000'
                                ); ?>

                            </p>

                            <p class="mb-1">

                                <strong>Tanggal :</strong>

                                <?= date(
                                    'd M Y',
                                    strtotime(
                                        $transaction['created_at']
                                        ?? date('Y-m-d')
                                    )
                                ); ?>

                            </p>

                            <p class="mb-1">

                                <strong>Status :</strong>

                                <?php
                                $status =
                                    $transaction['payment_status']
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

                            </p>

                        </div>

                        <!-- RIGHT -->

                        <div class="col-md-6 text-md-end">

                            <h6 class="fw-bold mb-3">

                                Pembayaran

                            </h6>

                            <p class="mb-1">

                                <strong>Metode :</strong>

                                <?= htmlspecialchars(
                                    $transaction['payment_method']
                                    ?? '-'
                                ); ?>

                            </p>

                            <p class="mb-1">

                                <strong>Total :</strong>

                                <span class="text-success fw-bold">

                                    Rp <?= number_format(
                                        $transaction['total_amount']
                                        ?? 0
                                    ); ?>

                                </span>

                            </p>

                        </div>

                    </div>

                    <!-- TABLE -->

                    <div class="table-responsive">

                        <table class="table table-bordered align-middle">

                            <thead class="table-light">

                                <tr>

                                    <th>Produk</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>

                                </tr>

                            </thead>

                            <tbody>

                                <?php
                                $grandTotal = 0;

                                while($item =
                                    mysqli_fetch_assoc($details)) :
                                ?>

                                <?php
                                $price =
                                    floatval(
                                        $item['price'] ?? 0
                                    );

                                $qty =
                                    intval(
                                        $item['qty'] ?? 0
                                    );

                                $subtotal = $price * $qty;

                                $grandTotal += $subtotal;
                                ?>

                                <tr>

                                    <td>

                                        <?= htmlspecialchars(
                                            $item['product_name']
                                            ?? 'Produk'
                                        ); ?>

                                    </td>

                                    <td>

                                        Rp <?= number_format(
                                            $price
                                        ); ?>

                                    </td>

                                    <td>

                                        <?= $qty; ?>

                                    </td>

                                    <td>

                                        Rp <?= number_format(
                                            $subtotal
                                        ); ?>

                                    </td>

                                </tr>

                                <?php endwhile; ?>

                            </tbody>

                        </table>

                    </div>

                    <!-- TOTAL -->

                    <div class="d-flex justify-content-end mt-4">

                        <div style="width:300px;">

                            <div class="d-flex justify-content-between mb-2">

                                <span class="fw-semibold">

                                    Total

                                </span>

                                <span class="fw-bold text-success">

                                    Rp <?= number_format(
                                        $grandTotal
                                    ); ?>

                                </span>

                            </div>

                        </div>

                    </div>

                    <!-- FOOTER -->

                    <div class="text-center mt-5">

                        <p class="text-muted mb-0">

                            Terima kasih telah berbelanja di

                            <strong>

                                Penjualan App

                            </strong>

                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<?php include '../includes/footer.php'; ?>