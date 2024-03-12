<?php
session_start();

// Include the User class and database connection
include 'class/user.php';

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['username']);

// Include your database connection file
include 'db.php';

// Create an instance of the User class
$user = new User($conn);

// Initialize notification variable
$notification = "";

// Retrieve user information from the database based on the session username
$username = $_SESSION['username'];

// Retrieve user profile information
$userData = $user->getUserProfile($username);

// Update user information if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize user input
    $newUsername = htmlspecialchars($_POST['username']);
    $newPassword = htmlspecialchars($_POST['password']);
    $newFullName = htmlspecialchars($_POST['full_name']);

    // Update user profile
    $updateResult = $user->updateUserProfile($username, $newUsername, $newPassword, $newFullName);

    // If update was successful, refresh user data and set notification
    if ($updateResult) {
        $userData = $user->getUserProfile($newUsername);
        $notification = "Profile updated successfully!";
    }
}

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Profile</title>
    <link rel="stylesheet" href="css/profile.css"/>
</head>
<body>
<header>
    <div class="container">
        <h1>FYP TITLE</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <?php if (!$isLoggedIn) { ?>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="signup.php">Sign Up</a></li>
                <?php } else { ?>
                    <li><a href="profile.php"><?php echo $_SESSION['username']; ?></a></li>
                    <li><a href="signout.php">Sign Out</a></li>
                <?php } ?>
                <li><a href="cart.php">Cart</a></li>
            </ul>
        </nav>
    </div>
</header>

<h1>User Profile</h1>

<?php if (!empty($notification)) { ?>
    <div class="notification"><?php echo $notification; ?></div>
<?php } ?>

<h2>Welcome, <?php echo $userData['username']; ?>!</h2>

<!-- Display user information -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" value="<?php echo $userData['username']; ?>" required><br><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo $userData['email']; ?>" readonly><br><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br><br>

    <label for="full_name">Full Name:</label>
    <input type="text" id="full_name" name="full_name" value="<?php echo $userData['full_name']; ?>" required><br><br>

    <input type="submit" value="Update">
</form>

<!-- Footer -->
<footer>
    <div class="container">
        <p>&copy; 2024 JunZ. All rights reserved.</p>
    </div>
</footer>
</body>
</html>
