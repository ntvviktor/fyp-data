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

    // Hash the new password
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    // Update user profile
    $updateResult = $user->updateUserProfile($username, $newUsername, $hashedPassword, $newFullName);

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

<h1>User Profile</h1>

<?php if (!empty($notification)) { ?>
    <div class="notification"><?php echo $notification; ?></div>
<?php } ?>

<h2>Welcome, <?php echo $userData['username']; ?>!</h2>

<!-- Display user information -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo $userData['email']; ?>" required><br><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br><br>

    <label for="full_name">Full Name:</label>
    <input type="text" id="full_name" name="full_name" value="<?php echo $userData['full_name']; ?>" required><br><br>
    <input type="submit" value="Update">
</form>

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
