<?php
session_start(); // Start session

// Include the db.php file to reuse the database connection
include_once 'db.php';

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['username']); // Check if the session variable is set

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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet" />
    <title>Otaku Oasis</title>
    <link rel="stylesheet" href="css/index.css" />
    <style>
        img {
            border: none;
        }

        .message {
            position: sticky;
            top: 0;
            margin: 0 auto;
            width: 61%;
            background-color: #fff;
            padding: 6px 9px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            z-index: 100;
            gap: 0px;
            border: 2px solid rgb(68, 203, 236);
            border-top-right-radius: 8px;
            border-bottom-left-radius: 8px;
        }

        .message span {
            font-size: 22px;
            color: rgb(240, 18, 18);
            font-weight: 400;
        }

        .message i {
            cursor: pointer;
            color: rgb(3, 227, 235);
            font-size: 15px;
        }
    </style>
</head>

<body>

    <?php include 'index_header.php' ?>
    <?php
    if (isset($message)) {
        foreach ($message as $message) {
            echo '
        <div class="message" id= "messages"><span>' . $message . '</span>
        </div>
        ';
        }
    }
    ?>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100 " src="https://source.unsplash.com/2200x800/?books" alt="First slide">
            </div>

            <div class="carousel-item">
                <img class="d-block w-100" src="https://source.unsplash.com/2200x800/?novel books" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="https://source.unsplash.com/2200x800/?pyshological books" alt="Third slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <!-- Main Content -->
    <main>
        <div class="container">
            <!-- Search bar -->
            <!-- Product Grid -->

            <!-- Most Viewed Products -->
            <h2>Most Viewed Products</h2>
            <section class="scroll-container">
                <div class="most-viewed">
                    <!-- Display random books -->
                    <?php
                    // Define the path to the directory containing book images
                    $directory = 'book_images';

                    // Get a list of all files in the directory
                    $files = glob("$directory/*.jpg"); // Adjust the file extension as needed

                    // Shuffle the array to get a random order
                    shuffle($files);

                    // Limit the number of products to display
                    $limit = 10; // Adjust the limit as Fneeded

                    // Slice the array to get a subset of random products
                    $random_files = array_slice($files, 0, $limit);

                    // Create an associative array to store product names and their corresponding prices
                    $products_with_prices = array();

                    // Fetch product names and prices from the database
                    $servername = "localhost"; // Change this to your database server hostname
                    $username = "root"; // Change this to your database username
                    $password = ""; // Change this to your database password
                    $database = "fyp"; // Change this to your database name

                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $database);

                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Fetch product names and prices from the database
                    $products_query = "SELECT name, price FROM product";
                    $products_result = $conn->query($products_query);

                    // Check if there are any results
                    if ($products_result->num_rows > 0) {
                        // Populate the associative array with product names and prices
                        while ($row = $products_result->fetch_assoc()) {
                            $products_with_prices[$row['name']] = $row['price'];
                        }
                    }

                    // Close the database connection
                    $conn->close();

                    // Loop through the random files and display them
                    foreach ($random_files as $file) {
                        $filename = basename($file, '.jpg'); // Get the filename without extension
                        $product_name = str_replace('_', ' ', ucfirst($filename)); // Convert filename to product name
                        $product_image_path = $file; // Image path is the file path
                    
                        // Check if the product name exists in the associative array
                        if (array_key_exists($product_name, $products_with_prices)) {
                            $product_price = $products_with_prices[$product_name];
                        } else {
                            $product_price = "Price not available"; // Set a default price if not found
                        }
                    ?>
                        <div class="product">
                            <img src="<?php echo $product_image_path; ?>" alt="<?php echo $product_name; ?>" style="width: 200px; height: 200px;">
                            <h2><?php echo substr($product_name, 0, 20); // Limit to first 20 characters ?></h2>
                            <p>Price: <?php echo $product_price; ?></p>
                            <a href="product.php?id=<?php echo $id; ?>"><button>View Product</button></a> <!-- Pass product ID to product.php -->
                            <button>Add to Cart</button>
                        </div>
                    <?php
                    }
                    ?>

                </div>
            </section>
            >


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
                            <h2><?php echo substr($product['name'], 0, 20); // Limit to first 20 characters 
                                ?></h2>
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
                                <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" />
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
    <script>
        setTimeout(() => {
            const box = document.getElementById('messages');

            // 👇️ hides element (still takes up space on page)
            box.style.display = 'none';
        }, 8000);
    </script>
    <!-- Footer -->
    <?php include 'index_footer.php'; ?>

    <script>
        setTimeout(() => {
            const box = document.getElementById('messages');

            // 👇️ hides element (still takes up space on page)
            box.style.display = 'none';
        }, 8000);
    </script>
</body>

</html>