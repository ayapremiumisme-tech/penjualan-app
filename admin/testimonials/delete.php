<?php

require_once '../../config/database.php';

$id = $_GET['id'];

mysqli_query($conn,
    "DELETE FROM testimonials
    WHERE id='$id'"
);

$_SESSION['success'] = "Testimoni berhasil dihapus";

header("Location: index.php");
exit;