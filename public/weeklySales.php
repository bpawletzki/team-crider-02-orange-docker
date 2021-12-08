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
    <script type="text/javascript">
        var ws;
        var wsUri = "ws:";
        var loc = window.location;
        console.log(loc);
        if (loc.protocol === "https:") {
            wsUri = "wss:";
        }
        // This needs to point to the web socket in the Node-RED flow
        // ... in this case it's ws/simple
        wsUri += "//" + loc.host + ":1880" + loc.pathname.replace("simple", "ws/simple");
        wsUri = "wss://capstoneorange02-env.eba-3h2pxmkf.us-east-1.elasticbeanstalk.com:1883/ws/simple";

        function wsConnect() {
            console.log("connect", wsUri);
            ws = new WebSocket(wsUri);

            //var line = "";    // either uncomment this for a building list of messages
            ws.onmessage = function(msg) {
                var vDate = new Date();
                var line = ""; // or uncomment this to overwrite the existing message
                // parse the incoming message as a JSON object
                var data = msg.data;
                //console.log(data);
                // build the output from the topic and payload parts of the object
                line += "<p>" + data + "</p>";
                // replace the messages div with the new "line"
                document.getElementById('messages').innerHTML = line;
                document.getElementById('status').innerHTML = "Connected: Last update: " + vDate.toLocaleTimeString();

                //ws.send(JSON.stringify({data:data}));
            }
            ws.onopen = function() {
                // update the status div with the connection status
                document.getElementById('status').innerHTML = "Connected";
                //ws.send("Open for data");
                console.log("connected");
            }
            ws.onclose = function() {
                // update the status div with the connection status
                document.getElementById('status').innerHTML = "Not Connected";
                // in case of lost connection tries to reconnect every 3 secs
                setTimeout(wsConnect, 3000);
            }
        }

        function doit(m) {
            if (ws) {
                ws.send(m);
            }
        }
    </script>
</head>

<body onload="wsConnect();" onunload="ws.disconnect();">
    <?php include('./components/nav.php') ?>
    <div id="inventory">
        <div class="bg-light border rounded border-light jumbotron py-5 px-4">
            <h1 style="font-family: 'Abril Fatface', serif;">Weekly Report</h1>
            <p></p>
        </div>
    </div>

    <div class="container site-section" id="inventoryDetails">
        <br>
        <span>Live data feed: </span><span id="status">unknown</span>
