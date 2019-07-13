    <?php session_start() ?>
    <?php

    if(isset($_SESSION['userId']) && $_SESSION['isAdmin'] == 1) {

        
        if(isset($_POST['add'])) {
            
            include_once ('database.php');

            $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD);
            $title = $_POST['title'];
            $release_date = $_POST['date'];
            $author_id = $_POST['author'];
            $category = $_POST['category'];
            $format = $_POST['format'];
            $price = $_POST['price'];
            $soldNum = $_POST['soldNum'];
            $url = $_POST['url'];
                
            $db_found = mysqli_select_db($connection, DB_NAME);
        
            $query = "INSERT INTO items (poster, title, release_date, author_id, category, format, price, soldNum) VALUES ('$url', '$title', '$release_date', $author_id, '$category', '$format', $price, $soldNum)";
        
            $result = mysqli_query($connection, $query);
        
            $fetchItem = mysqli_fetch_assoc($result);
        
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
        <input type="text" name='title' placeholder="Title">
        <br>
        <br>

        <label for="date">Release Date: </label>
        <input type="date" name='date' placeholder="Release Date">
        <br>
        <br>

        <label for="author">Author Id: </label>
        <input type="text" name='author' placeholder="Author id">
        <br>
        <br>

        <label for="category">Category: </label>
        <input type="text" name='category' placeholder="Category">
        <br>
        <br>

        <label for="format">Format: </label>
        <input type="text" name='format' placeholder="Format">
        <br>
        <br>

        <label for="price">Price: $</label>
        <input type="text" name='price' placeholder="Price">
        <br>
        <br>

        <label for="soldNum">Copies sold</label>
        <input type="text" name='soldNum' placeholder="Sold Number">
        <br>
        <br>

        <label for="url">Poster URL</label>
        <input type="url" name="url" id="" placeholder="Poster Url">
        <br>
        <br>

        <input type="submit" value="Add Item" name="add">
    </form>
        
    </body>
    </html>