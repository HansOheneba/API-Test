<?php
require_once 'db.php';
require_once 'functions.php';

$action = isset($_GET['action']) ? $_GET['action'] : null;

switch ($action) {
    case 'read':

        try {
            $product = new Product($db);
            $products = $product->read();
            http_response_code(200);
            header('Content-Type: application/json');
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(array("message" => "Database error: " . $e->getMessage()));
        }
        break;
    case 'create':

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
            http_response_code(405);
            echo json_encode(array("message" => "Method not allowed."));
        }
        break;
    case 'update':

        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {

            $id = isset($_GET['id']) ? $_GET['id'] : null;

            if ($id !== null) {
                try {

                    $data = json_decode(file_get_contents("php://input"));

                    if (isset($data->name) && isset($data->description) && isset($data->price)) {

                        $query = "UPDATE product SET name = ?, description = ?, price = ? WHERE id = ?";

                        $stmt = $db->prepare($query);

                        $stmt->bindParam(1, $data->name);
                        $stmt->bindParam(2, $data->description);
                        $stmt->bindParam(3, $data->price);
                        $stmt->bindParam(4, $id, PDO::PARAM_INT);

                        if ($stmt->execute()) {

                            header("HTTP/1.1 200 OK");
                            echo json_encode(array("message" => "Record updated successfully."));
                        } else {

                            header("HTTP/1.1 500 Internal Server Error");
                            echo json_encode(array("message" => "Failed to update the record."));
                        }
                    } else {

                        header("HTTP/1.1 400 Bad Request");
                        echo json_encode(array("message" => "Name, description, and price are required."));
                    }
                } catch (PDOException $e) {

                    header("HTTP/1.1 500 Internal Server Error");
                    echo json_encode(array("message" => "Database Error: " . $e->getMessage()));
                }
            } else {

                header("HTTP/1.1 400 Bad Request");
                echo json_encode(array("message" => "ID not provided in the URL."));
            }
        } else {
            http_response_code(405);
            echo json_encode(array("message" => "Method not allowed."));
        }
        break;
    case 'delete':

        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
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
        } else {
            http_response_code(405);
            echo json_encode(array("message" => "Method not allowed."));
        }
        break;
    default:
        http_response_code(404);
        echo json_encode(array("message" => "Endpoint not found."));
        break;
}