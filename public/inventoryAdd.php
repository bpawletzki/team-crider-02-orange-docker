<?php
session_start();
// only allow access if logged in
if (is_null($_SESSION["empLoggedin"]) || !($_SESSION["empLoggedin"])) {
    // Redirect to login page
    header("location: employeeLogin.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
head>

<title>Love You A Latte</title>
<?php include('./components/header.php') ?>

</head>

<body>
    <?php include('./components/nav.php') ?>

    <div id="inventory">
        <div class="bg-light border rounded border-light jumbotron py-5 px-4">
            <h1 style="font-family: 'Abril Fatface', serif;">Inventory</h1>
            <p></p>
        </div>
    </div>
    <?php

    ?>

    <div class="container site-section" id="inventoryDetails">
        <h1 style="font-family: 'Abril Fatface', serif;">Add Inventory</h1>
        <form method="post" action="process.php" id="inventoryForm">
            <label for="productName">Product Name:</label>
            <input type="text" id="productName" name="name"><br><br>
            Size:
            <select name="size">
                <option value="Small">Small</option>
                <option value="Medium">Medium</option>
                <option value="Large">Large</option>
            </select><br><br>
            <label for="productCode">Product Code (SKU):</label>
            <input type="text" id="productCode" name="code"><br><br>
            <label for="productCategory">Product Category: hot/iced/frozen</label>
            <input type="text" id="productCategory" name="category"><br><br>
            <label for="productPrice">Product Price:</label>
            <input type="text" id="productPrice" name="price"><br><br>
            <label for="productDescription">Product description:</label>
            <input type="text" id="productDescription" name="description"><br><br>
            <label for="img">Select image:</label>
            <input type="file" id="productImage" name="image" accept="image/*">
        </form>
        <br>
            <button type="add" form= "inventoryForm" name="action" value="add" href="process.php">Add Item</button>
        </div><br>

    <?php include('./components/footer.php') ?>
</body>

</html>