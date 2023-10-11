<?php

include "db.php";


class Product
{
    private $db;
    private $table = 'product';

    public function __construct($db)
    {
        $this->db = $db;
    }


    // Read Function
    public function read()
    {
        try {
            $query = "SELECT * FROM {$this->table}";

            $stmt = $this->db->prepare($query);

            $stmt->execute();

            $products = array();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $product = array(
                    'id' => $row['id'],
                    'name' => $row['name'],
                    'description' => $row['description'],
                    'price' => $row['price'],
                    'dateCreated' => $row['dateCreated'],
                    'dateModified' => $row['dateModified']
                );
                $products[] = $product;
            }

            header('Content-Type: application/json');
            echo json_encode($products);
        } catch (PDOException $e) {
            echo "Database Error: " . $e->getMessage();
        }
    }


    //Create FUnction
    public function create($name, $description, $price)
    {
        try {
            $query = "INSERT INTO {$this->table} (name, description, price) VALUES (:name, :description, :price)";

            $stmt = $this->db->prepare($query);

            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':price', $price);

            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Database Error: " . $e->getMessage();
            return false;
        }
    }


    //Update Function
    public function update()
    {
        try {

            if (isset($_GET['id'])) {
                $id = $_GET['id'];
            } else {
                return array("error" => "Missing 'id' parameter in the URL");
            }


            $data = json_decode(file_get_contents("php://input"));


            if (isset($data->name) && isset($data->description) && isset($data->price)) {
                $name = $data->name;
                $description = $data->description;
                $price = $data->price;
            } else {
                return array("error" => "Missing required fields in the request data");
            }

            $query = 'UPDATE ' . $this->table . ' SET name = ?, description = ?, price = ? WHERE id = ?';

            $stmt = $this->db->prepare($query);

            $stmt->bindParam(1, $name, PDO::PARAM_STR);
            $stmt->bindParam(2, $description, PDO::PARAM_STR);
            $stmt->bindParam(3, $price, PDO::PARAM_STR);
            $stmt->bindParam(4, $id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                return array("message" => "Record updated successfully");
            }
            return array("error" => "Failed to update the record");

        } catch (PDOException $e) {
            return array("error" => $e->getMessage());
        }
    }
    //Delete Function
    public function delete($id)
    {
        try {
            $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

            $stmt = $this->db->prepare($query);

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            return $stmt->execute();

        } catch (PDOException $e) {
            return array("error" => $e->getMessage());
        }
    }


}