<?php

require_once '../../config/config.php';
require_once '../../config/database.php';
require_once '../../includes/middleware.php';

isLogin();
isAdmin();

if(!isset($_GET['id']))
{
    header("Location: index.php");
    exit;
}

$id = intval($_GET['id']);

$query = mysqli_query(
    $conn,
    "SELECT * FROM users
    WHERE id='$id'
    LIMIT 1"
);

if(mysqli_num_rows($query) == 0)
{
    header("Location: index.php");
    exit;
}

$user = mysqli_fetch_assoc($query);

include '../../includes/header.php';
include '../../includes/navbar.php';

?>

<div class="container-fluid">

    <div class="row">

        <div class="col-md-2 p-0">

            <?php include '../../includes/sidebar.php'; ?>

        </div>

        <div class="col-md-10 p-4">

            <div class="d-flex justify-content-between align-items-center mb-4">

                <div>

                    <h3 class="fw-bold">

                        Detail User

                    </h3>

                    <p class="text-muted mb-0">

                        Informasi lengkap user

                    </p>

                </div>

                <a href="index.php"
                    class="btn btn-secondary">

                    Kembali

                </a>

            </div>

            <div class="card border-0 shadow rounded-4">

                <div class="card-body">

                    <table class="table">

                        <tr>

                            <th width="250">

                                ID User

                            </th>

                            <td>

                                #USER<?= $user['id']; ?>

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Nama

                            </th>

                            <td>

                                <?= $user['name']; ?>

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Email

                            </th>

                            <td>

                                <?= $user['email']; ?>

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Role

                            </th>

                            <td>

                                <span class="badge bg-primary">

                                    <?= ucfirst($user['role']); ?>

                                </span>

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Created At

                            </th>

                            <td>

                                <?= date(
                                    'd M Y H:i',
                                    strtotime($user['created_at'])
                                ); ?>

                            </td>

                        </tr>

                    </table>

                    <div class="mt-4">

                        <a href="edit.php?id=<?= $user['id']; ?>"
                            class="btn btn-warning">

                            <i class="fas fa-edit"></i>

                            Edit User

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<?php include '../../includes/footer.php'; ?>