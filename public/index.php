<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>

    <title>Love You A Latte</title>
    <?php include('./components/header.php') ?>

</head>

<body>
    <?php
    include('./components/nav.php');
    ?>

    <div id="intro">
        <div class="rounded border-light jumbotron py-5 px-4">
            <h1 style="font-family: 'Abril Fatface', serif;">Love You A Latte</h1>
            <p>Welcome to our fresh Brewed</p>
            <a class="nav-link active" href="../userLogin.php">User Login / Register new User</a>
        </div>
    </div>
    <div class="container site-section" id="welcome">
        <h1 style="font-family: 'Abril Fatface', serif;">
        <?php
        if (!empty($_SESSION["firstname"]))
            echo "Welcome, " . $_SESSION["firstname"] . ", ";
        else {
            echo "Welcome ";
        }?>
        To the Love You A Latte Cafe</h1>
        <p>Love you A Latte is a new alternative coffee shop. It has a homey atmosphere with great tasting coffee. Come in and have a cup, you won't regret it.</p>
    </div>
    <div class="dark-section">
        <div class="container site-section" id="why">
            <h1>Why Choose Us </h1>
            <div class="row">
                <div class="col-md-4 item">
                    <h2>Great Taste </h2>
                    <p>A Great tasting coffee to start your morning</p>
                </div>
                <div class="col-md-4 item">
                    <h2>Healthy &amp; Organic</h2>
                    <p>All coffee is made with the best organic and humanitarianly sourced beans&nbsp;</p>
                </div>
                <div class="col-md-4 item">
                    <h2>Great Customer Service</h2>
                    <p>Fast Ordering online and in person, customer satisfaction is always a priority</p>
                </div>
            </div>
        </div>
    </div>

    <?php include('./components/footer.php') ?>

</body>

</html>