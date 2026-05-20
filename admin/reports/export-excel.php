<?php

require_once '../../config/database.php';

header("Content-Type: application/vnd.ms-excel");

header("Content-Disposition: attachment; filename=laporan-penjualan.xls");

echo "
<table border='1'>

<tr>
    <th>Invoice</th>
    <th>Total</th>
</tr>
";

$query = mysqli_query($conn,
    "SELECT * FROM transactions"
);

while($row = mysqli_fetch_assoc($query))
{
    echo "
    <tr>
        <td>{$row['invoice_number']}</td>
        <td>{$row['total']}</td>
    </tr>
    ";
}

echo "</table>";