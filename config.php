<?php
    // connect to database
    $conn = mysqli_connect('localhost','root', '','user_db');

    if (mysqli_connect_errno())
    {
        die("Connection error: " . mysqli_connect_error());
    }

/**
    if(!$conn)
    {
        echo 'Connection error: ' . mysqli_connect_error();
    }
 */
?>