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
<?php include('./components/nav.php') ?>

    <div id="FAQintro">
        <div class="bg-light border rounded border-light jumbotron py-5 px-4">
            <h1 style="font-family: 'Abril Fatface', serif;">FAQs</h1>
        </div>
    </div>
    <div class="container site-section" id="welcome">
        <h1 style="font-family: 'Abril Fatface', serif;">Our Story</h1>
        <p>Love you A Latte is a new alternative coffee shop. It has a homey atmosphere with great tasting coffee. Come in and have a cup, you won't regret it.</p>
    </div>
    <div class="dark-section">
        <div class="container site-section" id="why">
            <h1>Information</h1>
            <div class="row">
                <div class="col-md-4 item">
                    <h2>Store Hours</h2>
                    <p>Monday-Friday: 6:00 AM-5:00PM</p>
                    <p>Saturday and Sunday: 9:00 AM-4:00PM</p>
                </div>
                <div class="col">
                    <h2>Suppliers</h2>
                    <p>All coffee is made with the best organic and humanitarianly sourced beans&nbsp;</p>
                </div>
            </div>
        </div>
    </div>
    
        <?php include('./components/footer.php') ?>

</body>

</html>