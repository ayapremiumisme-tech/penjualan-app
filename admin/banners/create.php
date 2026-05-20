<?php

require_once '../../config/config.php';
require_once '../../config/database.php';

if(isset($_POST['submit']))
{
    $title = $_POST['title'];

    $image = $_FILES['image']['name'];

    move_uploaded_file(
        $_FILES['image']['tmp_name'],
        '../../uploads/banners/' . $image
    );

    mysqli_query($conn,
        "INSERT INTO banners(title,image)
        VALUES('$title','$image')"
    );

    $_SESSION['success'] = "Banner berhasil ditambahkan";

    header("Location: index.php");
    exit;
}

include '../../includes/header.php';

?>

<div class="container mt-4">

    <div class="card">

        <div class="card-body">

            <h3>Tambah Banner</h3>

            <form method="POST"
                enctype="multipart/form-data">

                <div class="mb-3">

                    <label>Judul Banner</label>

                    <input type="text"
                        name="title"
                        class="form-control">

                </div>

                <div class="mb-3">

                    <label>Upload Banner</label>

                    <input type="file"
                        name="image"
                        class="form-control">

                </div>

                <button type="submit"
                    name="submit"
                    class="btn btn-primary">

                    Simpan

                </button>

            </form>

        </div>

    </div>

</div>

<?php include '../../includes/footer.php'; ?>