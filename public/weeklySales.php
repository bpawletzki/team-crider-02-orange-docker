<?php
session_start();
// only allow access if logged in
if (is_null($_SESSION["empLoggedin"]) || !($_SESSION["empLoggedin"])) {
    // Redirect to login page
    header("location: employeeLogin.php");
    exit;
}
require_once("dbcontroller.php");
$db_handle = new DBController();

?>
<!DOCTYPE html>
<html>

<head>

    <title>Love You A Latte</title>
    <?php include('./components/header.php') ?>

</head>

<body>
    <?php include('./components/nav.php') ?>
    <div id="inventory">
        <div class="bg-light border rounded border-light jumbotron py-5 px-4">
            <h1 style="font-family: 'Abril Fatface', serif;">Weekly Report</h1>
            <p></p>
        </div>
    </div>

    <div class="container site-section" id="inventoryDetails">
        <h1 style="font-family: 'Abril Fatface', serif;">&nbsp;</h1>
        <div id="dataTable">
          <table class="table table-hover table-dark">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Product</th>
                        <th scope="col">Monday</th>
                        <th scope="col">Tuesday</th>
                        <th scope="col">Wednesday</th>
                        <th scope="col">Thursday</th>
                        <th scope="col">Friday</th>
                        <th scope="col">Saturday</th>
                        <th scope="col">Sunday</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $product_array = $db_handle->runQuery("SELECT i.id, i.name,
                    SUM(CASE WHEN vdayOfWeek = 0 THEN coalesce(total,0) END) \"0\",
                    SUM(CASE WHEN vdayOfWeek = 1 THEN coalesce(total,0) END) \"1\",
                    SUM(CASE WHEN vdayOfWeek = 2 THEN coalesce(total,0) END) \"2\",
                    SUM(CASE WHEN vdayOfWeek = 3 THEN coalesce(total,0) END) \"3\",
                    SUM(CASE WHEN vdayOfWeek = 4 THEN coalesce(total,0) END) \"4\",
                    SUM(CASE WHEN vdayOfWeek = 5 THEN coalesce(total,0) END) \"5\",
                    SUM(CASE WHEN vdayOfWeek = 6 THEN coalesce(total,0) END) \"6\",
                    sum(total) as productTotal
                    FROM (select p.id, p.name, sum(cd.price)+sum(cd.pumps)*0.25 as total, weekday(c.checkoutTime) as vdayOfWeek
                    FROM product as p
                    LEFT JOIN checkoutDetail as cd ON p.id=cd.product_id
                    LEFT JOIN checkout as c ON cd.checkout_id=c.id
                    WHERE c.checkoutTime>DATE_ADD(c.checkoutTime, INTERVAL -1 WEEK) OR c.checkoutTime is Null
                    GROUP BY p.id) as i
                    GROUP BY i.id
                    ORDER BY i.id
                    ");
                    $total0=0;
                    $total1=0;
                    $total2=0;
                    $total3=0;
                    $total4=0;
                    $total5=0;
                    $total6=0;
                    $totalWeek=0;

                    if (!empty($product_array)) {
                        foreach ($product_array as $key => $value) {
                    ?>
                            <tr>
                                <th scope="row"><?php echo $product_array[$key]["id"]; ?></th>
                                <td><?php echo $product_array[$key]["name"]; ?></td>
                                <td><?php if (($product_array[$key]["0"])!=0) {printf("$%.2f", $product_array[$key]["0"]);$total0=$product_array[$key]["0"]+$total0;}; ?></td>
                                <td><?php if (($product_array[$key]["1"])!=0) {printf("$%.2f", $product_array[$key]["1"]);$total1=$product_array[$key]["1"]+$total1;}; ?></td>
                                <td><?php if (($product_array[$key]["2"])!=0) {printf("$%.2f", $product_array[$key]["2"]);$total2=$product_array[$key]["2"]+$total2;}; ?></td>
                                <td><?php if (($product_array[$key]["3"])!=0) {printf("$%.2f", $product_array[$key]["3"]);$total3=$product_array[$key]["3"]+$total3;}; ?></td>
                                <td><?php if (($product_array[$key]["4"])!=0) {printf("$%.2f", $product_array[$key]["4"]);$total4=$product_array[$key]["4"]+$total4;}; ?></td>
                                <td><?php if (($product_array[$key]["5"])!=0) {printf("$%.2f", $product_array[$key]["5"]);$total5=$product_array[$key]["5"]+$total5;}; ?></td>
                                <td><?php if (($product_array[$key]["6"])!=0) {printf("$%.2f", $product_array[$key]["6"]);$total6=$product_array[$key]["6"]+$total6;}; ?></td>
                                <td><?php if (($product_array[$key]["productTotal"])!=0) {printf("$%.2f", $product_array[$key]["productTotal"]);$totalWeek=$product_array[$key]["productTotal"]+$totalWeek;}; ?></td>
                            </tr>
                    <?php
                        }
                        ?>
                        <tr>
                        <th scope="row">Totals</th>
                        <td>All Products</td>
                        <td><?php if (($product_array[$key]["0"])!=0) {printf("$%.2f", $total0);}; ?></td>
                        <td><?php if (($product_array[$key]["1"])!=0) {printf("$%.2f", $total1);}; ?></td>
                        <td><?php if (($product_array[$key]["2"])!=0) {printf("$%.2f", $total2);}; ?></td>
                        <td><?php if (($product_array[$key]["3"])!=0) {printf("$%.2f", $total3);}; ?></td>
                        <td><?php if (($product_array[$key]["4"])!=0) {printf("$%.2f", $total4);}; ?></td>
                        <td><?php if (($product_array[$key]["5"])!=0) {printf("$%.2f", $total5);}; ?></td>
                        <td><?php if (($product_array[$key]["6"])!=0) {printf("$%.2f", $total6);}; ?></td>
                        <td><?php if (($product_array[$key]["productTotal"])!=0) {printf("$%.2f", $totalWeek);}; ?></td>
                       </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div><br>
    <div class="container site-section" id=responseStatusDisplay></div>
    <script type="text/javascript" src="./assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="./assets/bootstrap/js/bootstrap.min.js"></script>
    <?php include('./components/footer.php') ?>
</body>

</html>