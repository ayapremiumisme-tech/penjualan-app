<?php

function reportTemplate($title, $transactions)
{
?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <title><?= $title; ?></title>

    <style>

        body{
            font-family:Arial;
            padding:20px;
        }

        table{
            width:100%;
            border-collapse:collapse;
            margin-top:20px;
        }

        table th,
        table td{
            border:1px solid #ddd;
            padding:10px;
        }

        table th{
            background:#f5f5f5;
        }

    </style>

</head>

<body>

    <h2><?= $title; ?></h2>

    <table>

        <thead>

            <tr>

                <th>No</th>
                <th>Invoice</th>
                <th>Total</th>
                <th>Status</th>
                <th>Tanggal</th>

            </tr>

        </thead>

        <tbody>

            <?php
            $no = 1;

            foreach($transactions as $row) :
            ?>

            <tr>

                <td><?= $no++; ?></td>

                <td><?= $row['invoice_number']; ?></td>

                <td>
                    Rp <?= number_format($row['grand_total']); ?>
                </td>

                <td>
                    <?= ucfirst($row['payment_status']); ?>
                </td>

                <td>
                    <?= $row['created_at']; ?>
                </td>

            </tr>

            <?php endforeach; ?>

        </tbody>

    </table>

</body>
</html>

<?php
}
?>