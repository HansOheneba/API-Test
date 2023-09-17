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
    

}

?>