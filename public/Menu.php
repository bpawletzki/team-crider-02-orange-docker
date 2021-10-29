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
<iframe name="dummyframe" id="dummyframe"></iframe>
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
