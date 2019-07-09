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
            ?>
            <h3><?php echo $row['title'] ?><h3>
            <?php
            echo "<p> " . $row['name'] . "<p>";
            echo "<p> Release date: " . $row['release_date'];
            echo "</div>";
            echo "<div class='order'>";
            echo "<a href='#'><h5>Add to cart</h5></a>";
            echo "</div>";
            echo "</article>";
        }
    
    }
}
