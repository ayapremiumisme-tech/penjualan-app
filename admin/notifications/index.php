<?php

require_once '../../config/config.php';
require_once '../../config/database.php';

include '../../includes/header.php';

$query = mysqli_query($conn,
    "SELECT * FROM notifications
    ORDER BY id DESC"
);

?>

<div class="container mt-4">

    <h3>Notifikasi</h3>

    <div class="card">

        <div class="card-body">

            <table class="table table-bordered">

                <thead>

                    <tr>

                        <th>No</th>
                        <th>Judul</th>
                        <th>Pesan</th>
                        <th>Status</th>
                        <th>Tanggal</th>
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

                        <td><?= $row['title']; ?></td>

                        <td><?= $row['message']; ?></td>

                        <td>

                            <?php if($row['is_read']) : ?>

                                <span class="badge bg-success">
                                    Dibaca
                                </span>

                            <?php else : ?>

                                <span class="badge bg-warning">
                                    Belum Dibaca
                                </span>

                            <?php endif; ?>

                        </td>

                        <td>
                            <?= date('d M Y H:i', strtotime($row['created_at'])); ?>
                        </td>

                        <td>

                            <a href="read.php?id=<?= $row['id']; ?>"
                                class="btn btn-primary btn-sm">

                                Read

                            </a>

                            <a href="delete.php?id=<?= $row['id']; ?>"
                                class="btn btn-danger btn-sm">

                                Delete

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