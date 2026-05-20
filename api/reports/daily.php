<?php

header("Content-Type: application/json");

require_once '../../config/database.php';

$date = $_GET['date'] ?? date('Y-m-d');

$date = mysqli_real_escape_string($conn, $date);

$query = mysqli_query($conn,
    "SELECT *
    FROM transactions
    WHERE DATE(created_at)='$date'
    ORDER BY id DESC"
);

$data = [];
$total = 0;

while($row = mysqli_fetch_assoc($query))
{
    $data[] = $row;

    $total += $row['grand_total'];
}

echo json_encode([
    'status' => true,
    'date' => $date,
    'total_transactions' => count($data),
    'total_sales' => $total,
    'data' => $data
]);