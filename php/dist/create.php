<?php
$status = "failed";
$message = "Unknown";
if(!empty($_POST['name']) && !empty($_POST['description']) && !empty($_POST['price']) && !empty($_POST['dateCreated'] && !empty($_POST['dateModified']))){

$host = "localhost"; 
$username = "root";
$password = ""; 
$database = "product"; 

$conn = mysqli_connect($host, $username, $password, $database);
if($conn){

}
}
else $message = "All fields are required";
?>