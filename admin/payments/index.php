<?php

require_once '../../config/config.php';
require_once '../../config/database.php';

include '../../includes/header.php';

$query = mysqli_query($conn,
    "SELECT payments.*, transactions.invoice_number
    FROM payments
    LEFT JOIN transactions
    ON payments.transaction_id = transactions.id
    ORDER BY payments.id DESC"
);

?>

<div class="container mt-4">

    <h3>Data Pembayaran</h3>

    <div class="card">

        <div class="card-body">

            <table class="table table-bordered">

                <thead>

                    <tr>

                        <th>No</th>
                        <th>Invoice</th>
                        <th>Metode</th>
                        <th>Status</th>
                        <th>Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    <?php
                    $no = 1;

                    while($row = mysqli_fetch_assoc($query)) :
                    ?>

                    <tr>

                        <td><?= $no++; ?></td>

                        <td><?= $row['invoice_number']; ?></td>

                        <td><?= $row['method']; ?></td>

                        <td><?= ucfirst($row['status']); ?></td>

                        <td>

                            <a href="detail.php?id=<?= $row['id']; ?>"
                                class="btn btn-info btn-sm">

                                Detail

                            </a>

                            <a href="confirm.php?id=<?= $row['id']; ?>"
                                class="btn btn-success btn-sm">

                                Confirm

                            </a>

                            <a href="reject.php?id=<?= $row['id']; ?>"
                                class="btn btn-danger btn-sm">

                                Reject

                            </a>

                        </td>

                    </tr>

                    <?php endwhile; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?php include '../../includes/footer.php'; ?>