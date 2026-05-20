<?php
session_start();

require_once '../config/config.php';
require_once '../config/database.php';

include '../includes/header.php';
include 'navbar.php';

// VALIDASI ID
if(!isset($_GET['id']) || !is_numeric($_GET['id']))
{
    $_SESSION['error'] = "Produk tidak valid!";
    header("Location: products.php");
    exit;
}

$id = intval($_GET['id']);

// AMBIL DATA PRODUK
$query = mysqli_query(
    $conn,
    "SELECT * FROM products
    WHERE id='$id'
    LIMIT 1"
);

if(mysqli_num_rows($query) == 0)
{
    $_SESSION['error'] = "Produk tidak ditemukan!";
    header("Location: products.php");
    exit;
}

$product = mysqli_fetch_assoc($query);
?>

<div class="container py-5">

    <div class="row">

        <!-- IMAGE -->

        <div class="col-md-6 mb-4">

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

                <img
                    src="../uploads/products/<?= $product['image']; ?>"
                    class="img-fluid"
                    style="
                        width:100%;
                        height:500px;
                        object-fit:cover;
                    ">

            </div>

        </div>

        <!-- DETAIL -->

        <div class="col-md-6">

            <!-- TITLE -->

            <h2 class="fw-bold mb-3">

                <?= htmlspecialchars($product['name']); ?>

            </h2>

            <!-- PRICE -->

            <h3 class="text-success fw-bold mb-4">

                Rp <?= number_format($product['price']); ?>

            </h3>

            <!-- BADGE -->

            <div class="mb-4">

                <span class="badge bg-primary p-2">

                    Produk Digital

                </span>

                <span class="badge bg-success p-2">

                    Ready Stock

                </span>

            </div>

            <!-- DESCRIPTION -->

            <div class="card border-0 shadow-sm rounded-4 mb-4">

                <div class="card-body">

                    <h5 class="fw-bold mb-3">

                        Deskripsi Produk

                    </h5>

                    <p class="text-muted lh-lg">

                        <?php
                        if(
                            !empty($product['description'])
                        )
                        {
                            echo nl2br(
                                htmlspecialchars(
                                    $product['description']
                                )
                            );
                        }
                        else
                        {
                            echo "
                            Produk ini merupakan layanan premium
                            dengan kualitas terbaik dan harga
                            terjangkau.

                            Cocok digunakan untuk kebutuhan pribadi,
                            bisnis, hiburan, dan berbagai aktivitas
                            lainnya.

                            Produk tersedia dan siap digunakan
                            setelah pembayaran berhasil dilakukan.
                            ";
                        }
                        ?>

                    </p>

                </div>

            </div>

            <!-- FEATURES -->

            <div class="card border-0 shadow-sm rounded-4 mb-4">

                <div class="card-body">

                    <h5 class="fw-bold mb-3">

                        Keunggulan Produk

                    </h5>

                    <ul class="list-group list-group-flush">

                        <li class="list-group-item">

                            ✅ Produk original & terpercaya

                        </li>

                        <li class="list-group-item">

                            ✅ Pengiriman cepat otomatis

                        </li>

                        <li class="list-group-item">

                            ✅ Support 24 jam

                        </li>

                        <li class="list-group-item">

                            ✅ Harga terbaik

                        </li>

                    </ul>

                </div>

            </div>

            <!-- FORM -->

            <form
                action="add-cart.php?id=<?= $product['id']; ?>"
                method="POST">

                <div class="mb-4">

                    <label class="fw-semibold mb-2">

                        Jumlah

                    </label>

                    <input
                        type="number"
                        name="qty"
                        value="1"
                        min="1"
                        class="form-control rounded-3"
                        style="width:120px;">

                </div>

                <!-- BUTTON -->

                <div class="d-grid gap-2">

                    <button
                        type="submit"
                        class="btn btn-primary btn-lg rounded-3">

                        <i class="fas fa-shopping-cart"></i>

                        Tambah ke Keranjang

                    </button>

                    <a href="products.php"
                        class="btn btn-outline-secondary btn-lg rounded-3">

                        <i class="fas fa-arrow-left"></i>

                        Kembali ke Produk

                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

<?php include '../includes/footer.php'; ?>