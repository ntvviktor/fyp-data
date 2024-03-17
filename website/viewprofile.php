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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profile</title>
    <link rel="stylesheet" href="css/profile.css" />
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