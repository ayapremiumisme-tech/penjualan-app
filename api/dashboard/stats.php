<?php

header("Content-Type: application/json");

require_once '../../config/database.php';

$total_products = mysqli_num_rows(
    mysqli_query($conn,
        "SELECT id FROM products")
);

$total_users = mysqli_num_rows(
    mysqli_query($conn,
        "SELECT id FROM users")
);

$total_transactions = mysqli_num_rows(
    mysqli_query($conn,
        "SELECT id FROM transactions")
);

$sales = mysqli_fetch_assoc(
    mysqli_query($conn,
        "SELECT SUM(grand_total) AS total_sales
        FROM transactions
        WHERE payment_status='paid'")
);

echo json_encode([
    'status' => true,
    'data' => [
        'total_products' => $total_products,
        'total_users' => $total_users,
        'total_transactions' => $total_transactions,
        'total_sales' => $sales['total_sales'] ?? 0
    ]
]);