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

    <?php
    // Define variables and initialize with empty values
    $username = $password = $confirm_password = "";
    $username_err = $password_err = $confirm_password_err = "";

    // Processing form data when form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        require_once "dbconfig.php";


        // Validate username
        if (empty(trim($_POST["employeeUserName"]))) {
            $username_err = "Please enter a username.";
        } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["employeeUserName"]))) {
            $username_err = "Username can only contain letters, numbers, and underscores.";
        } else {
            // Prepare a select statement
            $sql = "SELECT id FROM employees WHERE username = ?";

            if ($stmt = mysqli_prepare($link, $sql)) {
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_username);

                // Set parameters
                $param_username = trim($_POST["employeeUserName"]);

                // Attempt to execute the prepared statement
                if (mysqli_stmt_execute($stmt)) {
                    /* store result */
                    mysqli_stmt_store_result($stmt);

                    if (mysqli_stmt_num_rows($stmt) == 1) {
                        $username_err = "This username is already taken.";
                        $_SESSION["accesserror"] = $username_err;
                    } else {
                        $username = trim($_POST["employeeUserName"]);
                    }
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }

                // Close statement
                mysqli_stmt_close($stmt);
            }
        }

        // Validate password
        if (empty(trim($_POST["employeePassword"]))) {
            $password_err = "Please enter a password.";
        } elseif (strlen(trim($_POST["employeePassword"])) < 6) {
            $password_err = "Password must have atleast 6 characters.";
            $_SESSION["accesserror"] = $password_err;
        } else {
            $password = trim($_POST["employeePassword"]);
        }

        // Validate confirm password
        if (empty(trim($_POST["employeePasswordConfirm"]))) {
            $confirm_password_err = "Please confirm password.";
        } else {
            $confirm_password = trim($_POST["employeePasswordConfirm"]);
            if (empty($password_err) && ($password != $confirm_password)) {
                $confirm_password_err = "Password did not match.";
                $_SESSION["accesserror"] = $confirm_password_err;
            }
        }
        $param_firstname = $_POST["firstName"];
        $param_lasstname = $_POST["LastName"];
        $param_employeeid = $_POST["employeeUserID"];
        // Check input errors before inserting in database
        if (empty($username_err) && empty($password_err) && empty($confirm_password_err)) {

            // Prepare an insert statement
            $sql = "INSERT INTO employees (username, password, firstname, lastname, employeeid) VALUES (?, ?, ?, ?, ?)";

            if ($stmt = mysqli_prepare($link, $sql)) {
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "sssss", $param_username, $param_password, $param_firstname, $param_lasstname, $param_employeeid);

                // Set parameters
                $param_username = $username;
                $param_password = password_hash($password, PASSWORD_BCRYPT); // Creates a password hash

                // Attempt to execute the prepared statement
                if (mysqli_stmt_execute($stmt)) {
                    $_SESSION["accesserror"] = "User created.";
                    // Redirect to login page
                    header("location: login.php");
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }

                // Close statement
                mysqli_stmt_close($stmt);
            }
        }

        // Close connection
        mysqli_close($link);
    }
    ?>


    <div id="employeeRegistration">
        <div class="site-section bg-light border rounded border-light jumbotron py-5 px-4">
            <h1 style="font-family: 'Abril Fatface', serif;">Employee Registration</h1>
            <p></p>
        </div>
    </div>

    <div class="container site-section" id="employeeRegistration">
        <?php
        if (!empty($_SESSION["accesserror"])) {
            echo $_SESSION["accesserror"];
        }
        ?>

        <form method="post" action="employeeRegistration.php" id="employeeRegister">
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
            <label for="employeePasswordConfirm">Confirm Employee Password:</label>
            <input type="text" id="employeePasswordConfirm" name="employeePasswordConfirm"><br><br>
        </form>
        <input type="submit" form="employeeRegister" name="register" value="Register"><br><br>
        <a href="employeeLogin.php">Click here to return to Login if already registered</a>
    </div><br>


    <?php include('./components/footer.php') ?>
</body>

</html>