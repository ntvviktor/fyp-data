<?php
session_start(); // Start session

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['username']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>FYP</title>
    <link rel="stylesheet" href="css/index.css"/>
    <style>
        /* Category List Styles */
#category-list {
  list-style-type: none;
  padding: 0;
  display: flex;
}

#category-list li {
  margin-right: 10px;
}

#category-list li button {
  background: none;
  border: none;
  padding: 0;
  font: inherit;
  cursor: pointer;
  color: blue; /* Change the color as needed */
  text-decoration: underline;
}

#category-list li button:hover {
  text-decoration: none;
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
                    <li><a href="profile.php"><?php echo $_SESSION['username']; ?></a></li>
                    <li><a href="signout.php">Sign Out</a></li>
                <?php } ?>
                <li><a href="cart.php">Cart</a></li>
            </ul>
        </nav>
    </div>
</header>

<!-- Main Content -->
<main>
    <div class="container">
        <div class="search-bar">
        <form action="search.php" method="GET">
            <input type="text" name="search" placeholder="Search..."/>
            <ul id="category-list">
                <li><button type="submit" name="category" value="option1">All Categories</button></li>
                <li><button type="submit" name="category" value="option2">Option 2</button></li>
                <li><button type="submit" name="category" value="option3">Option 3</button></li>
                <li><button type="submit" name="category" value="option4">Option 4</button></li>
            </ul>
        </form>
    </div>

        </div>
        <br/>
        <!-- Product Grid -->
        <!-- Most Viewed Products -->
        <h2>Most Viewed Products</h2>
        <section class="scroll-container">
            <div class="most-viewed">
                <!-- Product items here -->
                <?php for ($i = 1; $i <= 20; $i++) { ?>
                    <div class="product">
                        <img src="product<?php echo $i; ?>.jpg" alt="Product <?php echo $i; ?>"/>
                        <h2>Product <?php echo $i; ?></h2>
                        <p>$19.99</p>
                        <a href="product.php"><button>View Product</button></a>
                        <button>Add to Cart</button>
                    </div>
                <?php } ?>
                <!-- Add more products here -->
            </div>
        </section>

        <!-- On Sale Now -->
        <h2>On Sale Now</h2>
        <section class="scroll-container">
            <div class="on-sale">
                <!-- Product items here -->
                <?php for ($i = 21; $i <= 30; $i++) { ?>
                    <div class="product">
                        <img src="product<?php echo $i; ?>.jpg" alt="Product <?php echo $i; ?>"/>
                        <h2>Product <?php echo $i; ?></h2>
                        <p>$19.99</p>
                        <a href="product.php"><button>View Product</button></a>
                        <button>Add to Cart</button>
                    </div>
                <?php } ?>
                <!-- Add more products here -->
            </div>
        </section>

        <!-- Last Purchase Highlights -->
        <h2>Recent Purchase</h2>
        <section class="scroll-container">
            <div class="last-purchase">
                <?php
                // Assuming $recent_purchase is an array of purchased products
                $recent_purchase = array(); // Sample empty array

                if (empty($recent_purchase)) {
                    echo "<p>Seems like you have not purchased any of our products yet.</p>";
                } else {
                    // Product items here
                    foreach ($recent_purchase as $product) {
                        ?>
                        <div class="product">
                            <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>"/>
                            <h2><?php echo $product['name']; ?></h2>
                            <p><?php echo $product['price']; ?></p>
                            <a href="product.php"><button>View Product</button></a>
                            <button>Add to Cart</button>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </section>
    </div>
</main>

<!-- Footer -->
<footer>
    <div class="container">
        <p>&copy; 2024 JunZ. All rights reserved.</p>
    </div>
</footer>
</body>
</html>
