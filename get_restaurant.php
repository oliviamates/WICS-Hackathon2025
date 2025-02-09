<?php
include "db.php"; // Includes the database connection

// Enable CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

try {
    // Prepare and execute the query
    $stmt = $conn->prepare("SELECT * FROM restaurant_owners");
    $stmt->execute();

    // Fetch results as an associative array
    $restaurants = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return JSON response
    echo json_encode($restaurants);
} catch (PDOException $e) {
    // Return error message in JSON format
    echo json_encode(["error" => "Query failed: " . $e->getMessage()]);
}
?>