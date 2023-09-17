<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

// Initializing API
include_once('../core/initialize.php');

// Instance of product
$product = new Product($conn);

// Get data from the request body (JSON)
$data = json_decode(file_get_contents("php://input"));

// Check if the data is not null and contains the expected properties
if (
    !empty($data->id) &&
    !empty($data->name) &&
    !empty($data->description) &&
    isset($data->price)
) {
    // Initialize and use the Product class
    if ($product->update($data->id, $data->name, $data->description, $data->price)) {
        // The update was successful
        echo json_encode(array('message' => 'Product updated successfully.'));
    } else {
        // The update failed
        echo json_encode(array('message' => 'Failed to update product.'));
    }
} else {
    // Data is incomplete or missing
    echo json_encode(array('message' => 'Invalid data. Please provide all required fields.'));
}

?>