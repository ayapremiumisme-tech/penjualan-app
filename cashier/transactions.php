<?php

require_once '../config/config.php';
require_once '../config/database.php';

include '../includes/header.php';

$query = mysqli_query($conn,
    "SELECT * FROM transactions
    ORDER BY id DESC"
);

?>

<div class="container mt-4">

    <h3>Riwayat Transaksi</h3>

    <div class="card">

        <div class="card-body">

            <table class="table table-bordered">

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

                    while($row = mysqli_fetch_assoc($query)) :
                    ?>

                    <tr>

                        <td><?= $no++; ?></td>

                        <td><?= $row['invoice_number']; ?></td>

                        <td>
                            Rp <?= number_format($row['total']); ?>
                        </td>

                        <td>

                            <?php if($row['payment_status'] == 'paid') : ?>

                                <span class="badge bg-success">
                                    Paid
                                </span>

                            <?php else : ?>

                                <span class="badge bg-warning">
                                    Pending
                                </span>

                            <?php endif; ?>

                        </td>

                        <td>
                            <?= $row['created_at']; ?>
                        </td>

                    </tr>

                    <?php endwhile; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?php include '../includes/footer.php'; ?>