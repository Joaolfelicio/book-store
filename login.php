<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        height: 100vh;
    }

    h1 {
        margin-bottom: 100px;
    }

    </style>
</head>
<body>
    <h1>LOGIN</h1>

<?php
if(!isset($_SESSION['userId'])) {

?>

<form action="" method='POST'>

    <input type="email" name='email' placeholder="Enter your email...">
    <input type="password" name='password' placeholder="Enter your password...">
    <input type="submit" name=login value='Log In'>

</form>

<?php
} else {
    echo "<h1>You are logged in, do you wish to log out?</h1>";  
?>

<form action="" method='POST'>

    <input type="submit" name=logout value='Log out'>

</form>
<?php
}

?>
    
</body>
</html>
<?php

include_once ('database.php');

if(isset($_POST['login'])) {

    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    if(filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $password = htmlspecialchars($_POST['password']);

        $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD);
        
        $db_found = mysqli_select_db($connection, DB_NAME);
        
        $query = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($result)) {
            if(password_verify($password, $row['password']) && $email === $row['email']) {
                $_SESSION['userId'] = $row['user_id'];

                $_SESSION['isAdmin'] = $row['isAdmin'];

                echo "<p>Sucessfully connected</p>";
                header('Location: index.php');
            } else {
                echo "<p style='color: red'>Invalid password or email</p>";
            }
        }
    }
}


if(isset($_POST['logout'])) { 
    session_destroy();
    header("Location: login.php");
}
