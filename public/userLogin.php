<?php
// Initialize the session
session_start();
// 
//Log out Employee
$_SESSION["empLoggedin"] = false;


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

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $_SESSION["userLoggedin"] = false;
    unset($_SESSION["id"]);
    unset($_SESSION["username"]);
    unset($_SESSION["firstname"]);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if username is empty
    if (empty(trim($_POST["userUserName"]))) {
        $username_err = "Please enter username.";
    } else {
        $username = trim($_POST["userUserName"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["userPassword"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["userPassword"]);
    }
    // Check for 3 failed attempts
    // Prepare a select statement
    $sql = "SELECT id FROM accessfailed WHERE username = ? AND created_at > TIMESTAMPADD(MINUTE,-15,NOW())";

    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_username);

        // Set parameters
        $param_username = trim($_POST["userUserName"]);

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            /* store result */
            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) >= 3) {
                $username_err = "This username has 3 failed attempts in 15 minutes, please try again later";
                $_SESSION["accesserror"] = $username_err;
            } else {
                $username = trim($_POST["userUserName"]);
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    // Validate credentials
    if (empty($username_err) && empty($password_err)) {
        // Prepare a select statement
        $sql = "SELECT id, username, password, firstname, userid FROM users WHERE username = ?";

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
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $firstname, $userid);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $hashed_password)) {
                            // Password is correct, so start a new session
                            //session_start();

                            // Store data in session variables
                            $_SESSION["userLoggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            $_SESSION["firstname"] = $firstname;
                            $_SESSION["userid"] = $userid;
                            unset($_SESSION["accesserror"]);

                            // Redirect user to welcome page
                            header("location: index.php");
                            exit;
                        } else {
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password.";
                            $_SESSION["accesserror"] = $login_err;
                            $_SESSION["userLoggedin"] = false;
                            unset($_SESSION["id"]);
                            unset($_SESSION["username"]);
                            unset($_SESSION["firstname"]);

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
                                    header("location: userLogin.php");
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



    <div id="userPage">
        <div class="site-section bg-light border rounded border-light jumbotron py-5 px-4">
            <h1 style="font-family: 'Abril Fatface', serif;">User Login</h1>
            <p></p>
        </div>
    </div>

    <div class="container site-section" id="userLoginDiv">
        <?php
        if (!empty($_SESSION["accesserror"])) {
            echo $_SESSION["accesserror"];
        }
        ?>
        <form method="post" action="userLogin.php" id="userLogin">
            <label for="userUserName">User User Name:</label>
            <input type="text" id="userUserName" name="userUserName"><br><br>
            <label for="userPassword">User Password:</label>
            <input type="password" id="userPassword" name="userPassword"><br><br>
        </form>
        <input type="submit" form="userLogin" name="login" value="Login"><br><br>
    </div><br>


    <?php include('./components/footer.php') ?>
</body>

</html>