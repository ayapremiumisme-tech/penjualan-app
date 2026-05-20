<?php

require_once '../../config/config.php';
require_once '../../config/database.php';
require_once '../../includes/middleware.php';

isLogin();
isAdmin();

include '../../includes/header.php';
include '../../includes/navbar.php';

$query = mysqli_query(
    $conn,
    "SELECT * FROM products ORDER BY id DESC"
);

?>

<div class="container-fluid">

    <div class="row">

        <!-- SIDEBAR -->

        <div class="col-md-2 p-0">

            <?php include '../../includes/sidebar.php'; ?>

        </div>

        <!-- CONTENT -->

        <div class="col-md-10 p-4">

            <!-- HEADER -->

            <div class="d-flex justify-content-between align-items-center mb-4">

                <div>

                    <h3 class="fw-bold">

                        Data Produk

                    </h3>

                    <p class="text-muted mb-0">

                        Kelola seluruh produk toko

                    </p>

                </div>

                <a href="create.php"
                    class="btn btn-primary rounded-3">

                    <i class="fas fa-plus"></i>

                    Tambah Produk

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
                                placeholder="Cari produk...">

                        </div>

                    </div>

                    <!-- TABLE -->

                    <div class="table-responsive">

                        <table
                            class="table table-hover align-middle"
                            id="dataTable">

                            <thead class="table-dark">

                                <tr>

                                    <th>No</th>
                                    <th>Produk</th>
                                    <th>Harga</th>
                                    <th>Stock</th>
                                    <th>Aksi</th>

                                </tr>

                            </thead>

                            <tbody>

                                <?php if(mysqli_num_rows($query) > 0) : ?>

                                    <?php
                                    $no = 1;

                                    while($row = mysqli_fetch_assoc($query)) :
                                    ?>

                                    <tr>

                                        <td><?= $no++; ?></td>

                                        <td>

                                            <span class="fw-semibold text-primary">

                                                <?= $row['name']; ?>

                                            </span>

                                        </td>

                                        <td>

                                            Rp <?= number_format($row['price'], 0, ',', '.'); ?>

                                        </td>

                                        <td>

                                            <?= $row['stock']; ?>

                                        </td>

                                        <td>

                                            <div class="d-flex gap-1">

                                                <a href="edit.php?id=<?= $row['id']; ?>"
                                                    class="btn btn-warning btn-sm">

                                                    <i class="fas fa-edit"></i>

                                                </a>

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

                                        <td colspan="5"
                                            class="text-center py-4 text-muted">

                                            Tidak ada data produk

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

<script>

document
.getElementById('searchInput')
.addEventListener('keyup', function(){

    let value = this.value.toLowerCase();

    let rows = document.querySelectorAll(
        '#dataTable tbody tr'
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