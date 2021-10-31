<!-- <?php
// session_start();
// include("connection.php");
// include("funcitons.php");

// $user_data = check_login($con);
?> -->
<!DOCTYPE html>
<html>
<head>
    
    <title>Love You A Latte</title>
    <?php include('./components/header.php') ?>

</head>

<body>
<?php include('./components/nav.php') ?>

    <div id="employeeRegistration">
        <div class="bg-light border rounded border-light jumbotron py-5 px-4">
            <h1 style="font-family: 'Abril Fatface', serif;">Employee Registration</h1>
            <p></p>
        </div>
    </div>

    <div class="container site-section" id="employeeRegistration">
        <h1 style="font-family: 'Abril Fatface', serif;">Employee Registration</h1>
        <form method="post" action="process.php" id="employeeLogin">
            <label for="employeeFirstName">First Name:</label>
                <input type="text" id="employeeFirstName" name="firstName"><br><br>
            <label for="employeeLastName">Last Name:</label>
                <input type="text" id="employeeLastName" name="LastName"><br><br>
            <label for="employeeUserID">Employee Number:</label>
                <input type="text" id="employeeUserID" name="employeeUserID"><br><br>
            <label for="employeeUserName">Employee User Name:</label>
                <input type="text" id="employeeUserName" name="employeeUserName"><br><br>
            <label for="employeePassword">Employee Password:</label>
                <input type="text" id="employeePassword" name="employeePassword"><br><br>
            </form>
            <input type="submit" form= "employeeRegister" name="register" value="Register"><br><br>
            <a href="employeeLogin.php">Click here to return to Login if already registered</a>
        </div><br>

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