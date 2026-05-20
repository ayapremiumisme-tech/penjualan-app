<?php

require_once '../config/config.php';
require_once '../config/database.php';

if(isset($_POST['submit']))
{
    $message = htmlspecialchars($_POST['message']);

    mysqli_query($conn,
        "INSERT INTO testimonials
        (user_id,message,status)
        VALUES(
        '1',
        '$message',
        'pending'
        )"
    );

    $_SESSION['success'] = "Testimoni berhasil dikirim";
}

include '../includes/header.php';

?>

<div class="container mt-4">

    <div class="card">

        <div class="card-body">

            <h3>Kirim Testimoni</h3>

            <form method="POST">

                <div class="mb-3">

                    <textarea
                        name="message"
                        class="form-control"
                        rows="5"
                        placeholder="Masukkan testimoni..."
                    ></textarea>

                </div>

                <button type="submit"
                    name="submit"
                    class="btn btn-primary">

                    Kirim

                </button>

            </form>

        </div>

    </div>

</div>

<?php include '../includes/footer.php'; ?>