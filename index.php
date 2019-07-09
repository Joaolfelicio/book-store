<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    
    <style>
    article{
        padding: 15px;
    }
    </style>
</head>
<body>
<h1>best place to buy what you want </h1>

<h3>presentation</h3>
Lorem ipsum dolor sit amet consectetur adipisicing elit. Error magnam eveniet iure expedita, fugiat similique eos ad, quos numquam excepturi dolores nihil asperiores? Maxime dignissimos possimus molestias quaerat quia vero?
Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed non aperiam numquam quibusdam laboriosam possimus architecto amet quaerat veritatis in saepe nulla asperiores accusamus ipsum voluptate expedita, enim a aut.

<hr>
<?php
    // to work with database , we will use a function call :mysqli
    require_once 'database.php';
    $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD,DB_NAME);
    echo 'connection successfull <br>';
    //  choose which database that i want to work with
    
    $db_found = mysqli_select_db($conn, DB_NAME);
    echo DB_NAME . ' found!' . '<br>';
    $query = 'SELECT title, release_date,soldNum FROM items ORDER BY soldNum DESC  limit 3  ';
    $result = mysqli_query($conn, $query);

    while ($db_record = mysqli_fetch_assoc($result)) { 
        echo '<article>';
        echo '<hr>';
        echo 'TITLE : '. $db_record['title'] . '<br>';
        echo 'RELEASE DATE : ' . $db_record['release_date'] . '<br>';
        echo 'SELLERS NUM :' . $db_record['soldNum'] . '<br>';
        echo '</article>';

    }

?>
</body>
</html>