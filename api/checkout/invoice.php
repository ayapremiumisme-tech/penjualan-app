<?php

header("Content-Type: application/json");

require_once '../../config/database.php';

$invoice = $_GET['invoice'] ?? '';

$invoice = mysqli_real_escape_string($conn, $invoice);

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

$details = mysqli_query($conn,
    "SELECT td.*, products.name
    FROM transaction_details td
    LEFT JOIN products
    ON td.product_id = products.id
    WHERE td.transaction_id='{$transaction['id']}'"
);

$items = [];

while($row = mysqli_fetch_assoc($details))
{
    $items[] = $row;
}

echo json_encode([
    'status' => true,
    'transaction' => $transaction,
    'items' => $items
]);