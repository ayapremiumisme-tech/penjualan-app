<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

/*
|--------------------------------------------------------------------------
| CONFIG APP
|--------------------------------------------------------------------------
| Konfigurasi utama aplikasi
|
*/

date_default_timezone_set('Asia/Jakarta');

define('APP_NAME', 'Penjualan App');
define('APP_URL', 'http://localhost/penjualan-app');

define('APP_VERSION', '1.0');

define('UPLOAD_PATH', '../uploads/');

define('CURRENCY', 'Rp');

define('TAX_PERCENT', 11);

/*
|--------------------------------------------------------------------------
| ERROR REPORTING
|--------------------------------------------------------------------------
*/

error_reporting(E_ALL);
ini_set('display_errors', 1);

/*
|--------------------------------------------------------------------------
| SESSION START
|--------------------------------------------------------------------------
*/

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}