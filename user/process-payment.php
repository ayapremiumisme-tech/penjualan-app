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
| VALIDASI POST
|--------------------------------------------------------------------------
*/

if($_SERVER['REQUEST_METHOD'] != 'POST'){

    header("Location: transactions.php");
    exit;

}

/*
|--------------------------------------------------------------------------
| GET DATA
|--------------------------------------------------------------------------
*/

$transaction_id =
    isset($_POST['transaction_id'])
    ? intval($_POST['transaction_id'])
    : 0;

$payment_method =
    mysqli_real_escape_string(
        $conn,
        $_POST['payment_method']
    );

/*
|--------------------------------------------------------------------------
| VALIDASI TRANSACTION
|--------------------------------------------------------------------------
*/

$query = mysqli_query(
    $conn,
    "SELECT *
    FROM transactions
    WHERE id='$transaction_id'
    LIMIT 1"
);

if(mysqli_num_rows($query) == 0){

    $_SESSION['error'] =
        "Transaksi tidak ditemukan!";

    header("Location: transactions.php");
    exit;

}

$transaction =
    mysqli_fetch_assoc($query);

/*
|--------------------------------------------------------------------------
| UPLOAD PAYMENT PROOF
|--------------------------------------------------------------------------
*/

$payment_proof = '';

if(
    isset($_FILES['payment_proof']) &&
    $_FILES['payment_proof']['error'] == 0
){

    $file_name =
        time() .
        '_' .
        $_FILES['payment_proof']['name'];

    $tmp_name =
        $_FILES['payment_proof']['tmp_name'];

    $upload_path =
        "../uploads/payments/" .
        $file_name;

    /*
    |--------------------------------------------------------------------------
    | CREATE FOLDER IF NOT EXISTS
    |--------------------------------------------------------------------------
    */

    if(
        !file_exists("../uploads/payments")
    ){

        mkdir(
            "../uploads/payments",
            0777,
            true
        );

    }

    /*
    |--------------------------------------------------------------------------
    | MOVE FILE
    |--------------------------------------------------------------------------
    */

    move_uploaded_file(
        $tmp_name,
        $upload_path
    );

    $payment_proof = $file_name;

}

/*
|--------------------------------------------------------------------------
| UPDATE TRANSACTION
|--------------------------------------------------------------------------
*/

mysqli_query(
    $conn,
    "UPDATE transactions SET

        payment_method = '$payment_method',
        payment_proof = '$payment_proof',
        payment_status = 'paid'

    WHERE id='$transaction_id'"
);

/*
|--------------------------------------------------------------------------
| SUCCESS MESSAGE
|--------------------------------------------------------------------------
*/

$_SESSION['success'] =
    "Pembayaran berhasil dikirim!";

/*
|--------------------------------------------------------------------------
| REDIRECT
|--------------------------------------------------------------------------
*/

header(
    "Location: invoice.php?id=$transaction_id"
);

exit;