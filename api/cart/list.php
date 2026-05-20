<?php

header("Content-Type: application/json");

session_start();

$cart = $_SESSION['cart'] ?? [];

$total = 0;

foreach($cart as $item)
{
    $total += $item['price'] * $item['qty'];
}

echo json_encode([
    'status' => true,
    'total_item' => count($cart),
    'grand_total' => $total,
    'data' => $cart
]);