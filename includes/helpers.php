<?php

function slugify($text)
{
    $text = strtolower($text);
    $text = preg_replace('/[^A-Za-z0-9-]+/', '-', $text);

    return trim($text, '-');
}

function activeMenu($page, $current)
{
    return $page == $current ? 'active' : '';
}

function uploadPath($file)
{
    return '../uploads/' . $file;
}