<?php

require_once '../../config/database.php';

$id = $_GET['id'];

mysqli_query($conn,
    "DELETE FROM users WHERE id='$id'"
);

$_SESSION['success'] = "User berhasil dihapus";

header("Location: index.php");
exit;