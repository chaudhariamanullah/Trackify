<?php

   $host = "mysql-2c38a4ee-chaudhari-c6c0.e.aivencloud.com";
    $port = 24942;
    $user = "avnadmin";
    $pass = "YOUR_PASSWORD";
    $db   = "defaultdb";

    $conn = new mysqli($host, $user, $pass, $db, $port);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

?>