<?php
$host = "localhost"; // Database host (usually "localhost" for local development)
$username = "root"; // Database username
$password = ""; // Database password
$database = "product"; // Database name

$conn = new mysqli($host, $username, $password, $database);


if($conn){
 
}
else{
    echo "Database connection failed";
}

$conn->close();
?>