<?php
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();
?>
<!DOCTYPE html>
<html>

<head>

    <title>Love You A Latte</title>
    <?php include('./components/header.php') ?>

</head>

<body id="menubody">
<iframe name="dummyframe" id="dummyframe" style="display:none;"></iframe>
<?php include('./components/nav.php') ?>
    <div id="Menuintro">
        <div class="bg-light border rounded border-light jumbotron py-5 px-4">
            <h1 style="font-family: 'Abril Fatface', serif;">Menu</h1>
            <p>Enjoy a Delicious cup of Coffee</p>
        </div>
    </div>
    <section></section>
    <div class="dark-section">
        <div class="container overflow-auto site-section" id="why">
            <div id="product-grid">
	            <!-- <div class="txt-heading">Menu Items</div> -->
                <?php
                $product_array = $db_handle->runQuery("SELECT * FROM product ORDER BY id ASC");
                if (!empty($product_array)) { 
                    foreach($product_array as $key=>$value){
                ?>
                    <div class="product-item">
                        <form method="post" action="cart.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>" target="dummyframe">
                        <div class="product-image"><img src="<?php echo $product_array[$key]["image"]; ?>"></div>
                        <div class="product-tile-footer">
                        <div class="product-title"><?php echo $product_array[$key]["name"]; ?></div>
                        <div class="product-description"><?php echo $product_array[$key]["description"]; ?></div>
                        <select name="creamer-options"> /<!-- the creamer options dropdown menu-->
                        <option value=”0”>Creamer Options</option>
                        <option value=”1”>Skim</option>
                        <option value=”2”>2%</option>
                        <option value=”3”>Whole</option>
                        <option value=”4”>Soy</option>
                        <option value=”5”>Almond</option>
                        <option value=”6”>None</option>

                        </select>
                        <br>
                        <div class="product-price"><?php echo "$".$product_array[$key]["price"]; ?></div>
                        <div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1" size="2" /><input type="submit" value="Add to Cart" class="btnAddAction" /></div>
                        </div>
                        </form>
                    </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>

        <?php include('./components/footer.php') ?>
</body>

</html>
