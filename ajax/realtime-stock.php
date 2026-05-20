<?php

require_once '../config/database.php';

$product_id = $_GET['product_id'];

$query = mysqli_query($conn,
    "SELECT stock
    FROM products
    WHERE id='$product_id'"
);

$product = mysqli_fetch_assoc($query);

echo json_encode([
    'status' => true,
    'stock' => $product['stock']
]);