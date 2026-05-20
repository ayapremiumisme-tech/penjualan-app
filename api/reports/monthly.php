<?php

header("Content-Type: application/json");

require_once '../../config/database.php';

$month = $_GET['month'] ?? date('m');
$year  = $_GET['year'] ?? date('Y');

$month = intval($month);
$year  = intval($year);

$query = mysqli_query($conn,
    "SELECT *
    FROM transactions
    WHERE MONTH(created_at)='$month'
    AND YEAR(created_at)='$year'
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
    'month' => $month,
    'year' => $year,
    'total_transactions' => count($data),
    'total_sales' => $total,
    'data' => $data
]);