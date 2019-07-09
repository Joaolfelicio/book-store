<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    
    <style>
    article, h1, h3, .presentation{
        padding: 15px;
    }

    </style>
</head>
<body>
<h1>Best place to buy what you want </h1>

<h3>Presentation</h3>

<p class='presentation'>Lorem ipsum dolor sit amet consectetur adipisicing elit. Error magnam eveniet iure expedita, fugiat similique eos ad, quos numquam excepturi dolores nihil asperiores? Maxime dignissimos possimus molestias quaerat quia vero?
Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed non aperiam numquam quibusdam laboriosam possimus architecto amet quaerat veritatis in saepe nulla asperiores accusamus ipsum voluptate expedita, enim a aut.</p>

<hr>
<h3>Most sold:</h3>
<?php
    require_once 'database.php';
    $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD,DB_NAME);

    
    $db_found = mysqli_select_db($conn, DB_NAME);
    $query = 'SELECT * FROM items ORDER BY soldNum DESC LIMIT 3';
    $result = mysqli_query($conn, $query);

    while ($db_record = mysqli_fetch_assoc($result)) { 
        echo '<article>';
        ?>
        <p><strong>TITLE :</strong> <a href='product.php?itemId=<?php echo $db_record['item_id'] ?>'><?php echo $db_record['title'] ?></p></a>
        
        <?php
        echo 'RELEASE DATE : ' . $db_record['release_date'] . '<br>';
        echo 'SELLERS NUM : <strong>' . $db_record['soldNum'] . '</strong><br>';
        echo '</article>';
        echo '<hr>';

    }

?>
</body>
</html>