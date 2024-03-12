<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Checkout</title>
    <link rel="stylesheet" href="css/checkout.css" />
</head>
<body>
    <header>
        <div class="container">
            <h1>JunZ</h1>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li> <!-- Changed from index.html to index.php -->
                    <li><a href="login.php">Login</a></li> <!-- Changed from login.html to login.php -->
                    <li><a href="signup.php">Sign Up</a></li> <!-- Changed from signup.html to signup.php -->
                    <li><a href="cart.php">Cart</a></li> <!-- Changed from cart.html to cart.php -->
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <div class="container">
            <div class="checkout-content">
                <!-- Product Summary -->
                <div class="product-summary">
                    <h2>Order Summary</h2>
                    <!-- Cart items -->
                    <div class="cart-item">
                        <!-- Product image -->
                        <img src="path_to_product_image.jpg" alt="Product Image" />
                        <div class="item-details">
                            <!-- Product details -->
                            <h4>Product Name</h4>
                            <p>Price: $10.00</p>
                            <p>Quantity: 1</p>
                            <button class="remove-item-btn">Remove</button>
                        </div>
                    </div>
                    <!-- Additional cart items -->
                    <div class="cart-item">
                        <!-- Product image -->
                        <img src="path_to_product_image.jpg" alt="Product Image" />
                        <div class="item-details">
                            <!-- Product details -->
                            <h4>Product Name</h4>
                            <p>Price: $10.00</p>
                            <p>Quantity: 1</p>
                            <button class="remove-item-btn">Remove</button>
                        </div>
                    </div>
                    <div class="cart-item">
                        <!-- Product image -->
                        <img src="path_to_product_image.jpg" alt="Product Image" />
                        <div class="item-details">
                            <!-- Product details -->
                            <h4>Product Name</h4>
                            <p>Price: $10.00</p>
                            <p>Quantity: 1</p>
                            <button class="remove-item-btn">Remove</button>
                        </div>
                    </div>
                    <!-- Total -->
                    <div class="total">
                        <h3>Total: $<span id="total-price">40.00</span></h3>
                        <button id="checkout-btn">Place Order</button>
                    </div>
                </div>
                <!-- Delivery Address -->
                <div class="delivery-address">
                    <h2>Delivery Address</h2>
                    <p>
                        Full Name: <span id="fullname">Jun Ren</span><br>
                        Address: <span id="address">123 Singapore</span><br>
                        City: <span id="city">Jurong</span><br>
                        Zip Code: <span id="zipcode">510123</span>
                    </p>
                </div>
            </div>
        </div>
    </main>
    
    <footer>
        <div class="container">
            <p>&copy; <?php echo date("Y"); ?> E-commerce. All rights reserved.</p> <!-- Added PHP code to dynamically display the current year -->
        </div>
    </footer>

    <script src="js/checkout.js"></script>
</body>
</html>
