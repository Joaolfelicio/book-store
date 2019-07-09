<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <?php
    if(isset($_SESSION['userId'])) {

    echo "<h1>Cart details</h1>";

    require_once 'database.php';
    $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
    
    $order_id = 1; // me

    $db_found = mysqli_select_db($conn, DB_NAME);


    // ! SELECT WITH THIS USER ID AND ONLY THAT ONES THAT ARE PAID

    $query = "SELECT * FROM order_content oc
    INNER JOIN items i on oc.item_id = i.item_id
    INNER JOIN orders o on oc.order_id = o.order_id
    WHERE o.order_id = '$order_id' AND o.paid = 1";
    
    $result = mysqli_query($conn, $query);
    $totalPrice = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        echo $row['title'] . ": ";
        echo '$'. $row['price'] . '<br>';
        $totalPrice += $row['price'];
    }

    echo '<p><strong>The Total is $' . $totalPrice . "</strong></p>";

    ?>

    
<form action="account.php" method="POST">
    <input type="text" name='adress' placeholder="Enter the adress for the delivery">
    <select name="payment" id="">
        <option value="mastercard">MasterCard</option>
        <option value="visa">Visa</option>
        <option value="paypal">Paypal</option>
    </select>
</form>


<?php




    ?>
</body>

</html>
<?php
}
?>