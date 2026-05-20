<?php

header("Content-Type: application/json");

require_once '../../config/database.php';

$year = $_GET['year'] ?? date('Y');

$year = intval($year);

$query = mysqli_query($conn,
    "SELECT *
    FROM transactions
    WHERE YEAR(created_at)='$year'
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
    'year' => $year,
    'total_transactions' => count($data),
    'total_sales' => $total,
    'data' => $data
]);