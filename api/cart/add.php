<?php

header("Content-Type: application/json");

session_start();

require_once '../../config/database.php';

$product_id = $_POST['product_id'] ?? 0;
$qty        = $_POST['qty'] ?? 1;

$product_id = intval($product_id);
$qty        = intval($qty);

$query = mysqli_query($conn,
    "SELECT * FROM products
    WHERE id='$product_id'
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

$_SESSION['cart'][] = [
    'id'    => $product['id'],
    'name'  => $product['name'],
    'price' => $product['price'],
    'qty'   => $qty
];

echo json_encode([
    'status' => true,
    'message' => 'Produk berhasil ditambahkan ke cart'
]);