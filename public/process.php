<?php
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();
if (!empty($_REQUEST["action"])) {
    switch ($_REQUEST["action"]) {
        case "add":
            $product_name = $_POST["name"];
            $product_code = $_POST["code"];
            $product_price = $_POST["price"];
            $product_image = "product-images/" . $_POST["image"];
            $product_description = $_POST["description"];

            $add_item = $db_handle->insertQuery("INSERT INTO product (name, code, price, image, description)
            VALUES('$product_name','$product_code','$product_price','$product_image','$product_description')");
            header("location: Menu.php");
            exit;
            break;
    }
}
