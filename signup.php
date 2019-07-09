<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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
    <h1>SIGNUP</h1>

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
<?php
}

?>
    
</body>
</html>
<?php

include_once ('database.php');

if(isset($_POST['create'])) {

    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = htmlspecialchars($_POST['password']);
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);

    if(filter_var($email, FILTER_VALIDATE_EMAIL) && strlen($password) > 3 && strlen($first_name) > 3 && strlen($last_name) > 3) {

        $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD);
        $password = password_hash($password, PASSWORD_DEFAULT);
        
        $db_found = mysqli_select_db($connection, DB_NAME);
        
        $query = "INSERT INTO users (first_name, last_name, email, password) VALUES('$first_name', '$last_name', '$email', '$password')";
        $result = mysqli_query($connection, $query);
   
            if($result) {

                $query2 = "SELECT * FROM users WHERE email = '$email'";
                $result2 = mysqli_query($connection, $query2);

                while($row = mysqli_fetch_assoc($result2)) {
                    $_SESSION['userId'] = $row['user_id'];
                }

                echo "<p>Account sucessfully created</p>";
                
                header('Location: index.php');
            }
        } else {
            echo "<p style='color: red'>Invalid fields</p>";
        }
    }

if(isset($_POST['logout'])) { 
    session_destroy();
    header("Location: signup.php");
}
