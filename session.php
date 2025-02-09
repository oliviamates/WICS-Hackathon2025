<?php
session_start();
header("Content-Type: application/json");

if (isset($_SESSION['restaurant_name'])) {
    echo json_encode(["restaurant_name" => $_SESSION['restaurant_name']]);
} else {
    echo json_encode(["restaurant_name" => "Guest"]);
}
?>