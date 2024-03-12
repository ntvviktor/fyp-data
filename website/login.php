<?php
include 'db.php';
include 'class/user.php';

// Login logic
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = new User($conn);
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user->login($username, $password);

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FYP</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>JunZ</h1>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="signup.php">Sign Up</a></li>
                    <li><a href="cart.php">Cart</a></li>
                </ul>
            </nav>
        </div>
    </header>

   <!-- Login Form -->
   <section class="login-section">
        <div class="container">
            <form id="loginForm" action="" method="POST">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit">Login</button>
            </form>
        </div>
    </section>
        <!-- Footer -->
        <footer>
        <div class="container">
            <p>&copy; <?php echo date("Y"); ?> JunZ. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
