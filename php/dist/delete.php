<?php
$status = "failed";
$message = "Unknown";

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "product";

    $conn = mysqli_connect($host, $username, $password, $database);
    if ($conn) {
        // Prepare and execute the SQL query to delete the product
        $sql = "DELETE FROM product WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);

        if (mysqli_stmt_execute($stmt)) {
            if (mysqli_affected_rows($conn) > 0) {
                $status = "Success";
                $message = "Product Deleted Successfully";
            } else {
                $message = "No product found with the provided ID";
            }
        } else {
            $message = "Failed to delete product";
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    } else {
        $message = "Failed to connect to the database";
    }
} else {
    $message = "ID parameter missing in the URL";
}

header("location: index.php?status=" . $status . "&message=" . $message);
?>
