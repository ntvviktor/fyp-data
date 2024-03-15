<?php
// Start session
session_start();

// Check if user is logged in
$isLoggedIn = isset($_SESSION['username']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    color: #333;
    line-height: 1.6;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 960px;
    margin: 0 auto;
    padding: 20px;
}

header {
    background-color: #333;
    color: #fff;
    padding: 10px 0;
    text-align: center;
}

nav ul {
    list-style: none;
    padding: 0;
}

nav ul li {
    display: inline;
    margin-right: 10px;
}

nav a {
    color: #fff;
    text-decoration: none;
}

nav a:hover {
    text-decoration: underline;
}

h1 {
    text-align: center;
}

form {
    max-width: 600px;
    margin: 0 auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

form label {
    display: block;
    margin-bottom: 5px;
}

form input[type="number"],
form select,
form input[type="text"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

form input[type="submit"] {
    width: auto;
    padding: 10px 20px;
    background-color: #333;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

form input[type="submit"]:hover {
    background-color: #555;
}

    </style>
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
    <h1>User Details</h1>
    <form action="submit_details.php" method="post">
    <label for="age">Age:</label>
    <input type="number" id="age" name="age" required><br><br>

    <label for="gender">Gender:</label>
    <select id="gender" name="gender" required>
        <option value="" selected disabled>Select Gender</option>
        <option value="male">Male</option>
        <option value="female">Female</option>
    </select><br><br>

    <label for="occupation">Occupation:</label>
    <input type="text" id="occupation" name="occupation" required><br><br>

    <label for="genre">Genre:</label>
    <input type="text" id="genre" name="genre"><br><br>

    <input type="submit" value="Submit">

    <!-- Back Button -->
    <button onclick="goBack()">Back</button>
</form>

<script>
    // JavaScript function to navigate back to the previous page
    function goBack() {
        window.history.back();
    }
</script>


</body>
</html>
