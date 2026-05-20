<?php

require_once '../../config/database.php';

$id = $_GET['id'];

mysqli_query($conn,
    "UPDATE payments
    SET status='failed'
    WHERE id='$id'"
);

$_SESSION['success'] = "Pembayaran ditolak";

header("Location: index.php");
exit;