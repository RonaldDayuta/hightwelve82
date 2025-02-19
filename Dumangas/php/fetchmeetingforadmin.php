<?php
// Include your database connection (update the path if necessary)
include '../dbconnect/conn.php';

// Query to get the latest 2 meetings
$sql = "SELECT title, event_date, description, image FROM tblevents WHERE category = 'meeting' ORDER BY event_date asc LIMIT 2";
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
