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

                        Detail Banner

                    </h3>

                    <p class="text-muted mb-0">

                        Informasi lengkap banner promo

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

                    <div class="row">

                        <!-- IMAGE -->

                        <div class="col-md-5 text-center">

                            <?php if(!empty($banner['image'])) : ?>

                                <img
                                    src="<?= APP_URL; ?>/uploads/banners/<?= $banner['image']; ?>"
                                    class="img-fluid rounded-4 shadow-sm"
                                    style="max-height:350px; object-fit:cover;">

                            <?php else : ?>

                                <img
                                    src="https://via.placeholder.com/500x300?text=No+Image"
                                    class="img-fluid rounded-4">

                            <?php endif; ?>

                        </div>

                        <!-- DETAIL -->

                        <div class="col-md-7">

                            <table class="table table-borderless">

                                <tr>

                                    <th width="200">

                                        ID Banner

                                    </th>

                                    <td>

                                        #BNR<?= $banner['id']; ?>

                                    </td>

                                </tr>

                                <tr>

                                    <th>

                                        Judul Banner

                                    </th>

                                    <td>

                                        <span class="fw-semibold text-primary">

                                            <?= $banner['title']; ?>

                                        </span>

                                    </td>

                                </tr>

                                <tr>

                                    <th>

                                        Deskripsi

                                    </th>

                                    <td>

                                        <?= $banner['description'] ?? '-'; ?>

                                    </td>

                                </tr>

                                <tr>

                                    <th>

                                        Status

                                    </th>

                                    <td>

                                        <?php if($banner['status'] == 'active') : ?>

                                            <span class="badge bg-success">

                                                Active

                                            </span>

                                        <?php else : ?>

                                            <span class="badge bg-secondary">

                                                Inactive

                                            </span>

                                        <?php endif; ?>

                                    </td>

                                </tr>

                                <tr>

                                    <th>

                                        Created At

                                    </th>

                                    <td>

                                        <?php if(!empty($banner['created_at'])) : ?>

                                            <?= date(
                                                'd M Y H:i',
                                                strtotime($banner['created_at'])
                                            ); ?>

                                        <?php else : ?>

                                            -

                                        <?php endif; ?>

                                    </td>

                                </tr>

                            </table>

                            <!-- BUTTON -->

                            <div class="mt-4 d-flex gap-2">

                                <a href="edit.php?id=<?= $banner['id']; ?>"
                                    class="btn btn-warning rounded-3">

                                    <i class="fas fa-edit"></i>

                                    Edit Banner

                                </a>

                                <a href="delete.php?id=<?= $banner['id']; ?>"
                                    class="btn btn-danger rounded-3"
                                    onclick="return confirm('Yakin hapus banner ini?')">

                                    <i class="fas fa-trash"></i>

                                    Hapus

                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<?php include '../../includes/footer.php'; ?>