<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
    
    article {
        text-align: center;
    }
    p {
        max-width: 50%;
        margin: 20px auto;
    }

    </style>
</head>
<body>
    
</body>
</html>
<?php

include_once ('database.php');

if(isset($_GET['itemId'])) {

    $itemId = $_GET['itemId'];

    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD);
    
    $db_found = mysqli_select_db($connection, DB_NAME);
    
    $query = "SELECT * FROM items i INNER JOIN author a ON i.author_id = a.author_id WHERE item_id = '$itemId' ";
    $result = mysqli_query($connection, $query);
    
    
    // ! RETRIEVE ALL THE BOOKS
    if(!isset($_GET['filter'])) {
        while($row = mysqli_fetch_assoc($result)) {
            echo "<article>";
            echo "<div>";
            echo "<h3 style='margin-top: 75px'>Item: </h3>";
            ?>
            <a href='product.php?itemId= <?php echo $row['item_id'] ?>' > <h3><?php echo $row['title'] ?></h3> </a>
            <?php
            echo "<p> Release date: " . $row['release_date'];
            echo "<p> Price: " . $row['price'] . '$';
            echo "<p>" . $row['soldNum'] . " copies sold!";
            echo "<a href='#'><h5>Add to cart</h5></a>";
            echo "<h3 style='margin-top: 75px'>Author: </h3>";
            echo "<p> " . $row['name'] . "<p>";
            echo "<p> Birth date: " . $row['year_birth'];
            if($row['gender'] == 'm') {
                echo "<p> Male </p>";
            } else {
                echo "<p> Female </p>";
            }
            echo "<p><strong>Biography:</strong></p>";
            echo "<p> " . $row['biography'] . "<p>";
            echo "</div>";
            echo "</article>";
        }
    
    }
}
