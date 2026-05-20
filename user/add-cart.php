<?php
session_start();

require_once '../config/config.php';
require_once '../config/database.php';

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

// BUAT SESSION CART
if(!isset($_SESSION['cart']))
{
    $_SESSION['cart'] = [];
}

// CEK PRODUK SUDAH ADA
$found = false;

foreach($_SESSION['cart'] as &$item)
{
    if($item['id'] == $product['id'])
    {
        $item['qty'] += 1;
        $found = true;
        break;
    }
}

// TAMBAH PRODUK BARU
if(!$found)
{
    $_SESSION['cart'][] = [

        'id'    => $product['id'],
        'name'  => $product['name'],
        'price' => $product['price'],
        'image' => $product['image'],
        'qty'   => 1

    ];
}

$_SESSION['success'] =
    "Produk berhasil ditambahkan ke keranjang";

header("Location: cart.php");
exit;