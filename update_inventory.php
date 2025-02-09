<?php
// db.php: This file will contain the database connection logic
session_start();
include 'db.php';

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $foodDescription = $_POST['subject'];
    $amount = $_POST['firstname'];

    // Sanitize inputs (You can make further validation if needed)
    $foodDescription = htmlspecialchars($foodDescription);
    $amount = intval($amount);

    $restaurantName = $_SESSION['restaurant_name'];  // Ensure this session variable is set

    // Get the restaurant owner's ID using the restaurant name
    $query = $conn->prepare("SELECT id FROM restaurant_owners WHERE restaurant_name = ?");
    $query->execute([$restaurantName]);
    $restaurantOwner = $query->fetch(PDO::FETCH_ASSOC);

    if ($restaurantOwner) {
        $restaurantOwnerId = $restaurantOwner['id'];

        // Insert the new food entry into the database
        $query = $conn->prepare("INSERT INTO food_entries (restaurant_name, food_type, amount, restaurant_owner_id) 
                                 VALUES (?, ?, ?, ?)");
        $query->execute([$restaurantName, $foodDescription, $amount, $restaurantOwnerId]);

        // Redirect or give feedback
        echo "Food item added successfully!";
    } else {
        echo "Restaurant owner not found!";
    }
}
?>