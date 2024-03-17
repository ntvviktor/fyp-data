<head>
    <style>
        footer {
            background-color: #333;
            color: #fff;
            padding: 1rem 0;
            text-align: center;
            margin-top: auto;
        }

        h2 {
            font-size: 20px;
            font-weight: 700
        }

        .flex {
            display: flex;
        }

        ul li:not(:first-child) {
            padding: 5px;
        }

        .short_links ul {
            margin: 0 110px;
        }

        .sub_main .dropdown .dropbtn {
            border: none;
            cursor: pointer;
        }

        /* The container <div> - needed to position the dropdown content */
        .sub_main .dropdown {
            position: relative;
            display: inline-block;
        }

        /* Dropdown Content (Hidden by Default) */
        .sub_main .dropdown .dropdown-content {
            display: none;
            position: absolute;
            background-color: #CCCCCC;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        /* Links inside the dropdown */
        .sub_main .dropdown .dropbtn .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        /* Change color of dropdown links on hover */
        .sub_main .dropdown .dropbtn .dropdown-content a:hover {
            background-color: #f1f1f1
        }

        /* Show the dropdown menu on hover */
        .sub_main .dropdown:hover .dropdown-content {
            display: flex;
            flex-direction: column;
        }

        ul li {
            list-style-type: none;
        }
    </style>
</head>

<footer style="margin: auto; width: 100%; background-color: rgba(0, 0, 0, 0.2);">
    <div class="main" style="align-items:center; padding: 0; max-width: auto; margin: 0 auto;">
        <div class="sub_main">
            <div class="short_links flex" style="justify-content:center; ">
                <ul>
                    <h2>Quick Links</h2>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about-us.php">About Us</a></li>
                </ul>
                <?php
                if (isset($_SESSION['username'])) {
                    echo '
                <ul class="account">
                    <h2>Account</h2>
                    <li><a href="viewprofile.php">Profile</a></li>
                    <li><a href="cart.php">Cart</a></li>
                    <li><a href="orders.php">Order History</a></li>
                    <li><a href="signout.php">LogOut</a></li>
                </ul>';
                }
                ?>
                <ul>
                    <h2>Contact</h2>
                    <li><a href="contact-us.php">Contact Form</a></li>
                    <li>+65 912345678</li>
                    <li>contact@Otaku.com</li>
                    <li>Address: Singapore 123456</li>
                </ul>
            </div>
        </div>
    </div>

    <div style=" align-items:center; justify-content:center; margin:20px 0 0 ;" class="cmsg flex">
        <p>Designed By Jun Ren | Copyright &copy; <script>
                document.write(new Date().getFullYear())
            </script> All Rights are reserved by &nbsp</p>
        <div style="font-size: 30px;" class="logo">
            <a href="index.php"><span style="font-size: 15px;"> Otaku </span>
                <span class="me" style="font-size: 15px;">Oasis</span></a>
        </div>
    </div>
    </div>
    </ </footer>