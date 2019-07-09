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
    </style>
</head>


<body>
    
    <h1 style='text-align: center'>Our books: </h1>
    
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
        echo "</div>";
        echo "<div class='order'>";
        if(!empty($_SESSION['userId'])) {
            echo "<a href='#'><h5>Add to cart</h5></a>";
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
        echo "</div>";
        echo "<div class='order'>";
        
        if(!empty($_SESSION['userId'])) {
            echo "<a href='#'><h5>Add to cart</h5></a>";
        }
        echo "</div>";
        echo "</article>";
    }
}


?>