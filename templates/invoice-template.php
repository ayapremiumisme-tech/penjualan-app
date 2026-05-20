<?php

function invoiceTemplate($transaction, $items)
{
?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <title>Invoice <?= $transaction['invoice_number']; ?></title>

    <style>

        body{
            font-family:Arial, sans-serif;
            padding:30px;
            color:#333;
        }

        .invoice-box{
            max-width:900px;
            margin:auto;
            border:1px solid #eee;
            padding:30px;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        table th,
        table td{
            border:1px solid #ddd;
            padding:10px;
        }

        table th{
            background:#f5f5f5;
        }

        .text-right{
            text-align:right;
        }

    </style>

</head>

<body>

<div class="invoice-box">

    <h2>INVOICE</h2>

    <hr>

    <p>
        <strong>No Invoice:</strong>
        <?= $transaction['invoice_number']; ?>
    </p>

    <p>
        <strong>Tanggal:</strong>
        <?= $transaction['created_at']; ?>
    </p>

    <p>
        <strong>Status:</strong>
        <?= ucfirst($transaction['payment_status']); ?>
    </p>

    <table>

        <thead>

            <tr>

                <th>Produk</th>
                <th>Qty</th>
                <th>Harga</th>
                <th>Subtotal</th>

            </tr>

        </thead>

        <tbody>

            <?php foreach($items as $item) : ?>

            <tr>

                <td><?= $item['name']; ?></td>

                <td><?= $item['qty']; ?></td>

                <td>
                    Rp <?= number_format($item['price']); ?>
                </td>

                <td>
                    Rp <?= number_format($item['subtotal']); ?>
                </td>

            </tr>

            <?php endforeach; ?>

        </tbody>

    </table>

    <h3 class="text-right mt-3">

        Total:
        Rp <?= number_format($transaction['grand_total']); ?>

    </h3>

</div>

</body>
</html>

<?php
}
?>