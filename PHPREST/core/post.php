<?php
class Post
{

    //db Stuff
    private $conn;
    private $table = 'product';

    //Post Attributes
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

}

?>