<?php

session_start();

require_once '../config/database.php';

$id = $_POST['product_id'];

$product = mysqli_fetch_assoc(
    mysqli_query($conn,
        "SELECT * FROM products
        WHERE id='$id'")
);

$_SESSION['cart'][] = [
    'id'    => $product['id'],
    'name'  => $product['name'],
    'price' => $product['price'],
    'qty'   => 1
];

echo json_encode([
    'status' => true,
    'message' => 'Produk berhasil ditambahkan'
]);