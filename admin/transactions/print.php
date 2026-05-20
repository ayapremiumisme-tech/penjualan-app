<?php

require_once '../../config/config.php';
require_once '../../config/database.php';

if(!isset($_GET['id']))
{
    exit('ID transaksi tidak ditemukan');
}

$id = intval($_GET['id']);

/*
|--------------------------------------------------------------------------
| GET TRANSACTION
|--------------------------------------------------------------------------
*/

$query = mysqli_query(
    $conn,
    "SELECT transactions.*, users.name AS user_name,
    users.email AS user_email
    FROM transactions
    LEFT JOIN users
    ON transactions.user_id = users.id
    WHERE transactions.id='$id'
    LIMIT 1"
);

if(mysqli_num_rows($query) == 0)
{
    exit('Data transaksi tidak ditemukan');
}

$transaction = mysqli_fetch_assoc($query);

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>

        Print Invoice

    </title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            font-family:Arial, sans-serif;
            background:#f5f5f5;
            padding:40px;
            color:#333;
        }

        .invoice-box{
            max-width:900px;
            margin:auto;
            background:#fff;
            padding:40px;
            border-radius:12px;
            box-shadow:0 0 15px rgba(0,0,0,0.08);
        }

        .invoice-header{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:40px;
        }

        .company h1{
            color:#0d6efd;
            margin-bottom:8px;
        }

        .company p{
            color:#666;
            line-height:1.6;
        }

        .invoice-title{
            text-align:right;
        }

        .invoice-title h2{
            color:#0d6efd;
            margin-bottom:10px;
        }

        .invoice-info{
            margin-bottom:30px;
        }

        .invoice-info table{
            width:100%;
        }

        .invoice-info td{
            padding:8px 0;
        }

        .table{
            width:100%;
            border-collapse:collapse;
            margin-top:20px;
        }

        .table th{
            background:#0d6efd;
            color:#fff;
            padding:12px;
            text-align:left;
        }

        .table td{
            padding:12px;
            border-bottom:1px solid #ddd;
        }

        .total-box{
            margin-top:30px;
            width:300px;
            margin-left:auto;
        }

        .total-box table{
            width:100%;
        }

        .total-box td{
            padding:10px;
        }

        .grand-total{
            background:#0d6efd;
            color:#fff;
            font-weight:bold;
            border-radius:6px;
        }

        .status{
            display:inline-block;
            padding:8px 15px;
            border-radius:20px;
            font-size:14px;
            font-weight:bold;
        }

        .paid{
            background:#198754;
            color:#fff;
        }

        .pending{
            background:#ffc107;
            color:#000;
        }

        .failed{
            background:#dc3545;
            color:#fff;
        }

        .footer{
            margin-top:50px;
            text-align:center;
            color:#777;
            font-size:14px;
        }

        @media print{

            body{
                background:#fff;
                padding:0;
            }

            .invoice-box{
                box-shadow:none;
                border:none;
            }

        }

    </style>

</head>

<body onload="window.print()">

    <div class="invoice-box">

        <!-- HEADER -->

        <div class="invoice-header">

            <div class="company">

                <h1>

                    Penjualan App

                </h1>

                <p>

                    Jl. Sistem Informasi No. 1
                    <br>

                    Email:
                    admin@penjualanapp.com

                    <br>

                    Phone:
                    +62 812 3456 7890

                </p>

            </div>

            <div class="invoice-title">

                <h2>

                    INVOICE

                </h2>

                <p>

                    <?= $transaction['invoice_number']; ?>

                </p>

            </div>

        </div>

        <!-- CUSTOMER INFO -->

        <div class="invoice-info">

            <table>

                <tr>

                    <td>

                        <strong>
                            Customer:
                        </strong>

                        <br>

                        <?= $transaction['user_name']; ?>

                        <br>

                        <?= $transaction['user_email']; ?>

                    </td>

                    <td align="right">

                        <strong>
                            Tanggal:
                        </strong>

                        <br>

                        <?= date(
                            'd M Y H:i',
                            strtotime($transaction['created_at'])
                        ); ?>

                    </td>

                </tr>

            </table>

        </div>

        <!-- TABLE -->

        <table class="table">

            <thead>

                <tr>

                    <th>

                        Invoice

                    </th>

                    <th>

                        Customer

                    </th>

                    <th>

                        Status

                    </th>

                    <th>

                        Total

                    </th>

                </tr>

            </thead>

            <tbody>

                <tr>

                    <td>

                        <?= $transaction['invoice_number']; ?>

                    </td>

                    <td>

                        <?= $transaction['user_name']; ?>

                    </td>

                    <td>

                        <?php if($transaction['payment_status'] == 'paid') : ?>

                            <span class="status paid">

                                Paid

                            </span>

                        <?php elseif($transaction['payment_status'] == 'pending') : ?>

                            <span class="status pending">

                                Pending

                            </span>

                        <?php else : ?>

                            <span class="status failed">

                                Failed

                            </span>

                        <?php endif; ?>

                    </td>

                    <td>

                        Rp <?= number_format($transaction['total']); ?>

                    </td>

                </tr>

            </tbody>

        </table>

        <!-- TOTAL -->

        <div class="total-box">

            <table>

                <tr>

                    <td>

                        Subtotal

                    </td>

                    <td align="right">

                        Rp <?= number_format($transaction['total']); ?>

                    </td>

                </tr>

                <tr>

                    <td>

                        Tax

                    </td>

                    <td align="right">

                        Rp 0

                    </td>

                </tr>

                <tr class="grand-total">

                    <td>

                        Grand Total

                    </td>

                    <td align="right">

                        Rp <?= number_format($transaction['total']); ?>

                    </td>

                </tr>

            </table>

        </div>

        <!-- FOOTER -->

        <div class="footer">

            Terima kasih telah berbelanja di
            <strong>

                Penjualan App

            </strong>

            <br>

            Invoice ini dicetak otomatis oleh sistem.

        </div>

    </div>

</body>

</html>