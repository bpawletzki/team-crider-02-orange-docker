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

<head>

    <title>Love You A Latte</title>
    <?php include('./components/header.php') ?>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <?php include('./components/nav.php') ?>

    <div id="inventory">
        <div class="bg-light border rounded border-light jumbotron py-5 px-4">
            <h1 style="font-family: 'Abril Fatface', serif;">Update Inventory</h1>
            <p></p>
        </div>
    </div>
    <?php

    ?>

    <div class="container site-section" id="inventoryDetails">
        <h1 style="font-family: 'Abril Fatface', serif;">Update Inventory</h1>
        <form><input type="text" id="searchId" class="search-key" placeholder="Id">
        <input type="text" id="searchName" class="search-key" placeholder="Name">
        <input type="text" id="searchCode" class="search-key" placeholder="Code">
        <input type="text" id="searchImage" class="search-key" placeholder="Image">
        <input type="text" id="searchPrice" class="search-key" placeholder="Price">
        <input type="text" id="searchDescription" class="search-key" placeholder="Description">
        <input type="submit" id="searchButton" value="Search">
        <input type="reset" id="resetButton" value="reset">
        </form>
        <div id="dataTable">

        </div>
    </div><br>
    <div class="container site-section" id=responseStatusDisplay></div>
    <script type="text/javascript" src="./assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="./assets/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="./assets/bootstrap/js/bootstable.min.js"></script>
    <script type="text/javascript">
    
        function myLoadTable() {
            $('#dataTable').load(
                "inventoryAction.php", { action: "list" },
                function() {
                    // https://github.com/t-edson/bootstable
                    $('#editableTable').SetEditable({
                        columnsEd: "1,2,3,4,5,6",
                        onEdit: function(columnsEd) {
                            var productId = columnsEd[0].childNodes[1].innerHTML;
                            var productName = columnsEd[0].childNodes[3].innerHTML;
                            var productCode = columnsEd[0].childNodes[5].innerHTML;
                            var productImage = columnsEd[0].childNodes[7].innerHTML;
                            var productPrice = columnsEd[0].childNodes[9].innerHTML;
                            var productDescription = columnsEd[0].childNodes[11].innerHTML;
                            $.ajax({
                                type: 'POST',
                                url: "inventoryAction.php",
                                dataType: "json",
                                data: {
                                    id: productId,
                                    name: productName,
                                    code: productCode,
                                    image: productImage,
                                    price: productPrice,
                                    description: productDescription,
                                    action: 'edit'
                                },
                                success: function(response) {
                                    if (!response.status) {
                                        $("#responseStatusDisplay").html(response.message)
                                    }
                                    myLoadTable();

                                }
                            });
                        },
                        onBeforeDelete: function(columnsEd) {
                            var productId = columnsEd[0].childNodes[1].innerHTML;
                            $.ajax({
                                type: 'POST',
                                url: "inventoryAction.php",
                                dataType: "json",
                                data: {
                                    id: productId,
                                    action: 'delete'
                                },
                                success: function(response) {
                                    if (!response.status) {
                                        $("#responseStatusDisplay").html("Unable to delete row. The product must be removed from all receipts before it can be removed.")
                                    }
                                    myLoadTable();
                                },

                            });
                        },
                    })
                });
        };
        myLoadTable();
    </script>
    <?php include('./components/footer.php') ?>
</body>

</html>