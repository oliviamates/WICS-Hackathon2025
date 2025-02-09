<?php
include "db.php";
$restaurant_id = $_GET['restaurant_id'];
$query = $conn->prepare("SELECT * FROM food_entries WHERE restaurant_owner_id = ?");
$query->execute([$restaurant_id]);
$inventory = $query->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($inventory);
?>