<?php
require "../../koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone_number = htmlspecialchars($_POST['phone_number']);
    $message = htmlspecialchars($_POST['message']);
    $date = htmlspecialchars($_POST['date']);

    $sql = "UPDATE contact SET 
            name='$name', 
            email='$email', 
            phone_number='$phone_number', 
            message='$message', 
            date='$date' 
            WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../read/read-contact.php?status=success");
    } else {
        header("Location: ../read/read-contact.php?status=error");
    }
    exit;
}
?>
