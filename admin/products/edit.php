<?php

require_once '../../config/config.php';
require_once '../../config/database.php';
require_once '../../includes/middleware.php';

isLogin();
isAdmin();

/*
|--------------------------------------------------------------------------
| GET PRODUCT ID
|--------------------------------------------------------------------------
*/

if(!isset($_GET['id']))
{
    header("Location: index.php");
    exit;
}

$id = intval($_GET['id']);

/*
|--------------------------------------------------------------------------
| GET PRODUCT DATA
|--------------------------------------------------------------------------
*/

$productQuery = mysqli_query(
    $conn,
    "SELECT * FROM products WHERE id='$id' LIMIT 1"
);

if(mysqli_num_rows($productQuery) == 0)
{
    $_SESSION['error'] = "Produk tidak ditemukan";

    header("Location: index.php");
    exit;
}

$product = mysqli_fetch_assoc($productQuery);

/*
|--------------------------------------------------------------------------
| UPDATE PRODUCT
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
    | KEEP OLD IMAGE
    |--------------------------------------------------------------------------
    */

    $image = $product['image'];

    /*
    |--------------------------------------------------------------------------
    | UPLOAD NEW IMAGE
    |--------------------------------------------------------------------------
    */

    if(isset($_FILES['image']) && $_FILES['image']['name'] != '')
    {
        $newImage = time() . '_' . $_FILES['image']['name'];

        move_uploaded_file(
            $_FILES['image']['tmp_name'],
            '../../uploads/products/' . $newImage
        );

        /*
        |--------------------------------------------------------------------------
        | DELETE OLD IMAGE
        |--------------------------------------------------------------------------
        */

        if(!empty($product['image']))
        {
            $oldImagePath =
                '../../uploads/products/' . $product['image'];

            if(file_exists($oldImagePath))
            {
                unlink($oldImagePath);
            }
        }

        $image = $newImage;
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE QUERY
    |--------------------------------------------------------------------------
    */

    $update = mysqli_query(
        $conn,
        "UPDATE products SET
            category_id    = '$category',
            name           = '$name',
            price          = '$price',
            stock          = '$stock',
            image          = '$image'
        WHERE id='$id'"
    );

    if($update)
    {
        $_SESSION['success'] = "Produk berhasil diupdate";

        header("Location: index.php");
        exit;
    }
    else
    {
        $_SESSION['error'] = "Produk gagal diupdate";
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

                        Edit Produk

                    </h3>

                    <p class="text-muted mb-0">

                        Update data produk

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

                    <!-- ERROR -->

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

                        <!-- NAME -->

                        <div class="mb-3">

                            <label class="form-label">

                                Nama Produk

                            </label>

                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                value="<?= $product['name']; ?>"
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

                                    <option
                                        value="<?= $cat['id']; ?>"
                                        <?= ($product['category_id'] == $cat['id']) ? 'selected' : ''; ?>>

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
                                value="<?= $product['price']; ?>"
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
                                value="<?= $product['stock']; ?>"
                                required>

                        </div>

                        <!-- CURRENT IMAGE -->

                        <div class="mb-3">

                            <label class="form-label">

                                Gambar Saat Ini

                            </label>

                            <br>

                            <?php if(!empty($product['image'])) : ?>

                                <img
                                    src="<?= APP_URL; ?>/uploads/products/<?= $product['image']; ?>"
                                    width="120"
                                    class="rounded shadow-sm">

                            <?php else : ?>

                                <div class="text-muted">

                                    Tidak ada gambar

                                </div>

                            <?php endif; ?>

                        </div>

                        <!-- NEW IMAGE -->

                        <div class="mb-3">

                            <label class="form-label">

                                Upload Gambar Baru

                            </label>

                            <input
                                type="file"
                                name="image"
                                class="form-control">

                            <small class="text-muted">

                                Kosongkan jika tidak ingin mengganti gambar

                            </small>

                        </div>

                        <!-- BUTTON -->

                        <button
                            type="submit"
                            name="submit"
                            class="btn btn-primary rounded-3">

                            <i class="fas fa-save"></i>

                            Update Produk

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<?php include '../../includes/footer.php'; ?>