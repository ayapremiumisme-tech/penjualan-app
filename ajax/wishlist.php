<?php

session_start();

require_once '../config/database.php';

$user_id    = $_SESSION['user_id'] ?? 1;
$product_id = $_POST['product_id'];

$check = mysqli_query($conn,
    "SELECT * FROM wishlist
    WHERE user_id='$user_id'
    AND product_id='$product_id'"
);

if(mysqli_num_rows($check) > 0)
{
    echo json_encode([
        'status' => false,
        'message' => 'Produk sudah ada di wishlist'
    ]);

    exit;
}

mysqli_query($conn,
    "INSERT INTO wishlist
    (
        user_id,
        product_id
    )
    VALUES
    (
        '$user_id',
        '$product_id'
    )"
);

echo json_encode([
    'status' => true,
    'message' => 'Wishlist berhasil ditambahkan'
]);