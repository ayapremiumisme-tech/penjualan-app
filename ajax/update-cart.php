<?php

session_start();

$product_id = $_POST['product_id'];
$qty        = $_POST['qty'];

foreach($_SESSION['cart'] as $key => $item)
{
    if($item['id'] == $product_id)
    {
        $_SESSION['cart'][$key]['qty'] = $qty;
    }
}

echo json_encode([
    'status' => true,
    'message' => 'Cart berhasil diupdate'
]);