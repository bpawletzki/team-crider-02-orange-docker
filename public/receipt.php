<?php
//session start
session_start();

//connecting to DB
require_once("dbcontroller.php");
$db_handle = new DBController();
$db_handle->connectDB();
?>
<!DOCTYPE HTML>
<html>

<head>

    <title>Love You A Latte</title>
    <?php include('./components/header.php') ?>
</head>

<body>
    <?php include('./components/nav.php') ?>

    <body>
        <br>
        <br>
        <br>
        <br>
        <br>
        <h4>Checkout Receipt</h4>
        <?php

        if (!empty($_SESSION["cart_item"])) {
            date_default_timezone_set("America/New_York");
            $date_clicked = date('Ymdhis');
            $checkout = $db_handle->insertQuery("INSERT INTO checkout (checkoutTime) VALUE('$date_clicked')");
            $checkout_id = $db_handle->getId("SELECT id FROM checkout ORDER BY checkoutTime DESC LIMIT 1");
            $_SESSION["checkoutid"] = $checkout_id;
            foreach ($_SESSION["cart_item"] as $item) {
                $productId = $item["id"];
                $productQuantity = $item["quantity"];
                $productPrice = $item["quantity"] * $item["price"];
                $detail = $db_handle->insertQuery("INSERT INTO checkoutDetail (price, product_id, checkout_id, quantity)
        VALUES('$productPrice','$productId','$checkout_id','$productQuantity')");
            }
        }
        //initialzing total price, receipt number and date/time variables
        $dateAndTime = "";
        $receiptNum = "";
        $totalPrice = 0.0;
        if (!empty($_SESSION["checkoutid"])) {

            //selectng all items from coffee details table
            $results = $db_handle->runQuery("SELECT checkoutDetail.product_id, checkoutDetail.id, checkoutDetail.quantity, checkoutDetail.price, product.name FROM checkoutDetail JOIN product ON checkoutDetail.product_id=product.id WHERE checkout_id='" . $_SESSION["checkoutid"] . "'");
            //looping through the items to display them individually along side their prices and quantities
            foreach ($results as $result) {
                $product_id = $result["product_id"];
                $product_name = $result["name"];
                $id = $result["id"];
                $qty = $result["quantity"];
                $price = $result["price"];

                //selecting date/time from the checkout table and id which will used for the reciept number    
                $dateTime = $db_handle->runQuery("SELECT * FROM checkout WHERE id='" . $_SESSION["checkoutid"] . "'");
                foreach ($dateTime as $datetime) {
                    $receiptNum = $datetime["id"];
                    $dateAndTime = $datetime["checkoutTime"];
                }

                //select the coffee names from the product table using the product_id from the checkoutdetails table
                $coffeeNames = $db_handle->runQuery("SELECT * FROM product WHERE id='$product_id'");
                foreach ($coffeeNames as $coffeeName) {
                    $name = $coffeeName["name"];
                }

                //displaying all required information collected from the DB
                echo
                $name . "<br>" .
                    "Quantity: " .
                    $qty . "<br>" . "Price: " .
                    $price . "<br><br>";
                $totalPrice += $price;
            }
            echo
            "Total Cost: " . $totalPrice . "<br>" .
                "Checkout Time/Date: " .
                $dateAndTime . "<br>" . "Receipt Number: " .
                $receiptNum;
        } else {
            echo "No items in cart.";
        }
        ?>
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-md-4 footer-navigation">
                        <h3><a href="#" style="font-family: 'Abril Fatface', serif;">Love You A Latte</a></h3>
                        <p class="links"><a href="#">Coffee&nbsp;</a><strong> · </strong><a href="#">Order&nbsp;</a><strong> · </strong><a href="#">Relax</a><strong> </strong></p>
                        <p class="company-name">Love You A Latte © 2021</p>
                    </div>
                    <div class="col-sm-6 col-md-4 footer-contacts">
                        <div>
                            <p><span class="new-line-span">0000 PlaceHolder St</span> Columbus, OH</p>
                        </div>
                        <div>
                            <p class="footer-center-info email text-start"> +1 *** ****</p>
                        </div>
                        <div>
                            <p> <a href="#" target="_blank">placeholder@email.com</a></p>
                        </div>
                    </div>
                    <div class="col-md-4 footer-about">
                        <h4>About the company</h4>
                        <p>Place Holder for a summary of a future about the company section</p>
                        <div class="social-links social-icons"></div>
                    </div>
                </div>
            </div>
            <?php include('./components/footer.php') ?>
    </body>

</html>
