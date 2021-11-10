<?php
session_start();

include_once("dbconfig.php");

if (!empty($_POST) && $_POST['action'] == 'edit' && $_POST['id']) {
    $updateField = '';
    if (isset($_POST['name'])) {
        $updateField .= "name='" . $_POST['name'] . "'";
        $updateField .= ", code='" . $_POST['code'] . "'";
        $updateField .= ", image='" . $_POST['image'] . "'";
        $updateField .= ", price='" . $_POST['price'] . "'";
        $updateField .= ", description='" . $_POST['description'] . "'";
    }
    if ($updateField && $_POST['id']) {
        $sqlQuery = "UPDATE product SET $updateField WHERE id='" . $_POST['id'] . "'";
        if (mysqli_query($link, $sqlQuery)) {
            $data = array(
                "message"    => "Record Updated",
                "status" => 1
            );
        } else {
            $data = array(
                "message" => "database error:" . mysqli_error($link),
                "status" => 0
            );
        }
        echo json_encode($data);
    }
}
if (!empty($_POST) && $_POST['action'] == 'delete' && $_POST['id']) {
    $sqlQuery = "DELETE FROM product WHERE id='" . $_POST['id'] . "'";
    if (mysqli_query($link, $sqlQuery)) {

        $data = array(
            "message" => "Record Deleted",
            "status" => 1
        );
    } else {
        $data = array(
            "message" => "database error:" . mysqli_error($link),
            "status" => 0
        );
    }
    echo json_encode($data);
}
if (!empty($_POST) && $_POST['action'] == 'list') {
    if (empty($_SESSION['searchName'])) {$_SESSION['searchName'] = "%";};
    if (empty($_SESSION['searchCode'])) {$_SESSION['searchCode'] = "%";};
    if (empty($_SESSION['searchImage'])) {$_SESSION['searchImage'] = "%";};
    if (empty($_SESSION['searchPrice'])) {$_SESSION['searchPrice'] = "%";};
    if (empty($_SESSION['searchDescription'])) {$_SESSION['searchDescription'] = "%";};

    $searchField = '';
    $searchField .= "name LIKE '" . $_SESSION['searchName'] . "' ";
    $searchField .= "AND code LIKE '" . $_SESSION['searchCode'] . "' ";
    $searchField .= "AND image LIKE '" . $_SESSION['searchImage'] . "' ";
    $searchField .= "AND price LIKE '" . $_SESSION['searchPrice'] . "' ";
    $searchField .= "AND description LIKE '" . $_SESSION['searchDescription'] . "' ";
    $sqlQuery = "SELECT id, name, code, image, price, description FROM product WHERE " . $searchField;
    $resultSet = mysqli_query($link, $sqlQuery);
?>

    <script type="text/javascript" src="./assets/bootstrap/js/bootstable.min.js"></script>
    <table id="editableTable" class="table table-bordered table-responsivetable-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Code</th>
                <th>Image</th>
                <th>Price</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($product = mysqli_fetch_assoc($resultSet)) { ?>
                <tr id="<?php echo $product['id']; ?>">
                    <td data-input="searchId"><?php echo $product['id']; ?></td>
                    <td data-input="searchName"><?php echo $product['name']; ?></td>
                    <td data-input="searchCode"><?php echo $product['code']; ?></td>
                    <td data-input="searchImage"><?php echo $product['image']; ?></td>
                    <td data-input="searchPrice"><?php echo $product['price']; ?></td>
                    <td data-input="searchDescription"><?php echo $product['description']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php
}
?>