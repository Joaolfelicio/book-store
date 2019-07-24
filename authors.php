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

    <title>Authors</title>

    <style>
        article {
            padding: 15px;
            display: flex;
            margin-top: 35px;
            margin-left: 50px;
            display: flex;
            justify-content: space-evenly;
        }


        article h3 {
            padding-left: 0px;
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

        form {
            padding: 15px;
            padding-left: 50px;
        }
    </style>
</head>


<body>
<?php require('navbar.php') ?>
    
    <h1 style='text-align: center'>AUTHORS: </h1>
    

</body>
</html>
<?php


include_once ('database.php');

$connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD);

$db_found = mysqli_select_db($connection, DB_NAME);

$query = 'SELECT * FROM author';
$result = mysqli_query($connection, $query);

if(isset($_SESSION['userId'])) {
    $userId = $_SESSION['userId'];
}


while($row = mysqli_fetch_assoc($result)) {
    echo "<article>";
    echo "<div class='poster'>";
    ?>
    <a href='author.php?authorId=<?php echo $row['author_id'] ?>' > <img class='poster' src="<?php echo $row['picture'] ?>" alt="poster for the author."> </a>
    <?php
    echo "</div>";
    echo "<div class='content'>";
    ?>
    <a href='product.php?authorId=<?php echo $row['author_id']?>' > <h3><?php echo $row['name'] ?></h3> </a>
    <?php

    $yearBirth = new DateTime($row['year_birth']);
    $now = new DateTime();
    $diff = $now->diff($yearBirth);
    echo "<br>";

    echo "<p> Birth date: " . $row['year_birth'] . " (" . $diff->y . " years old)";

    echo "<p> Gender: " . ucfirst($row['gender']);

    if(strlen($row['biography']) < 60) {
        echo "<p>" . $row['biography'] . "</p>";
    } else {
        $shortDescript = substr($row['biography'], 0, 100) . "...";
        echo "<p>" . $shortDescript . "</p>";
    }

    echo "</div>";
    echo "<div class='order'>";

    
    echo "</div>";
    echo "</article>";
}
?>