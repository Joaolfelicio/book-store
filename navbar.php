
<style>
    .form {
            display: flex;
            align-items: center;
            flex-direction: column;
            height: 100vh;
        }

        h1 {
            margin-bottom: 100px;
        }
   article,
        h1,
        h3,
        .presentation {
            padding: 15px;
        }

        body,
        html {
            height: 100%;
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
        }

        .header-img {
            width: 100%;
            height: 400px;
            background: url('http://www.kodhus.com/freecourse-images/header-image.jpg');
            background-size: cover;
        }

        .hero-text {
            text-align: center;
            position: absolute;
            top: 30%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
        }

        .hero-text button {
            border: none;
            outline: 0;
            display: inline-block;
            padding: 10px 25px;
            color: black;
            background-color: #ddd;
            text-align: center;
            cursor: pointer;
        }

        .hero-text button:hover {
            background-color: #555;
            color: white;
        }

</style>
<div id='cssmenu'>
   <ul>
      <li class='active'><a href='index.php'>Home</a></li>
      <li><a href='products.php'>Products</a></li> <?php
      if (isset($_SESSION['userId'])) {
        $user_id = $_SESSION['userId'];
          ?>
      <li ><a href='cart_page.php'>My Cart <?php
      
      require_once 'database.php';
      $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD,DB_NAME);
  
      
      $db_found = mysqli_select_db($connection, DB_NAME);

      $query = "SELECT SUM(oc.quantity) as cartNum FROM order_content oc
      INNER JOIN items i on oc.item_id = i.item_id
      INNER JOIN orders o on oc.order_id = o.order_id
      WHERE o.user_id = '$user_id' AND o.paid = 0 ORDER BY oc.order_id";

        $result = mysqli_query($connection, $query);
        $row = mysqli_fetch_array($result);
        echo $row['cartNum'];
        
    }
      ?>
      </a></li>
      <li><a href='contact_page.php'>Contact</a></li>
      <?php
      if (isset($_SESSION['userId'])) {
         ?>
         <li><a href='my_account.php'>My Account</a></li>
         <li><a href='logout.php'>Log Out</a></li>

      <?php
      }
      ?>
      <?php
      if (!isset($_SESSION['userId'])) {
         ?>
         <li><a href='login.php'>Log In</a></li>
         <li><a href='signup.php'>Sign Up</a></li>

      <?php
      }
      if (isset($_SESSION['userId'])) {
         if($_SESSION['isAdmin'] == 1) {
         ?>
         <li><a href='admin/admin.php'>Admin</a></li>

<?php
         }
        }
?>
   </ul>
</div>