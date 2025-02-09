<?php
session_start();
include "db.php"; // Database connection

header("Content-Type: application/json");

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(["status" => "error", "message" => "User not logged in"]);
    exit();
}

$restaurant_owner_id = $_SESSION['user_id']; // Get restaurant ID from session

// Fetch food items for this restaurant
$query = $conn->prepare("SELECT food_type, amount FROM food_entries WHERE restaurant_owner_id = ?");
$query->execute([$restaurant_owner_id]);
$inventory = $query->fetchAll(PDO::FETCH_ASSOC);

// Return the inventory as JSON
echo json_encode(["status" => "success", "inventory" => $inventory]);
?>
