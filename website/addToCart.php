<?php
session_start();

// Check if product ID is provided
if (isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];

    // Add the product to the cart (you can implement this logic as per your application's requirements)
    $_SESSION['cart'][] = $productId;

    // Redirect back to the previous page or cart page
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
} else {
    // Redirect back to the previous page if product ID is not provided
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}
?>
