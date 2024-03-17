<?php
include 'db.php';

session_start();
$isLoggedIn = isset($_SESSION['username']);
if (!$isLoggedIn) {
    header('location:login.php');
    exit(); // Make sure to exit after redirecting
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Page</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .msg {
            display: block;
            width: 1200px;
            background-color: white;
            border: 1px solid #ddd;
            padding: 20px;
            z-index: 999;
            text-align: left;
            margin: 0 auto;
        }

        .msg p {
            margin: 0;
        }



        .search-form form {
            max-width: 1200px;
            margin: 30px auto;
            display: flex;
            gap: 15px;
        }

        .search-form form .search_btn {
            margin-top: 0;
        }

        .search-form form .box {
            width: 100%;
            padding: 12px 14px;
            border: 2px solid rgb(0, 167, 245);
            font-size: 20px;
            color: black;
            border-radius: 5px;
        }

        .search_btn {
            display: inline-block;
            padding: 10px 25px;
            cursor: pointer;
            color: white;
            font-size: 18px;
            border-radius: 5px;
            text-transform: capitalize;
            background-color: rgb(0, 167, 245);
        }

        #search_results {
            position: absolute;
            background-color: white;
            border: 1px solid #ddd;
            z-index: 999;
            width: 60%;
            display: none;
            left: 15%;
        }


        #search_results li {
            list-style-type: none;
            padding: 10px;
            cursor: pointer;
        }

        #search_results li:hover {
            background-color: #f9f9f9;
        }
    </style>
</head>

<body>

    <?php include 'index_header.php'; ?>

    <section class="search-form">
        <form action="" method="POST">
            <input type="text" class="box" name="search_box" id="search_box" placeholder="Search products...">
            <input type="submit" name="search_btn" value="Search" class="search_btn">
        </form>
        <div id="search_results"></div>
    </section>

    <div class="msg">
        <?php
        if (isset($_POST['search_btn'])) {
            $search_box = $_POST['search_box'];
            if (!empty($search_box)) {
                $search_box = filter_var($search_box, FILTER_SANITIZE_STRING);
                $select_products = mysqli_query($conn, "SELECT * FROM `product` WHERE name LIKE '%$search_box%' OR author LIKE '%$search_box%' OR genre LIKE '%$search_box%'");
                if (mysqli_num_rows($select_products) > 0) {
                    echo '<h4>Search Result for "' . htmlspecialchars($search_box) . '" is: </h4><br>';
                    while ($fetch_product = mysqli_fetch_assoc($select_products)) {
                        echo ' <p>Name: ' . htmlspecialchars($fetch_product['name']) . ', Price: ' . htmlspecialchars($fetch_product['price']) . '</p>';
                    }
                } else {
                    echo '<p class="empty">Could not find "' . htmlspecialchars($search_box) . '"! </p>';
                }
            } else {
                echo '<p class="empty">Please enter a search term!</p>';
            }
        };
        ?>
    </div>

    <?php include 'index_footer.php'; ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#search_box').keyup(function() {
                var query = $(this).val();
                if (query != '') {
                    $.ajax({
                        url: 'search.php',
                        method: 'POST',
                        data: {
                            query: query
                        },
                        success: function(data) {
                            $('#search_results').fadeIn();
                            $('#search_results').html(data);
                        }
                    });
                } else {
                    $('#search_results').fadeOut();
                }
            });
            $(document).on('click', 'li', function() {
                $('#search_box').val($(this).text());
                $('#search_results').fadeOut();
            });
        });
    </script>

</body>

</html>