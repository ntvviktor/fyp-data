<?php
session_start(); // Start session

include 'db.php';
include 'class/user.php';
$isLoggedIn = isset($_SESSION['username']); // Check if the session variable is set
// Initialize error message variable
$error = "";

// Login logic
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = new User($conn);
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Attempt to log in
    if (!$user->login($username, $password)) {
        $error = "Invalid username or password.";
    }

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
    <?php include 'index_header.php' ?>
    <?php
    if (isset($message)) {
        foreach ($message as $message) {
            echo '
        <div class="message" id= "messages"><span>' . $message . '</span>
        </div>
        ';
        }
    }
    ?>

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
                <?php if (!empty($error)) { ?>
                    <div class="error"><?php echo $error; ?></div>
                <?php } ?>
                <button type="submit">Login</button>
            </form>
        </div>
    </section>
    <script>
        setTimeout(() => {
            const box = document.getElementById('messages');

            // 👇️ hides element (still takes up space on page)
            box.style.display = 'none';
        }, 8000);
    </script>
    <!-- Footer -->
    <?php include 'index_footer.php'; ?>
</body>

</html>