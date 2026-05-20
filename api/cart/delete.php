<?php

header("Content-Type: application/json");

session_start();

$product_id = $_POST['product_id'] ?? 0;

$product_id = intval($product_id);

if(isset($_SESSION['cart']))
{
    foreach($_SESSION['cart'] as $key => $item)
    {
        if($item['id'] == $product_id)
        {
            unset($_SESSION['cart'][$key]);
        }
    }

    $_SESSION['cart'] = array_values($_SESSION['cart']);
}

echo json_encode([
    'status' => true,
    'message' => 'Produk berhasil dihapus dari cart'
]);