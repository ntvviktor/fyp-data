<?php
// Start the session
session_start();

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['username']);

// Check if the cart is empty
$cartIsEmpty = true; // Assume cart is empty initially
$totalPrice = 0; // Initialize total price

// Example condition to check if cart session variable is set and not empty (you should adjust this based on your actual implementation)
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    $cartIsEmpty = false; // Cart is not empty
    
    // Calculate total price by summing up the prices of all items in the cart
    foreach ($_SESSION['cart'] as $item) {
        $totalPrice += $item['price'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="css/cart.css" />
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
            <h2>Your Shopping Cart</h2>
            <?php if ($cartIsEmpty): ?>
                <p>Your shopping cart is empty.</p>
            <?php else: ?>
                <!-- Display cart items -->
                <!-- Replace this section with the actual code to display cart items -->
                <?php foreach ($_SESSION['cart'] as $item): ?>
                    <div class="cart-item">
                        <img src="<?php echo $item['image']; ?>" alt="Product Image" />
                        <div class="item-details">
                            <h4><?php echo $item['name']; ?></h4>
                            <p>Price: $<?php echo number_format($item['price'], 2); ?></p>
                            <p>Quantity: <?php echo $item['quantity']; ?></p>
                            <button class="remove-item-btn">Remove</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
            <div class="total">
                <h3>Total: $<span id="total-price"><?php echo number_format($totalPrice, 2); ?></span></h3>
                <a href="checkout.php"><button id="checkout-btn">Checkout</button></a>
            </div>
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
