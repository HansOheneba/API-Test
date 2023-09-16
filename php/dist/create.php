<?php
$status = "failed";
$message = "Unknown";
if (!empty($_POST['name']) && !empty($_POST['description']) && !empty($_POST['price'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];


    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "product";

    $conn = mysqli_connect($host, $username, $password, $database);
    if ($conn) {
        $sql = "insert into product (name, description, price) 
            VALUES ('" . $name . "','" . $description . "','" . $price . "')";
        if (mysqli_query($conn, $sql)) {
            if (mysqli_affected_rows($conn)) {
                $status = "Success";
                $message = "Product Added Successfully";
            } else
                $message = "Failed to add Product";

        } else
            $message = "Failed to add Product";
    } else
        $message = "All fields are required";
} else
    $message = "All fields are required";

header(header: "location: index.php?status=" . $status . "&&message=" . $message);

?>