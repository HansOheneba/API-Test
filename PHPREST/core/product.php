<?php
class Product
{

    //db Stuff
    private $conn;
    private $table = 'product';

    //Product Attributes
    public $id;
    public $name;
    public $description;
    public $price;
    public $dateCreated;
    public $dateModified;


    //Constructor with db conn
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function read()
    {
        // Create a SQL query to select all columns from the 'product' table
        $query = 'SELECT * FROM ' . $this->table;

        // Execute the query
        $result = $this->conn->query($query);

        return $result; // Return the result set
    }
    public function readSingle($id)
    {
        // Create a SQL query to select a single entry from the 'product' table based on its ID
        $query = 'SELECT * FROM ' . $this->table . ' WHERE id = ?';

        // Prepare the query
        $stmt = $this->conn->prepare($query);

        // Bind the ID parameter
        $stmt->bind_param('i', $id);

        // Execute the query
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            // Fetch the product data as an associative array
            $product = $result->fetch_assoc();
            return $product;
        } else {
            return null; // No product found with the given ID
        }
    }
    public function create($name, $description, $price)
    {
        // Create a SQL query to insert a new record into the 'product' table
        $query = 'INSERT INTO ' . $this->table . ' (name, description, price) VALUES (?, ?, ?)';

        // Prepare the query
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bind_param('ssd', $name, $description, $price); // Assuming 'name' and 'description' are strings, and 'price' is a double

        // Execute the query
        if ($stmt->execute()) {
            return true; // Record created successfully
        } else {
            return false; // Failed to create the record
        }
    }
    public function update($id, $name, $description, $price)
    {
        // Create a SQL query to update a record in the 'product' table
        $query = 'UPDATE ' . $this->table . ' SET name = ?, description = ?, price = ? WHERE id = ?';
    
        // Prepare the query
        $stmt = $this->conn->prepare($query);
    
        // Bind parameters
        $stmt->bind_param('ssdi', $name, $description, $price, $id); // Assuming 'name' and 'description' are strings, 'price' is a double, and 'id' is an integer
    
        // Execute the query
        if ($stmt->execute()) {
            return true; // Record updated successfully
        } else {
            return false; // Failed to update the record
        }
    }
    

    public function delete($id)
{
    // Create a SQL query to delete a record from the 'product' table based on its ID
    $query = 'DELETE FROM ' . $this->table . ' WHERE id = ?';

    // Prepare the query
    $stmt = $this->conn->prepare($query);

    // Bind the ID parameter
    $stmt->bind_param('i', $id);

    // Execute the query
    if ($stmt->execute()) {
        return true; // Record deleted successfully
    } else {
        return false; // Failed to delete the record
    }
}



}

?>