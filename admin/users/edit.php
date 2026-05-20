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

/*
|--------------------------------------------------------------------------
| UPDATE USER
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

    $role = mysqli_real_escape_string(
        $conn,
        $_POST['role']
    );

    if(!empty($_POST['password']))
    {
        $password = password_hash(
            $_POST['password'],
            PASSWORD_DEFAULT
        );

        mysqli_query(
            $conn,
            "UPDATE users SET

            name='$name',
            email='$email',
            password='$password',
            role='$role'

            WHERE id='$id'"
        );
    }
    else
    {
        mysqli_query(
            $conn,
            "UPDATE users SET

            name='$name',
            email='$email',
            role='$role'

            WHERE id='$id'"
        );
    }

    $_SESSION['success'] =
        "User berhasil diupdate";

    header("Location: index.php");
    exit;
}

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

                        Edit User

                    </h3>

                    <p class="text-muted mb-0">

                        Update data user

                    </p>

                </div>

                <a href="index.php"
                    class="btn btn-secondary">

                    Kembali

                </a>

            </div>

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
                                value="<?= $user['name']; ?>"
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
                                value="<?= $user['email']; ?>"
                                required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">

                                Password Baru
                                (opsional)

                            </label>

                            <input
                                type="password"
                                name="password"
                                class="form-control">

                        </div>

                        <div class="mb-3">

                            <label class="form-label">

                                Role

                            </label>

                            <select
                                name="role"
                                class="form-control">

                                <option value="admin"
                                    <?= ($user['role'] == 'admin') ? 'selected' : ''; ?>>

                                    Admin

                                </option>

                                <option value="user"
                                    <?= ($user['role'] == 'user') ? 'selected' : ''; ?>>

                                    User

                                </option>

                                <option value="cashier"
                                    <?= ($user['role'] == 'cashier') ? 'selected' : ''; ?>>

                                    Cashier

                                </option>

                            </select>

                        </div>

                        <button
                            type="submit"
                            name="submit"
                            class="btn btn-primary">

                            <i class="fas fa-save"></i>

                            Update User

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<?php include '../../includes/footer.php'; ?>