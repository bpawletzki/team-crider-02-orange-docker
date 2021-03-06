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
        <div class="rounded border-light jumbotron py-5 px-4">
            <h1 style="font-family: 'Abril Fatface', serif;">Iced Drinks</h1>
            <p>Enjoy a Delicious cup of Coffee</p>
        </div>
    </div>
    <section></section>
    <div class="dark-section">
        <div class="container overflow-auto site-section" id="why">
            <div id="product-grid">
	            <!-- <div class="txt-heading">Menu Items</div> -->
                <?php
                $product_array = $db_handle->runQuery("SELECT * FROM product WHERE category='iced' ORDER BY id ASC");
                if (!empty($product_array)) { 
                    foreach($product_array as $key=>$value){
                ?>
                    <div class="product-item">
                        <form method="post" action="cart.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>" target="dummyframe" autocomplete="off">
                        <div class="product-image"><img src="<?php echo $product_array[$key]["image"]; ?>"></div>
                        <div class="product-tile-footer">
                        <div class="product-title"><?php echo $product_array[$key]["name"]; ?></div>
                        <div class="product-description"><?php echo $product_array[$key]["description"]; ?></div>
                        <select name="creamer-options"> /<!-- the creamer options dropdown menu-->
                        <option value="None">Creamer Options</option>
                        <option value="Skim">Skim</option>
                        <option value="2%">2%</option>
                        <option value="Whole">Whole</option>
                        <option value="Soy">Soy</option>
                        <option value="Almond">Almond</option>
                        <option value="None">None</option>
                        </select>
                        <select name="sweetener-options"> /<!-- the sweetener options dropdown menu-->
                        <option value="None">Sweetener Options</option>
                        <option value="Sugar">Sugar</option>
                        <option value="Sweet and low">Sweet and low</option>
                        <option value="Stevia">Stevia</option>
                        <option value="Honey">Honey</option>
                        <option value="None">None</option>
                        </select>
                        <select name="syrup-options"> /<!-- the syrup options dropdown menu-->
                        <option value="None">Syrup $0.25/pump</option>
                        <option value="chocolate">Chocolate</option>
                        <option value="vanilla">Vanilla</option>
                        <option value="caramel">Caramel</option>
                        <option value="cinnamon">Cinnamon</option>
                        <option value="None">None</option>
                        </select>
                        <div style="float: left;" class="syrup-pumps"><input type="number" min="0" name="pumps" value="0" size="2" /></div>
                        <br>
                        Espresso $1.50 per shot
                        <div style="float: center;" class="espresso-shots"><input type="number" min="0" max="20" name="shots" value="0" size="2" /></div>
                        <br>

                        <div class="product-price"><?php echo "$".$product_array[$key]["price"]; ?></div>
                        <div class="cart-action"><input type="number" class="product-quantity" name="quantity" min="0" value="1" size="2" /><input type="submit" value="Add to Cart" class="btnAddAction" /></div>
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