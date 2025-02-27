<?php
// Include your database connection
include '../dbconnect/conn.php';

// Set timezone to avoid date mismatch issues
date_default_timezone_set('Asia/Manila');

// Get today's date and the date 5 days from today
$today = date('Y-m-d');
$next5Days = date('Y-m-d', strtotime('+5 days'));

// Query to get meetings scheduled from today to the next 5 days
$sql = "SELECT title, event_date, description, image FROM tblevents 
        WHERE category = 'meeting' AND event_date BETWEEN ? AND ? 
        ORDER BY event_date ASC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $today, $next5Days);
$stmt->execute();
$result = $stmt->get_result();

$meetings = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $meetings[] = $row; // Add each meeting to the array
    }
}

// Return JSON response
echo json_encode($meetings);

$stmt->close();
$conn->close();
