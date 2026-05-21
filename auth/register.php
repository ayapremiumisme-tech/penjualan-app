<?php

session_start();

require_once '../config/config.php';
require_once '../config/database.php';

/*
|--------------------------------------------------------------------------
| REGISTER
|--------------------------------------------------------------------------
*/

if(isset($_POST['register']))
{
    $name =
        htmlspecialchars($_POST['name']);

    $email =
        htmlspecialchars($_POST['email']);

    $password =
        password_hash(
            $_POST['password'],
            PASSWORD_DEFAULT
        );

    /*
    |--------------------------------------------------------------------------
    | CHECK EMAIL
    |--------------------------------------------------------------------------
    */

    $check = mysqli_query(
        $conn,
        "SELECT *
        FROM users
        WHERE email='$email'"
    );

    if(mysqli_num_rows($check) > 0)
    {
        $_SESSION['error'] =
            "Email sudah digunakan";
    }
    else
    {
        mysqli_query(
            $conn,
            "INSERT INTO users
            (
                name,
                email,
                password,
                role
            )
            VALUES
            (
                '$name',
                '$email',
                '$password',
                'user'
            )"
        );

        $_SESSION['success'] =
            "Register berhasil";

        header("Location: login.php");
        exit;
    }
}

include '../includes/header.php';

?>

<style>

body{

    margin:0;
    padding:20px;

    min-height:100vh;

    display:flex;
    justify-content:center;
    align-items:center;

    background:
    linear-gradient(
        135deg,
        #6c8cff,
        #7b4dbe
    );

    font-family:'Poppins',sans-serif;

    overflow:auto;

}

/* CARD */

.register-card{

    width:100%;
    max-width:430px;

    background:
    rgba(255,255,255,0.15);

    backdrop-filter:blur(12px);

    border:
    1px solid rgba(255,255,255,0.2);

    border-radius:28px;

    box-shadow:
    0 10px 40px rgba(0,0,0,0.25);

    padding:45px;

    color:white;

    margin:auto;

}

/* TITLE */

.register-title{

    font-size:42px;

    font-weight:700;

    text-align:center;

    margin-bottom:8px;

}

.register-subtitle{

    text-align:center;

    margin-bottom:35px;

    opacity:.9;

}

/* LABEL */

.form-label{

    font-size:16px;

    margin-bottom:10px;

}

/* INPUT */

.form-control{

    border:none !important;

    border-radius:16px;

    padding:14px 18px;

    background:
    rgba(255,255,255,0.95);

    box-shadow:none !important;

}

/* BUTTON */

.btn-register{

    width:100%;

    border:none;

    border-radius:16px;

    padding:14px;

    font-size:18px;

    font-weight:700;

    background:white;

    color:black;

    transition:.3s;

}

.btn-register:hover{

    transform:translateY(-2px);

    background:#f5f5f5;

}

/* ALERT */

.alert{

    border:none;

    border-radius:14px;

}

/* LINK */

.auth-link{

    color:#ffc107;

    text-decoration:none;

    font-weight:700;

}

.auth-link:hover{

    text-decoration:underline;

}

</style>

<div class="register-card">

    <!-- TITLE -->

    <h1 class="register-title">

        Penjualan App

    </h1>

    <p class="register-subtitle">

        Buat akun anda

    </p>

    <!-- ALERT -->

    <?php if(isset($_SESSION['error'])) : ?>

        <div class="alert alert-danger">

            <?= $_SESSION['error']; ?>

        </div>

        <?php unset($_SESSION['error']); ?>

    <?php endif; ?>

    <?php if(isset($_SESSION['success'])) : ?>

        <div class="alert alert-success">

            <?= $_SESSION['success']; ?>

        </div>

        <?php unset($_SESSION['success']); ?>

    <?php endif; ?>

    <!-- FORM -->

    <form method="POST">

        <!-- NAME -->

        <div class="mb-4">

            <label class="form-label">

                Nama Lengkap

            </label>

            <input
                type="text"
                name="name"
                class="form-control"
                required>

        </div>

        <!-- EMAIL -->

        <div class="mb-4">

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

        <div class="mb-4">

            <label class="form-label">

                Password

            </label>

            <div class="position-relative">

                <input
                    type="password"
                    name="password"
                    id="password"
                    class="form-control pe-5"
                    required>

                <!-- ICON -->

                <span
                    onclick="togglePassword()"
                    style="
                        position:absolute;
                        right:18px;
                        top:50%;
                        transform:translateY(-50%);
                        cursor:pointer;
                        color:black;
                    ">

                    <i
                        class="fas fa-eye"
                        id="eyeIcon"></i>

                </span>

            </div>

        </div>

        <!-- BUTTON -->

        <button
            type="submit"
            name="register"
            class="btn-register">

            Register

        </button>

    </form>

    <!-- LOGIN -->

    <div
        class="text-center mt-4">

        Sudah punya akun?

        <a
            href="login.php"
            class="auth-link">

            Login

        </a>

    </div>

</div>

<script>

function togglePassword()
{
    let password =
        document.getElementById('password');

    let eyeIcon =
        document.getElementById('eyeIcon');

    if(password.type === 'password')
    {
        password.type = 'text';

        eyeIcon.classList.remove('fa-eye');

        eyeIcon.classList.add('fa-eye-slash');
    }
    else
    {
        password.type = 'password';

        eyeIcon.classList.remove('fa-eye-slash');

        eyeIcon.classList.add('fa-eye');
    }
}

</script>

<?php include '../includes/footer.php'; ?>