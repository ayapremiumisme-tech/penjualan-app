<?php

require_once '../../config/database.php';

$id = $_GET['id'];

$payment = mysqli_fetch_assoc(
    mysqli_query($conn,
        "SELECT payments.*, transactions.invoice_number
        FROM payments
        LEFT JOIN transactions
        ON payments.transaction_id = transactions.id
        WHERE payments.id='$id'")
);

include '../../includes/header.php';

?>

<div class="container mt-4">

    <div class="card">

        <div class="card-body">

            <h3>Detail Pembayaran</h3>

            <hr>

            <p>
                Invoice:
                <?= $payment['invoice_number']; ?>
            </p>

            <p>
                Metode:
                <?= $payment['method']; ?>
            </p>

            <p>
                Status:
                <?= ucfirst($payment['status']); ?>
            </p>

            <p>
                Bukti Pembayaran:
            </p>

            <img src="../../uploads/payments/<?= $payment['proof']; ?>"
                width="300">

        </div>

    </div>

</div>

<?php include '../../includes/footer.php'; ?>