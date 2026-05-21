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

/*
|--------------------------------------------------------------------------
| GET DATA
|--------------------------------------------------------------------------
*/

$id =
    isset($_GET['id'])
    ? intval($_GET['id'])
    : 0;

$user_id =
    $_SESSION['user_id'];

/*
|--------------------------------------------------------------------------
| CHECK TRANSACTION
|--------------------------------------------------------------------------
*/

$query = mysqli_query(
    $conn,
    "SELECT *
    FROM transactions
    WHERE id='$id'
    AND user_id='$user_id'
    LIMIT 1"
);

if(mysqli_num_rows($query) < 1)
{
    $_SESSION['error'] =
        "Transaksi tidak ditemukan";

    header("Location: transactions.php");
    exit;
}

$transaction =
    mysqli_fetch_assoc($query);

/*
|--------------------------------------------------------------------------
| DELETE PAYMENT IMAGE
|--------------------------------------------------------------------------
*/

if(!empty($transaction['payment_proof']))
{
    $file =
        '../uploads/payments/' .
        $transaction['payment_proof'];

    if(file_exists($file))
    {
        unlink($file);
    }
}

/*
|--------------------------------------------------------------------------
| DELETE TRANSACTION
|--------------------------------------------------------------------------
*/

mysqli_query(
    $conn,
    "DELETE FROM transactions
    WHERE id='$id'
    AND user_id='$user_id'"
);

/*
|--------------------------------------------------------------------------
| SUCCESS
|--------------------------------------------------------------------------
*/

$_SESSION['success'] =
    "Transaksi berhasil dihapus";

header("Location: transactions.php");
exit;