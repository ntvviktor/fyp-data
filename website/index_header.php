<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="./css/nav.css">
<style>
  .sub-menu-wrap {
    position: fixed;
    top: 9%;
    right: -1%;
    width: 320px;
    max-height: 0px;
    overflow: hidden;
    transition: max-height 0.5s;
    z-index: 100;

  }

  .sub-menu-wrap.open-menu {
    max-height: 400px;
  }

  .sub-menu {
    background: #fff;
    padding: 20px;
    margin: 10px;
    border-bottom-right-radius: 16px;
    border-bottom-left-radius: 16px;
  }

  .user-info {
    display: flex;
    align-items: center;
  }

  .user-info h3 {
    font-weight: 500;
  }

  .user-info img {
    width: 60px;
    border-radius: 50%;
    margin-right: 15px;
  }

  .sub-menu hr {
    border: 0;
    height: 1px;
    width: 100%;
    background: #ccc;
    margin: 15px 10px;
  }

  .sub-menu-link {
    display: flex;
    align-items: center;
    text-decoration: none;
    color: #525252;
    margin: 12px e;
  }

  .sub-menu-link p {
    width: 100%;
  }

  .sub-menu-link img {
    width: 40px;
    background: #e5e5e5;
    border-radius: 50%;
    padding: 8px;
    margin-right: 15px;
  }

  .sub-menu-link span {
    font-size: 22px;
    transition: transform 0.5s;
  }

  .sub-menu-link:hover span {
    transform: translateX(5px);
  }

  .sub-menu-link:hover p {
    font-weight: 600;
  }

  .link_btn {
    background-color: brown;
    padding: 6px;
    border-radius: 10px;
    margin-left: 10px;
    color: white;
    font-weight: 500;
  }
</style>

<body>
  <header>
    <div class="logo">
      <a href="index.php"><span>Otaku</span>
        <span class="me">Oasis</span></a>
    </div>
    <div class="nav">
      <a href="index.php">Home</a>
      <div class="dropdown">
        <button class="dropbtn">Category </button>
        <div class="dropdown-content">
          <a href="http://localhost/fyp-data-main/website/index.php#most-viewed">Most Viewed</a>
          <a href="http://localhost/fyp-data-main/website/index.php#on-sale">On Sale</a>
          <a href="http://localhost/fyp-data-main/website/index.php#last-purchase">Last Purchase</a>
        </div>
      </div>
      <?php if (!$isLoggedIn) { ?>
      <?php } else { ?>
        <a class="Btn" href="search_books.php"><img style="height:30px;" src="./images/sea2.png" alt=""></a>
      <?php } ?>
    </div>

    <div class="user-box" style="display: flex; align-items:center;">
      <?php if (isset($_SESSION['username'])) {
        echo ' <img style="height:40px; margin-left:10px ;" src="images/ds2.png" class="user-pic" onclick="toggleMenu()" />';
      } else {
        echo '<div class="use_links"><a class="link_Btn" style="background-color: rgb(0, 167, 245);
        padding: 6px;
        border-radius: 10px;
        margin-left: 10px;
        color: white;
        font-weight: 500;" href="login.php">Login</a><a class="link_Btn" style="background-color: rgb(0, 167, 245);
        padding: 6px;
        border-radius: 10px;
        margin-left: 10px;
        color: white;
        font-weight: 500;" href="signup.php">Register</a></div>';
      } ?>
    </div>

  </header>
  <div class="sub-menu-wrap" id="subMenu">
    <div class="sub-menu">
      <div class="user-info">
        <img src="images/ds2.png" />
        <div class="user-info" style="display: block;">
          <h3>Hello, <?php echo $_SESSION['username'] ?></h3>
        </div>
      </div>
      <hr />
      <a href="viewprofile.php" class="sub-menu-link">
        <p>Profile</p>
        <span>></span>
      </a>
      <a href="cart.php" class="sub-menu-link">
        <p>Cart</p>
        <span>></span>
      </a>
      <a href="orders.php" class="sub-menu-link">
        <p>Order history</p>
        <span>></span>
      </a>
      <a href="signout.php" class="sub-menu-link">
        <p style="background-color: red; border-radius:8px; text-align:center; color:white; font-weight:600; margin-top:5px; padding:5px;">Logout</p>
      </a>
    </div>
  </div>


  <script>
    let subMenu = document.getElementById("subMenu");

    function toggleMenu() {
      subMenu.classList.toggle("open-menu");
    }
  </script>
</body>

</html>