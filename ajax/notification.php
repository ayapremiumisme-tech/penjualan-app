<?php

require_once '../config/database.php';

$query = mysqli_query($conn,
    "SELECT *
    FROM notifications
    ORDER BY id DESC
    LIMIT 10"
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