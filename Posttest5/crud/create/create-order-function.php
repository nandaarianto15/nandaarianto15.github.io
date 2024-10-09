<?php
require "../../koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $phone = htmlspecialchars($_POST['phone']);
    $address = htmlspecialchars($_POST['address']);

    $service_raw = htmlspecialchars($_POST['service']);
    $service = '';
    if ($service_raw == 'basic-package') {
        $service = 'Basic Package';
    } elseif ($service_raw == 'standard-package') {
        $service = 'Standard Package';
    } elseif ($service_raw == 'premium-package') {
        $service = 'Premium Package';
    }

    $weight = htmlspecialchars($_POST['weight']);
    $order_date = htmlspecialchars($_POST['pickup']);
    $note = htmlspecialchars($_POST['note']);
    $status = 'Requested';

    $sql = "INSERT INTO orders (fullname, phone_number, address, service, weight, order_date, note, status) 
            VALUES ('$name', '$phone', '$address', '$service', '$weight', '$order_date', '$note', '$status')";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../../order.php?status=success");
    } else {
        header("Location: ../../order.php?status=error");
    }
    exit;
}
?>
