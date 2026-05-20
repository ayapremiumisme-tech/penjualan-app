<?php

header("Content-Type: application/json");

require_once '../../config/database.php';

$invoice = $_POST['invoice'] ?? '';
$method  = $_POST['method'] ?? 'qris';

$invoice = mysqli_real_escape_string($conn, $invoice);
$method  = mysqli_real_escape_string($conn, $method);

$query = mysqli_query($conn,
    "SELECT * FROM transactions
    WHERE invoice_number='$invoice'
    LIMIT 1"
);

if(mysqli_num_rows($query) < 1)
{
    echo json_encode([
        'status' => false,
        'message' => 'Invoice tidak ditemukan'
    ]);
    exit;
}

$transaction = mysqli_fetch_assoc($query);

mysqli_query($conn,
    "INSERT INTO payments
    (
        transaction_id,
        payment_method,
        payment_status,
        created_at
    )
    VALUES
    (
        '{$transaction['id']}',
        '$method',
        'paid',
        NOW()
    )"
);

mysqli_query($conn,
    "UPDATE transactions
    SET payment_status='paid'
    WHERE id='{$transaction['id']}'"
);

echo json_encode([
    'status' => true,
    'message' => 'Pembayaran berhasil'
]);