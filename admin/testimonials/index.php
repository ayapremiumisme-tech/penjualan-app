<?php

require_once '../../config/config.php';
require_once '../../config/database.php';

include '../../includes/header.php';

$query = mysqli_query($conn,
    "SELECT testimonials.*, users.name AS user_name
    FROM testimonials
    LEFT JOIN users
    ON testimonials.user_id = users.id
    ORDER BY testimonials.id DESC"
);

?>

<div class="container mt-4">

    <div class="d-flex justify-content-between mb-3">

        <h3>Data Testimoni</h3>

    </div>

    <div class="card">

        <div class="card-body">

            <table class="table table-bordered">

                <thead>

                    <tr>

                        <th>No</th>
                        <th>User</th>
                        <th>Testimoni</th>
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

                        <td><?= $row['user_name']; ?></td>

                        <td><?= $row['message']; ?></td>

                        <td>

                            <?php if($row['status'] == 'approved') : ?>

                                <span class="badge bg-success">
                                    Approved
                                </span>

                            <?php elseif($row['status'] == 'rejected') : ?>

                                <span class="badge bg-danger">
                                    Rejected
                                </span>

                            <?php else : ?>

                                <span class="badge bg-warning">
                                    Pending
                                </span>

                            <?php endif; ?>

                        </td>

                        <td>

                            <a href="approve.php?id=<?= $row['id']; ?>"
                                class="btn btn-success btn-sm">

                                Approve

                            </a>

                            <a href="reject.php?id=<?= $row['id']; ?>"
                                class="btn btn-warning btn-sm">

                                Reject

                            </a>

                            <a href="delete.php?id=<?= $row['id']; ?>"
                                class="btn btn-danger btn-sm">

                                Hapus

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