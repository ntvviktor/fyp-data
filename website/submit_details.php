<?php
// Start session
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect user to login page or handle unauthorized access
    header("Location: login.php");
    exit;
}

// Include database connection and any necessary classes or functions
include 'db.php';
// Include any other necessary classes or functions for processing user details

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user inputs from the form
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $occupation = $_POST['occupation'];
    $genre = $_POST['genre'];

    // You can perform further validation here if needed

    // Assuming you have a table named 'user_details' to store user details
    $username = $_SESSION['username'];

    // Insert user details into the database
    $sql = "INSERT INTO user_details (username, age, gender, occupation, genre) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sisss", $username, $age, $gender, $occupation, $genre);
    
    // Execute the statement
    if ($stmt->execute()) {
        // Data inserted successfully
        // You can redirect the user to a success page or perform any other actions
        header("Location: index.php");
        exit;
    } else {
        // Error occurred while inserting data
        // You can redirect the user to an error page or display an error message
        echo "Error: " . $conn->error;
    }

    // Close prepared statement
    $stmt->close();
}

// Close database connection
$conn->close();
?>
