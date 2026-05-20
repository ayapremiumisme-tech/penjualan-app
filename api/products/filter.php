<?php

header("Content-Type: application/json");

require_once '../../config/database.php';

$category_id = $_GET['category_id'] ?? 0;

$category_id = intval($category_id);

$query = mysqli_query($conn,
    "SELECT * FROM products
    WHERE category_id='$category_id'
    ORDER BY id DESC"
);

$data = [];

while($row = mysqli_fetch_assoc($query))
{
    $data[] = $row;
}

echo json_encode([
    'status' => true,
    'data' => $data
]);