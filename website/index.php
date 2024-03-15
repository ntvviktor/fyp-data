<?php
session_start(); // Start session

// Include the db.php file to reuse the database connection
include_once 'db.php';

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['username']);

// Define arrays for most viewed products and products on sale
$most_viewed_products = array();
$on_sale_products = array();

// Define the range of product IDs for most viewed products and products on sale
$most_viewed_product_range = range(1, 20);
$on_sale_product_range = range(21, 30);

// Retrieve most viewed products from the database based on their IDs
foreach ($most_viewed_product_range as $id) {
    $sql_most_viewed = "SELECT * FROM product WHERE id = $id";
    $result_most_viewed = mysqli_query($conn, $sql_most_viewed);
    $most_viewed_products[] = mysqli_fetch_assoc($result_most_viewed);
}

// Retrieve products on sale from the database based on their IDs
foreach ($on_sale_product_range as $id) {
    $sql_on_sale = "SELECT * FROM product WHERE id = $id";
    $result_on_sale = mysqli_query($conn, $sql_on_sale);
    $on_sale_products[] = mysqli_fetch_assoc($result_on_sale);
}
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
        <h1>Otaku Oasis</h1>
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

<!-- Main Content -->
<main>
    <div class="container">
        <!-- Search bar -->
        <!-- Product Grid -->
        
        <!-- Most Viewed Products -->
        <h2>Most Viewed Products</h2>
        <section class="scroll-container">
            <div class="most-viewed">
                <!-- Display most viewed products -->
                <?php foreach ($most_viewed_products as $product) { ?>
                    <div class="product">
                        <?php
                        // Dynamically generate image path based on product name
                        $product_image_path = 'path/to/images/' . strtolower(str_replace(' ', '_', $product['name'])) . '.jpg';
                        ?>
                        <img src="<?php echo $product_image_path; ?>" alt="<?php echo $product['name']; ?>">
                        <h2><?php echo substr($product['name'], 0, 20); // Limit to first 20 characters ?></h2>
                        <p><?php echo $product['price']; ?></p>
                        <a href="product.php"><button>View Product</button></a>
                        <button>Add to Cart</button>
                    </div>
                <?php } ?>
            </div>
        </section>

        <!-- On Sale Now -->
        <h2>On Sale Now</h2>
        <section class="scroll-container">
            <div class="on-sale">
                <!-- Display products on sale -->
                <?php foreach ($on_sale_products as $product) { ?>
                    <div class="product">
                        <?php
                        // Dynamically generate image path based on product name
                        $product_image_path = 'path/to/images/' . strtolower(str_replace(' ', '_', $product['name'])) . '.jpg';
                        ?>
                        <img src="<?php echo $product_image_path; ?>" alt="<?php echo $product['name']; ?>">
                        <h2><?php echo substr($product['name'], 0, 20); // Limit to first 20 characters ?></h2>
                        <p><?php echo $product['price']; ?></p>
                        <a href="product.php"><button>View Product</button></a>
                        <button>Add to Cart</button>
                    </div>
                <?php } ?>
            </div>
        </section>

        
        <!-- Recent Purchase Highlights -->
        <h2>Recent Purchase</h2>
        <section class="scroll-container">
            <!-- Display recent purchase highlights -->
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
