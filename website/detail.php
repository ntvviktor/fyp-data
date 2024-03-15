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

$userDetails = $user->getUserDetails($username);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $occupation = $_POST['occupation'];
    $genre = $_POST['genre']; // Assuming you have a field named 'genre'

    // Update user details in the database
    $updateResult = $user->updateUserDetails($username, $age, $gender, $occupation, $genre);

    if ($updateResult) {
        $notification = "User details updated successfully!";
        // Refresh user details after updating
        $userDetails = $user->getUserDetails($username);
    } else {
        $notification = "Failed to update user details.";
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
    <title>Edit Details</title>
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
                    <li><a href="viewprofile.php"><?php echo $_SESSION['username']; ?></a></li>
                    <li><a href="signout.php">Sign Out</a></li>
                <?php } ?>
                <li><a href="cart.php">Cart</a></li>
            </ul>
        </nav>
    </div>
</header>

<h1>Edit User Details</h1>

<?php if (!empty($notification)) { ?>
    <div class="notification"><?php echo $notification; ?></div>
<?php } ?>

<!-- Edit Details Form -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="age">Age:</label>
    <!-- Check if $userDetails is not null before accessing its elements -->
    <input type="number" id="age" name="age" value="<?php echo isset($userDetails['age']) ? $userDetails['age'] : ''; ?>" required><br>

    <label for="gender">Gender:</label>
    <!-- Check if $userDetails is not null before accessing its elements -->
    <select id="gender" name="gender" required>
        <option value="male" <?php if (isset($userDetails['gender']) && $userDetails['gender'] == 'male') echo 'selected'; ?>>Male</option>
        <option value="female" <?php if (isset($userDetails['gender']) && $userDetails['gender'] == 'female') echo 'selected'; ?>>Female</option>
    </select><br>

    <label for="occupation">Occupation:</label>
    <!-- Check if $userDetails is not null before accessing its elements -->
    <input type="text" id="occupation" name="occupation" value="<?php echo isset($userDetails['occupation']) ? $userDetails['occupation'] : ''; ?>" required><br>

    <label for="genre">Genre:</label>
    <!-- Check if $userDetails is not null before accessing its elements -->
    <input type="text" id="genre" name="genre" value="<?php echo isset($userDetails['genre']) ? $userDetails['genre'] : ''; ?>"><br>

    <input type="submit" value="Update">
</form>


<!-- Footer -->
<footer>
    <!-- Footer content -->
</footer>
</body>
</html>
