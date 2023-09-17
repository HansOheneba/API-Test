<?php
//Headers
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');

// Initializing API
include_once('../core/initialize.php');

// Instance of post
$post = new Post($conn);

// Call the read method to get specific columns for each record
$result = $post->read();

if ($result) {
    $row_count = $result->num_rows; // Get the number of rows

    if ($row_count > 0) {
        // Loop through the results and list each row individually
        while ($row = $result->fetch_assoc()) { // Use fetch_assoc() instead of PDO's fetch
            // Access specific columns for each record
            $id = $row['id'];
            $name = $row['name'];
            $description = $row['description'];
            $price = $row['price'];
            $dateCreated = $row['dateCreated'];
            $dateModified = $row['dateModified'];

            // Output or process each row as needed
            echo "ID: $id, Name: $name, Description: $description, Price: $price, Date Created: $dateCreated, Date Modified: $dateModified<br>";
        }
    } else {
        echo "No products found.";
    }
} else {
    echo "Failed to fetch data.";
}


?>