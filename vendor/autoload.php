<?php

/*
|--------------------------------------------------------------------------
| SIMPLE AUTOLOADER
|--------------------------------------------------------------------------
| File ini digunakan untuk auto load class / function
| secara otomatis tanpa perlu require manual.
|--------------------------------------------------------------------------
*/

spl_autoload_register(function ($class)
{
    $directories = [

        __DIR__ . '/../config/',
        __DIR__ . '/../includes/',
        __DIR__ . '/../admin/',
        __DIR__ . '/../user/',
        __DIR__ . '/../cashier/',
        __DIR__ . '/../api/',
        __DIR__ . '/../templates/'

    ];

    foreach ($directories as $directory)
    {
        $file = $directory . $class . '.php';

        if (file_exists($file))
        {
            require_once $file;
            return;
        }
    }
});

/*
|--------------------------------------------------------------------------
| HELPER FILES
|--------------------------------------------------------------------------
*/

$helpers = [

    __DIR__ . '/../includes/functions.php',
    __DIR__ . '/../includes/helpers.php',
    __DIR__ . '/../includes/validation.php',
    __DIR__ . '/../includes/auth.php',
    __DIR__ . '/../includes/upload.php',
    __DIR__ . '/../includes/pagination.php',
    __DIR__ . '/../includes/activity_log.php'

];

foreach ($helpers as $helper)
{
    if (file_exists($helper))
    {
        require_once $helper;
    }
}