<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-headers: Access-Control-Allow-headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

// Initializing API
include_once('../core/initialize.php');

// Instance of post
$post = new Post($conn);

// Get data from POST request
$data = json_decode(file_get_contents("php://input"));

// Check if data is not empty
if (!empty($data->name) && !empty($data->description) && !empty($data->price)) {
    // Set properties for the new product
    $post->name = $data->name;
    $post->description = $data->description;
    $post->price = $data->price;

    // Create the new product
    if ($post->create($post->name, $post->description, $post->price)) {
        echo json_encode(array('message' => 'Product created successfully.'));
    } else {
        echo json_encode(array('message' => 'Failed to create product.'));
    }
} else {
    echo json_encode(array('message' => 'Incomplete data. Please provide name, description, and price.'));
}
?>
