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
  <title>Joao</title>

  <style>
  article {
      margin-top: 30px;
  }
  </style>

</head>
<body>

<h1>User info</h1>

<?php

if (!empty($_SESSION['userId'])) {
   $user_session = $_SESSION['userId'];
       require_once 'database.php';
       $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD,DB_NAME);


       $db_found = mysqli_select_db($conn, DB_NAME);
   # code...

   $query = "SELECT * FROM users
   where user_id = $user_session ";
   $result = mysqli_query($conn, $query);

    
   while ($db_record = mysqli_fetch_assoc($result)) {
       echo '<article>';
       echo 'First Name : ' . $db_record['first_name'] . '<br>';
       echo 'Last Name : ' . $db_record['last_name'] . '<br>';
       echo 'Email : ' . $db_record['email'] . '<br>';
       echo '</article>';
   }

   $query = "SELECT * FROM order_content oc
   INNER JOIN items i on oc.item_id = i.item_id
   INNER JOIN orders o on oc.order_id = o.order_id
   WHERE o.user_id = '$user_session' AND o.paid = 1 ORDER BY oc.order_id";
   
   $result = mysqli_query($conn, $query);
   $num = 0;
   while($row = mysqli_fetch_assoc($result)) {

    echo "<article>";
    if($num !== $row['order_id']) {
        $sum = 0;
        echo "<hr>";


        
        echo "<p>Order id: " . $row['order_id'] . "</p>";
        $num = $row['order_id'];
        echo "<p> Date of order: " . $row['date'];
    }
    echo "<div>";
    echo "<h3>" . $row['title'] . "<h3> </a>";
    echo "<p> Price: $" . $row['price'];
    echo "</div>";
    echo "</article>";

   }
   echo "<hr>";

}else{
   header('Location: login.php ') ;
}


?>
</body>
</html>