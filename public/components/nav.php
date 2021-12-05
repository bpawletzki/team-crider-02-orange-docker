<nav class="navbar navbar-dark navbar-expand-md fixed-top bg-dark" id="navstyle">
    <div class="container" id="navcontainer">
        <div><a class="navbar-brand" href="#" style="font-family: 'Abril Fatface', serif;"><strong>Love You A Latte</strong></a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button></div>
        <div class="collapse navbar-collapse" id="navcol-1">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item" style="font-family: 'Abril Fatface', serif;"><a class="nav-link active" href="../index.php" data-bs-target="index.html">Home</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Menu
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li class="dropdown-item"><a class="nav-link active" href="../Menu.php" style="font-family: 'Abril Fatface', serif;" data-bs-target="Menu.html">Hot Drinks</a></li>
                        <li class="dropdown-item"><a class="nav-link active" href="../icedMenu.php" style="font-family: 'Abril Fatface', serif;" data-bs-target="Menu.html">Iced Drinks</a></li>
                        <li class="dropdown-item"><a class="nav-link active" href="../frozenMenu.php" style="font-family: 'Abril Fatface', serif;" data-bs-target="Menu.html">Frozen Drinks</a></li>
                        <li class="dropdown-item"><a class="nav-link active" href="../bakeryMenu.php" style="font-family: 'Abril Fatface', serif;" data-bs-target="Menu.html">Bakery Items</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link active" href="../FAQs.php" style="font-family: 'Abril Fatface', serif;" data-bs-target="FAQs.html">FAQs</a></li>
                <li class="nav-item"><a class="nav-link active" href="../ContactUs.php" style="font-family: 'Abril Fatface', serif;" data-bs-target="Contact%20Us.html">Contact Us</a></li>
                <?php
                if (!empty($_SESSION["empLoggedin"]) && ($_SESSION["empLoggedin"])) {
                    echo '<li class="nav-item dropdown">';
                    echo '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Employee Menu</a>';
                    echo '<ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
                    echo '<li class="dropdown-item"><a class="nav-link active" href="../inventoryAdd.php" style="font-family: \'Abril Fatface\', serif;" data-bs-target="inventory.html">Inventory Add</a></li>';
                    echo '<li class="dropdown-item"><a class="nav-link active" href="../inventoryUpdate.php" style="font-family: \'Abril Fatface\', serif;" data-bs-target="inventory.html">Inventory Update</a></li>';
                    echo '<li class="dropdown-item"><a class="nav-link active" href="../employeeRegistration.php" style="font-family: \'Abril Fatface\', serif;" >Register Employee</a></li>';
                    echo '<li class="dropdown-item"><a class="nav-link active" href="../weeklySales.php" style="font-family: \'Abril Fatface\', serif;" >Weekly Sales Report</a></li>';
                    echo '</ul></li>';
                }
                ?>
                <li class="nav-item"><a class="nav-link active" href="../employeeLogin.php" style="font-family: 'Abril Fatface', serif;" data-bs-target="employeeLogin.html">Employee Login</a></li>
                <li class="nav-item"><a class="nav-link active" href="../userLogin.php" style="font-family: 'Abril Fatface', serif;" data-bs-target="userLogin.html">User Login</a></li>
                <li class="nav-item"><a class="nav-link active" href="../cart.php" style="font-family: 'Abril Fatface', serif;"><img src="assets/img/cart.png"></a></li>
            </ul>
        </div>
        <?php
        if (!empty($_SESSION["firstname"]))
            echo $_SESSION["firstname"] ?>
    </div>
</nav>