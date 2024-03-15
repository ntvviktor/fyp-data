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
                    <li><a href="viewprofile.php"><?php echo $_SESSION['username']; ?></a></li>
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
<div>
    <p><strong>Username:</strong> <?php echo $userData['username']; ?></p>
    <p><strong>Email:</strong> <?php echo $userData['email']; ?></p>
    <p><strong>Full Name:</strong> <?php echo $userData['full_name']; ?></p>
    <!-- Check if 'age' key exists before accessing it -->
    <p><strong>Age:</strong> <?php echo isset($userDetails['age']) ? $userDetails['age'] : 'Empty'; ?></p>
    <!-- Check if 'gender' key exists before accessing it -->
    <p><strong>Gender:</strong> <?php echo isset($userDetails['gender']) ? $userDetails['gender'] : 'Empty'; ?></p>
    <!-- Check if 'occupation' key exists before accessing it -->
    <p><strong>Occupation:</strong> <?php echo isset($userDetails['occupation']) ? $userDetails['occupation'] : 'Empty'; ?></p>
    <!-- Check if 'genre' key exists before accessing it -->
    <p><strong>Genre:</strong> <?php echo isset($userDetails['genre']) ? $userDetails['genre'] : 'Empty'; ?></p>
    <a href="profile.php">Edit Account</a> 
    <a href="detail.php">Edit Details</a>
</div>

<!-- Footer -->
<footer>
    <div class="container">
        <p>&copy; 2024 JunZ. All rights reserved.</p>
    </div>
</footer>
</body>
</html>
