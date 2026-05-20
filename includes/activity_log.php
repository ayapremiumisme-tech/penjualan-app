<?php

require_once __DIR__ . '/../config/database.php';

function activityLog($user_id, $activity)
{
    global $conn;

    $activity = mysqli_real_escape_string($conn, $activity);

    $query = "INSERT INTO activity_logs(user_id, activity)
              VALUES('$user_id', '$activity')";

    mysqli_query($conn, $query);
}