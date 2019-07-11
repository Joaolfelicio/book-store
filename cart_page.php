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
p{
    padding: 15px;
}

article h1{
    margin-bottom: 55px;
    padding-left: 2
}

input {
    margin: 15px;
    margin-bottom: 50px;
}

        </style>
</head>

<body>
<?php
    require "navbar.php";

    if(isset($_SESSION['userId'])) {
        $userId = $_SESSION['userId'];
        $payed = false;
        echo "<h1>Cart details</h1>";

        require_once 'database.php';
        $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
        $user_id = $_SESSION['userId'];

        $db_found = mysqli_select_db($conn, DB_NAME);


        // ! SELECT WITH THIS USER ID AND ONLY THAT ONES THAT ARE NOT PAID
        // ! IN THE ORDER PAGE IT WILL BE THE SAME BUT FOR PAID = 1

        $query = "SELECT * FROM order_content oc
        INNER JOIN items i on oc.item_id = i.item_id
        INNER JOIN orders o on oc.order_id = o.order_id
        WHERE o.user_id = '$user_id' AND o.paid = 0 ORDER BY oc.order_id";
        
        $result = mysqli_query($conn, $query);
        $totalPrice = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<p>" . $row['title'] . ": $" . $row['price'] . '</p>';
            $totalPrice += $row['price'];
        }
        if($totalPrice != 0) {
            echo '<p><strong>The Total is $' . $totalPrice . "</strong></p>";
        } else {
            echo '<p><strong>Your cart is empty</strong></p>';
        }

        if(isset($_POST['pay'])) {

            if(!empty($_POST['payment']) && !empty($_POST['address']) ) {
                
                $queryPay = "UPDATE orders SET paid = 1 WHERE user_id = '$userId' AND paid = 0";
                $resultPay = mysqli_query($conn, $queryPay);

                if($resultPay) {
                    echo "<p><strong>Payed sucessfully.</strong></p>";

                } else {
                    echo "<p style='color: red'><strong>Connection to the server failed.</strong></p>";
                }
                

            } else {
                echo "<p style='color: red'> Please fill the required fields</p>";
            }
        }

        if($totalPrice != 0) {
    ?>


<form action="" method="POST">
    <input type="text" name='address' placeholder="Enter the address for the delivery">
    <select name="payment" id="">
        <option value="">-----</option>
        <option value="mastercard">MasterCard</option>
        <option value="visa">Visa</option>
        <option value="paypal">Paypal</option>
    </select>
    <input type="submit" value="Pay now!" name='pay'>
</form>

<?php } ?>

</body>

</html>
<?php } ?>