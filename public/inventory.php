<?php
session_start();
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

    <div class="container site-section" id="inventoryDetails">
        <h1 style="font-family: 'Abril Fatface', serif;">Update Inventory</h1>
        <form method="post" action="process.php" id="inventoryForm">
            <label for="productName">Product Name:</label>
            <input type="text" id="productName" name="name"><br><br>
            <label for="productCode">Product Code (SKU):</label>
            <input type="text" id="productCode" name="code"><br><br>
            <label for="productPrice">Product Price:</label>
            <input type="text" id="productPrice" name="price"><br><br>
            <label for="productDescription">Product description:</label>
            <input type="text" id="productDescription" name="description"><br><br>
            <label for="img">Select image:</label>
            <input type="file" id=productImage" name="image" accept="image/*">
        </form>
            <button type="add" form= "inventoryForm" name="add" value="Add Item" href="process.php?action=add">Add Item</button>
            <button type="delete" form= "inventoryForm" name="delete" value="Delete Item" href="process.php?action=delete">Delete Item</button>
            <button type="update" form= "inventoryForm" name="update" value="Update Item" href="process.php?action=update">Update Item Details</button>
        </div><br>

        <?php include('./components/footer.php') ?>
</body>
</html>