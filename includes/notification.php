<?php

function setFlash($type, $message)
{
    $_SESSION['flash'] = [
        'type' => $type,
        'message' => $message
    ];
}

function showFlash()
{
    if(isset($_SESSION['flash']))
    {
        $flash = $_SESSION['flash'];

        echo "
        <script>
            Swal.fire({
                icon: '{$flash['type']}',
                title: '{$flash['message']}',
                timer: 2000,
                showConfirmButton: false
            });
        </script>
        ";

        unset($_SESSION['flash']);
    }
}