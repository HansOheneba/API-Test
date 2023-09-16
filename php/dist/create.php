<?php
$status = "failed";
$message = "Unknown";
if (!empty($_POST['name']) && !empty($_POST['description']) && !empty($_POST['price']) && !empty($_POST['dateCreated'] && !empty($_POST['dateModified']))) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $dateCreated = $_POST['dateCreated'];
    $dateModified = $_POST['dateModified'];

    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "product";

    $conn = mysqli_connect($host, $username, $password, $database);
    if ($conn) {
        $sql = "insert into products (name, description, price,) 
                values('" . $name . "','" . $description . "','" . $price . "')";
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