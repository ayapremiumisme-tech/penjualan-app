<?php
session_start();

require_once '../config/config.php';
require_once '../config/database.php';

if(isset($_POST['login']))
{
    $email = mysqli_real_escape_string(
        $conn,
        $_POST['email']
    );

    $password = $_POST['password'];

    $query = mysqli_query(
        $conn,
        "SELECT * FROM users
        WHERE email='$email'
        LIMIT 1"
    );

    if(mysqli_num_rows($query) > 0)
    {
        $user = mysqli_fetch_assoc($query);

        if(password_verify(
            $password,
            $user['password']
        ))
        {
            $_SESSION['user_id']
                = $user['id'];

            $_SESSION['user_name']
                = $user['name'];

            $_SESSION['user_role']
                = $user['role'];

            if($user['role'] == 'admin')
            {
                header(
                    "Location: ../admin/dashboard.php"
                );
            }
            else
            {
                header(
                    "Location: ../user/home.php"
                );
            }

            exit;
        }
        else
        {
            $_SESSION['error']
                = "Password salah!";
        }
    }
    else
    {
        $_SESSION['error']
            = "Email tidak ditemukan!";
    }
}

include '../includes/header.php';
?>

<style>

body{
    background:
    linear-gradient(
        135deg,
        #667eea,
        #764ba2
    );

    min-height:100vh;
}

.auth-card{
    backdrop-filter: blur(10px);

    background:
    rgba(255,255,255,0.15);

    border:1px solid rgba(255,255,255,0.2);

    border-radius:25px;

    box-shadow:
    0 8px 32px rgba(0,0,0,0.2);
}

.form-control{
    border-radius:12px;
    padding:12px;
}

.btn-login{
    border-radius:12px;
    padding:12px;
    font-weight:600;
}

</style>

<div class="container">

    <div class="row justify-content-center align-items-center"
        style="min-height:100vh;">

        <div class="col-md-4">

            <div class="auth-card p-4 text-white">

                <div class="text-center mb-4">

                    <h2 class="fw-bold">

                        Penjualan App

                    </h2>

                    <p>

                        Login ke akun anda

                    </p>

                </div>

                <?php if(isset($_SESSION['error'])) : ?>

                    <div class="alert alert-danger">

                        <?= $_SESSION['error']; ?>

                    </div>

                    <?php unset($_SESSION['error']); ?>

                <?php endif; ?>

                <form method="POST">

                    <div class="mb-3">

                        <label>Email</label>

                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            required>

                    </div>

                    <div class="mb-3">

                        <label>Password</label>

                        <div class="input-group">

                            <input
                                type="password"
                                name="password"
                                id="password"
                                class="form-control"
                                required>

                            <button
                                type="button"
                                class="btn btn-light"
                                onclick="togglePassword()">

                                <i class="fas fa-eye"></i>

                            </button>

                        </div>

                    </div>

                    <div class="d-flex justify-content-between mb-3">

                        <a href="forgot-password.php"
                            class="text-white text-decoration-none">

                            Lupa Password?

                        </a>

                    </div>

                    <button
                        type="submit"
                        name="login"
                        class="btn btn-light w-100 btn-login">

                        Login

                    </button>

                </form>

                <div class="text-center mt-4">

                    Belum punya akun?

                    <a href="register.php"
                        class="text-warning fw-bold">

                        Register

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

<script>

function togglePassword()
{
    let password =
        document.getElementById('password');

    if(password.type === 'password')
    {
        password.type = 'text';
    }
    else
    {
        password.type = 'password';
    }
}

</script>

<?php include '../includes/footer.php'; ?>