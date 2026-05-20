<?php

function base_url($path = '')
{
    return APP_URL . '/' . $path;
}

function redirect($url)
{
    header("Location: $url");
    exit;
}

function dd($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
    die();
}

function formatRupiah($angka)
{
    return "Rp " . number_format($angka, 0, ',', '.');
}