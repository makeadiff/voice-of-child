<?php

if (isset($_POST['submit'])) {
//    echo '<pre>';
//    print_r($_POST);
//    $message = add_info();
//    echo $message;
    add_info();
    echo '<script type="text/javascript">';
    echo 'alert("Info Saved Successfully!");';
    echo 'window.location.href = "index.php";';
    echo '</script>';
}

function add_info() {

    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $fName = $_POST['fName'];
    $fUrl = $_POST['fUrl'];
    $pName = $_POST['pName'];
    $pUrl = $_POST['pUrl'];
    $price = $_POST['price'];
    $bPrice = $_POST['bPrice'];
    $bKashNumber = $_POST['bKashNumber'];
    $transaction = $_POST['transaction'];
    $ownBKash = $_POST['ownBKash'];
    $comment = $_POST['comment'];

    $db_connect = mysqli_connect('localhost', 'root', '');
    if ($db_connect) {
        mysqli_select_db($db_connect, 'db_momoz');
    }
    $sql = "INSERT INTO customer_info (name, address, phone, fName, fUrl, pName, pUrl, price, bPrice, bKashNumber, transaction, ownBKash, comment) VALUES ('$name', '$address', '$phone', '$fName', '$fUrl', '$pName', '$pUrl', '$price', '$bPrice', '$bKashNumber', '$transaction', '$ownBKash', '$comment')";
    if (mysqli_query($db_connect, $sql)) {
        $message = "Info Saved Successfully!";
        return $message;
    } else {
        die('Query Problem' . mysqli_error($db_connect));
    }
}

?>
