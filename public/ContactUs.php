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

    <div id="contactWelcome">
        <div class="bg-light border rounded border-light jumbotron py-5 px-4">
            <h1 style="font-family: 'Abril Fatface', serif;">Contact Us</h1>
            <p></p>
        </div>
    </div>
    <div class="container site-section" id="welcome">
        <h1 style="font-family: 'Abril Fatface', serif;">Welcome</h1>
        <p><br><strong>Please feel free to get in touch with us. We would love to hear your feedback so that our staff can better serve you and promote a better Café experience.</strong><br><br></p>
    </div>
    <div class="dark-section">
        <div class="container site-section" id="why">
            <h1>Contact Us</h1>
            <div class="row">
                <div class="col-md-4 item">
                    <h2>Phone Number</h2>
                    <p><br><strong>1(***)*** ****</strong><br><br></p>
                </div>
                <div class="col-md-4 item">
                    <h2>Email</h2>
                    <p><br><strong>placeholder@email.com</strong><br><br></p>
                </div>
                <div class="col-md-4 item">
                    <h2>Address</h2>
                    <p><br><strong>0000 Placeholder St Columbus, OH</strong><br><br></p>
                </div>
            </div>
        </div>
    </div>
        <?php include('./components/footer.php') ?>

</body>

</html>