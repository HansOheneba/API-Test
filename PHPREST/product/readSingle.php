<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Initializing API
include_once('../core/initialize.php');

// Instance of product
$product = new Product($conn);

// Check if the 'id' parameter is provided in the URL
if (isset($_GET['id'])) {
    $product_id = $_GET['id']; // Get the product ID from the URL

    // Call readSingle method to get the product data for the specified ID
    $product_data = $product->readSingle($product_id);

    if ($product_data) {
        echo json_encode($product_data); // Encode and output the product data as JSON
    } else {
        echo json_encode(array('message' => 'Product not found'));
    }
} else {
    echo json_encode(array('message' => 'Missing product ID'));
}
?>
