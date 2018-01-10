<!DOCTYPE html>
<html lang="en" >

    <head>
        <meta charset="UTF-8">
        <title>Momoz||Order Form</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>

        <link rel="stylesheet" href="css/style.css">

        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="icon" href="favicon.ico" type="image/x-icon">


    </head>

    <body>
        <div class="container">
            <h1 class="span12 fs-main-title text-center" >Momoz</h1>
            <h2 class="span12 fs-title text-center" style="color: red">Order Form</h2>
        </div>
        <!-- MultiStep Form -->
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <form id="msform" action="preview.php" method="get">
                    <!-- progressbar -->
                    <ul id="progressbar">
                        <li class="active">Personal Details</li>
                        <li>Product Details</li>
                        <li>Payment Details</li>
                    </ul>
                    <!-- fieldsets -->
                    <fieldset>
                        <h2 class="fs-title">Personal Details</h2>
                        <h3 class="fs-subtitle">Tell us about you</h3>
                        <input type="text" name="name" placeholder="Your Full Name" required=""/>
                        <!--<input type="text" name="address" placeholder="Address"/>-->
                        <textarea name="address" placeholder="Enter Your Address" required=""></textarea>
                        <input type="text" name="phone" placeholder="Phone" required=""/>
                        <input type="text" name="fName" placeholder="Your Facebook Name" required=""/>
                        <input type="url" name="fUrl" placeholder="Facebook Id Link/URL" required=""/>
                        <input type="button" name="next" class="next action-button" value="Next"/>
                    </fieldset>
                    <fieldset>
                        <h2 class="fs-title">Product Details</h2>
                        <h3 class="fs-subtitle">Your product info</h3>
                        <input type="text" name="pName" placeholder="Name of The Product" required=""/>
                        <input type="url" name="pUrl" placeholder="Website link/url to Purchase" required=""/>
                        <input type="text" name="price" placeholder="Total Price of the Product in TK" required=""/>
                        <input type="text" name="bPrice" placeholder="BKashed Amount" required=""/>
                        <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                        <input type="button" name="next" class="next action-button" value="Next"/>
                    </fieldset>
                    <fieldset>
                        <h2 class="fs-title">Payment Details</h2>
                        <h3 class="fs-subtitle">Fill in your payment details</h3>
                        <input type="text" name="bKashNumber" placeholder="Last 4 Digit of Your BKash Number" required=""/>
                        <input type="text" name="transaction" placeholder="Transaction Id" required=""/>
                        <input type="text" name="ownBKash" placeholder="The Number You BKash us in" required=""/>
                        <textarea name="comment" placeholder="Comments"></textarea>
                        <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                        <input type="submit" name="submit" class="submit action-button" value="Submit"/>
                    </fieldset>
                </form>
            </div>
        </div>
        <!-- /.MultiStep Form -->
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
        <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js'></script>


        <script  src="js/index.js"></script>

    </body>

</html>