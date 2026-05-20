<?php
session_start();

if(!isset($_POST['id']) || !isset($_POST['qty'])){
    $_SESSION['error'] = "Data tidak valid!";
    header("Location: cart.php");
    exit;
}

$id = intval($_POST['id']);
$qty = intval($_POST['qty']);

if($qty < 1){
    $_SESSION['error'] = "Jumlah harus lebih dari 0!";
    header("Location: cart.php");
    exit;
}

if(isset($_SESSION['cart'])){
    foreach($_SESSION['cart'] as &$item){
        if($item['id'] == $id){
            $item['qty'] = $qty;
            break;
        }
    }
}

$_SESSION['success'] = "Keranjang berhasil diperbarui";
header("Location: cart.php");
exit;