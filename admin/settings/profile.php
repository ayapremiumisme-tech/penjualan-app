<?php

require_once '../../config/config.php';
require_once '../../config/database.php';

include '../../includes/header.php';

$user_id = $_SESSION['user_id'];

$user = mysqli_fetch_assoc(
    mysqli_query($conn,
        "SELECT * FROM users
        WHERE id='$user_id'")
);

if(isset($_POST['update']))
{
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);

    mysqli_query($conn,
        "UPDATE users SET
        name='$name',
        email='$email'
        WHERE id='$user_id'"
    );

    $_SESSION['success'] = "Profile berhasil diupdate";

    header("Location: profile.php");
    exit;
}

?>

<div class="container mt-4">

    <div class="card">

        <div class="card-body">

            <h3>Profile Settings</h3>

            <form method="POST">

                <div class="mb-3">

                    <label>Nama</label>

                    <input type="text"
                        name="name"
                        value="<?= $user['name']; ?>"
                        class="form-control">

                </div>

                <div class="mb-3">

                    <label>Email</label>

                    <input type="email"
                        name="email"
                        value="<?= $user['email']; ?>"
                        class="form-control">

                </div>

                <button type="submit"
                    name="update"
                    class="btn btn-primary">

                    Update Profile

                </button>

            </form>

        </div>

    </div>

</div>

<?php include '../../includes/footer.php'; ?>