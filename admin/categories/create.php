<?php

require_once '../../config/config.php';
require_once '../../config/database.php';

if(isset($_POST['submit']))
{
    $name = htmlspecialchars($_POST['name']);

    mysqli_query($conn,
        "INSERT INTO categories(name)
        VALUES('$name')"
    );

    $_SESSION['success'] = "Kategori berhasil ditambahkan";

    header("Location: index.php");
    exit;
}

include '../../includes/header.php';

?>

<div class="container mt-4">

    <div class="card">

        <div class="card-body">

            <h3>Tambah Kategori</h3>

            <form method="POST">

                <div class="mb-3">

                    <label>Nama Kategori</label>

                    <input type="text"
                        name="name"
                        class="form-control"
                        required>

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