<?php
require "../../koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['tel']);
    $message = htmlspecialchars($_POST['message']);

    $sql = "INSERT INTO contact (name, email, phone_number, message, date) 
            VALUES ('$name', '$email', '$phone', '$message', NOW())";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../../index.php?status=success");
    } else {
        header("Location: ../../index.php?status=error");
    }
    exit;
}

?>
