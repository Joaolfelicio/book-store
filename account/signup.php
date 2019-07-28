<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../style/styles.css">
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script src="../script/script.js"></script>
    <title>Document</title>
    <style>
    .cred {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        padding-top: 100px;
    }

    h1 {
        margin-bottom: 100px;
        text-align: center;
    }

    </style>
</head>
<body>
<?php require "navbar-account.php" ?>

    <h1>SIGNUP</h1>
    <div class='cred'>

<?php
if(!isset($_SESSION['userId'])) {

?>

<form action="" method='POST'>

    <input type="email" name='email' placeholder="Enter your email...">
    <input type="password" name='password' placeholder="Enter your password...">
    <br>
    <input type="text" name='first_name' placeholder="Enter your first name...">
    <input type="text" name='last_name' placeholder="Enter your last name...">
    <br>
    <input type="submit" name=create value='Create account'>

</form>

<?php
} else {
    echo "<h1>You are logged in, do you wish to log out?</h1>"; 
?>

<form action="" method='POST'>

    <input type="submit" name=logout value='Log out'>
</form>
</div>
<?php
}

?>
    
</body>
</html>
<?php

include_once ('../db/database.php');

if(isset($_POST['create'])) {

    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = htmlspecialchars($_POST['password']);
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);

    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD);
    $password = password_hash($password, PASSWORD_DEFAULT);
    
    $db_found = mysqli_select_db($connection, DB_NAME);

    $query2 = "SELECT * FROM users WHERE email = '$email'";
    $result2 = mysqli_query($connection, $query2);

    $row_cnt = mysqli_num_rows($result2);

    if(filter_var($email, FILTER_VALIDATE_EMAIL) && strlen($password) > 3 && strlen($first_name) > 3 && strlen($last_name) > 3 && $row_cnt == 0) {

        
        $query = "INSERT INTO users (first_name, last_name, email, password) VALUES('$first_name', '$last_name', '$email', '$password')";
        $result = mysqli_query($connection, $query);
   
            if($result) {

                $query3 = "SELECT * FROM users WHERE email = '$email'";
                $result3 = mysqli_query($connection, $query3);

                while($row = mysqli_fetch_assoc($result3)) {
                    $_SESSION['userId'] = $row['user_id'];
                    $_SESSION['isAdmin'] = $row['isAdmin'];
                }

                echo "<p>Account sucessfully created</p>";
                
                header('Location: ../index.php');
            }
        } else {
            echo "<p style='color: red'>Invalid fields or email already registered.</p>";
        }
    }

if(isset($_POST['logout'])) { 
    session_destroy();
    header("Location: signup.php");
}
