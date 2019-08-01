<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../style/styles.css">
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script src="../script/script.js"></script>
    <title>Book Details</title>
    <style>
    
        p, h2, h3 {
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
            justify-content: space-evenly;
            height: 300px;
        }

        h2 {
            margin-bottom: 25px;
        }

        #cart {
            margin-left: 50px;
        }
        
    </style>
</head>
<body>
    <?php require 'navbar-item-auth.php'; ?>
</body>
</html>
<?php

include_once ('../db/database.php');

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
            echo "<h2 style='margin-bottom: 25px'>Book: </h2>";
            echo "<div class='content'>"; 
            echo "<div>";
            ?>
            
            <img src="<?php echo $row['poster'] ?>" alt="">
            <?php
            echo "</div>";
            echo "<div class='content-text'>";
            echo "<h2>" . $row['title'] . "</h2>";
            echo "<p> Release date: " . $row['release_date'];
            echo "<p> Price: " . $row['price'] . '$';
            echo "<p>" . $row['soldNum'] . " copies sold!";
            if(!empty($_SESSION['userId'])) {
                ?>
                <form action="buy.php" method='POST'>
        
                    <input type="hidden" value='<?php echo $row['item_id'] ?>' name="itemId">
                    <!-- <input class='image' type="image" name='submitBuy' src="http://cdn.onlinewebfonts.com/svg/img_569392.png" alt=""> -->
                    <input type="submit" id='cart' value="CART" name='submitBuy'>
                </form>
        
                <?php
            }
            echo "</div>";
            echo "</div>";
            echo "<h2 style='margin-top: 75px'>Author: </h2>";
            echo "<div class='author'>";
            echo "<div>";
            ?>
            
            <a href='author.php?authorId=<?php echo $row['author_id'] ?>'><img src="<?php echo $row['picture'] ?>" alt=""></a>
            <?php
            echo "</div>";
            echo "<div class='author-text'>"; ?>
            <h3><a href='author.php?authorId=<?php echo $row['author_id'] ?>'><?php echo $row['name']?></a></h3>
            <?php
            $yearBirth = new DateTime($row['year_birth']);
            $now = new DateTime();
            $diff = $now->diff($yearBirth);

            echo "<p> Birth date: " . $row['year_birth'] . " (" . $diff->y . " years old)";

            echo "<p>" . ucfirst($row['gender']) . "</p>";
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
