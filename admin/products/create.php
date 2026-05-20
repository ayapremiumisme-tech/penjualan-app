<?php

require_once '../../config/config.php';
require_once '../../config/database.php';
require_once '../../includes/middleware.php';

isLogin();
isAdmin();

/*
|--------------------------------------------------------------------------
| CREATE PRODUCT
|--------------------------------------------------------------------------
*/

if(isset($_POST['submit']))
{
    $name       = mysqli_real_escape_string($conn, $_POST['name']);
    $price      = mysqli_real_escape_string($conn, $_POST['price']);
    $stock      = mysqli_real_escape_string($conn, $_POST['stock']);
    $category   = mysqli_real_escape_string($conn, $_POST['category_id']);

    /*
    |--------------------------------------------------------------------------
    | UPLOAD IMAGE
    |--------------------------------------------------------------------------
    */

    $image = '';

    if(isset($_FILES['image']) && $_FILES['image']['name'] != '')
    {
        $image = time() . '_' . $_FILES['image']['name'];

        move_uploaded_file(
            $_FILES['image']['tmp_name'],
            '../../uploads/products/' . $image
        );
    }

    /*
    |--------------------------------------------------------------------------
    | INSERT PRODUCT
    |--------------------------------------------------------------------------
    */

    $insert = mysqli_query(
        $conn,
        "INSERT INTO products
        (
            category_id,
            name,
            price,
            stock,
            image
        )
        VALUES
        (
            '$category',
            '$name',
            '$price',
            '$stock',
            '$image'
        )"
    );

    if($insert)
    {
        $_SESSION['success'] = "Produk berhasil ditambahkan";

        header("Location: index.php");
        exit;
    }
    else
    {
        $_SESSION['error'] = "Produk gagal ditambahkan";
    }
}

include '../../includes/header.php';
include '../../includes/navbar.php';

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

                        Tambah Produk

                    </h3>

                    <p class="text-muted mb-0">

                        Tambahkan produk baru ke sistem

                    </p>

                </div>

                <a href="index.php"
                    class="btn btn-secondary rounded-3">

                    <i class="fas fa-arrow-left"></i>

                    Kembali

                </a>

            </div>

            <!-- CARD -->

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body">

                    <!-- ALERT -->

                    <?php if(isset($_SESSION['error'])) : ?>

                        <div class="alert alert-danger">

                            <?= $_SESSION['error']; ?>

                        </div>

                        <?php unset($_SESSION['error']); ?>

                    <?php endif; ?>

                    <!-- FORM -->

                    <form
                        method="POST"
                        enctype="multipart/form-data">

                        <!-- PRODUCT NAME -->

                        <div class="mb-3">

                            <label class="form-label">

                                Nama Produk

                            </label>

                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                placeholder="Masukkan nama produk"
                                required>

                        </div>

                        <!-- CATEGORY -->

                        <div class="mb-3">

                            <label class="form-label">

                                Kategori

                            </label>

                            <select
                                name="category_id"
                                class="form-control"
                                required>

                                <option value="">

                                    -- Pilih Kategori --

                                </option>

                                <?php

                                $categories = mysqli_query(
                                    $conn,
                                    "SELECT * FROM categories ORDER BY name ASC"
                                );

                                while($cat = mysqli_fetch_assoc($categories)) :
                                ?>

                                    <option value="<?= $cat['id']; ?>">

                                        <?= $cat['name']; ?>

                                    </option>

                                <?php endwhile; ?>

                            </select>

                        </div>

                        <!-- PRICE -->

                        <div class="mb-3">

                            <label class="form-label">

                                Harga Produk

                            </label>

                            <input
                                type="number"
                                name="price"
                                class="form-control"
                                placeholder="Masukkan harga produk"
                                required>

                        </div>

                        <!-- STOCK -->

                        <div class="mb-3">

                            <label class="form-label">

                                Stock Produk

                            </label>

                            <input
                                type="number"
                                name="stock"
                                class="form-control"
                                placeholder="Masukkan stock produk"
                                required>

                        </div>

                        <!-- IMAGE -->

                        <div class="mb-3">

                            <label class="form-label">

                                Gambar Produk

                            </label>

                            <input
                                type="file"
                                name="image"
                                class="form-control">

                            <small class="text-muted">

                                Format file:
                                JPG, JPEG, PNG

                            </small>

                        </div>

                        <!-- BUTTON -->

                        <button
                            type="submit"
                            name="submit"
                            class="btn btn-primary rounded-3">

                            <i class="fas fa-save"></i>

                            Simpan Produk

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<?php include '../../includes/footer.php'; ?>