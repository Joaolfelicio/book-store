<?php session_start() ?>
<?php
 
if(isset($_POST['deleteCart'])) {
    require "database.php";

    $itemDeleteCart = $_POST['itemDeleteCart'];

    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD);

    $db_found = mysqli_select_db($connection, DB_NAME);

    if(isset($_SESSION['userId'])) {
        $userId = $_SESSION['userId'];
    }
 
    //? INSERT ORDER INTO ORDERS
    // !    FIX THIS QUERY, NOT WORKING BECAUSE OF THE LIMIT
    $query = "DELETE oc FROM order_content oc
    INNER JOIN items i on oc.item_id = i.item_id
    INNER JOIN orders o on oc.order_id = o.order_id
    WHERE o.user_id = $userId AND o.paid = 0 AND oc.item_id = $itemDeleteCart LIMIT 1";

    $result = mysqli_query($connection, $query);

    var_dump($query);
    var_dump($result);
    // header("Location: cart_page.php");
}