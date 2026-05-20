<?php

require_once '../../config/database.php';

$query = mysqli_query($conn,
    "SELECT * FROM transactions"
);

?>

<!DOCTYPE html>
<html>
<head>

    <title>Print Report</title>

</head>

<body onload="window.print()">

    <h2>Laporan Penjualan</h2>

    <table border="1"
        width="100%"
        cellpadding="10">

        <tr>

            <th>Invoice</th>
            <th>Total</th>

        </tr>

        <?php while($row = mysqli_fetch_assoc($query)) : ?>

        <tr>

            <td><?= $row['invoice_number']; ?></td>

            <td>
                Rp <?= number_format($row['total']); ?>
            </td>

        </tr>

        <?php endwhile; ?>

    </table>

</body>
</html>