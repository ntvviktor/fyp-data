<?php
include 'db.php';

session_start();

if (!isset($_SESSION['username'])) {
    header('location:login.php');
    exit(); // Make sure to exit after redirecting
}

$admin_id = $_SESSION['username'];

if (isset($_POST['add_books'])) {
    $bauthor = mysqli_real_escape_string($conn, $_POST['btitle']);
    $btitle = mysqli_real_escape_string($conn, $_POST['bauthor']);
    $genre = mysqli_real_escape_string($conn, $_POST['genre']);
    $rating = mysqli_real_escape_string($conn, $_POST['rating']); // Assuming you have a rating input
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $desc = mysqli_real_escape_string($conn, $_POST['bdesc']);
    $img = $_FILES["image"]["name"];
    $img_temp_name = $_FILES["image"]["tmp_name"];
    $img_file = "./book_images/" . $img;

    $message = array(); // Initialize an empty array to store error messages

    if (empty($bauthor)) {
        $message[] = 'Please Enter author name';
    } elseif (empty($btitle)) {
        $message[] = 'Please Enter book title';
    } elseif (empty($price)) {
        $message[] = 'Please Enter book price';
    } elseif (empty($genre)) {
        $message[] = 'Please Choose a genre';} 
    elseif (empty($rating)) {
        $message[] = 'Please Choose the rating';
    } elseif (empty($desc)) {
        $message[] = 'Please Enter book description';
    } elseif (empty($img)) {
        $message[] = 'Please Choose Image';
    } else {

        $add_book = mysqli_query($conn, "INSERT INTO product(`author`, `name`, `price`, `rating`, `genre`, `description`, `image`) 
        VALUES('$bauthor','$btitle','$price','$rating','$genre','$desc','$img')") or die('Query failed');

        if ($add_book) {

            move_uploaded_file($img_temp_name, $img_file);
            $message[] = 'New Book Added Successfully';
        } else {
            $message[] = 'Book Not Added Successfully'; // Changed to array assignment
        }
    }
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `product` WHERE bid = '$delete_id'") or die('query failed');
    header('location:add_books.php');
    exit(); // Make sure to exit after redirecting
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/add_books.css">
    <title>Add Books</title>
</head>

<body>
    <?php
    include './admin_header.php'
    ?>
    <?php
    if (isset($message)) {
        foreach ($message as $msg) {
            echo '
        <div class="message" id="messages"><span>' . $msg . '</span>
        </div>
        ';
        }
    }
    ?>
    <div class="container_box">
        <form action="" method="POST" enctype="multipart/form-data">
            <h3>Add Books To <a href="index.php"><span>Otaku </span><span>Oasis</span></a></h3>
            <input type="text" name="btitle" placeholder="Enter book Name" class="text_field">
            <input type="text" name="bauthor" placeholder="Enter Author name" class="text_field">
            <input type="number" min="0" name="price" class="text_field" placeholder="enter product price">
            <select name="genre" required class="text_field">
                <option value="fantasy">Fantasy</option>
                <option value="romance">Romance</option>
                <option value="adventure">Adventure</option>
            </select>
            <input type="number" name="rating"  min="0" max= "5" class="text_field" placeholder="enter rating" step="0.1">

            <textarea name="bdesc" placeholder="Enter book description" id="" class="text_field" cols="18" rows="5"></textarea>
            <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="text_field">
            <input type="submit" value="Add Book" name="add_books" class="btn text_field">
        </form>
    </div>

    <!-- Rest of your HTML code -->

    <script src="./js/admin.js"></script>
    <script>
        setTimeout(() => {
            const box = document.getElementById('messages');

            // 👇️ hides element (still takes up space on page)
            box.style.display = 'none';
        }, 8000);
    </script>
</body>

</html>
