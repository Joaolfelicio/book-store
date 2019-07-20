<?php session_start() ?>
<?php
 
if(isset($_POST['submitBuy'])) {
    require "database.php";

    $itemId = $_POST['itemId'];

    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD);

    $db_found = mysqli_select_db($connection, DB_NAME);

    if(isset($_SESSION['userId'])) {
        $userId = $_SESSION['userId'];
    }
 
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

    $orderId = $fetch3['order_id'];

    $queryQt = "SELECT * FROM order_content oc INNER JOIN items i on oc.item_id = i.item_id
    INNER JOIN orders o on oc.order_id = o.order_id WHERE i.item_id = '$itemId' AND o.order_id = '$orderId' AND o.paid = 0";

    $resultQt = mysqli_query($connection, $queryQt);
    $fetchQt = mysqli_fetch_assoc($resultQt);

    if(!$fetchQt) {
        $queryOrder = "INSERT INTO order_content(item_id, order_id) VALUES('$itemId', '$orderId')";
        $resultOrder = mysqli_query($connection, $queryOrder);
        echo "First time cart";
    } else {
        $quantity = $fetchQt['quantity'] + 1;
        $queryUpdateQuantity = "UPDATE order_content SET quantity = $quantity WHERE item_id = '$itemId' AND order_id = '$orderId'";
        $resultUpdateQuantity = mysqli_query($connection, $queryUpdateQuantity);
        echo "<pre>";
        var_dump($resultUpdateQuantity);
        echo "</pre>";
        echo "Second time cart";
    }


    header("Location: products.php");
}