<p></p>
        <div id="messages"><table class="table table-hover table-dark table-sm">
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
                    CAST(SUM(CASE WHEN vdayOfWeek = 0 THEN coalesce(total,0) END) * 1.00 AS DECIMAL(18,2)) AS \"mon\", 
                    CAST(SUM(CASE WHEN vdayOfWeek = 1 THEN coalesce(total,0) END) * 1.00  AS DECIMAL(18,2)) AS \"tue\", 
                    CAST(SUM(CASE WHEN vdayOfWeek = 2 THEN coalesce(total,0) END) * 1.00  AS DECIMAL(18,2)) AS \"wed\", 
                    CAST(SUM(CASE WHEN vdayOfWeek = 3 THEN coalesce(total,0) END) * 1.00  AS DECIMAL(18,2)) AS \"thr\", 
                    CAST(SUM(CASE WHEN vdayOfWeek = 4 THEN coalesce(total,0) END) * 1.00  AS DECIMAL(18,2)) AS \"fri\", 
                    CAST(SUM(CASE WHEN vdayOfWeek = 5 THEN coalesce(total,0) END) * 1.00  AS DECIMAL(18,2)) AS \"sat\", 
                    CAST(SUM(CASE WHEN vdayOfWeek = 6 THEN coalesce(total,0) END) * 1.00 AS DECIMAL(18,2)) AS \"sun\", 
                    CAST(sum(total) * 1.00 AS DECIMAL(18,2)) as productTotal FROM (select p.id, p.name, 
                    sum(cd.price)+(cd.quantity*sum(cd.pumps)*0.25) as total, 
                    weekday(c.checkoutTime) as vdayOfWeek 
                    FROM product as p 
                    LEFT JOIN checkoutDetail as cd ON p.id=cd.product_id 
                    LEFT JOIN checkout as c ON cd.checkout_id=c.id 
                    WHERE c.checkoutTime>DATE_ADD(c.checkoutTime, INTERVAL -1 WEEK) OR c.checkoutTime is Null GROUP BY p.id) as i GROUP BY i.id ORDER BY i.id ;
                    
                    ");
                    $total0 = 0;
                    $total1 = 0;
                    $total2 = 0;
                    $total3 = 0;
                    $total4 = 0;
                    $total5 = 0;
                    $total6 = 0;
                    $totalWeek = 0;

                    if (!empty($product_array)) {
                        foreach ($product_array as $key => $value) {
                    ?>
                            <tr>
                                <th scope="row"><?php echo $product_array[$key]["id"]; ?></th>
                                <td><?php echo $product_array[$key]["name"]; ?></td>
                                <td><?php if (($product_array[$key]["mon"]) != 0) {
                                        printf("$%.2f", $product_array[$key]["mon"]);
                                        $total0 = $product_array[$key]["mon"] + $total0;
                                    }; ?></td>
                                <td><?php if (($product_array[$key]["tue"]) != 0) {
                                        printf("$%.2f", $product_array[$key]["tue"]);
                                        $total1 = $product_array[$key]["tue"] + $total1;
                                    }; ?></td>
                                <td><?php if (($product_array[$key]["wed"]) != 0) {
                                        printf("$%.2f", $product_array[$key]["wed"]);
                                        $total2 = $product_array[$key]["wed"] + $total2;
                                    }; ?></td>
                                <td><?php if (($product_array[$key]["thr"]) != 0) {
                                        printf("$%.2f", $product_array[$key]["thr"]);
                                        $total3 = $product_array[$key]["thr"] + $total3;
                                    }; ?></td>
                                <td><?php if (($product_array[$key]["fri"]) != 0) {
                                        printf("$%.2f", $product_array[$key]["fri"]);
                                        $total4 = $product_array[$key]["fri"] + $total4;
                                    }; ?></td>
                                <td><?php if (($product_array[$key]["sat"]) != 0) {
                                        printf("$%.2f", $product_array[$key]["sat"]);
                                        $total5 = $product_array[$key]["sat"] + $total5;
                                    }; ?></td>
                                <td><?php if (($product_array[$key]["sun"]) != 0) {
                                        printf("$%.2f", $product_array[$key]["sun"]);
                                        $total6 = $product_array[$key]["sun"] + $total6;
                                    }; ?></td>
                                <td><?php if (($product_array[$key]["productTotal"]) != 0) {
                                        printf("$%.2f", $product_array[$key]["productTotal"]);
                                        $totalWeek = $product_array[$key]["productTotal"] + $totalWeek;
                                    }; ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                        <tr>
                            <th scope="row">Totals</th>
                            <td>All Products</td>
                            <td><?php if (($product_array[$key]["mon"]) != 0) {
                                    printf("$%.2f", $total0);
                                }; ?></td>
                            <td><?php if (($product_array[$key]["tue"]) != 0) {
                                    printf("$%.2f", $total1);
                                }; ?></td>
                            <td><?php if (($product_array[$key]["wed"]) != 0) {
                                    printf("$%.2f", $total2);
                                }; ?></td>
                            <td><?php if (($product_array[$key]["thr"]) != 0) {
                                    printf("$%.2f", $total3);
                                }; ?></td>
                            <td><?php if (($product_array[$key]["fri"]) != 0) {
                                    printf("$%.2f", $total4);
                                }; ?></td>
                            <td><?php if (($product_array[$key]["sat"]) != 0) {
                                    printf("$%.2f", $total5);
                                }; ?></td>
                            <td><?php if (($product_array[$key]["sun"]) != 0) {
                                    printf("$%.2f", $total6);
                                }; ?></td>
                            <td><?php if (($product_array[$key]["productTotal"]) != 0) {
                                    printf("$%.2f", $totalWeek);
                                }; ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <p></p>
        </div>
    </div><br>
    <div class="container site-section" id=responseStatusDisplay></div>
    <script type="text/javascript" src="./assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="./assets/bootstrap/js/bootstrap.min.js"></script>
    <?php include('./components/footer.php') ?>
</body>

</html>