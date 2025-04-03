<?php
session_start(); // Make sure this is at the very top

header("Content-Type: application/json");

// Include the database connection
include "dbconnect/conn.php"; // Ensure this file contains a proper database connection

// Get JSON input from the request body
$data = json_decode(file_get_contents("php://input"), true); // Decode JSON to associative array

if (!$data || !isset($data['username']) || !isset($data['password'])) {
    echo json_encode(["success" => false, "message" => "Invalid request"]);
    exit;
}

$username = $data['username'];
$password = $data['password'];

// Debug: Check received username
error_log("Username received: " . $username);

// Query the database for the user
$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Debug: Check if user exists
if (!$user) {
    error_log("No user found with username: " . $username);
    echo json_encode(["success" => false, "message" => "Invalid username or password"]);
    exit;
}

// Debug: Check the stored password in the database
error_log("Stored Password: " . $user['password']);

// Compare the plain text password
if ($password === $user["password"]) {
    $_SESSION["loggedIn"] = true;
    $_SESSION["username"] = $user["username"];
    
    echo json_encode(["success" => true, "message" => "Login successful"]);
} else {
    echo json_encode(["success" => false, "message" => "Invalid username or password"]);
}

// Close the prepared statement and the database connection
$stmt->close();
$conn->close();
?>
