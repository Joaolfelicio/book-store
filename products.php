<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        article {
            padding: 15px;
            display: flex;
        }

        .order {
            width: 300px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        img {
            width: 50px;
            height: 50px;
        }
    </style>
</head>


<body>
    
    <h1 style='text-align: center'>BOOKS: </h1>
    
    <form action="" method='GET'>
        
        <label for="filterDrop">Choose the category of the film:</label>
        
        <select name="filterDrop" id="">
            <option value=""> -------</option>
            <option value="humor">Humor</option>
            <option value="drama">Drama</option>
            <option value="classic">Classic</option>
            <option value="action">Action</option>
        </select>

        <input type="submit" value="Filter" name='filter'>

    </form>

</body>
</html>
<?php


include_once ('database.php');

$connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD);

$db_found = mysqli_select_db($connection, DB_NAME);

$query = 'SELECT * FROM items i INNER JOIN author a ON i.author_id = a.author_id';
$result = mysqli_query($connection, $query);

if(isset($_SESSION['userId'])) {
    $userId = $_SESSION['userId'];
}


// ! RETRIEVE ALL THE BOOKS
if(!isset($_GET['filter'])) {
    while($row = mysqli_fetch_assoc($result)) {
        echo "<article>";
        echo "<div>";
        ?>
        <a href='product.php?itemId=<?php echo $row['item_id']?>' > <h3><?php echo $row['title'] ?><h3> </a>
        <?php
        echo "<p> " . $row['name'] . "<p>";
        echo "<p> Release date: " . $row['release_date'];
        echo "<p> Price: $" . $row['price'];
        echo "</div>";
        echo "<div class='order'>";
        if(!empty($_SESSION['userId'])) {
            ?>
            <a href='?itemId=<?php echo $row['item_id']?>'><img src='http://cdn.onlinewebfonts.com/svg/img_569392.png' alt='basket.'></a>"
            <?php
        }
        echo "</div>";
        echo "</article>";
    }

}

// ! FILTER THE BOOKS
if(isset($_GET['filter'])) {

    $category = $_GET['filterDrop'];

    $queryCategory = "SELECT * FROM items i INNER JOIN author a ON i.author_id = a.author_id WHERE category LIKE '%$category%'";
    $resultCategory = mysqli_query($connection, $queryCategory);

    while($row = mysqli_fetch_assoc($resultCategory)) {
        echo "<article>";
        echo "<div>";
        ?>
        <a href='product.php?itemId= <?php echo $row['item_id'] ?>' > <h3><?php echo $row['title'] ?><h3> </a>
        <?php
        echo "<p> " . $row['name'] . "<p>";
        echo "<p> Release date: " . $row['release_date'];
        echo "<p> Price: $" . $row['price'];
        echo "</div>";
        echo "<div class='order'>";
        
        if(!empty($_SESSION['userId'])) {
            ?>
            <a href='?itemId=<?php echo $row['item_id']?>'><img src='http://cdn.onlinewebfonts.com/svg/img_569392.png' alt='basket.'></a>"
            <?php
        }
        echo "</div>";
        echo "</article>";
    }
}


// ! ADD ITEM TO PRE-ORDER PAGE
if(isset($_GET['itemId'])) {
    $itemId = $_GET['itemId'];

    $queryItem = "SELECT * FROM items WHERE item_id = '$itemId'";
    $resultItem = mysqli_query($connection, $queryItem);

    $item = mysqli_fetch_assoc($resultItem);
    $itemPrice = $item['price'];

    
    //? INSERT ORDER INTO ORDERS
    $queryPreOrder = "INSERT INTO orders(user_id, order_price) VALUES('$userId', '$itemPrice')";
    $resultPreOrder = mysqli_query($connection, $queryPreOrder);

    //? GET ORDER ID OF RECENTLY UPDATED ORDER
    $queryGetOrder = "SELECT * FROM orders WHERE user_id = '$userId' AND order_price = '$itemPrice' ORDER BY order_id DESC LIMIT 1";
    $resultGetOrder = mysqli_query($connection, $queryGetOrder);
    $resultGetOrderFetch = mysqli_fetch_assoc($resultGetOrder);
    $orderId = $resultGetOrderFetch['order_id'];

    //? ADD ORDER TO ORDER CONTENT
    $queryOrder = "INSERT INTO order_content(item_id, order_id) VALUES('$itemId', '$orderId')";
    $resultOrder = mysqli_query($connection, $queryOrder);
}
?>