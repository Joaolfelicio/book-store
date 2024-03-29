<?php session_start() ?>
<?php
 
if(isset($_POST['deleteCart'])) {
    require "../db/database.php";

    $itemId = $_POST['itemDeleteCart'];
    $orderId = $_POST['orderId'];

    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD);

    $db_found = mysqli_select_db($connection, DB_NAME);

    if(isset($_SESSION['userId'])) {
        $userId = $_SESSION['userId'];
    }

    // ! NOT UPDATING, RETURNING FALSE

    $queryQt = "SELECT * FROM order_content oc INNER JOIN items i on oc.item_id = i.item_id
    INNER JOIN orders o on oc.order_id = o.order_id WHERE i.item_id = '$itemId' AND o.order_id = '$orderId' AND o.paid = 0";

    $resultQt = mysqli_query($connection, $queryQt);
    $fetchQt = mysqli_fetch_assoc($resultQt);
    $quantity = $fetchQt['quantity'] - 1;

    $query = "UPDATE order_content oc
    INNER JOIN items i ON oc.item_id = i.item_id
    INNER JOIN orders o ON oc.order_id = o.order_id SET oc.quantity = $quantity 
    WHERE o.user_id = $userId AND o.paid = 0 AND oc.item_id = $itemId";

    $result = mysqli_query($connection, $query);

    header("Location: cart_page.php");
}