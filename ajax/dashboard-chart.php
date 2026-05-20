<?php

require_once '../config/database.php';

$query = mysqli_query($conn,
    "SELECT
        DATE(created_at) AS tanggal,
        SUM(grand_total) AS total
    FROM transactions
    GROUP BY DATE(created_at)
    ORDER BY created_at ASC
    LIMIT 7"
);

$labels = [];
$data   = [];

while($row = mysqli_fetch_assoc($query))
{
    $labels[] = $row['tanggal'];
    $data[]   = $row['total'];
}

echo json_encode([
    'labels' => $labels,
    'data' => $data
]);