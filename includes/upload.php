<?php

function uploadImage($file, $path)
{
    $filename = time() . '_' . $file['name'];

    $target = $path . $filename;

    move_uploaded_file($file['tmp_name'], $target);

    return $filename;
}