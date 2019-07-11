<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../styles.css">
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script src="../script.js"></script>
    <title>Document</title>

    <style>

        .options {
            width: 200px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin-left: 50px;
        }

        img {
            width: 50px;
            height: 50px;
        }
        article {
            padding: 15px;
            display: flex;
            margin-top: 35px;
            justify-content: space-evenly;
        }
        .poster {
            height: 300px;
            width: 200px;
        }

        .content {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            flex-direction: column;
            margin-left: 50px;
            width: 200px;
        }
    </style>
</head>


<body>
    <?php
    include "navbarAdmin.php";
if(isset($_SESSION['userId']) && $_SESSION['isAdmin'] == 1) {
    ?>
    <h1 style='text-align: center'>ADMIN</h1>
    
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

    <br>
    <a href='add.php'>Add a new Item</a>

</body>
</html>

<?php



        include_once ('../database.php');

        $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD);
        
        $db_found = mysqli_select_db($connection, DB_NAME);
        
        $query = 'SELECT * FROM items i INNER JOIN author a ON i.author_id = a.author_id WHERE i.isAvailable = 1';
        $result = mysqli_query($connection, $query);

    if(isset($_SESSION['userId'])) {
        $userId = $_SESSION['userId'];
    }


// ! RETRIEVE ALL THE BOOKS
if(!isset($_GET['filter'])) {
    while($row = mysqli_fetch_assoc($result)) {
        echo "<article>";
        echo "<div class='poster'>";
        ?>
        <a href='../product.php?itemId=<?php echo $row['item_id'] ?>' > <img class='poster' src="<?php echo $row['poster'] ?>" alt="poster for the book"> </a>
        <?php
        echo "</div>";
        echo "<div class='content'>";
        ?>
        <a href='../product.php?itemId=<?php echo $row['item_id']?>' > <h3><?php echo $row['title'] ?><h3> </a>
        <?php
        echo "<p> " . $row['name'] . "<p>";
        echo "<p> Release date: " . $row['release_date'];
        echo "<p> Price: $" . $row['price'];
        echo "</div>";
        echo "<div class='options'>";
        if(!empty($_SESSION['userId'])) {
            ?>
            <p><a href='edit.php?editId=<?php echo $row['item_id']?>'>Edit</a></p>
            
            <p><a href='delete.php?deleteId=<?php echo $row['item_id']?>'>Delete</a></p>
            <?php
        }
        echo "</div>";
        echo "</article>";
    }

}

// ! FILTER THE BOOKS
if(isset($_GET['filter'])) {

    $category = $_GET['filterDrop'];

    $queryCategory = "SELECT * FROM items i INNER JOIN author a ON i.author_id = a.author_id WHERE category LIKE '%$category%' AND i.isAvailable = 1";
    $resultCategory = mysqli_query($connection, $queryCategory);

    while($row = mysqli_fetch_assoc($resultCategory)) {
        echo "<article>";
        echo "<div class='poster'>";
        ?>
        <a href='product.php?itemId=<?php echo $row['item_id'] ?>' > <img class='poster' src="<?php echo $row['poster'] ?>" alt="poster for the book"> </a>
        <?php
        echo "</div>";
        echo "<div class='content'>";
        ?>
        <a href='product.php?itemId=<?php echo $row['item_id']?>' > <h3><?php echo $row['title'] ?><h3> </a>
        <?php
        echo "<p> " . $row['name'] . "<p>";
        echo "<p> Release date: " . $row['release_date'];
        echo "<p> Price: $" . $row['price'];
        echo "</div>";
        echo "<div class='options'>";
        
        if(!empty($_SESSION['userId'])) {
            ?>
            <p><a href='edit.php?editId=<?php echo $row['item_id']?>'>Edit</a></p>
            
            <p><a href='delete.php?deleteId=<?php echo $row['item_id']?>'>Delete</a></p>
            <?php
        }
        echo "</div>";
        echo "</article>";
    }
}
}