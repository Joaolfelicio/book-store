<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
    


    </style>
</head>
<body>
    
</body>
</html>
<?php

include_once ('database.php');

    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD);
    
    $db_found = mysqli_select_db($connection, DB_NAME);

if(isset($_GET['itemId'])) {

    $itemId = $_GET['itemId'];
    
    $query = "SELECT * FROM items i INNER JOIN author a ON i.author_id = a.author_id WHERE item_id = '$itemId' ";
    $result = mysqli_query($connection, $query);
    
    
    // ! RETRIEVE ALL THE BOOKS
    if(!isset($_GET['filter'])) {
        while($row = mysqli_fetch_assoc($result)) {
            echo "<article>";
            echo "<h2 style='margin-bottom: 25px'>Item: </h2>";
            echo "<div class='content'>"; 
            echo "<div>";
            ?>
            
            <img src="<?php echo $row['poster'] ?>" alt="">
            <?php
            echo "</div>";
            echo "<div class='content-text'>";
            echo "<h3>" . $row['title'] . "</h3>";
            echo "<p> Release date: " . $row['release_date'];
            echo "<p> Price: " . $row['price'] . '$';
            echo "<p>" . $row['soldNum'] . " copies sold!";
            if(!empty($_SESSION['userId'])) {
                ?>
                <a href='product.php?buyId=<?php echo $row['item_id']?>'><h5>Add to cart</h5></a>
                <?php
            }
            echo "</div>";
            echo "</div>";
            echo "<h2 style='margin-top: 75px'>Author: </h2>";
            echo "<div class='author'>";
            echo "<div>";
            ?>
            
            <img src="<?php echo $row['picture'] ?>" alt="">
            <?php
            echo "</div>";
            echo "<div class='author-text'>";
            echo "<h2> " . $row['name'] . "</h2>";
            echo "<p> Birth date: " . $row['year_birth'];
            if($row['gender'] == 'm') {
                echo "<p> Male </p>";
            } else {
                echo "<p> Female </p>";
            }
            echo "<p><strong>Biography:</strong></p>";
            echo "<p> " . $row['biography'] . "<p>";
            echo "</div>";
            echo "</div>";
            echo "</article>";
        }
    
    }
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
}
