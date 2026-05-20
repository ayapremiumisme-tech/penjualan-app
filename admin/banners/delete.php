<?php

require_once '../../config/database.php';

$id = $_GET['id'];

mysqli_query($conn,
    "DELETE FROM banners WHERE id='$id'"
);

$_SESSION['success'] = "Banner berhasil dihapus";

header("Location: index.php");
exit;