<?php session_start() ?>
<?php

if(isset($_SESSION['userId']) && $_SESSION['isAdmin'] == 1 && isset($_GET['deleteId'])) {
    $deleteId = $_GET['deleteId'];
    
    include_once ('../database.php');

    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD);
        
    $db_found = mysqli_select_db($connection, DB_NAME);

    $query = "UPDATE items SET isAvailable = 0 WHERE item_id = $deleteId";

    $result = mysqli_query($connection, $query);

    header("Location: admin.php");
}

?>

