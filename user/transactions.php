<?php

session_start();

require_once '../config/config.php';
require_once '../config/database.php';

/*
|--------------------------------------------------------------------------
| CHECK LOGIN
|--------------------------------------------------------------------------
*/

if(!isset($_SESSION['user_id']))
{
    header("Location: ../auth/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

/*
|--------------------------------------------------------------------------
| GET TRANSACTIONS
|--------------------------------------------------------------------------
*/

$query = mysqli_query(
    $conn,
    "SELECT *
    FROM transactions
    WHERE user_id='$user_id'
    ORDER BY id DESC"
);

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

/* GLASS CARD */

.glass-card{
    background:
    rgba(255,255,255,0.15);

    backdrop-filter:blur(12px);

    border:
    1px solid rgba(255,255,255,0.2);

    border-radius:25px;

    box-shadow:
    0 8px 30px rgba(0,0,0,0.2);
}

/* STATUS */

.badge-modern{
    padding:10px 16px;

    border-radius:12px;

    font-size:14px;
}

/* ACCOUNT BOX */

.account-box{
    background:
    rgba(255,255,255,0.1);

    border:
    1px solid rgba(255,255,255,0.2);

    border-radius:20px;

    padding:20px;
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

            Transaksi Saya

        </h1>

        <p class="hero-subtitle">

            Riwayat pembelian akun anda

        </p>

    </div>

    <div class="row">

        <?php if(mysqli_num_rows($query) > 0) : ?>

            <?php while($row = mysqli_fetch_assoc($query)) : ?>

                <div class="col-lg-6 mb-4">

                    <div class="glass-card p-4 h-100">

                        <!-- INVOICE -->

                        <div class="mb-3">

                            <h5 class="fw-bold">

                                <?= $row['invoice_number']; ?>

                            </h5>

                        </div>

                        <!-- TOTAL -->

                        <div class="mb-3">

                            <span class="text-light">

                                Total Pembayaran

                            </span>

                            <h3 class="fw-bold text-warning">

                                Rp <?= number_format(
                                    $row['total']
                                ); ?>

                            </h3>

                        </div>

                        <!-- STATUS -->

                        <div class="mb-4">

                            <?php if(
                                $row['payment_status']
                                == 'paid'
                            ) : ?>

                                <span class="badge bg-success badge-modern">

                                    Paid

                                </span>

                            <?php else : ?>

                                <span class="badge bg-warning text-dark badge-modern">

                                    Pending

                                </span>

                            <?php endif; ?>

                        </div>

                        <!-- ACCOUNT -->

                        <?php if(
                            !empty($row['account_email'])
                        ) : ?>

                            <div class="account-box">

                                <h5 class="fw-bold text-warning mb-4">

                                    Akun Netflix

                                </h5>

                                <div class="mb-2">

                                    <strong>Email:</strong>

                                    <br>

                                    <?= $row['account_email']; ?>

                                </div>

                                <div class="mb-2">

                                    <strong>Password:</strong>

                                    <br>

                                    <?= $row['account_password']; ?>

                                </div>

                                <?php if(
                                    !empty($row['account_note'])
                                ) : ?>

                                    <div class="mt-3">

                                        <strong>Catatan:</strong>

                                        <br>

                                        <?= nl2br(
                                            $row['account_note']
                                        ); ?>

                                    </div>

                                <?php endif; ?>

                            </div>

                        <?php else : ?>

                            <div class="account-box text-center">

                                <h6 class="mb-2">

                                    Akun belum dikirim admin

                                </h6>

                                <small class="text-light">

                                    Tunggu admin memproses pesanan anda

                                </small>

                            </div>

                        <?php endif; ?>

                    </div>

                </div>

            <?php endwhile; ?>

        <?php else : ?>

            <div class="col-12">

                <div class="glass-card p-5 text-center">

                    <h4 class="fw-bold">

                        Belum Ada Transaksi

                    </h4>

                    <p class="text-light">

                        Anda belum melakukan pembelian

                    </p>

                </div>

            </div>

        <?php endif; ?>

    </div>

</div>

<?php include '../includes/footer.php'; ?>