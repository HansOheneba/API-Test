<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

// Initializing API
include_once('../core/initialize.php');

// Instance of post
$post = new Post($conn);

// Get the product ID from the request
$data = json_decode(file_get_contents("php://input"));

if (!empty($data->id)) {
    // Use the delete method to delete the product
    if ($post->delete($data->id)) {
        // The delete was successful
        echo json_encode(array('message' => 'Product deleted successfully.'));
    } else {
        // The delete failed
        echo json_encode(array('message' => 'Failed to delete product.'));
    }
} else {
    // Invalid request data
    echo json_encode(array('message' => 'Invalid request data.'));
}
?>
