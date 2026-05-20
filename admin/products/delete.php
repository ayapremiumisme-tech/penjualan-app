<?php

require_once '../../config/database.php';

$id = $_GET['id'];

mysqli_query($conn,
    "DELETE FROM products WHERE id='$id'"
);

header("Location: index.php");