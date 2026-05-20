<?php

/*
|--------------------------------------------------------------------------
| SESSION SECURITY
|--------------------------------------------------------------------------
*/

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

/*
|--------------------------------------------------------------------------
| SESSION TIMEOUT
|--------------------------------------------------------------------------
*/

$timeout_duration = 3600;

if (isset($_SESSION['LAST_ACTIVITY'])) {

    if ((time() - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {

        session_unset();
        session_destroy();

        header("Location: ../auth/login.php?expired=1");
        exit;
    }
}

/*
|--------------------------------------------------------------------------
| UPDATE LAST ACTIVITY
|--------------------------------------------------------------------------
*/

$_SESSION['LAST_ACTIVITY'] = time();

/*
|--------------------------------------------------------------------------
| REGENERATE SESSION ID
|--------------------------------------------------------------------------
*/

if (!isset($_SESSION['CREATED'])) {

    $_SESSION['CREATED'] = time();

} else if (time() - $_SESSION['CREATED'] > 1800) {

    session_regenerate_id(true);

    $_SESSION['CREATED'] = time();
}