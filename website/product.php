<?php
// Start the session
session_start();

// Include database connection file
include 'db.php';

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['username']);

// Fetch product information from the database
$sql = "SELECT * FROM product";
$result = $conn->query($sql);

// Check if any products are found
if ($result->num_rows > 0) {
    // Products are found, display them
    $products = $result->fetch_all(MYSQLI_ASSOC);
} else {
    // No products found, handle accordingly (e.g., display a message)
    $products = [];
}

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="css/product.css" />
</head>
<body>
    <header>
        <div class="container">
            <h1>JunZ</h1>
            <nav>
                <ul>
                    <?php if ($isLoggedIn) { ?>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="profile.php"><?php echo $_SESSION['username']; ?></a></li>
                        <li><a href="signout.php">Sign Out</a></li>
                        <li><a href="cart.php">Cart</a></li>
                    <?php } else { ?>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="login.php">Login</a></li>
                        <li><a href="signup.php">Sign Up</a></li>
                        <li><a href="cart.php">Cart</a></li>
                    <?php } ?>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <div class="container">
            <h2>Available Products</h2>
            <?php if (count($products) > 0): ?>
                <div class="product-list">
                    <?php foreach ($products as $product): ?>
                        <div class="product-item">
                            <img src="<?php echo $product['image_url']; ?>" alt="<?php echo $product['name']; ?>" />
                            <h3><?php echo $product['name']; ?></h3>
                            <p>Price: $<?php echo $product['price']; ?></p>
                            <p><?php echo $product['author']; ?></p>
                            <button>Add to Cart</button>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p>No products available.</p>
            <?php endif; ?>
        </div>
    </main>

    <footer>
        <div class="container">
            <p>&copy; <?php echo date("Y"); ?> Shopping Cart. All rights reserved.</p>
        </div>
    </footer>

    <script src="js/script.js"></script>
</body>
</html>
