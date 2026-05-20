<?php

require_once '../../config/database.php';

$id = $_GET['id'];

mysqli_query($conn,
    "UPDATE transactions
    SET payment_status='failed'
    WHERE id='$id'"
);

$_SESSION['success'] = "Status transaksi menjadi failed";

header("Location: index.php");
exit;