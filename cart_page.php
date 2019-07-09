<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1>Cart details</h1>
    <?php
    // to work with database , we will use a function call :mysqli
    require_once 'database.php';
    $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
    echo 'connection successfull <br>';
    //  choose which database that i want to work with
    $user_id = 1;

    $db_found = mysqli_select_db($conn, DB_NAME);
    echo DB_NAME . ' found!' . '<br>';
    echo '<hr>';
    $query = "SELECT * FROM card
    INNER JOIN users on users.user_id = card.user_id
    INNER JOIN items on items.item_id = card.item_id WHERE users.user_id = '$user_id'";
    $result = mysqli_query($conn, $query);
    $totalPrice = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        echo $row['title'] . ": ";
        echo '$'. $row['price'] . '<br>';
        $totalPrice += $row['price'];
    }
    echo 'The Total is $' . $totalPrice;




    ?>
</body>

</html>