<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles.css">
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script src="script.js"></script>
    <title>Document</title>
    <style>
    

    p, h2, h3, a {
        margin-left: 50px;
    }

    img {
        width: 200px;
        height: 300px;
        margin-left: 50px;
    }

    .content, .author {
        display: flex;
    }

    .content-text, .author-text {
        display: flex;
        flex-direction: column;
        justify-content: center;
        height: 300px;
    }

    #cart {
        margin-left: 50px;
    }
    


    </style>
</head>
<body>
    <?php require 'navbar.php'; ?>
</body>
</html>
<?php

include_once ('database.php');

    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD);
    
    $db_found = mysqli_select_db($connection, DB_NAME);

if(isset($_GET['authorId'])) {

    $authorId = $_GET['authorId'];
    
    $query = "SELECT * FROM author WHERE author_id = $authorId";
    $result = mysqli_query($connection, $query);
    

    $row = mysqli_fetch_assoc($result);
            
    echo "<article>";
    echo "<div class='poster'>";
    ?>
    <img class='poster' src="<?php echo $row['picture'] ?>" alt="poster for the author.">
    <?php
    echo "</div>";
    echo "<div class='content'>";
    ?>
    <h3><?php echo $row['name'] ?></h3>
    <?php

    $yearBirth = new DateTime($row['year_birth']);
    $now = new DateTime();
    $diff = $now->diff($yearBirth);
    echo "<br>";

    echo "<p> Birth date: " . $row['year_birth'] . " (" . $diff->y . " years old)";

    echo "<p> Gender: " . ucfirst($row['gender']);

    echo "<p>" . $row['biography'] . "</p>";

    echo "</article>";
}

if(isset($_SESSION['userId'])) {
    $userId = $_SESSION['userId'];
}

if(isset($_GET['buyId'])) {
    $buyId = $_GET['buyId'];
 
    //? INSERT ORDER INTO ORDERS
    $query2 = "SELECT * FROM orders WHERE user_id = '$userId' AND paid = 0";
    $result2 = mysqli_query($connection, $query2);
    $fetch2 = mysqli_fetch_array($result2);

    var_dump($fetch2);
    
    if(empty($fetch2)) {
        $queryPreOrder = "INSERT INTO orders(user_id) VALUES('$userId')";
        $resultPreOrder = mysqli_query($connection, $queryPreOrder);
    }
    
    //? ADD CONTENT OF THE CART
    $query3 = "SELECT * FROM orders WHERE user_id = '$userId' AND paid = 0";
    $result3 = mysqli_query($connection, $query3);

    $fetch3 = mysqli_fetch_assoc($result3);

    var_dump($fetch3);
    $orderId = $fetch3['order_id'];

    $queryOrder = "INSERT INTO order_content(item_id, order_id) VALUES('$buyId', '$orderId')";
    $resultOrder = mysqli_query($connection, $queryOrder);
    header("Location: products.php");


}
