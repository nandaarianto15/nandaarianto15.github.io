<?php 
session_start(); 
include "../koneksi.php";

if (isset($_POST['name']) && isset($_POST['password'])) {    
    $name = mysqli_real_escape_string($conn, $_POST['name']); 
    $pass = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM user WHERE name='$name' AND password='$pass'";        
    $result = mysqli_query($conn, $sql);        
    
    if (mysqli_num_rows($result) === 1) {            
        $row = mysqli_fetch_assoc($result);            
        if ($row['name'] === $name && $row['password'] === $pass) {                
            $_SESSION['id'] = $row['id'];                
            $_SESSION['name'] = $row['name'];                       

            if ($row['name'] === 'admin') {
                header("Location: read/read-order.php");
                exit();
            } else {
                header("Location: ../order.php");
                exit();
            }            
        } else {                
            header("Location: ../login.php?error=Incorrect name or Password");                
            exit();            
        }        
    } else {            
        header("Location: ../login.php?error=Incorrect name or Password");            
        exit();        
    }    
} else {    
    header("Location: index.php");    
    exit();
}
?>
