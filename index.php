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


    .content {
        margin-left: 50px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    
    article {
        display: flex;
        margin: 25px;
    }

    img {
        width: 150px;
        height: 250px;
        margin-left: 50px;
    }
    
    </style>
</head>
<body>
<?php require('navbar.php') ?>
<?php require('header.php') ?>
<h1>Best place to buy what you want </h1>

<h3>Presentation</h3>

<p class='presentation'>Lorem ipsum dolor sit amet consectetur adipisicing elit. Error magnam eveniet iure expedita, fugiat similique eos ad, quos numquam excepturi dolores nihil asperiores? Maxime dignissimos possimus molestias quaerat quia vero?
Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed non aperiam numquam quibusdam laboriosam possimus architecto amet quaerat veritatis in saepe nulla asperiores accusamus ipsum voluptate expedita, enim a aut.</p>

<h3>Most sold:</h3>
<?php
    require_once 'database.php';
    $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD,DB_NAME);

    
    $db_found = mysqli_select_db($conn, DB_NAME);
    $query = 'SELECT * FROM items ORDER BY soldNum DESC LIMIT 3';
    $result = mysqli_query($conn, $query);

    while ($db_record = mysqli_fetch_assoc($result)) { 
        echo '<article>';
        echo "<div>";
        ?>

        <img src="<?php echo $db_record['poster'] ?>" alt="">
        <?php
        echo "</div>";
        echo "<div class='content'>";
        ?>
        <p><strong>Title:</strong> <a href='product.php?itemId=<?php echo $db_record['item_id'] ?>'><?php echo $db_record['title'] ?></p></a>
        
        <?php
        echo '<p>Release date: ' . $db_record['release_date'] . '</p>';
        echo '<p>Copies sold: <strong>' . $db_record['soldNum'] . '</strong></p>';
        echo "</div>";
        echo '</article>';

    }

?>
</body>
</html>