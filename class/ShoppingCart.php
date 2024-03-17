<?php
class Cart {
    private $conn; // Database connection

    // Constructor to initialize the database connection
    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Method to fetch product details from the database based on product ID
    public function fetchProductDetails($productId) {
        // Prepare the SQL query to fetch product details
        $sql = "SELECT * FROM product WHERE id = ?";
        
        // Prepare the statement
        $stmt = $this->conn->prepare($sql);
        
        // Bind parameters
        $stmt->bind_param("i", $productId);
        
        // Execute the statement
        $stmt->execute();
        
        // Get the result
        $result = $stmt->get_result();
        
        // Check if a row is fetched
        if ($result->num_rows > 0) {
            // Fetch product details as an associative array
            $productDetails = $result->fetch_assoc();
            return $productDetails;
        } else {
            // If no product found, return false
            return false;
        }
    }

    public function addToCart($product_id) {
        // Check if user is logged in
        if (isset($_SESSION['username'])) {
            // Retrieve product details from the database based on product ID
            $sql_product = "SELECT * FROM product WHERE id = $product_id";
            $result_product = mysqli_query($this->conn, $sql_product);
            $product = mysqli_fetch_assoc($result_product);
            
            // Insert product into shopping cart table
            $username = $_SESSION['username'];
            $product_name = $product['name'];
            $product_price = $product['price'];
            
            $sql_insert_cart = "INSERT INTO shopping_cart (username, product_name, product_price) VALUES ('$username', '$product_name', $product_price)";
            if (mysqli_query($this->conn, $sql_insert_cart)) {
                // Cart updated successfully
                return "Product added to cart successfully.";
            } else {
                // Error in inserting into cart
                return "Error: " . $sql_insert_cart . "<br>" . mysqli_error($this->conn);
            }
        } else {
            // User not logged in
            return "Please login to add products to cart.";
        }
    }

    // Method to remove an item from the cart
    public function removeItem($productId)
    {
        // Construct the DELETE query
        $sql = "DELETE FROM cart WHERE product_id = $productId";

        // Execute the DELETE query
        if (mysqli_query($this->conn, $sql)) {
            return true; // Item removed successfully
        } else {
            // Handle any errors if the deletion fails
            return false;
        }
    }
}
?>
