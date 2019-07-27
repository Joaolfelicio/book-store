<?php session_start()?>
<!DOCTYPE html>
<html lang=''>
<head>
  <meta charset='utf-8'>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="styles.css">
  <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
  <script src="script.js"></script>
  <title>Account</title>

  <style>


  body h1, h3 {
      margin-bottom: 50px;
  }

  h3 {
      margin-left: 35px;
  }

  h1, article {
      margin-left: 35px;
      margin-top: 35px;
      margin-bottom: 30px;
  }

  body h2 {
      margin: 40px 35px;
  }

  .dateOrder {
      margin-left: 35px;
  }
  </style>

</head>
<body>

    
    <?php

    require "navbar.php";
        echo "<h1>User info</h1>";

if (!empty($_SESSION['userId'])) {
   $user_session = $_SESSION['userId'];
    require_once 'database.php';
    $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD,DB_NAME);

    $db_found = mysqli_select_db($conn, DB_NAME);


   $query = "SELECT * FROM users
   where user_id = $user_session ";
   $result = mysqli_query($conn, $query);

    
   while ($db_record = mysqli_fetch_assoc($result)) {
       echo '<article>';
       echo '<p><strong>First Name:</strong> ' . ucfirst($db_record['first_name']) . '</p>';
       echo '<p><strong>Last Name:</strong> ' . ucfirst($db_record['last_name']) . '</p>';
       echo '<p><strong>Email:</strong> ' . $db_record['email'] . '</p>';
       echo '</article>';
   }

   $query = "SELECT * FROM order_content oc
   INNER JOIN items i on oc.item_id = i.item_id
   INNER JOIN orders o on oc.order_id = o.order_id
   WHERE o.user_id = '$user_session' AND o.paid = 1 ORDER BY oc.order_id DESC";
   
   $result = mysqli_query($conn, $query);
   $num = 0;
   $total = 0;
   
   while($row = mysqli_fetch_assoc($result)) {
       if($num !== $row['order_id']) {
            if($total > 0) {
                echo "<h3> TOTAL: $" .  $total . "</h3>";
            }
           $total =  $row['price'] * $row['quantity'];
           echo "<hr>";        
           echo "<h2>Order id: " . $row['order_id'] . "</h2>";
           echo "<p class='dateOrder'><strong> Address:</strong> " . $row['address'];
           echo "<p class='dateOrder'><strong> Payment method:</strong> " . $row['payment_method'];
           echo "<p class='dateOrder'><strong> Date of order:</strong> " . $row['date'];

           $num = $row['order_id'];
        } else {
            $total += $row['price']  * $row['quantity'];
            
        }
        if($row['quantity'] > 0) {
            
            echo "<article>";
            echo "<div>"; ?>
            <h4> <?php echo $row['quantity'] . "x" ?> <a href='product.php?itemId=<?php echo $row["item_id"]?>' > <?php echo $row['title'] ?></a></h4>   
            <?php
            echo "<p> Price: $" . $row['price'] * $row['quantity'];
            echo "</div>";
            echo "</article>";
        }


}



}else{
   header('Location: login.php ') ;
}


?>
</body>
</html>