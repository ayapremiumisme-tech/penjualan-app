<?php
session_start();

if(!isset($_GET['id'])){
    $_SESSION['error'] = "Produk tidak valid!";
    header("Location: cart.php");
    exit;
}

$id = intval($_GET['id']);

if(isset($_SESSION['cart'])){
    foreach($_SESSION['cart'] as $key => $item){
        if($item['id'] == $id){
            unset($_SESSION['cart'][$key]);
            $_SESSION['cart'] = array_values($_SESSION['cart']); // reindex
            break;
        }
    }
}

$_SESSION['success'] = "Produk berhasil dihapus dari keranjang";
header("Location: cart.php");
exit;