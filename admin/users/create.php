<?php

require_once '../../config/config.php';
require_once '../../config/database.php';
require_once '../../includes/middleware.php';

isLogin();
isAdmin();

/*
|--------------------------------------------------------------------------
| CREATE USER
|--------------------------------------------------------------------------
*/

if(isset($_POST['submit']))
{
    $name = mysqli_real_escape_string(
        $conn,
        $_POST['name']
    );

    $email = mysqli_real_escape_string(
        $conn,
        $_POST['email']
    );

    $password = password_hash(
        $_POST['password'],
        PASSWORD_DEFAULT
    );

    $role = mysqli_real_escape_string(
        $conn,
        $_POST['role']
    );

    $check = mysqli_query(
        $conn,
        "SELECT id FROM users
        WHERE email='$email'"
    );

    if(mysqli_num_rows($check) > 0)
    {
        $_SESSION['error'] =
            "Email sudah digunakan";
    }
    else
    {
        $insert = mysqli_query(
            $conn,
            "INSERT INTO users
            (
                name,
                email,
                password,
                role,
                created_at
            )
            VALUES
            (
                '$name',
                '$email',
                '$password',
                '$role',
                NOW()
            )"
        );

        if($insert)
        {
            $_SESSION['success'] =
                "User berhasil ditambahkan";

            header("Location: index.php");
            exit;
        }
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

            <div class="d-flex justify-content-between align-items-center mb-4">

                <div>

                    <h3 class="fw-bold">

                        Tambah User

                    </h3>

                    <p class="text-muted mb-0">

                        Tambahkan user baru

                    </p>

                </div>

                <a href="index.php"
                    class="btn btn-secondary">

                    Kembali

                </a>

            </div>

            <?php if(isset($_SESSION['error'])) : ?>

                <div class="alert alert-danger">

                    <?= $_SESSION['error']; ?>

                </div>

                <?php unset($_SESSION['error']); ?>

            <?php endif; ?>

            <div class="card border-0 shadow rounded-4">

                <div class="card-body">

                    <form method="POST">

                        <div class="mb-3">

                            <label class="form-label">

                                Nama

                            </label>

                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">

                                Email

                            </label>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">

                                Password

                            </label>

                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">

                                Role

                            </label>

                            <select
                                name="role"
                                class="form-control">

                                <option value="admin">

                                    Admin

                                </option>

                                <option value="user">

                                    User

                                </option>

                                <option value="cashier">

                                    Cashier

                                </option>

                            </select>

                        </div>

                        <button
                            type="submit"
                            name="submit"
                            class="btn btn-primary">

                            <i class="fas fa-save"></i>

                            Simpan User

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<?php include '../../includes/footer.php'; ?>