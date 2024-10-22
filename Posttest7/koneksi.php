<?php

    $server = "localhost";
    $user = "root";
    $passowrd = "";
    $db_name = "db_laundry";
    
    $conn = mysqli_connect($server, $user, $passowrd,$db_name);

    if (!$conn) {
        die("Gagal terhubung ke database: ". mysqli_connect_error());
    }

?>