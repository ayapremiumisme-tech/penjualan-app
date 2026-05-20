<?php

function receiptTemplate($transaction)
{
?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <title>Receipt</title>

    <style>

        body{
            font-family:monospace;
            width:300px;
            margin:auto;
            padding:20px;
        }

        .center{
            text-align:center;
        }

    </style>

</head>

<body onload="window.print()">

    <div class="center">

        <h2>PENJUALAN APP</h2>

        <p>
            Sistem Informasi Penjualan
        </p>

    </div>

    <hr>

    <p>
        Invoice:
        <?= $transaction['invoice_number']; ?>
    </p>

    <p>
        Total:
        Rp <?= number_format($transaction['grand_total']); ?>
    </p>

    <p>
        Status:
        <?= ucfirst($transaction['payment_status']); ?>
    </p>

    <p>
        Tanggal:
        <?= $transaction['created_at']; ?>
    </p>

    <hr>

    <div class="center">

        <p>
            Terima kasih telah berbelanja
        </p>

    </div>

</body>
</html>

<?php
}
?>