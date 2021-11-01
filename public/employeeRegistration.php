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
        <div class="site-section bg-light border rounded border-light jumbotron py-5 px-4">
            <h1 style="font-family: 'Abril Fatface', serif;">Employee Registration</h1>
            <p></p>
        </div>
    </div>

    <div class="container site-section" id="employeeRegistration">
        <form method="post" action="employeeRegistration.php" id="employeeLogin">
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


        <?php include('./components/footer.php') ?>
</body>
</html>