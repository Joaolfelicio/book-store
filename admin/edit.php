<?php session_start() ?>
<?php

if(isset($_SESSION['userId']) && $_SESSION['isAdmin'] == 1 && isset($_GET['editId'])) {
    $editId = $_GET['editId'];
    
    include_once ('../database.php');

    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD);
        
    $db_found = mysqli_select_db($connection, DB_NAME);

    $query = "SELECT * FROM items i INNER JOIN author o ON i.author_id = o.author_id WHERE item_id = $editId";

    $result = mysqli_query($connection, $query);

    $fetchItem = mysqli_fetch_assoc($result);

    $title = $fetchItem['title'];
    $release_date = $fetchItem['release_date'];
    $author_name = $fetchItem['name'];
    $author_id = $fetchItem['author_id'];
    $category = $fetchItem['category'];
    $format = $fetchItem['format'];
    $price = $fetchItem['price'];
    $soldNum = $fetchItem['soldNum'];
    $url = $fetchItem['poster'];




    if(isset($_POST['edit'])) {
        $title = $_POST['title'];
        $release_date = $_POST['date'];
        $author_name = $_POST['author'];
        $category = $_POST['category'];
        $format = $_POST['format'];
        $price = $_POST['price'];
        $soldNum = $_POST['soldNum'];
        $url = $_POST['url'];

        // ! CHANGE QUERY TO UPDATE AUTHOR

        $queryUpdate = "UPDATE items SET poster = '$url', title = '$title', release_date = '$release_date', author_id = $author_name, category = '$category', format = '$format', price = $price, soldNum = $soldNum WHERE item_id = $editId ;";

        $resultEdit = mysqli_query($connection, $queryUpdate);
        header("Location: admin.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="../styles.css">
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script src="../script.js"></script>
</head>
<body>
    <?php include "navbarAdmin.php" ?>

<form action="" method="POST">
    <label for="title">Title: </label>    
    <input type="text" name='title' value ='<?php echo $title ?>' placeholder="Title">
    <br>
    <br>

    <label for="date">Release Date: </label>
    <input type="date" name='date' value ='<?php echo $release_date ?>' placeholder="Release Date">
    <br>
    <br>

    <label for="author">Author: </label>
    <input type="text" name='author' value ='<?php echo $author_name ?>' placeholder="Author id">
    <br>
    <br>

    <label for="category">Category: </label>
    <input type="text" name='category' value ='<?php echo $category ?>' placeholder="Category">
    <br>
    <br>

    <label for="format">Format: </label>
    <input type="text" name='format' value ='<?php echo $format ?>' placeholder="Format">
    <br>
    <br>

    <label for="price">Price: $</label>
    <input type="text" name='price' value ='<?php echo $price ?>' placeholder="Price">
    <br>
    <br>

    <label for="soldNum">Copies sold</label>
    <input type="text" name='soldNum' value ='<?php echo $soldNum ?>' placeholder="Sold Number">
    <br>
    <br>

    <label for="url">Poster URL</label>
    <input type="url" name="url" id="" value ='<?php echo $url ?>' placeholder="Poster Url">
    <br>
    <br>

    <input type="submit" value="Edit" name="edit">
</form>
    
</body>
</html>