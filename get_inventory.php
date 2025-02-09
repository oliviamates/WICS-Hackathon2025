<?php
include "db.php";

// Ensure that the restaurant_id is provided in the query string
if (isset($_GET['restaurant_id'])) {
    $restaurant_id = $_GET['restaurant_id'];
    
    // Prepare and execute the query to fetch inventory for the given restaurant_id
    $query = $conn->prepare("SELECT food_type, amount FROM food_entries WHERE restaurant_owner_id = :restaurant_id");
    $query->bindParam(':restaurant_id', $restaurant_id, PDO::PARAM_INT);
    $query->execute();

    // Fetch all the results as an associative array
    $inventory = $query->fetchAll(PDO::FETCH_ASSOC);

    // Return the inventory as JSON
    echo json_encode($inventory);
} else {
    // If no restaurant_id is provided, return an error message
    echo json_encode(["error" => "No restaurant ID provided"]);
}
?>