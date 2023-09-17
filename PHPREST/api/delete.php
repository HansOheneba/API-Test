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

// Check if an 'id' parameter is present in the query string
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    // If 'id' is not in the query string, attempt to parse it from the request body
    $data = json_decode(file_get_contents("php://input"));
    $id = isset($data->id) ? $data->id : null;
}

if (!empty($id)) {
    // Use the delete method to delete the product
    if ($post->delete($id)) {
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
