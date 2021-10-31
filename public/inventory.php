
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
        </form>
            <button type="add" form= "inventoryForm" name="add" value="Add Item">Add Item</button>
            <button type="delete" form= "inventoryForm" name="delete" value="Delete Item">Delete Item</button>
            <button type="update" form= "inventoryForm" name="update" value="Update Item">Update Item Details</button>
        </div><br>

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