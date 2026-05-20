<?php

header("Content-Type: application/json");

require_once '../../config/database.php';

$keyword = trim($_GET['keyword'] ?? '');

$keyword = mysqli_real_escape_string($conn, $keyword);

$query = mysqli_query($conn,
    "SELECT * FROM products
    WHERE name LIKE '%$keyword%'
    ORDER BY id DESC"
);

$data = [];

while($row = mysqli_fetch_assoc($query))
{
    $data[] = $row;
}

echo json_encode([
    'status' => true,
    'total' => count($data),
    'data' => $data
]);