<?php
include '../dbconnect/conn.php'; // Adjust this based on your database connection file

$today = date('Y-m-d');

$sql = "SELECT event_date, title, description FROM tblevents WHERE category = 'events' AND event_date IN ('$today') ORDER BY event_date DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode($row);
} else {
    echo json_encode(["title" => "No Event", "event_date" => "", "description" => "No events available."]);
}

$conn->close();
