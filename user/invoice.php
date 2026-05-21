<?php

session_start();

require_once '../config/config.php';
require_once '../config/database.php';

/*
|--------------------------------------------------------------------------
| CHECK LOGIN
|--------------------------------------------------------------------------
*/

if(
    !isset($_SESSION['user']) &&
    !isset($_SESSION['user_id'])
){

    header("Location: ../auth/login.php");
    exit;

}

/*
|--------------------------------------------------------------------------
| VALIDASI ID
|--------------------------------------------------------------------------
*/

if(
    !isset($_GET['id']) ||
    !is_numeric($_GET['id'])
){

    header("Location: transactions.php");
    exit;

}

$id = intval($_GET['id']);

/*
|--------------------------------------------------------------------------
| GET TRANSACTION
|--------------------------------------------------------------------------
*/

$query = mysqli_query(
    $conn,
    "SELECT *
    FROM transactions
    WHERE id='$id'
    LIMIT 1"
);

if(mysqli_num_rows($query) == 0){

    header("Location: transactions.php");
    exit;

}

$transaction = mysqli_fetch_assoc($query);

/*
|--------------------------------------------------------------------------
| HEADER
|--------------------------------------------------------------------------
*/

include '../includes/header.php';
include 'navbar.php';

?>

<style>

body{
    background:
    linear-gradient(
        135deg,
        #6c8cff,
        #7b4dbe
    );

    min-height:100vh;

    font-family:'Poppins', sans-serif;

    color:white;
}

/* HERO */

.hero-section{
    text-align:center;

    padding:40px 0 60px;
}

.hero-title{
    font-size:50px;

    font-weight:700;
}

.hero-subtitle{
    opacity:0.9;
}

/* GLASS */

.glass-card{
    background:
    rgba(255,255,255,0.15);

    backdrop-filter:blur(12px);

    border:
    1px solid rgba(255,255,255,0.2);

    border-radius:25px;

    overflow:hidden;

    box-shadow:
    0 8px 30px rgba(0,0,0,0.2);
}

/* LABEL */

.invoice-label{
    font-size:14px;

    opacity:0.8;

    margin-bottom:5px;
}

.invoice-value{
    font-size:18px;

    font-weight:600;
}

/* TOTAL */

.total-price{
    font-size:38px;

    font-weight:700;

    color:#ffe082;
}

/* STATUS */

.badge-paid{
    background:#22c55e;
}

.badge-pending{
    background:#facc15;
    color:black;
}

.badge-failed{
    background:#ef4444;
}

/* BUTTON */

.btn-modern{
    border:none;

    border-radius:12px;

    background:white;

    color:#6c63ff;

    font-weight:600;

    padding:12px 20px;

    transition:0.3s;
}

.btn-modern:hover{
    background:#f3f4f6;
}

/* NAVBAR */

.navbar{
    background:transparent !important;
}

.navbar a{
    color:white !important;
}

</style>

<div class="container py-5">

    <!-- HERO -->

    <div class="hero-section">

        <h1 class="hero-title">

            Invoice

        </h1>

        <p class="hero-subtitle">

            Detail transaksi pembelian anda

        </p>

    </div>

    <!-- INVOICE -->

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="glass-card p-5">

                <!-- INVOICE NUMBER -->

                <div class="mb-4">

                    <div class="invoice-label">

                        Invoice Number

                    </div>

                    <div class="invoice-value">

                        <?= $transaction['invoice_number']; ?>

                    </div>

                </div>

                <!-- DATE -->

                <div class="mb-4">

                    <div class="invoice-label">

                        Tanggal

                    </div>

                    <div class="invoice-value">

                        <?= date(
                            'd M Y H:i',
                            strtotime($transaction['created_at'])
                        ); ?>

                    </div>

                </div>

                <!-- PAYMENT METHOD -->

                <div class="mb-4">

                    <div class="invoice-label">

                        Metode Pembayaran

                    </div>

                    <div class="invoice-value">

                        <?= $transaction['payment_method'] ?? 'QRIS'; ?>

                    </div>

                </div>

                <!-- STATUS -->

                <div class="mb-4">

                    <div class="invoice-label">

                        Status Pembayaran

                    </div>

                    <div class="invoice-value">

                        <?php if($transaction['payment_status'] == 'paid'): ?>

                            <span class="badge badge-paid">

                                Paid

                            </span>

                        <?php elseif($transaction['payment_status'] == 'pending'): ?>

                            <span class="badge badge-pending">

                                Pending

                            </span>

                        <?php else: ?>

                            <span class="badge badge-failed">

                                Failed

                            </span>

                        <?php endif; ?>

                    </div>

                </div>

                <!-- TOTAL -->

                <div class="mb-5">

                    <div class="invoice-label">

                        Total Pembayaran

                    </div>

                    <div class="total-price">

                        Rp <?= number_format($transaction['total']); ?>

                    </div>

                </div>

                <!-- PAYMENT PROOF -->

                <?php if(!empty($transaction['payment_proof'])): ?>

                    <div class="mb-5">

                        <div class="invoice-label mb-3">

                            Bukti Pembayaran

                        </div>

                        <img
                            src="../uploads/payments/<?= $transaction['payment_proof']; ?>"
                            class="img-fluid rounded-4 shadow">

                    </div>

                <?php endif; ?>

                <!-- BUTTON -->

                <div class="d-flex gap-3 flex-wrap">

                    <!-- BACK -->

                    <a href="transactions.php"
                        class="btn btn-modern">

                        Kembali

                    </a>

                    <!-- PAYMENT -->

                    <?php if($transaction['payment_status'] == 'pending'): ?>

                        <a href="payment.php?id=<?= $transaction['id']; ?>"
                            class="btn btn-modern">

                            Bayar Sekarang

                        </a>

                    <?php endif; ?>

                </div>

            </div>

        </div>

    </div>

</div>

<?php include '../includes/footer.php'; ?>