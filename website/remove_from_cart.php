<?php
// Start the session
session_start();

// Check if productId is set in the POST request
if (isset($_POST['productId'])) {
    $productIdToRemove = $_POST['productId'];

    // Check if the product exists in the cart
    if (isset($_SESSION['cart']) && in_array($productIdToRemove, $_SESSION['cart'])) {
        // Find the index of the product in the cart array
        $index = array_search($productIdToRemove, $_SESSION['cart']);

        // Remove the product from the cart array
        unset($_SESSION['cart'][$index]);

        // Optional: You may want to update other cart-related data, such as total price, here
    }
}

// Redirect back to the checkout page
header("Location: checkout.php");
exit();
?>
