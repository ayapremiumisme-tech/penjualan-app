<?php
session_start();

require_once '../config/config.php';
require_once '../config/database.php';

include '../includes/header.php';
include 'navbar.php';

// Cek login
if(!isset($_SESSION['user_id']))
{
    header("Location: ../auth/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Ambil data user
$query = mysqli_query(
    $conn,
    "SELECT * FROM users
    WHERE id='$user_id'
    LIMIT 1"
);

$user = mysqli_fetch_assoc($query);

// UPDATE PROFILE
if(isset($_POST['update_profile']))
{
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);

    // FOTO PROFILE
    $photo = $user['photo'] ?? '';

    if(isset($_FILES['photo']) &&
        $_FILES['photo']['error'] == 0)
    {
        $fileName =
            time() . '_' .
            $_FILES['photo']['name'];

        $tmp =
            $_FILES['photo']['tmp_name'];

        move_uploaded_file(
            $tmp,
            '../uploads/profiles/' . $fileName
        );

        $photo = $fileName;
    }

    // PASSWORD
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

?>

<div class="container mt-5">

    <!-- ALERT -->

    <?php if(isset($_SESSION['success'])) : ?>

        <div class="alert alert-success">

            <?= $_SESSION['success']; ?>

        </div>

        <?php unset($_SESSION['success']); ?>

    <?php endif; ?>

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card border-0 shadow-lg rounded-4">

                <div class="card-body p-5">

                    <!-- TITLE -->

                    <div class="text-center mb-5">

                        <!-- PHOTO -->

                        <?php
                        $photo =
                            !empty($user['photo'])
                            ? '../uploads/profiles/' .
                                $user['photo']
                            : 'https://via.placeholder.com/120';
                        ?>

                        <img
                            src="<?= $photo; ?>"
                            width="120"
                            height="120"
                            class="rounded-circle shadow mb-3"
                            style="object-fit:cover;">

                        <h2 class="fw-bold">

                            Profile Saya

                        </h2>

                        <p class="text-muted">

                            Kelola informasi akun anda

                        </p>

                    </div>

                    <!-- FORM -->

                    <form method="POST"
                        enctype="multipart/form-data">

                        <!-- NAME -->

                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                Nama Lengkap

                            </label>

                            <input
                                type="text"
                                name="name"
                                class="form-control rounded-3"
                                value="<?= htmlspecialchars(
                                    $user['name'] ?? ''
                                ); ?>"
                                required>

                        </div>

                        <!-- EMAIL -->

                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                Email

                            </label>

                            <input
                                type="email"
                                name="email"
                                class="form-control rounded-3"
                                value="<?= htmlspecialchars(
                                    $user['email'] ?? ''
                                ); ?>"
                                required>

                        </div>

                        <!-- PASSWORD -->

                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                Password Baru

                            </label>

                            <input
                                type="password"
                                name="password"
                                class="form-control rounded-3"
                                placeholder="Kosongkan jika tidak ingin mengganti password">

                        </div>

                        <!-- PHOTO -->

                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                Foto Profile

                            </label>

                            <input
                                type="file"
                                name="photo"
                                class="form-control rounded-3">

                        </div>

                        <!-- BUTTON -->

                        <button
                            type="submit"
                            name="update_profile"
                            class="btn btn-primary w-100 rounded-3">

                            <i class="fas fa-save"></i>

                            Simpan Perubahan

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<?php include '../includes/footer.php'; ?>