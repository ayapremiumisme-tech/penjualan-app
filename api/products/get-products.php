<?php

header("Content-Type: application/json");

require_once '../../config/database.php';

$query = mysqli_query($conn,
    "SELECT products.*, categories.name AS category_name
    FROM products
    LEFT JOIN categories
    ON products.category_id = categories.id
    ORDER BY products.id DESC"
);

$data = [];

while($row = mysqli_fetch_assoc($query))
{
    $data[] = $row;
}

echo json_encode([
    'status' => true,
    'message' => 'Data produk berhasil diambil',
    'data' => $data
]);