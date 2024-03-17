<?php
session_start(); // Start session

// Include the db.php file to reuse the database connection
include_once 'db.php';

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['username']); // Check if the session variable is set

include 'class/user.php';

// Handle form submission logic
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the register button is clicked
    if (isset($_POST['register'])) {
        // Create a new instance of the User class with the database connection
        $user = new User($conn);

        // Process form data and register user
        $registerResult = $user->register($_POST['fullname'], $_POST['username'], $_POST['email'], $_POST['password'], $_POST['confirm_password'], $_POST['user_type']);

        // Display success or error message based on registration result
        if ($registerResult === true) {
            // Store username in session
            $_SESSION['username'] = $_POST['username'];
            $registrationSuccess = "Registration successful!";
        } else {
            $registrationError = "Registration failed: " . $registerResult;
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FYP</title>
    <link rel="stylesheet" href="css/signup.css">
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

    <!-- Sign Up Form -->
    <section class="signup-section">
        <div class="container">
            <form id="signupForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <label for="fullname">Full Name:</label>
                    <input type="text" id="fullname" name="fullname" required>
                </div>
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm Password:</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                </div>
                <div class="form-group">
                    <label for="user_type">User Type:</label>
                    <select id="user_type" name="user_type" required>
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <button type="submit" name="register">Sign Up</button>
            </form>
            <br>
            <?php if (isset($registrationSuccess)) { ?>
                <p><?php echo $registrationSuccess; ?></p>
            <?php } ?>
            <?php if (isset($registrationError)) { ?>
                <p><?php echo $registrationError; ?></p>
            <?php } ?>
            <p>Already have an account? <a href="login.php">Login</a></p>
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