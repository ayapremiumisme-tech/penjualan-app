<?php

if(isset($_FILES['image']))
{
    $filename = time() . '_' . $_FILES['image']['name'];

    move_uploaded_file(
        $_FILES['image']['tmp_name'],
        '../../uploads/products/' . $filename
    );

    echo json_encode([
        'status' => true,
        'filename' => $filename
    ]);
}