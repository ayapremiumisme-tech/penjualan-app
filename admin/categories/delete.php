<?php

require_once '../../config/database.php';

$id = $_GET['id'];

mysqli_query($conn,
    "DELETE FROM categories WHERE id='$id'"
);

$_SESSION['success'] = "Kategori berhasil dihapus";

header("Location: index.php");
exit;