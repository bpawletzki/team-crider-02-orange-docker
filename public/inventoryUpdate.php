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
head>

<title>Love You A Latte</title>
<?php include('./components/header.php') ?>

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



    <?php include('./components/footer.php') ?>
</body>

</html>