<?php
require "../../koneksi.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT foto FROM orders WHERE id = '$id'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $photo = $row['foto'];

        if (!empty($photo)) {
            $photoPath = "../../assets/img_laundry/" . $photo;
            if (file_exists($photoPath)) {
                unlink($photoPath); 
            }
        }
    }

    $sql = "DELETE FROM orders WHERE id = '$id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../read/read-order.php?status=deleted");
    } else {
        header("Location: ../read/read-order.php?status=error");
    }
} else {
    header("Location: ../read/read-order.php?status=error");
}
exit;
?>
