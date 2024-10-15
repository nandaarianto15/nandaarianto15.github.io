<?php
session_start();
require "../../koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $phone = htmlspecialchars($_POST['phone']);
    $address = htmlspecialchars($_POST['address']);

    // user_id dari session
    $user_id = $_SESSION['id']; 

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

    // Upload Foto
    $target_dir = "../../assets/img_laundry/";
    $file = $_FILES['photo'];
    $file_name = $file['name'];
    $tmp_name = $file['tmp_name'];

    // Mendapatkan ekstensi file
    $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    // Format nama baru dengan timestamp
    $timestamp = date('Y-m-d H.i.s'); 
    $new_filename = $timestamp . "." . $file_extension;
    $target_file = $target_dir . $new_filename;

    // Validasi dan pindahkan file
    if (move_uploaded_file($tmp_name, $target_file)) {
        // Jika upload berhasil, simpan data ke database
        $sql = "INSERT INTO orders (user_id, fullname, phone_number, address, service, weight, order_date, note, status, foto) 
                VALUES ('$user_id', '$name', '$phone', '$address', '$service', '$weight', '$order_date', '$note', '$status', '$new_filename')";

        if ($conn->query($sql) === TRUE) {
            header("Location: ../../order.php?status=success");
        } else {
            // Menampilkan pesan error SQL jika gagal
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        // Jika upload gagal
        echo "Failed upload file.";
    }
    exit;
}
?>
