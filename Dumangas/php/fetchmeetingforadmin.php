<?php
// Include your database connection (update the path if necessary)
include '../dbconnect/conn.php';

// Get today's date
$today = date('Y-m-d');
$tomorrow = date('Y-m-d', strtotime('+1 day'));

// Query to get meetings scheduled for today and tomorrow
$sql = "SELECT title, event_date, description, image FROM tblevents 
        WHERE category = 'meeting' AND event_date IN ('$today', '$tomorrow') 
        ORDER BY event_date ASC LIMIT 2";

$result = $conn->query($sql);
$meetings = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $meetings[] = $row; // Add each meeting to the array
    }
}

// Return JSON response
echo json_encode($meetings);
$conn->close();
