<?php

require_once '../../config/config.php';
require_once '../../config/database.php';

include '../../includes/header.php';

$user_id = $_SESSION['user_id'];

if(isset($_POST['change_password']))
{
    $old_password = $_POST['old_password'];
    $new_password = password_hash(
        $_POST['new_password'],
        PASSWORD_DEFAULT
    );

    $user = mysqli_fetch_assoc(
        mysqli_query($conn,
            "SELECT * FROM users
            WHERE id='$user_id'")
    );

    if(password_verify($old_password, $user['password']))
    {
        mysqli_query($conn,
            "UPDATE users SET
            password='$new_password'
            WHERE id='$user_id'"
        );

        $_SESSION['success'] = "Password berhasil diubah";
    }
    else
    {
        $_SESSION['error'] = "Password lama salah";
    }

    header("Location: security.php");
    exit;
}

?>

<div class="container mt-4">

    <div class="card">

        <div class="card-body">

            <h3>Security Settings</h3>

            <form method="POST">

                <div class="mb-3">

                    <label>Password Lama</label>

                    <input type="password"
                        name="old_password"
                        class="form-control">

                </div>

                <div class="mb-3">

                    <label>Password Baru</label>

                    <input type="password"
                        name="new_password"
                        class="form-control">

                </div>

                <button type="submit"
                    name="change_password"
                    class="btn btn-danger">

                    Ubah Password

                </button>

            </form>

        </div>

    </div>

</div>

<?php include '../../includes/footer.php'; ?>