<?php

header("Content-Type: application/json");

require_once '../../config/database.php';

$id = $_GET['id'] ?? 0;

$id = intval($id);

$query = mysqli_query($conn,
    "SELECT products.*, categories.name AS category_name
    FROM products
    LEFT JOIN categories
    ON products.category_id = categories.id
    WHERE products.id='$id'
    LIMIT 1"
);

if(mysqli_num_rows($query) < 1)
{
    echo json_encode([
        'status' => false,
        'message' => 'Produk tidak ditemukan'
    ]);
    exit;
}

$product = mysqli_fetch_assoc($query);

echo json_encode([
    'status' => true,
    'data' => $product
]);