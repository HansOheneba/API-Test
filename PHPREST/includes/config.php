<?php
require_once "db_conn.php";

$sql = "SELECT * FROM product";
$result = $conn->query($sql);

?>