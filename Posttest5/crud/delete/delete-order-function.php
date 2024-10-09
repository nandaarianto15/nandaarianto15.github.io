<?php
require "../../koneksi.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

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
