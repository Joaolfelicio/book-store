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
            margin-top: 35px;
            display: flex;
            justify-content: space-evenly;

        }

        .order {
            width: 300px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .image {
            width: 50px;
            height: 50px;
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

$query = 'SELECT * FROM items i INNER JOIN author a ON i.author_id = a.author_id WHERE i.isAvailable = 1';
$result = mysqli_query($connection, $query);

if(isset($_SESSION['userId'])) {
    $userId = $_SESSION['userId'];
}

    // ! FILTER THE BOOKS

$category = isset($_GET['filterDrop']) ? $_GET['filterDrop'] : "";

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
    echo "<div class='order'>";
    if(!empty($_SESSION['userId'])) {

        ?>
        <form action="buy.php" method='POST'>

            <input type="hidden" value='<?php echo $row['item_id'] ?>' name="itemId">
            <!-- <input class='image' type="image" name='submitBuy' src="http://cdn.onlinewebfonts.com/svg/img_569392.png" alt=""> -->
            <input type="submit" value="CART" name='submitBuy'>
        </form>

        <?php
    }
    echo "</div>";
    echo "</article>";
}
?>