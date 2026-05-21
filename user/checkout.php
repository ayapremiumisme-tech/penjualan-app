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
| CHECK CART
|--------------------------------------------------------------------------
*/

if(
    !isset($_SESSION['cart']) ||
    count($_SESSION['cart']) == 0
){

    $_SESSION['error'] =
        "Keranjang masih kosong!";

    header("Location: cart.php");
    exit;

}

/*
|--------------------------------------------------------------------------
| GET USER ID
|--------------------------------------------------------------------------
*/

$user_id = 0;

if(isset($_SESSION['user']['id'])){

    $user_id = $_SESSION['user']['id'];

}elseif(isset($_SESSION['user_id'])){

    $user_id = $_SESSION['user_id'];

}

/*
|--------------------------------------------------------------------------
| TOTAL
|--------------------------------------------------------------------------
*/

$total = 0;

foreach($_SESSION['cart'] as $item){

    $price =
        isset($item['price'])
        ? intval($item['price'])
        : 0;

    $qty =
        isset($item['qty'])
        ? intval($item['qty'])
        : 1;

    $total += ($price * $qty);

}

/*
|--------------------------------------------------------------------------
| INVOICE
|--------------------------------------------------------------------------
*/

$invoice =
    'INV-' .
    date('YmdHis') .
    rand(100,999);

/*
|--------------------------------------------------------------------------
| INSERT TRANSACTION
|--------------------------------------------------------------------------
*/

mysqli_query(
    $conn,
    "INSERT INTO transactions (

        invoice_number,
        user_id,
        total,
        payment_status,
        created_at

    ) VALUES (

        '$invoice',
        '$user_id',
        '$total',
        'pending',
        NOW()

    )"
);

/*
|--------------------------------------------------------------------------
| GET TRANSACTION ID
|--------------------------------------------------------------------------
*/

$transaction_id = mysqli_insert_id($conn);

/*
|--------------------------------------------------------------------------
| CLEAR CART
|--------------------------------------------------------------------------
*/

unset($_SESSION['cart']);

/*
|--------------------------------------------------------------------------
| REDIRECT TO PAYMENT
|--------------------------------------------------------------------------
*/

header(
    "Location: payment.php?id=$transaction_id"
);

exit;