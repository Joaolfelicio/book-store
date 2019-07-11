<style>
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
      <li><a href='products.php'>Products</a></li>
      <li><a href='cart_page.php'>My Cart</a></li>
      <?php
      if (isset($_SESSION['userId'])) {
         ?>
         <li><a href='my_account.php'>My Account</a></li>
         <li><a href='log_out.php'>Log Out</a></li>

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
      ?>
      <li><a href='contact_page.php'>Contact</a></li>

   </ul>
</div>