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

$response = array(); // Create an array to hold the response data

if ($result) {
    $row_count = $result->num_rows; // Get the number of rows

    if ($row_count > 0) {
        $response['data'] = array(); // Create a "data" key for the response array

        // Loop through the results and add each product to the "data" array
        while ($row = $result->fetch_assoc()) { // Use fetch_assoc() instead of PDO's fetch
            $product = array(
                'id' => $row['id'],
                'name' => $row['name'],
                'description' => $row['description'],
                'price' => $row['price'],
                'dateCreated' => $row['dateCreated'],
                'dateModified' => $row['dateModified']
            );

            $response['data'][] = $product; // Add the product to the "data" array
        }

        echo json_encode($response); // Encode the response array as JSON
    } else {
        $response['message'] = "No products found.";
        echo json_encode($response); // Encode the response array as JSON
    }
} else {
    $response['message'] = "Failed to fetch data.";
    echo json_encode($response); // Encode the response array as JSON
}


?>