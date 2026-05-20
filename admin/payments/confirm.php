<?php

require_once '../../config/database.php';

$id = $_GET['id'];

mysqli_query($conn,
    "UPDATE payments
    SET status='paid'
    WHERE id='$id'"
);

$_SESSION['success'] = "Pembayaran berhasil dikonfirmasi";

header("Location: index.php");
exit;