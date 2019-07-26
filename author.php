<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles.css">
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script src="script.js"></script>
    <title>Document</title>
    <style>
    

    p, h2, h3, a {
        margin-left: 50px;
    }

    .content h3 {
        padding: 0px;
    }

    img {
        width: 200px;
        height: 300px;
        margin-left: 50px;
    }

    article {
        display: flex;
        /* padding: 0px !important; */
        margin-left: 50px;
        justify-content: space-between;
        margin-top: 30px;
        width: 70%;
    }

    .content {
        display: flex;
        flex-direction: column;
        justify-content: space-evenly;
    }

    .content-text, .author-text {
        display: flex;
        flex-direction: column;
        justify-content: center;
        height: 300px;
    }

    #cart {
        margin-left: 50px;
    }

    .image {
            width: 50px;
            height: 50px;
        }

    .poster {
        height: 300px;
        width: 200px;
    }

    .author {
        margin-left: 100px;
    }

    .content, .content-author {
        display: flex;
        justify-content: center;
        align-items: flex-start;
        flex-direction: column;
    }

    .content-author {
        padding-left: 30px;
    }

    form {
        padding: 15px;
        padding-left: 50px;
    }

    .order {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }



    </style>
</head>
<body>
    <?php require 'navbar.php'; ?>
</body>
</html>
<?php

include_once ('database.php');

    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD);
    
    $db_found = mysqli_select_db($connection, DB_NAME);

if(isset($_GET['authorId'])) {

    $authorId = $_GET['authorId'];
    
    $query = "SELECT * FROM author WHERE author_id = $authorId";
    $result = mysqli_query($connection, $query);
    

    $row = mysqli_fetch_assoc($result);
    echo "<h2 style='margin-bottom: 25px'>Author: </h2>";

    echo "<article class='author'>";
    echo "<div class='poster'>";
    ?>
    <img class='poster' src="<?php echo $row['picture'] ?>" alt="poster for the author.">
    <?php
    echo "</div>";
    echo "<div class='content-author'>";
    ?>
    <h2><?php echo $row['name'] ?></h2>
    <?php

    $yearBirth = new DateTime($row['year_birth']);
    $now = new DateTime();
    $diff = $now->diff($yearBirth);

    echo "<p> Birth date: " . $row['year_birth'] . " (" . $diff->y . " years old)";

    echo "<p> Gender: " . ucfirst($row['gender']);

    echo "<p>" . $row['biography'] . "</p>";

    echo "</article>";


    $queryBooks = "SELECT * FROM items i INNER JOIN author a ON i.author_id = a.author_id WHERE a.author_id = $authorId";
    $resultBooks = mysqli_query($connection, $queryBooks);
    echo "<h2 style='margin-top: 75px'>Books: </h2>";
    while($row = mysqli_fetch_assoc($resultBooks)) {
        echo "<article>";
        echo "<div class='poster'>";
        ?>
        <a href='product.php?itemId=<?php echo $row['item_id'] ?>' > <img class='poster' src="<?php echo $row['poster'] ?>" alt="<?php $row['title'] ?>"> </a>
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
                <input type="submit" value="CART" name='submitBuy'>

            </form>
    
            <?php
        }
        echo "</div>";
        echo "</article>";
    }
}

if(isset($_SESSION['userId'])) {
    $userId = $_SESSION['userId'];
}



if(isset($_GET['buyId'])) {
    $buyId = $_GET['buyId'];
 



}
