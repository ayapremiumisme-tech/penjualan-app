<?php

require_once '../config/database.php';

$invoice = $_GET['invoice'];

$data = mysqli_fetch_assoc(
    mysqli_query($conn,
        "SELECT * FROM transactions
        WHERE invoice_number='$invoice'")
);

?>

<!DOCTYPE html>
<html>
<head>

    <title>Receipt</title>

    <style>

        body{
            font-family:Arial;
            padding:20px;
        }

    </style>

</head>

<body onload="window.print()">

    <h2>Struk Pembayaran</h2>

    <hr>

    <p>
        Invoice:
        <?= $data['invoice_number']; ?>
    </p>

    <p>
        Total:
        Rp <?= number_format($data['total']); ?>
    </p>

    <p>
        Status:
        <?= ucfirst($data['payment_status']); ?>
    </p>

    <p>
        Tanggal:
        <?= $data['created_at']; ?>
    </p>

</body>
</html>