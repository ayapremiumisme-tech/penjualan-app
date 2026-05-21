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

.form-label{
    font-weight:600;
}

/* INPUT */

.form-control,
.form-select{
    border:none;

    border-radius:14px;

    padding:14px;

    background:
    rgba(255,255,255,0.9);
}

/* BUTTON */

.btn-modern{
    border:none;

    border-radius:14px;

    background:white;

    color:#6c63ff;

    font-weight:600;

    padding:14px 24px;

    transition:0.3s;
}

.btn-modern:hover{
    background:#f3f4f6;
}

/* TOTAL */

.total-price{
    font-size:40px;

    font-weight:700;

    color:#ffe082;
}

/* BOX */

.payment-box{
    background:
    rgba(255,255,255,0.1);

    border:
    1px solid rgba(255,255,255,0.2);

    border-radius:20px;

    padding:25px;
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

            Pembayaran

        </h1>

        <p class="hero-subtitle">

            Selesaikan pembayaran transaksi anda

        </p>

    </div>

    <div class="row justify-content-center">

        <div class="col-lg-7">

            <div class="glass-card p-5">

                <!-- INVOICE -->

                <div class="mb-4">

                    <h5 class="fw-bold mb-2">

                        Invoice

                    </h5>

                    <div>

                        <?= $transaction['invoice_number']; ?>

                    </div>

                </div>

                <!-- TOTAL -->

                <div class="mb-5">

                    <h5 class="fw-bold mb-2">

                        Total Pembayaran

                    </h5>

                    <div class="total-price">

                        Rp <?= number_format($transaction['total']); ?>

                    </div>

                </div>

                <!-- FORM -->

                <form
                    action="process-payment.php"
                    method="POST"
                    enctype="multipart/form-data">

                    <input
                        type="hidden"
                        name="transaction_id"
                        value="<?= $transaction['id']; ?>">

                    <!-- PAYMENT METHOD -->

                    <div class="mb-4">

                        <label class="form-label">

                            Metode Pembayaran

                        </label>

                        <select
                            name="payment_method"
                            class="form-select"
                            id="paymentMethod"
                            required>

                            <option value="QRIS">

                                QRIS

                            </option>

                            <option value="Bank">

                                Bank Transfer

                            </option>

                            <option value="E-Wallet">

                                E-Wallet

                            </option>

                        </select>

                    </div>

                    <!-- QRIS -->

                    <div
                        class="payment-box mb-4"
                        id="qrisBox">

                        <h5 class="fw-bold mb-4 text-center">

                            Scan QRIS

                        </h5>

                        <div class="text-center">

                            <img
                                src="../uploads/qris/qris.jpg"
                                class="img-fluid rounded-4 shadow"
                                width="280">

                        </div>

                        <div class="mt-4 text-center">

                            Nominal:

                            <span class="fw-bold text-warning">

                                Rp <?= number_format($transaction['total']); ?>

                            </span>

                        </div>

                    </div>

                    <!-- BANK -->

                    <div
                        class="payment-box mb-4 d-none"
                        id="bankBox">

                        <h5 class="fw-bold mb-4">

                            Pilihan Bank

                        </h5>

                        <!-- BRI -->

                        <div class="mb-4">

                            <h6 class="fw-bold">

                                BANK BRI

                            </h6>

                            <div>

                                1234567890

                            </div>

                            <small>

                                A/N Nicholas Widjaja

                            </small>

                        </div>

                        <!-- MANDIRI -->

                        <div class="mb-4">

                            <h6 class="fw-bold">

                                BANK MANDIRI

                            </h6>

                            <div>

                                9876543210

                            </div>

                            <small>

                                A/N Nicholas Widjaja

                            </small>

                        </div>

                        <!-- SEABANK -->

                        <div>

                            <h6 class="fw-bold">

                                SEABANK

                            </h6>

                            <div>

                                08123456789

                            </div>

                            <small>

                                A/N Nicholas Widjaja

                            </small>

                        </div>

                    </div>

                    <!-- EWALLET -->

                    <div
                        class="payment-box mb-4 d-none"
                        id="ewalletBox">

                        <h5 class="fw-bold mb-4">

                            Pilihan E-Wallet

                        </h5>

                        <!-- SHOPEEPAY -->

                        <div class="mb-4">

                            <h6 class="fw-bold">

                                SHOPEEPAY

                            </h6>

                            <div>

                                08123456789

                            </div>

                            <small>

                                A/N Nicholas Widjaja

                            </small>

                        </div>

                        <!-- DANA -->

                        <div class="mb-4">

                            <h6 class="fw-bold">

                                DANA

                            </h6>

                            <div>

                                08123456789

                            </div>

                            <small>

                                A/N Nicholas Widjaja

                            </small>

                        </div>

                        <!-- OVO -->

                        <div class="mb-4">

                            <h6 class="fw-bold">

                                OVO

                            </h6>

                            <div>

                                08123456789

                            </div>

                            <small>

                                A/N Nicholas Widjaja

                            </small>

                        </div>

                        <!-- GOPAY -->

                        <div>

                            <h6 class="fw-bold">

                                GOPAY

                            </h6>

                            <div>

                                08123456789

                            </div>

                            <small>

                                A/N Nicholas Widjaja

                            </small>

                        </div>

                    </div>

                    <!-- UPLOAD -->

                    <div class="mb-4">

                        <label class="form-label">

                            Upload Bukti Pembayaran

                        </label>

                        <input
                            type="file"
                            name="payment_proof"
                            class="form-control"
                            accept="image/*"
                            required>

                    </div>

                    <!-- BUTTON -->

                    <div class="d-grid">

                        <button
                            type="submit"
                            class="btn btn-modern">

                            Kirim Pembayaran

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

<script>

const paymentMethod =
document.getElementById('paymentMethod');

const qrisBox =
document.getElementById('qrisBox');

const bankBox =
document.getElementById('bankBox');

const ewalletBox =
document.getElementById('ewalletBox');

paymentMethod.addEventListener(
    'change',
    function(){

        // HIDE ALL

        qrisBox.classList.add('d-none');
        bankBox.classList.add('d-none');
        ewalletBox.classList.add('d-none');

        // QRIS

        if(this.value == 'QRIS'){

            qrisBox.classList.remove('d-none');

        }

        // BANK

        if(this.value == 'Bank'){

            bankBox.classList.remove('d-none');

        }

        // EWALLET

        if(this.value == 'E-Wallet'){

            ewalletBox.classList.remove('d-none');

        }

    }
);

</script>

<?php include '../includes/footer.php'; ?>