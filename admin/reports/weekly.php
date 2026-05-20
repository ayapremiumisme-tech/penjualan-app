<?php

require_once '../../config/config.php';
require_once '../../config/database.php';

include '../../includes/header.php';

$query = mysqli_query($conn,
    "SELECT * FROM transactions
    WHERE YEARWEEK(created_at, 1)=YEARWEEK(CURDATE(),1)"
);

$total = 0;

?>

<div class="container mt-4">

    <h3>Laporan Mingguan</h3>

    <div class="card">

        <div class="card-body">

            <table class="table table-bordered">

                <thead>

                    <tr>

                        <th>Invoice</th>
                        <th>Total</th>

                    </tr>

                </thead>

                <tbody>

                    <?php while($row = mysqli_fetch_assoc($query)) : ?>

                    <?php $total += $row['total']; ?>

                    <tr>

                        <td><?= $row['invoice_number']; ?></td>

                        <td>
                            Rp <?= number_format($row['total']); ?>
                        </td>

                    </tr>

                    <?php endwhile; ?>

                </tbody>

            </table>

            <h5>
                Total:
                Rp <?= number_format($total); ?>
            </h5>

        </div>

    </div>

</div>

<?php include '../../includes/footer.php'; ?>