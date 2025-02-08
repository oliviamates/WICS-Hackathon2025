<?php
include "db.php";
$data = json_decode(file_get_contents("php://input"));
$username = $data->username;
$password = $data->password;

$query = $conn->prepare("SELECT * FROM users WHERE username = ?");
$query->execute([$username]);
$user = $query->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user['password'])) {
    echo json_encode(["status" => "success", "user_id" => $user['id'], "role" => $user['role']]);
} else {
    echo json_encode(["status" => "error", "message" => "Invalid credentials"]);
}
?>