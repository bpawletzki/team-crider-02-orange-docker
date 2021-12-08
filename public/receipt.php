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
    <div id="CheckoutReceipt">
        <div class="bg-light border rounded border-light jumbotron py-5 px-4">
            <p></p>
        </div>
    </div>
    <div class="container overflow-auto site-section" id="receipt">
        <h2>Checkout Receipt</h2>
        <?php
        function guidv4($data = null)
        {
            // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
            $data = $data ?? random_bytes(16);
            assert(strlen($data) == 16);

            // Set version to 0100
            $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
            // Set bits 6-7 to 10
            $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

            // Output the 36 character UUID.
            return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
        }

        if (!empty($_SESSION["cart_item"])) {
            date_default_timezone_set("America/New_York");
            $date_clicked = date('Ymdhis');
            $reciept_uuid = guidv4();
            if (!empty($_SESSION["empLoggedin"]) && $_SESSION["empLoggedin"]) {
                $user_id = $_SESSION["employeeid"];
            }
            if (!empty($_SESSION["username"]) && $_SESSION["userLoggedin"]) {
                $user_id = $_SESSION["username"];
            }
            if (empty($user_id)) {
                $user_id = $_SERVER["REMOTE_ADDR"];
            }

            $checkout = $db_handle->insertQuery("INSERT INTO checkout (checkoutTime, uuid, accountid) VALUE('$date_clicked', '$reciept_uuid', '$user_id')");
            $checkout_id = $db_handle->getId("SELECT id FROM checkout WHERE uuid='$reciept_uuid'");
            $_SESSION["checkoutid"] = $checkout_id;
            foreach ($_SESSION["cart_item"] as $item) {
                $productId = $item["id"];
                $productQuantity = $item["quantity"];
                $productPrice = $item["quantity"] * $item["price"];
                $productOption = $item["creamer"];
                $productOption2 = $item["sweetener"];
                $productOption3 = $item["syrup"];
                $productOption3quantity = $item["pumps"];
                $detail = $db_handle->insertQuery("INSERT INTO checkoutDetail (price, product_id, checkout_id, quantity, creamer, sweetener, syrup, pumps)
        VALUES('$productPrice','$productId','$checkout_id','$productQuantity', '$productOption', '$productOption2', '$productOption3', '$productOption3quantity')");
            }
            #Send notification to weekly sales report node-red /checkout to let it know to update the report screen.
            $curl = curl_init("http://node-red:1880/checkout");
            curl_setopt($curl, CURLOPT_TIMEOUT_MS, 1);
            $output = curl_exec($curl);
            curl_close($curl);
        }
        //initialzing total price, receipt number and date/time variables
        $dateAndTime = "";
        $receiptNum = "";
        $totalPrice = 0.0;
        if (!empty($_SESSION["checkoutid"])) {

            //selectng all items from coffee details table
            $results = $db_handle->runQuery("SELECT checkoutDetail.product_id, checkoutDetail.id, checkoutDetail.quantity, checkoutDetail.price, product.name, checkoutDetail.creamer, checkoutDetail.sweetener, checkoutDetail.syrup, checkoutDetail.pumps FROM checkoutDetail JOIN product ON checkoutDetail.product_id=product.id WHERE checkout_id='" . $_SESSION["checkoutid"] . "'");
            //looping through the items to display them individually along side their prices and quantities
            foreach ($results as $result) {
                $product_id = $result["product_id"];
                $product_name = $result["name"];
                $id = $result["id"];
                $qty = $result["quantity"];
                $price = $result["price"];
                $productOption = $result["creamer"];
                $productOption2 = $result["sweetener"];
                $productOption3 = $result["syrup"];
                $productOption3quantity = $result["pumps"];


                //adding price per syrup pump
                if (!empty($productOption3) && $productOption3 != "None") {
                    if (empty($productOption3quantity)) {
                        $productOption3quantity = 1;
                    }
                    $price = $price + ($productOption3quantity * 0.25);
                }

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
                $receiptDetails = $name . "<br>" . "Quantity: " . $qty;
                if (!empty($productOption) && $productOption != "None") {
                    $receiptDetails = $receiptDetails . "<br>" . "Creamer: " . $productOption;
                }
                if (!empty($productOption2) && $productOption2 != "None") {
                    $receiptDetails = $receiptDetails . "<br>" . "Sweetener: " . $productOption2;
                }
                if (!empty($productOption3) && $productOption3 != "None") {
                    $receiptDetails = $receiptDetails . "<br>" . "Syrup: " . $productOption3;
                    if (!empty($productOption3quantity)) {
                        $receiptDetails = $receiptDetails . "<br>" . "Syrup pumps: " . $productOption3quantity . " @ $0.25/pump";
                    }
                }

                $receiptDetails = $receiptDetails .
                    "<br>" . "Price: $" . number_format($price, 2) .
                    "<br><br>";
                echo $receiptDetails;
                $totalPrice += $price;
            }
            echo
            "Total Cost: $" . number_format($totalPrice, 2) . "<br>" .
                "Checkout Time/Date: " .
                $dateAndTime . "<br>" . "Receipt Number: " .
                $receiptNum;
            unset($_SESSION["cart_item"]);
            unset($checkout_id);
            unset($_SESSION["checkoutid"]);
        } else {
            echo "No items in cart.";
        }
        ?>
    </div>
    <?php include('./components/footer.php') ?>
</body>

</html>