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

    public function read()
    {
        try {
            $query = "SELECT * FROM product";

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

    public function create($name, $description, $price)
    {
        try {
            $query = "INSERT INTO {$this->table} (name, description, price) VALUES (:name, :description, :price)";
            
            $stmt = $this->db->prepare($query);
            
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':price', $price);
            
            if ($stmt->execute()) {
                return true; 
            } else {
                return false; 
            }
        } catch (PDOException $e) {
            echo "Database Error: " . $e->getMessage();
            return false;
        }
    }
}
