<?php
include 'db.php';

class User {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function login($username, $password) {
        $sql = "SELECT * FROM user WHERE username = ?";
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
    
                // Redirect to index.php
                header("Location: index.php");
                exit;
            }
        }
        return false;
    }

    public function signup($fullname, $username, $email, $password, $confirm_password) {
        // Validate form data
        if (empty($fullname) || empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
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
        $sql = "INSERT INTO user (full_name, username, email, password) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssss", $fullname, $username, $email, $hashedPassword);
        if ($stmt->execute()) {
            echo "Registration successful!";
            return true; // User registered successfully
        } else {
            echo "Registration failed: " . $stmt->error;
            return false; // Failed to register user
        }

        $stmt->close();
    }
}

// Registration logic
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {
    include 'db.php';
    $user = new User($conn);
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    $result = $user->signup($fullname, $username, $email, $password, $confirm_password);

    if ($result === "success") {
        echo "<script>alert('Registration successful! Redirecting to login page...');</script>";
        header("refresh:2;url=login.php");
    } else {
        echo "<script>alert('" . $result . "');</script>";
    }

    $conn->close();
}
?>