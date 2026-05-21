<?php

session_start();

require_once '../config/database.php';

/*
|--------------------------------------------------------------------------
| VALIDASI ID
|--------------------------------------------------------------------------
*/

if(
    !isset($_GET['id']) ||
    !is_numeric($_GET['id'])
){

    $_SESSION['error'] =
        "Produk tidak valid!";

    header("Location: products.php");
    exit;
}

$id = intval($_GET['id']);

/*
|--------------------------------------------------------------------------
| GET PRODUCT
|--------------------------------------------------------------------------
*/

$query = mysqli_query(
    $conn,
    "SELECT * FROM products
    WHERE id='$id'
    LIMIT 1"
);

if(mysqli_num_rows($query) == 0){

    $_SESSION['error'] =
        "Produk tidak ditemukan!";

    header("Location: products.php");
    exit;
}

$product = mysqli_fetch_assoc($query);

/*
|--------------------------------------------------------------------------
| INIT WISHLIST
|--------------------------------------------------------------------------
*/

if(!isset($_SESSION['wishlist'])){

    $_SESSION['wishlist'] = [];

}

/*
|--------------------------------------------------------------------------
| CHECK DUPLICATE
|--------------------------------------------------------------------------
*/

$found = false;

foreach($_SESSION['wishlist'] as $item){

    if($item['id'] == $product['id']){

        $found = true;
        break;

    }

}

/*
|--------------------------------------------------------------------------
| ADD WISHLIST
|--------------------------------------------------------------------------
*/

if(!$found){

    $_SESSION['wishlist'][] = [

        'id'    => $product['id'],
        'name'  => $product['name'],
        'price' => $product['price'],
        'image' => $product['image']

    ];

    $_SESSION['success'] =
        "Produk berhasil ditambahkan ke wishlist";

}else{

    $_SESSION['success'] =
        "Produk sudah ada di wishlist";

}

/*
|--------------------------------------------------------------------------
| REDIRECT
|--------------------------------------------------------------------------
*/

header("Location: wishlist.php");
exit;