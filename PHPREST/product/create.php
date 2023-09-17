<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-headers: Access-Control-Allow-headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

// Initializing API
include_once('../core/initialize.php');

// Instance of product
$product = new Product($conn);

// Get data from POST request
$data = json_decode(file_get_contents("php://input"));

// Check if data is not empty
if (!empty($data->name) && !empty($data->description) && !empty($data->price)) {
    // Set properties for the new product
    $product->name = $data->name;
    $product->description = $data->description;
    $product->price = $data->price;

    // Create the new product
    if ($product->create($product->name, $product->description, $product->price)) {
        echo json_encode(array('message' => 'Product created successfully.'));
    } else {
        echo json_encode(array('message' => 'Failed to create product.'));
    }
} else {
    echo json_encode(array('message' => 'Incomplete data. Please provide name, description, and price.'));
}
?>
