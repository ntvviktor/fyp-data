<?php
include 'db.php';

class User {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function login($username, $password) {
        $sql = "SELECT id, username, password, user_type FROM user WHERE username = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                // Start session and set user data
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['user_type'] = $user['user_type'];
    
                // Redirect based on user type
                if ($user['user_type'] == 'admin') {
                    header("Location: admin.php");
                } else {
                    header("Location: index.php");
                }
                exit;
            }
        }
        return false;
    }
    

    public function register($fullname, $username, $email, $password, $confirm_password, $user_type) {
        // Validate form data
        if (empty($fullname) || empty($username) || empty($email) || empty($password) || empty($confirm_password) || empty($user_type)) {
            echo "All fields are required.";
            return false;
        }
    
        if ($password != $confirm_password) {
            echo "Passwords do not match.";
            return false;
        }
    
        // Check if the username or email already exists
        $stmt = $this->conn->prepare("SELECT * FROM user WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            echo "Username or email already exists.";
            $stmt->close();
            return false;
        }
        $stmt->close();
    
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
        // Insert user data into the database
        $sql = "INSERT INTO user (full_name, username, email, password, user_type) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssss", $fullname, $username, $email, $hashedPassword, $user_type);
        if ($stmt->execute()) {
            // Close the statement
            $stmt->close();
            // Redirect the user
            header("refresh:2;url=add_details.php");
            // Return true after redirect
            return true; // User registered successfully
        } else {
            echo "Registration failed: " . $stmt->error;
            // Close the statement
            $stmt->close();
            return false; // Failed to register user
        }
    }
    
    public function submitDetails($username) {
        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve form data
            $age = $_POST["age"];
            $gender = $_POST["gender"];
            $occupation = $_POST["occupation"];
            $interests = $_POST["interests"];

            // Insert user details into the database
            $stmt = $this->conn->prepare("INSERT INTO user_details (username, age, gender, occupation, interests) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $username, $age, $gender, $occupation, $interests);

            if ($stmt->execute()) {
                // User details inserted successfully
                echo "User details submitted successfully.";
            } else {
                // Error inserting user details
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            // If the form is not submitted via POST, redirect the user
            $this->redirectToHomePage();
        }
    }

    private function redirectToHomePage() {
        header("Location: index.php");
        exit;
    }

    public function getUserProfile($username) {
        // Prepare and execute the query to retrieve user profile
        $sql = "SELECT * FROM user WHERE username = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
    
        // Check if the query was successful
        if ($result->num_rows > 0) {
            // Fetch user data
            $userData = $result->fetch_assoc();
            // Free result set
            $result->free_result();
            // Close statement
            $stmt->close();
            // Return user data
            return $userData;
        } else {
            // If no user found, return empty array
            return array();
        }
    }
    public function updateUserProfile($oldUsername, $newUsername, $hashedPassword, $newFullName) {
        // Prepare and execute the update statement
        $stmt = $this->conn->prepare("UPDATE user SET username=?, password=?, full_name=? WHERE username=?");
        $stmt->bind_param("ssss", $newUsername, $hashedPassword, $newFullName, $oldUsername);
        $result = $stmt->execute();
        
        // Check if update was successful
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function getUserDetails($username) {
        $sql = "SELECT * FROM user_details WHERE username = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            // Fetch user details as an associative array
            return $result->fetch_assoc();
        } else {
            // Handle case where user details are not found
            return null;
        }
    }
    public function updateUserDetails($username, $age, $gender, $occupation, $genre) {
        $sql = "UPDATE user_details SET age = ?, gender = ?, occupation = ?, genre = ? WHERE username = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("issss", $age, $gender, $occupation, $genre, $username);
        
        if ($stmt->execute()) {
            // Return true if update was successful
            return true;
        } else {
            // Return false if update failed
            return false;
        }
    }
}    


?>