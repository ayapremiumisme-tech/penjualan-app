<?php

header("Content-Type: application/json");

session_start();

$product_id = $_POST['product_id'] ?? 0;
$qty        = $_POST['qty'] ?? 1;

$product_id = intval($product_id);
$qty        = intval($qty);

if(isset($_SESSION['cart']))
{
    foreach($_SESSION['cart'] as $key => $item)
    {
        if($item['id'] == $product_id)
        {
            $_SESSION['cart'][$key]['qty'] = $qty;
        }
    }
}

echo json_encode([
    'status' => true,
    'message' => 'Cart berhasil diupdate'
]);