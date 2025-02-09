<?php
session_start();
include "db.php"; // Include the database connection

// Get the raw POST data sent by the user
$data = json_decode(file_get_contents("php://input"));

// Get the username and password from the POST request
$username = $data->username;
$password = $data->password;

// Query the 'restaurant_owners' table to find the user by username
$query = $conn->prepare("SELECT * FROM restaurant_owners WHERE username = ?");
$query->execute([$username]);
$user = $query->fetch(PDO::FETCH_ASSOC);

// Check if the user was found and the password matches
if ($user && $user['password'] === $password) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['restaurant_name'] = $user['restaurant_name'];
    // If the username and password match, return a success response
    echo json_encode(["status" => "success", "user_id" => $user['id'], "restaurant_name" => $user['restaurant_name']]);
} else {
    // If the username and/or password are incorrect, return an error response
    echo json_encode(["status" => "error", "message" => "Invalid credentials"]);
}
?>