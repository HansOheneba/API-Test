<?php
$host = "localhost"; 
$username = "root";
$password = ""; 
$database = "product"; 

$conn = mysqli_connect($host, $username, $password, $database);


if($conn){
 $sql = "select * from products";
 $results = mysqli_query($conn,$sql);
 if($results){
    header("Content-Type: JSON");
    $i=0;
    while($row = mysqli_fetch_assoc($results)){
        $response[$i]['id'] = $row ['id'];
        $response[$i]['name'] = $row ['name'];
        $response[$i]['description'] = $row ['description'];
        $response[$i]['price'] = $row ['price'];
        $response[$i]['dateCreated'] = $row ['dateCreated'];
        $response[$i]['dateModified'] = $row ['dateModified'];

        $i++;
    }
    echo json_encode($response,JSON_PRETTY_PRINT);
 }
}
else{
    echo "Database connection failed";
}

$conn->close();
?>