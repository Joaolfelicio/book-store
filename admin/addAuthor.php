<?php session_start() ?>
    <?php

    if(isset($_SESSION['userId']) && $_SESSION['isAdmin'] == 1) {

        
        if(isset($_POST['add'])) {
            
            include_once ('../database.php');

            $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD);
            $name = $_POST['name'];
            $birth_date = $_POST['date'];
            $gender = $_POST['gender'];
            $biography = addslashes($_POST['biography']);
            $url = $_POST['url'];
                
            $db_found = mysqli_select_db($connection, DB_NAME);
        
            $query = "INSERT INTO author (picture, name, year_birth, gender, biography) VALUES ('$url', '$name', '$birth_date', '$gender', '$biography')";

            var_dump($query);
        
            $result = mysqli_query($connection, $query);
        
            var_dump($result);
        
            // header("Location: admin.php");
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

        <style>
            #bio {
                display: flex;
                width: 250px;
                justify-content: space-between;
                align-items: flex-start;
            }
        </style>
    </head>
    <body>
        <?php include "navbarAdmin.php" ?>

    <form action="" method="POST">
    <label for="name">Name: </label>    
        <input type="text" name='name' placeholder="Name">
        <br>
        <br>

        <label for="date">Year of birth: </label>
        <input type="date" name='date' placeholder="Year of birth">
        <br>
        <br>

        <label for="gender">Gender: </label>

        <input type="radio" name="gender" value="Male"> Male
        <input type="radio" name="gender" value="Female"> Female

        <br>
        <br>

        <div id='bio'>

        <label for="biography">Biography: </label>
        <textarea name="biography" id="" cols="30" rows="5"></textarea>

        </div>
        <br>
        <br>

        <label for="url">Picture URL</label>
        <input type="url" name="url" id="" placeholder="Poster Url">
        <br>
        <br>

        <input type="submit" value="Add Item" name="add">
    </form>
        
    </body>
    </html>