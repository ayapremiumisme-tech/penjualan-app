<?php

require_once '../../config/config.php';
require_once '../../config/database.php';
require_once '../../includes/middleware.php';

isLogin();
isAdmin();

include '../../includes/header.php';
include '../../includes/navbar.php';

/*
|--------------------------------------------------------------------------
| GET BANNERS
|--------------------------------------------------------------------------
*/

$query = mysqli_query(
    $conn,
    "SELECT * FROM banners ORDER BY id DESC"
);

$totalBanner = mysqli_num_rows($query);

?>

<div class="container-fluid">

    <div class="row">

        <!-- SIDEBAR -->

        <div class="col-md-2 p-0">

            <?php include '../../includes/sidebar.php'; ?>

        </div>

        <!-- CONTENT -->

        <div class="col-md-10 p-4">

            <!-- PAGE HEADER -->

            <div class="d-flex justify-content-between align-items-center mb-4">

                <div>

                    <h3 class="fw-bold">

                        Data Banners

                    </h3>

                    <p class="text-muted mb-0">

                        Total Banner:
                        <?= $totalBanner; ?>

                    </p>

                </div>

                <a href="create.php"
                    class="btn btn-primary rounded-3">

                    <i class="fas fa-plus"></i>

                    Tambah Banner

                </a>

            </div>

            <!-- CARD -->

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body">

                    <!-- SEARCH -->

                    <div class="row mb-3">

                        <div class="col-md-4">

                            <input
                                type="text"
                                id="searchInput"
                                class="form-control"
                                placeholder="Cari banner...">

                        </div>

                    </div>

                    <!-- TABLE -->

                    <div class="table-responsive">

                        <table
                            class="table table-hover table-striped align-middle"
                            id="bannerTable">

                            <thead class="table-dark">

                                <tr>

                                    <th>No</th>
                                    <th>Banner</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                    <th width="180">Aksi</th>

                                </tr>

                            </thead>

                            <tbody>

                                <?php if(mysqli_num_rows($query) > 0) : ?>

                                    <?php
                                    $no = 1;

                                    while($row = mysqli_fetch_assoc($query)) :
                                    ?>

                                    <tr>

                                        <!-- NO -->

                                        <td>

                                            <?= $no++; ?>

                                        </td>

                                        <!-- IMAGE -->

                                        <td>

                                            <?php if(!empty($row['image'])) : ?>

                                                <img
                                                    src="<?= APP_URL; ?>/uploads/banners/<?= $row['image']; ?>"
                                                    width="80"
                                                    height="50"
                                                    class="rounded shadow-sm"
                                                    style="object-fit:cover;">

                                            <?php else : ?>

                                                <div
                                                    class="bg-light d-flex align-items-center justify-content-center rounded"
                                                    style="width:80px; height:50px;">

                                                    <i class="fas fa-image text-secondary"></i>

                                                </div>

                                            <?php endif; ?>

                                        </td>

                                        <!-- TITLE -->

                                        <td>

                                            <span class="fw-semibold text-primary">

                                                <?= $row['title']; ?>

                                            </span>

                                        </td>

                                        <!-- STATUS -->

                                        <td>

                                            <?php if($row['status'] == 'active') : ?>

                                                <span class="badge bg-success">

                                                    Active

                                                </span>

                                            <?php else : ?>

                                                <span class="badge bg-secondary">

                                                    Inactive

                                                </span>

                                            <?php endif; ?>

                                        </td>

                                        <!-- DATE -->

                                        <td>

                                            <?= date('d M Y', strtotime($row['created_at'])); ?>

                                        </td>

                                        <!-- ACTION -->

                                        <td>

                                            <div class="d-flex gap-1">

                                                <!-- DETAIL -->

                                                <a href="detail.php?id=<?= $row['id']; ?>"
                                                    class="btn btn-info btn-sm">

                                                    <i class="fas fa-eye"></i>

                                                </a>

                                                <!-- EDIT -->

                                                <a href="edit.php?id=<?= $row['id']; ?>"
                                                    class="btn btn-warning btn-sm">

                                                    <i class="fas fa-edit"></i>

                                                </a>

                                                <!-- DELETE -->

                                                <a href="delete.php?id=<?= $row['id']; ?>"
                                                    class="btn btn-danger btn-sm">

                                                    <i class="fas fa-trash"></i>

                                                </a>

                                            </div>

                                        </td>

                                    </tr>

                                    <?php endwhile; ?>

                                <?php else : ?>

                                    <tr>

                                        <td colspan="6"
                                            class="text-center py-4 text-muted">

                                            Tidak ada data banner

                                        </td>

                                    </tr>

                                <?php endif; ?>

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- REALTIME SEARCH -->

<script>

document
.getElementById('searchInput')
.addEventListener('keyup', function(){

    let value = this.value.toLowerCase();

    let rows = document.querySelectorAll(
        '#bannerTable tbody tr'
    );

    rows.forEach(function(row){

        row.style.display =
            row.innerText.toLowerCase().includes(value)
            ? ''
            : 'none';

    });

});

</script>

<?php include '../../includes/footer.php'; ?>