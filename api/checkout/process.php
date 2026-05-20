<?php

header("Content-Type: application/json");

session_start();

require_once '../../config/database.php';

if(empty($_SESSION['cart']))
{
    echo json_encode([
        'status' => false,
        'message' => 'Keranjang kosong'
    ]);
    exit;
}

$user_id = $_SESSION['user_id'] ?? 1;

$invoice = 'INV-' . time();

$total = 0;

foreach($_SESSION['cart'] as $item)
{
    $subtotal = $item['price'] * $item['qty'];

    $total += $subtotal;
}

$tax = $total * 0.11;

$grand_total = $total + $tax;

$insert = mysqli_query($conn,
    "INSERT INTO transactions
    (
        invoice_number,
        user_id,
        total,
        tax,
        grand_total,
        payment_status,
        created_at
    )
    VALUES
    (
        '$invoice',
        '$user_id',
        '$total',
        '$tax',
        '$grand_total',
        'pending',
        NOW()
    )"
);

$transaction_id = mysqli_insert_id($conn);

foreach($_SESSION['cart'] as $item)
{
    $subtotal = $item['price'] * $item['qty'];

    mysqli_query($conn,
        "INSERT INTO transaction_details
        (
            transaction_id,
            product_id,
            qty,
            price,
            subtotal
        )
        VALUES
        (
            '$transaction_id',
            '{$item['id']}',
            '{$item['qty']}',
            '{$item['price']}',
            '$subtotal'
        )"
    );

    mysqli_query($conn,
        "UPDATE products
        SET stock = stock - {$item['qty']}
        WHERE id='{$item['id']}'"
    );
}

unset($_SESSION['cart']);

echo json_encode([
    'status' => true,
    'message' => 'Checkout berhasil',
    'invoice' => $invoice,
    'grand_total' => $grand_total
]);