<?php

session_start();

require_once '../config/database.php';

$id = $_GET['id'];

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

$_SESSION['success'] = "Produk ditambahkan ke keranjang";

header("Location: pos.php");
exit;