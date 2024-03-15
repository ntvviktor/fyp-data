<?php
include 'db.php';
include 'class/user.php';

// Start session
session_start();

// Handle form submission logic
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the register button is clicked
    if (isset($_POST['register'])) {
        // Create a new instance of the User class with the database connection
        $user = new User($conn);

        // Process form data and register user
        $registerResult = $user->register($_POST['fullname'], $_POST['username'], $_POST['email'], $_POST['password'], $_POST['confirm_password']);

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

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; <?php echo date("Y"); ?> JunZ. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
