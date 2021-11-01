<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
// if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
//     header("location: index.php");
//     exit;
// }

// Include config file
require_once "dbconfig.php";

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if username is empty
    if (empty(trim($_POST["employeeUserName"]))) {
        $username_err = "Please enter username.";
    } else {
        $username = trim($_POST["employeeUserName"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["employeePassword"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["employeePassword"]);
    }
    // Check for 3 failed attempts
    // Prepare a select statement
    $sql = "SELECT id FROM accessfailed WHERE username = ? AND created_at > TIMESTAMPADD(MINUTE,-5,NOW())";

    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_username);

        // Set parameters
        $param_username = trim($_POST["employeeUserName"]);

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            /* store result */
            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) >= 3) {
                $username_err = "This username has 3 failed attempts in 15 minutes, please try again later";
                $_SESSION["accesserror"] = $username_err;
            } else {
                $username = trim($_POST["employeeUserName"]);
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    // Validate credentials
    if (empty($username_err) && empty($password_err)) {
        // Prepare a select statement
        $sql = "SELECT id, username, password, firstname FROM employees WHERE username = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = $username;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if username exists, if yes then verify password
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $firstname);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $hashed_password)) {
                            // Password is correct, so start a new session
                            //session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            $_SESSION["firstname"] = $firstname;
                            unset($_SESSION["accesserror"]);

                            // Redirect user to welcome page
                            header("location: index.php");
                            exit;
                        } else {
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password.";
                            $_SESSION["accesserror"] = $login_err;
                            $_SESSION["loggedin"] = false;
                            unset($_SESSION["id"]);
                            unset($_SESSION["username"]);

                            // Prepare an insert statement
                            $sql = "INSERT INTO accessfailed (username) VALUES (?)";

                            if ($stmt = mysqli_prepare($link, $sql)) {
                                // Bind variables to the prepared statement as parameters
                                mysqli_stmt_bind_param($stmt, "s", $param_username);

                                // Set parameters
                                $param_username = $username;

                                // Attempt to execute the prepared statement
                                if (mysqli_stmt_execute($stmt)) {
                                    // Redirect to login page
                                    header("location: employeeLogin.php");
                                } else {
                                    echo "Oops! Something went wrong. Please try again later.";
                                }
                            }
                        }
                    }
                } else {
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
                    $_SESSION["accesserror"] = $login_err;

                }
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

<!DOCTYPE html>
<html>

<head>

    <title>Love You A Latte</title>
    <?php include('./components/header.php') ?>

</head>

<body>
    <?php include('./components/nav.php') ?>



    <div id="employeePage">
        <div class="site-section bg-light border rounded border-light jumbotron py-5 px-4">
            <h1 style="font-family: 'Abril Fatface', serif;">Employee Login</h1>
            <p></p>
        </div>
    </div>

    <div class="container site-section" id="employeeLoginDiv">
        <?php
        if (!empty($_SESSION["accesserror"])) {
            echo $_SESSION["accesserror"];
        }
        ?>
        <form method="post" action="employeeLogin.php" id="employeeLogin">
            <label for="employeeUserName">Employee User Name:</label>
            <input type="text" id="employeeUserName" name="employeeUserName"><br><br>
            <label for="employeePassword">Employee Password:</label>
            <input type="text" id="employeePassword" name="employeePassword"><br><br>
        </form>
        <input type="submit" form="employeeLogin" name="login" value="Login"><br><br>
        <a href="employeeRegistration.php">Click here to Register</a>
    </div><br>


    <?php include('./components/footer.php') ?>
</body>

</html>