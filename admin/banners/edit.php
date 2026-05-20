<?php

require_once '../../config/config.php';
require_once '../../config/database.php';
require_once '../../includes/middleware.php';

isLogin();
isAdmin();

/*
|--------------------------------------------------------------------------
| CHECK ID
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
| GET BANNER
|--------------------------------------------------------------------------
*/

$query = mysqli_query(
    $conn,
    "SELECT * FROM banners
    WHERE id='$id'
    LIMIT 1"
);

if(mysqli_num_rows($query) == 0)
{
    $_SESSION['error'] =
        "Banner tidak ditemukan";

    header("Location: index.php");
    exit;
}

$banner = mysqli_fetch_assoc($query);

/*
|--------------------------------------------------------------------------
| UPDATE BANNER
|--------------------------------------------------------------------------
*/

if(isset($_POST['submit']))
{
    $title = mysqli_real_escape_string(
        $conn,
        $_POST['title']
    );

    $description = mysqli_real_escape_string(
        $conn,
        $_POST['description']
    );

    $status = mysqli_real_escape_string(
        $conn,
        $_POST['status']
    );

    $image = $banner['image'];

    /*
    |--------------------------------------------------------------------------
    | UPLOAD IMAGE
    |--------------------------------------------------------------------------
    */

    if(isset($_FILES['image']) &&
        $_FILES['image']['name'] != '')
    {
        $tmp_name = $_FILES['image']['tmp_name'];

        $filename = time() . '-' .
            $_FILES['image']['name'];

        $uploadPath =
            '../../uploads/banners/' . $filename;

        move_uploaded_file(
            $tmp_name,
            $uploadPath
        );

        /*
        |--------------------------------------------------------------------------
        | DELETE OLD IMAGE
        |--------------------------------------------------------------------------
        */

        if(!empty($banner['image']) &&
            file_exists(
                '../../uploads/banners/' .
                $banner['image']
            ))
        {
            unlink(
                '../../uploads/banners/' .
                $banner['image']
            );
        }

        $image = $filename;
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE QUERY
    |--------------------------------------------------------------------------
    */

    $update = mysqli_query(
        $conn,
        "UPDATE banners SET

            title = '$title',
            description = '$description',
            image = '$image',
            status = '$status'

        WHERE id='$id'"
    );

    if($update)
    {
        $_SESSION['success'] =
            "Banner berhasil diupdate";

        header("Location: index.php");
        exit;
    }
    else
    {
        $_SESSION['error'] =
            "Banner gagal diupdate";
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

                        Edit Banner

                    </h3>

                    <p class="text-muted mb-0">

                        Update banner promosi aplikasi

                    </p>

                </div>

                <a href="index.php"
                    class="btn btn-secondary rounded-3">

                    <i class="fas fa-arrow-left"></i>

                    Kembali

                </a>

            </div>

            <!-- ALERT -->

            <?php if(isset($_SESSION['error'])) : ?>

                <div class="alert alert-danger">

                    <?= $_SESSION['error']; ?>

                </div>

                <?php unset($_SESSION['error']); ?>

            <?php endif; ?>

            <!-- CARD -->

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body">

                    <form
                        method="POST"
                        enctype="multipart/form-data">

                        <!-- TITLE -->

                        <div class="mb-3">

                            <label class="form-label">

                                Judul Banner

                            </label>

                            <input
                                type="text"
                                name="title"
                                class="form-control"
                                value="<?= $banner['title']; ?>"
                                required>

                        </div>

                        <!-- DESCRIPTION -->

                        <div class="mb-3">

                            <label class="form-label">

                                Deskripsi

                            </label>

                            <textarea
                                name="description"
                                class="form-control"
                                rows="5"
                                placeholder="Masukkan deskripsi banner"><?= $banner['description']; ?></textarea>

                        </div>

                        <!-- IMAGE -->

                        <div class="mb-3">

                            <label class="form-label">

                                Gambar Banner

                            </label>

                            <input
                                type="file"
                                name="image"
                                class="form-control"
                                accept="image/*"
                                onchange="previewImage(event)">

                        </div>

                        <!-- IMAGE PREVIEW -->

                        <div class="mb-3">

                            <?php if(!empty($banner['image'])) : ?>

                                <img
                                    id="preview"
                                    src="<?= APP_URL; ?>/uploads/banners/<?= $banner['image']; ?>"
                                    class="img-fluid rounded-3 border"
                                    style="max-height:250px; object-fit:cover;">

                            <?php else : ?>

                                <img
                                    id="preview"
                                    src="https://via.placeholder.com/500x250?text=Preview+Banner"
                                    class="img-fluid rounded-3 border"
                                    style="max-height:250px; object-fit:cover;">

                            <?php endif; ?>

                        </div>

                        <!-- STATUS -->

                        <div class="mb-4">

                            <label class="form-label">

                                Status

                            </label>

                            <select
                                name="status"
                                class="form-control">

                                <option
                                    value="active"
                                    <?= ($banner['status'] == 'active') ? 'selected' : ''; ?>>

                                    Active

                                </option>

                                <option
                                    value="inactive"
                                    <?= ($banner['status'] == 'inactive') ? 'selected' : ''; ?>>

                                    Inactive

                                </option>

                            </select>

                        </div>

                        <!-- BUTTON -->

                        <button
                            type="submit"
                            name="submit"
                            class="btn btn-primary rounded-3">

                            <i class="fas fa-save"></i>

                            Update Banner

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- IMAGE PREVIEW -->

<script>

function previewImage(event)
{
    const reader = new FileReader();

    reader.onload = function()
    {
        const output =
            document.getElementById('preview');

        output.src = reader.result;
    }

    reader.readAsDataURL(
        event.target.files[0]
    );
}

</script>

<?php include '../../includes/footer.php'; ?>