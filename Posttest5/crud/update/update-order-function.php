<?php
require "../../koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $fullname = htmlspecialchars($_POST['fullname']);
    $phone_number = htmlspecialchars($_POST['phone_number']);
    $address = htmlspecialchars($_POST['address']);
    $service = htmlspecialchars($_POST['service']);
    $weight = htmlspecialchars($_POST['weight']);
    $order_date = htmlspecialchars($_POST['order_date']);
    $note = htmlspecialchars($_POST['note']);
    $status = htmlspecialchars($_POST['status']);

    $sql = "UPDATE orders SET 
            fullname = '$fullname',
            phone_number = '$phone_number',
            address = '$address',
            service = '$service',
            weight = '$weight',
            order_date = '$order_date',
            note = '$note',
            status = '$status' 
            WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../read/read-order.php?status=success");
    } else {
        header("Location: ../read/read-order.php?status=error");
    }
    exit;
}
?>
