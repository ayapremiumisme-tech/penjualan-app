<?php

require_once '../../config/database.php';

$id = $_GET['id'];

mysqli_query($conn,
    "UPDATE transactions
    SET payment_status='paid'
    WHERE id='$id'"
);

$_SESSION['success'] = "Status transaksi menjadi paid";

header("Location: index.php");
exit;