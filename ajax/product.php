<?php

require_once 'db.php';
require_once 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        $product = new Product($db);
        $products = $product->read();
        http_response_code(200);
        header('Content-Type: application/json');
        echo json_encode($products);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(array("message" => "Database error: " . $e->getMessage()));
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"));
    if (!empty($data->name) && !empty($data->description) && !empty($data->price)) {
        try {
            $product = new Product($db);
            $created = $product->create($data->name, $data->description, $data->price);
            if ($created) {
                http_response_code(201);
                echo json_encode(array("message" => "Product created successfully."));
            } else {
                http_response_code(500);
                echo json_encode(array("message" => "Failed to create product."));
            }
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(array("message" => "Database error: " . $e->getMessage()));
        }
    } else {
        http_response_code(400);
        echo json_encode(array("message" => "Incomplete data."));
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // Get the ID from the URL (assuming it's in the query string)
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    // Check if the ID is provided in the URL
    if ($id !== null) {
        try {
            // Parse the JSON request body
            $data = json_decode(file_get_contents("php://input"));
            // Ensure the required fields are provided (name, description, and price)
            if (isset($data->name) && isset($data->description) && isset($data->price)) {
                // Create a SQL query to update the record
                $query = "UPDATE product SET name = ?, description = ?, price = ? WHERE id = ?";
                // Prepare the query
                $stmt = $db->prepare($query);
                // Bind parameters
                $stmt->bindParam(1, $data->name);
                $stmt->bindParam(2, $data->description);
                $stmt->bindParam(3, $data->price);
                $stmt->bindParam(4, $id, PDO::PARAM_INT);
                // Execute the query
                if ($stmt->execute()) {
                    // The record was updated successfully
                    header("HTTP/1.1 200 OK");
                    echo json_encode(array("message" => "Record updated successfully."));
                } else {
                    // Failed to update the record
                    header("HTTP/1.1 500 Internal Server Error");
                    echo json_encode(array("message" => "Failed to update the record."));
                }
            } else {
                // Required fields not provided
                header("HTTP/1.1 400 Bad Request");
                echo json_encode(array("message" => "Name, description, and price are required."));
            }
        } catch (PDOException $e) {
            // Database error
            header("HTTP/1.1 500 Internal Server Error");
            echo json_encode(array("message" => "Database Error: " . $e->getMessage()));
        }
    } else {
        // ID not provided in the URL
        header("HTTP/1.1 400 Bad Request");
        echo json_encode(array("message" => "ID not provided in the URL."));
    }
    
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    if ($id !== null) {
        try {
            $product = new Product($db);
            $deleted = $product->delete($id);
            if ($deleted) {
                header("HTTP/1.1 200 OK");
                echo json_encode(array("message" => "Record deleted successfully."));
            } else {

                header("HTTP/1.1 500 Internal Server Error");
                echo json_encode(array("message" => "Failed to delete the record."));
            }
        } catch (PDOException $e) {
   
            header("HTTP/1.1 500 Internal Server Error");
            echo json_encode(array("message" => "Database Error: " . $e->getMessage()));
        }
    } else {

        header("HTTP/1.1 400 Bad Request");
        echo json_encode(array("message" => "ID not provided in the URL."));
    }
}
else {
    http_response_code(405);
    echo json_encode(array("message" => "Method not allowed."));
}
?>
