<?php
require "../koneksi.php";
if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); 
    $checkQuery = "SELECT * FROM user WHERE name = '$name'";
    $checkResult = mysqli_query($conn, $checkQuery);
    if (mysqli_num_rows($checkResult) > 0) {
        echo "
        <script>
        alert('nama sudah digunakan! Silakan gunakan usexrname lain.');
        document.location.href = 'registrasi.php';
        </script>
        ";
    } else {
        $query = "INSERT INTO user (name, password) VALUES ('$name', '$password')";
        if (mysqli_query($conn, $query)) {
        echo "
            <script>
            alert('Registrasi berhasil!');
            document.location.href = '../login.php';
            </script>
        ";
        } else {
        echo "
            <script>
            alert('Registrasi gagal!');
            document.location.href = 'index.php';
            </script>
        ";
        }
    }
}
?>