<?php
include "db.php";
$query = $conn->query("SELECT * FROM restaurants");
$restaurants = $query->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($restaurants);
?>