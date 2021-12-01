<?php
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();
if (!empty($_GET["action"])) {
	switch ($_GET["action"]) {
		case "add":
			if (!empty($_POST["quantity"])) {
				$productByCode = $db_handle->runQuery("SELECT * FROM product WHERE code='" . $_GET["code"] . "'");
				$k = $productByCode[0]["code"] . $_POST["creamer-options"] . $_POST["sweetener-options"] . $_POST["syrup-options"];
				$itemArray = array($k => array('name' => $productByCode[0]["name"], 'code' => $productByCode[0]["code"], 'quantity' => $_POST["quantity"], 'price' => $productByCode[0]["price"], 'image' => $productByCode[0]["image"], 'id' => $productByCode[0]["id"], 'creamer' => $_POST["creamer-options"], 'sweetener' => $_POST["sweetener-options"], 'syrup' => $_POST["syrup-options"]));
				// echo $itemArray;
				if (!empty($_SESSION["cart_item"])) {
					$resultsArraySearch = preg_grep("/.*?" . $productByCode[0]["code"] . $_POST["creamer-options"] . $_POST["sweetener-options"] . $_POST["syrup-options"] . "*?./i", array_keys($_SESSION["cart_item"]));
					if ($resultsArraySearch) {
						if (empty($_SESSION["cart_item"][$k]["quantity"])) {
							$_SESSION["cart_item"][$k]["quantity"] = 0;
						}
						$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
					} else {
						$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"], $itemArray);
					}
				} else {
					$_SESSION["cart_item"] = $itemArray;
				}
			}
			break;
		case "remove":
			if (!empty($_SESSION["cart_item"])) {
				foreach ($_SESSION["cart_item"] as $k => $v) {
					if ($_GET["code"] == $k)
						unset($_SESSION["cart_item"][$k]);
					if (empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
				}
			}
			break;
		case "empty":
			unset($_SESSION["cart_item"]);
			break;
		case "checkout":
			// if(!empty($_SESSION["cart_item"])) {
			// 	date_default_timezone_set("America/New_York");
			// 	$date_clicked = date('Ymdhis');
			// 	$checkout = $db_handle->insertQuery("INSERT INTO checkout (checkoutTime) VALUE('$date_clicked')");
			// 	$checkout_id = $db_handle->getId("SELECT id FROM checkout ORDER BY checkoutTime DESC LIMIT 1");
			// 	$_SESSION["checkoutid"] = $checkout_id;
			// 	foreach($_SESSION["cart_item"] as $item) {
			// 		$productId = $item["id"];
			// 		$productQuantity = $item["quantity"];
			// 		$productPrice = $item["quantity"]*$item["price"];
			// 		$detail = $db_handle->insertQuery("INSERT INTO checkoutDetail (price, product_id, checkout_id, quantity)
			// 		VALUES('$productPrice','$productId','$checkout_id','$productQuantity')");
			// 	 }
			// }
	}
}
?>
<HTML>

<HEAD>
	<TITLE>Love You A Latte Order</TITLE>
	<?php include('components/header.php') ?>

</HEAD>

<BODY>
	<?php include('./components/nav.php') ?>
	<div id="shopping-cart">
		<div class="txt-heading">Ordered Items</div>

		<a id="btnEmpty" href="cart.php?action=empty">Empty Cart</a>
		<?php
		if (isset($_SESSION["cart_item"])) {
			$total_quantity = 0;
			$total_price = 0;
		?>
			<table class="tbl-cart" cellpadding="10" cellspacing="1">
				<tbody>
					<tr>
						<th style="text-align:left;">Name</th>
						<th style="text-align:left;">Creamer Options</th>
						<th style="text-align:left;">Sweetner Options</th>
						<th style="text-align:left;">Syrup Options</th>
						<th style="text-align:left;">Code</th>
						<th style="text-align:right;" width="5%">Quantity</th>
						<th style="text-align:right;" width="10%">Order Price</th>
						<th style="text-align:right;" width="10%">Price</th>
						<th style="text-align:center;" width="5%">Remove</th>
					</tr>
					<?php
					foreach ($_SESSION["cart_item"] as $item) {
						if($item["syrup"]!="None"){
							$item_price = $item["quantity"] * ($item["price"]+0.25);
												}
												else{
													$item_price = $item["price"]*$item["quantity"];
												}
					?>
						<tr>
							<td><img src="<?php echo $item["image"]; ?>" class="cart-item-image" /><?php echo $item["name"]; ?>
							</td>
							<td> <?php echo $item["creamer"]; ?></td><!-- the creamer options are supposed to print, the variable is added at the end of line 10-->
							<td> <?php echo $item["sweetener"]; ?></td><!-- the sweetener options are supposed to print, the variable is added at the end of line 10-->
							<td> <?php echo $item["syrup"]; 
							?></td><!-- the syrup options are supposed to print, the variable is added at the end of line 10-->
							<td><?php echo $item["code"]; ?></td>
							<td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
							<td style="text-align:right;"><?php echo "$ " . $item["price"]; ?></td>
							<td style="text-align:right;"><?php echo "$ " . number_format($item_price, 2); ?></td>
							<td style="text-align:center;"><a href="cart.php?action=remove&code=<?php echo $item["code"].$item["creamer"].$item["sweetener"].$item["syrup"]; ?>" class="btnRemoveAction"><img src="./assets/img/icon-delete.png" alt="Remove Item" /></a></td>
						</tr>
					<?php
						$total_quantity += $item["quantity"];
						$total_price += $item_price;
					}		?>

					<tr>
						<td colspan="4" align="right">Total:</td>
						<td align="right"><?php echo $total_quantity; ?></td>
						<td align="right" colspan="2"><strong><?php echo "$ " . number_format($total_price, 2); ?></strong>
						</td>
						<td></td>
					</tr>
				</tbody>
			</table>
		<?php
		} else {
		?>
			<div class="no-records">Your Cart is Empty</div>
		<?php
		}
		?> <a id="btnEmpty" href="receipt.php?action=checkout">Checkout</a>
	</div>

	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
</BODY>

</HTML>