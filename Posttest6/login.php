
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets//css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script>
        function validateForm() {
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;

            if (username.trim() === '') {
                alert('Username is required.');
                return false; 
            }

            if (password.trim() === '') {
                alert('Password is required.');
                return false; 
            }

            return true; 
        }

        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const passwordToggle = document.getElementById('passwordToggle');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordToggle.classList.remove('fa-eye');
                passwordToggle.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                passwordToggle.classList.remove('fa-eye-slash');
                passwordToggle.classList.add('fa-eye');
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        
        <?php
        if (isset($_GET['error'])) {
            echo "<p style='color: red;'>{$_GET['error']}</p>";
        }
        ?>
        
        <form method="POST" action="crud/login-function.php" onsubmit="return validateForm();">
            <label for="username">Username</label>
            <input type="text" id="username" name="name" placeholder="Enter your username" value="<?php echo isset($_GET['name']) ? htmlspecialchars($_GET['name']) : ''; ?>" >
            
            <label for="password">Password</label>
            <div class="password-wrapper">
                <input type="password" id="password" name="password" placeholder="Enter your password" >
                <i id="passwordToggle" class="fas fa-eye" onclick="togglePassword()"></i>
            </div>
            
            <a href="forgot-password/forgot-password.php">Forgot password?</a>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
