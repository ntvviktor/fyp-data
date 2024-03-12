<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FYP</title>
    <link rel="stylesheet" href="css/product.css" />
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

    <div class="container">
        <div class="product-container">
            <img class="product-image" src="product-image.jpg" alt="Product Image" />
            <h1 class="product-title">Product Title</h1>
            <p class="product-price">$99.99</p>
            <p class="product-description">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vestibulum magna sed enim tempus, vel consectetur sapien lacinia.
            </p>
            <button class="product-btn">Add to Cart</button>
        </div>
    </div>

    <!-- Related Products Section -->
    
    <section class="scroll-container">
        <div class="container">
            <h2>Related Products</h2>
            <div class="related-products">
                <!-- Add related products here -->
                <?php
                    // Loop to generate related products dynamically
                    for ($i = 1; $i <= 8; $i++) {
                        echo '<div class="product">';
                        echo '<img src="related-product-' . $i . '.jpg" alt="Related Product ' . $i . '" />';
                        echo '<h3>Related Product ' . $i . '</h3>';
                        echo '<p>$' . (40 + $i * 10) . '.99</p>'; // Generating a price based on the loop index
                        echo '</div>';
                    }
                ?>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; <?php echo date("Y"); ?> JunZ. All rights reserved.</p> <!-- Added PHP code to dynamically display the current year -->
        </div>
    </footer>
</body>
</html>
