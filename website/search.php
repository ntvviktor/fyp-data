<?php
include 'db.php';

if(isset($_POST['query'])) {
    $search_box = $_POST['query'];
    $search_box = filter_var($search_box, FILTER_SANITIZE_STRING);
    $select_products = mysqli_query($conn, "SELECT name FROM `product` WHERE name LIKE '%$search_box%' LIMIT 5");
    if(mysqli_num_rows($select_products) > 0) {
        while($fetch_product = mysqli_fetch_assoc($select_products)) {
            echo '<li>' . htmlspecialchars($fetch_product['name']) . '</li>';
        }
    } else {
        echo '<li>No matches found</li>';
    }
}
?>
