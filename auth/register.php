<?php

require_once '../config/config.php';
require_once '../config/database.php';

/*
|--------------------------------------------------------------------------
| REGISTER PROCESS
|--------------------------------------------------------------------------
*/

if(isset($_POST['register']))
{
    // GET INPUT

    $name = trim(
        htmlspecialchars($_POST['name'])
    );

    $email = trim(
        htmlspecialchars($_POST['email'])
    );

    $password = $_POST['password'];

    /*
    |--------------------------------------------------------------------------
    | VALIDATION
    |--------------------------------------------------------------------------
    */

    if(
        empty($name) ||
        empty($email) ||
        empty($password)
    )
    {
        $_SESSION['error'] =
            "Semua field wajib diisi!";
    }
    else
    {
        /*
        |--------------------------------------------------------------------------
        | CHECK EMAIL
        |--------------------------------------------------------------------------
        */

        $check = mysqli_query(
            $conn,
            "SELECT id FROM users
            WHERE email='$email'
            LIMIT 1"
        );

        if(mysqli_num_rows($check) > 0)
        {
            $_SESSION['error'] =
                "Email sudah digunakan!";
        }
        else
        {
            /*
            |--------------------------------------------------------------------------
            | HASH PASSWORD
            |--------------------------------------------------------------------------
            */

            $hashPassword = password_hash(
                $password,
                PASSWORD_DEFAULT
            );

            /*
            |--------------------------------------------------------------------------
            | INSERT USER
            |--------------------------------------------------------------------------
            */

            $insert = mysqli_query(
                $conn,
                "INSERT INTO users
                (
                    name,
                    email,
                    password,
                    role,
                    status,
                    created_at
                )
                VALUES
                (
                    '$name',
                    '$email',
                    '$hashPassword',
                    'user',
                    'active',
                    NOW()
                )"
            );

            if($insert)
            {
                $_SESSION['success'] =
                    "Register berhasil!";

                header("Location: login.php");
                exit;
            }
            else
            {
                $_SESSION['error'] =
                    "Register gagal!";
            }
        }
    }
}

include '../includes/header.php';
?>

<div class="auth-container">

    <div class="auth-card animate__animated animate__fadeIn">

        <h3 class="auth-title">

            Register Penjualan App

        </h3>

        <!-- ALERT ERROR -->

        <?php if(isset($_SESSION['error'])) : ?>

            <div class="alert alert-danger">

                <?= $_SESSION['error']; ?>

            </div>

            <?php unset($_SESSION['error']); ?>

        <?php endif; ?>

        <!-- FORM -->

        <form method="POST">

            <!-- NAME -->

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

            <!-- EMAIL -->

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

            <!-- PASSWORD -->

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

            <!-- BUTTON -->

            <button
                type="submit"
                name="register"
                class="btn btn-primary w-100">

                Register

            </button>

        </form>

        <!-- LOGIN -->

        <div class="text-center mt-3">

            Sudah punya akun?

            <a href="login.php">

                Login

            </a>

        </div>

    </div>

</div>

<?php include '../includes/footer.php'; ?>