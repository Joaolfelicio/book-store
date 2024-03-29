<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style/styles.css">
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script src="script/script.js"></script>
    <title>Contact</title>
    <style>
    form{
        padding: 15px;
    }
    p {
        padding: 15px;
    }
    </style>
</head>
<body>
<?php

    require "navbar.php";
    require_once 'db/database.php';
    $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD,DB_NAME);

    $db_found = mysqli_select_db($conn, DB_NAME);
    $query = 'SELECT title, release_date,soldNum FROM items ORDER BY soldNum DESC limit 3  ';
    $result = mysqli_query($conn, $query);
    $contactEmail = '';
    $contactTextArea = '';
    $msg = 'Please check your email, your comment has to be more than 10 letters';
    if (isset($_POST['contact_submit'])) {
        
        if (filter_var(filter_var($_POST['contactEmail'], FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL) && strlen($_POST['textArea']) > 10){
            $contactEmail = $_POST['contactEmail'];
            echo $msg = ' your comment has been sent' . '<br>';
            $contactTextArea = $_POST['textArea'];
            echo $contactEmail . '<br>'; 
            echo $contactTextArea. '<br>';
        }else {
            echo $msg;
        }
    }
    ?>
    <h1>Contact us for more informations</h1>
    <p> <strong> Our Address is :</strong> <br> 81b rue de Luxembourg L-9984 Luxembourg</p>
    <p> <strong> Telephone  Number :</strong> <br> 00352 661 626 661</p>

    <form action="" method='POST'>
        <input type="text" name='contactEmail' placeholder='your email to caontact'> <br>
        <textarea name="textArea" id="" cols="30" rows="10" placeholder='what do you think of our webpage'></textarea> <br>
        <input type="submit" name='contact_submit' value='send'>
    </form>

</body>
</html>