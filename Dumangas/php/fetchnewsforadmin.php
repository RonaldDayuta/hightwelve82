<?php
include '../dbconnect/conn.php'; // Database connection

// Set timezone to avoid date mismatches
date_default_timezone_set('Asia/Manila');

// Get today's date
$today = date('Y-m-d');

// Use a prepared statement for security
$sql = "SELECT event_date, title, description FROM tblevents 
        WHERE category = ? AND event_date = ? 
        ORDER BY event_date DESC LIMIT 1";

$stmt = $conn->prepare($sql);
$category = 'news-today';
$stmt->bind_param("ss", $category, $today);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode($row);
} else {
    echo json_encode([
        "title" => "No Event",
        "event_date" => "",
        "description" => "No events available."
    ]);
}

// Close connections
$stmt->close();
$conn->close();
