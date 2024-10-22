<?php
session_start(); // Pastikan session dimulai untuk akses yang aman
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

    // Cek jika ada file foto baru diunggah
    $file_uploaded = isset($_FILES['photo']) && $_FILES['photo']['error'] == 0;
    $new_filename = "";

    if ($file_uploaded) {
        // Direktori target
        $target_dir = "../../assets/img_laundry/";
        $tmp_name = $_FILES['photo']['tmp_name'];
        $ekstensi = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));

        // Nama file baru dengan format timestamp
        $timestamp = date('Y-m-d H.i.s');
        $new_filename = $timestamp . "." . $ekstensi;
        $target_file = $target_dir . $new_filename;

        // Validasi file
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($ekstensi, $allowed_extensions)) {
            header("Location: ../read/read-order.php?status=invalid_file");
            exit;
        }

        // Pindahkan file ke folder target
        if (move_uploaded_file($tmp_name, $target_file)) {
            // Ambil nama file lama untuk dihapus
            $query = "SELECT foto FROM orders WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $old_filename = $row['foto'];

            // Hapus foto lama jika ada
            if ($old_filename && file_exists($target_dir . $old_filename)) {
                unlink($target_dir . $old_filename);
            }
        } else {
            header("Location: ../read/read-order.php?status=upload_error");
            exit;
        }
    }

    // Update data dengan atau tanpa foto baru
    if ($file_uploaded) {
        $sql = "UPDATE orders SET 
                fullname = ?, phone_number = ?, address = ?, 
                service = ?, weight = ?, order_date = ?, 
                note = ?, status = ?, foto = ? 
                WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssssi", 
            $fullname, $phone_number, $address, 
            $service, $weight, $order_date, 
            $note, $status, $new_filename, $id);
    } else {
        $sql = "UPDATE orders SET 
                fullname = ?, phone_number = ?, address = ?, 
                service = ?, weight = ?, order_date = ?, 
                note = ?, status = ? 
                WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssi", 
            $fullname, $phone_number, $address, 
            $service, $weight, $order_date, 
            $note, $status, $id);
    }

    if ($stmt->execute()) {
        header("Location: ../read/read-order.php?status=success");
    } else {
        header("Location: ../read/read-order.php?status=error");
    }
    exit;
}
?>
