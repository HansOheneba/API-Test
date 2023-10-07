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
} else {
    // Return a method not allowed response for other request methods
    http_response_code(405); // 405 Method Not Allowed status code
    echo json_encode(array("message" => "Method not allowed."));
}