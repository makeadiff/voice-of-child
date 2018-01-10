<?php
$name = $_GET["name"];
$address = $_GET["address"];
$phone = $_GET["phone"];
$fName = $_GET["fName"];
$fUrl = $_GET["fUrl"];
$pName = $_GET["pName"];
$pUrl = $_GET["pUrl"];
$price = $_GET["price"];
$bPrice = $_GET["bPrice"];
$bKashNumber = $_GET["bKashNumber"];
$transaction = $_GET["transaction"];
$ownBKash = $_GET["ownBKash"];
$comment = $_GET["comment"];

if (isset($_GET)) {
//    echo '<pre>';
//    print_r($_GET);
}
?>

<!DOCTYPE html>
<html lang="en" >

    <head>
        <meta charset="UTF-8">
        <title>Momoz||Order Preview</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>

        <link rel="stylesheet" href="css/style.css">

        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <link rel="icon" href="/favicon.ico" type="image/x-icon">


    </head>

    <body>
        <div class="container">
            <h1 class="span12 fs-main-title text-center" >Momoz</h1>
            <h2 class="span12 fs-title text-center" style="color: red">Preview Order</h2>
        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <form id="msform" action="submit.php" method="post">
                    <fieldset>
                        <h2 class="fs-subtitle">Personal Details</h2>

                        <label class="label label-default" >Name:</label>
                        <input type="text" name="name" placeholder="Your Full Name" readonly="" value="<?php echo $_GET['name']; ?>"/>
                        <label class="label label-default" >Address:</label>
                        <textarea name="address" placeholder="Enter Your Address" readonly=""><?php echo $_GET['address']; ?></textarea>
                        <label class="label label-default" >Phone:</label>
                        <input type="text" name="phone" placeholder="Phone" value="<?php echo $_GET['phone']; ?>" readonly=""/>
                        <label class="label label-default" >Your Facebook Name:</label>
                        <input type="text" name="fName" placeholder="Your Facebook Name" value="<?php echo $_GET['fName']; ?>" readonly=""/>
                        <label class="label label-default" >Facebook Id Link/URL:</label>
                        <!--<input type="url" name="fUrl" placeholder="Facebook Id Link/URL" value="<?php echo $_GET['fUrl']; ?>" readonly=""/>-->
                        <textarea name="fUrl" readonly=""><?php echo $_GET['fUrl']; ?></textarea>

                        <h2 class="fs-subtitle">Product Details</h2>
                        <label class="label label-default" >Name of The Product:</label>
                        <input type="text" name="pName" placeholder="Name of The Product" value="<?php echo $_GET['pName']; ?>" readonly=""/>
                        <label class="label label-default" >Website link/url to Purchase:</label>
                        <!--<input type="url" name="pUrl" placeholder="Website link/url to Purchase" value="<?php echo $_GET['pUrl']; ?>" readonly=""/>-->
                        <textarea name="pUrl" readonly=""><?php echo $_GET['pUrl']; ?></textarea>

                        <label class="label label-default" >Total Price of the Product in TK:</label>
                        <input type="text" name="price" placeholder="Total Price of the Product in TK" value="<?php echo $_GET['price']; ?>" readonly=""/>
                        <label class="label label-default" >BKashed Amount:</label>
                        <input type="text" name="bPrice" placeholder="BKashed Amount" value="<?php echo $_GET['bPrice']; ?>" readonly=""/>

                        <h2 class="fs-subtitle">Payment Details</h2>
                        <label class="label label-default" >Last 4 Digit of Your BKash Number:</label>
                        <input type="text" name="bKashNumber" placeholder="Last 4 Digit of Your BKash Number" value="<?php echo $_GET['bKashNumber']; ?>" readonly=""/>
                        <label class="label label-default" >Transaction Id:</label>
                        <input type="text" name="transaction" placeholder="Transaction Id" value="<?php echo $_GET['transaction']; ?>" readonly=""/>
                        <label class="label label-default" >The Number You BKash us in:</label>
                        <input type="text" name="ownBKash" placeholder="The Number You BKash us in" value="<?php echo $_GET['ownBKash']; ?>" readonly=""/>
                        <label class="label label-default" >Comments:</label>
                        <textarea name="comment" placeholder="Comments" readonly=""><?php echo $_GET['comment']; ?></textarea>
                        <input type="submit" name="submit" class="submit action-button" value="Submit"/>
                    </fieldset>
                </form>
            </div>
        </div>

    </body>
