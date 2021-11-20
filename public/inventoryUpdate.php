<?php
session_start();
// only allow access if logged in
if (is_null($_SESSION["empLoggedin"]) || !($_SESSION["empLoggedin"])) {
    // Redirect to login page
    header("location: employeeLogin.php");
    exit;
}

if (!empty($_POST['name'])) {
    $_SESSION['searchName'] = "%" . $_POST['name'] . "%";
    $_SESSION['placeName'] = $_POST['name'];
} else {
    $_SESSION['searchName'] = "%";
    $_SESSION['placeName'] = "Name";
};
if (!empty($_POST['code'])) {
    $_SESSION['searchCode'] = "%" . $_POST['code'] . "%";
    $_SESSION['placeCode'] = $_POST['code'];
} else {
    $_SESSION['searchCode'] = "%";
    $_SESSION['placeCode'] = "Code";
};
if (!empty($_POST['category'])) {
    $_SESSION['searchCategory'] = "%" . $_POST['category'] . "%";
    $_SESSION['placeCategory'] = $_POST['category'];
} else {
    $_SESSION['searchCategory'] = "%";
    $_SESSION['placeCategory'] = "Category";
}; 
if (!empty($_POST['image'])) {
    $_SESSION['searchImage'] = "%" . $_POST['image'] . "%";
    $_SESSION['placeImage'] = $_POST['image'];
} else {
    $_SESSION['searchImage'] = "%";
    $_SESSION['placeImage'] = "Image";
};
if (!empty($_POST['price'])) {
    $_SESSION['searchPrice'] = "%" . $_POST['price'] . "%";
    $_SESSION['placePrice'] = $_POST['price'];
} else {
    $_SESSION['searchPrice'] = "%";
    $_SESSION['placePrice'] = "Price";
};
if (!empty($_POST['description'])) {
    $_SESSION['searchDescription'] = "%" . $_POST['description'] . "%";
    $_SESSION['placeDescription'] = $_POST['description'];
} else {
    $_SESSION['searchDescription'] = "%";
    $_SESSION['placeDescription'] = "Description";
};

?>
<!DOCTYPE html>
<html>

<head>

    <title>Love You A Latte</title>
    <?php include('./components/header.php') ?>
    <!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"> -->

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
        <form method="post" action="inventoryUpdate.php">
            <input type="text" id="searchName" class="search-key" name="name" placeholder="Name">
            <input type="text" id="searchCode" class="search-key" name="code" placeholder="Code">
            Category:
            <select type="text" id="searchCategory" class="search-key" name="categeory" placeholder="Category">
                <option value="...">...</option>
                <option value="hot">Hot</option>
                <option value="iced">Iced</option>
                <option value="frozen">Frozen</option>
            </select>
            <input type="text" id="searchImage" class="search-key" name="image" placeholder="Image">
            <input type="text" id="searchPrice" class="search-key" name="price" placeholder="Price">
            <input type="text" id="searchDescription" class="search-key" name="description" placeholder="Description">
            <input type="submit" id="searchButton" name="action" value="Search">
            <br>
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
            $('#searchButton').submit(
                "inventoryAction.php", {
                    action: "list"
                });
            $('#dataTable').load(
                "inventoryAction.php", {
                    action: "list"
                },
                function() {
                    // https://github.com/t-edson/bootstable
                    $('#editableTable').SetEditable({
                        columnsEd: "1,2,3,4,5,6,7",
                        onEdit: function(columnsEd) {
                            var productId = columnsEd[0].childNodes[1].innerHTML;
                            var productName = columnsEd[0].childNodes[3].innerHTML;
                            var productCode = columnsEd[0].childNodes[5].innerHTML;
                            var productCategory = columnsEd[0].childNodes[5].innerHTML;
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
                                    category:productCategory,
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
    <script src="assets/js/jquery.min.js"></script>
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <?php include('./components/footer.php') ?>
</body>

</html>