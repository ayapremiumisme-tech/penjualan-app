<?php
session_start();

require_once '../config/config.php';
require_once '../config/database.php';

/*
|--------------------------------------------------------------------------
| CHECK LOGIN
|--------------------------------------------------------------------------
*/

if(!isset($_SESSION['user_id']))
{
    header("Location: ../auth/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

/*
|--------------------------------------------------------------------------
| GET USER DATA
|--------------------------------------------------------------------------
*/

$query = mysqli_query(
    $conn,
    "SELECT * FROM users
    WHERE id='$user_id'
    LIMIT 1"
);

$user = mysqli_fetch_assoc($query);

/*
|--------------------------------------------------------------------------
| UPDATE PROFILE
|--------------------------------------------------------------------------
*/

if(isset($_POST['update_profile']))
{
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);

    /*
    |--------------------------------------------------------------------------
    | FOTO PROFILE
    |--------------------------------------------------------------------------
    */

    $photo = $user['photo'] ?? '';

    if(
        isset($_FILES['photo']) &&
        $_FILES['photo']['error'] == 0
    )
    {
        /*
        |--------------------------------------------------------------------------
        | CREATE FOLDER
        |--------------------------------------------------------------------------
        */

        if(
            !file_exists('../uploads/profiles/')
        )
        {
            mkdir(
                '../uploads/profiles/',
                0777,
                true
            );
        }

        /*
        |--------------------------------------------------------------------------
        | FILE NAME
        |--------------------------------------------------------------------------
        */

        $fileName =
            time() . '_' .
            $_FILES['photo']['name'];

        $tmp =
            $_FILES['photo']['tmp_name'];

        /*
        |--------------------------------------------------------------------------
        | MOVE FILE
        |--------------------------------------------------------------------------
        */

        move_uploaded_file(
            $tmp,
            '../uploads/profiles/' . $fileName
        );

        $photo = $fileName;
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE PASSWORD
    |--------------------------------------------------------------------------
    */

    if(!empty($_POST['password']))
    {
        $password =
            password_hash(
                $_POST['password'],
                PASSWORD_DEFAULT
            );

        mysqli_query(
            $conn,
            "UPDATE users SET

            name='$name',
            email='$email',
            password='$password',
            photo='$photo'

            WHERE id='$user_id'"
        );
    }
    else
    {
        mysqli_query(
            $conn,
            "UPDATE users SET

            name='$name',
            email='$email',
            photo='$photo'

            WHERE id='$user_id'"
        );
    }

    $_SESSION['success'] =
        "Profile berhasil diperbarui";

    header("Location: profile.php");
    exit;
}

/*
|--------------------------------------------------------------------------
| INCLUDE HEADER
|--------------------------------------------------------------------------
*/

include '../includes/header.php';
include 'navbar.php';

?>

<style>

body{
    background:
    linear-gradient(
        135deg,
        #6c8cff,
        #7b4dbe
    );

    min-height:100vh;

    font-family:'Poppins', sans-serif;

    color:white;
}

/* HERO */

.hero-section{
    text-align:center;

    padding:40px 0 60px;
}

.hero-title{
    font-size:52px;

    font-weight:700;
}

.hero-subtitle{
    opacity:0.9;
}

/* GLASS CARD */

.glass-card{
    background:
    rgba(255,255,255,0.15);

    backdrop-filter:blur(12px);

    border:
    1px solid rgba(255,255,255,0.2);

    border-radius:28px;

    box-shadow:
    0 10px 40px rgba(0,0,0,0.2);
}

/* PROFILE PHOTO */

.profile-photo{
    width:130px;
    height:130px;

    border-radius:50%;

    object-fit:cover;

    border:5px solid rgba(255,255,255,0.4);

    box-shadow:
    0 5px 20px rgba(0,0,0,0.25);
}

/* INPUT */

.form-control{
    border:none;

    border-radius:16px;

    padding:14px 18px;

    background:
    rgba(255,255,255,0.92);

    box-shadow:none !important;
}

/* LABEL */

.form-label{
    font-weight:600;

    margin-bottom:10px;
}

/* BUTTON */

.btn-modern{
    border:none;

    border-radius:16px;

    padding:14px;

    background:white;

    color:#6c63ff;

    font-weight:700;

    transition:0.3s;
}

.btn-modern:hover{
    background:#f3f4f6;

    transform:translateY(-2px);
}

/* ALERT */

.alert-modern{
    background:
    rgba(34,197,94,0.2);

    border:
    1px solid rgba(34,197,94,0.4);

    color:white;

    border-radius:16px;
}

/* NAVBAR */

.navbar{
    background:transparent !important;
}

.navbar a{
    color:white !important;
}

</style>

<div class="container py-5">

    <!-- HERO -->

    <div class="hero-section">

        <h1 class="hero-title">

            Profile Saya

        </h1>

        <p class="hero-subtitle">

            Kelola informasi akun anda dengan mudah

        </p>

    </div>

    <!-- ALERT -->

    <?php if(isset($_SESSION['success'])) : ?>

        <div class="row justify-content-center mb-4">

            <div class="col-lg-6">

                <div class="alert alert-modern">

                    <?= $_SESSION['success']; ?>

                </div>

            </div>

        </div>

        <?php unset($_SESSION['success']); ?>

    <?php endif; ?>

    <div class="row justify-content-center">

        <div class="col-lg-6">

            <div class="glass-card p-5">

                <!-- PROFILE -->

                <div class="text-center mb-5">

                    <?php
                    $photo =
                        !empty($user['photo'])
                        ? '../uploads/profiles/' .
                            $user['photo'] .
                            '?v=' . time()
                        : 'https://via.placeholder.com/130';
                    ?>

                    <img
                        src="<?= $photo; ?>"
                        class="profile-photo mb-3">

                    <h3 class="fw-bold">

                        <?= htmlspecialchars(
                            $user['name']
                        ); ?>

                    </h3>

                    <p class="text-light">

                        <?= htmlspecialchars(
                            $user['email']
                        ); ?>

                    </p>

                </div>

                <!-- FORM -->

                <form
                    method="POST"
                    enctype="multipart/form-data">

                    <!-- NAME -->

                    <div class="mb-4">

                        <label class="form-label">

                            Nama Lengkap

                        </label>

                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            value="<?= htmlspecialchars(
                                $user['name'] ?? ''
                            ); ?>"
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
                            value="<?= htmlspecialchars(
                                $user['email'] ?? ''
                            ); ?>"
                            required>

                    </div>

                    <!-- PASSWORD -->

                    <div class="mb-4">

                        <label class="form-label">

                            Password Baru

                        </label>

                        <input
                            type="password"
                            name="password"
                            class="form-control"
                            placeholder="Kosongkan jika tidak ingin mengganti password">

                    </div>

                    <!-- PHOTO -->

                    <div class="mb-5">

                        <label class="form-label">

                            Foto Profile

                        </label>

                        <input
                            type="file"
                            name="photo"
                            class="form-control">

                    </div>

                    <!-- BUTTON -->

                    <div class="d-grid">

                        <button
                            type="submit"
                            name="update_profile"
                            class="btn btn-modern">

                            <i class="fas fa-save"></i>

                            Simpan Perubahan

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

<?php include '../includes/footer.php'; ?>