<?php
include '../dbconnect/conn.php';

date_default_timezone_set('Asia/Manila'); // Set timezone
$today = date('Y-m-d');

$sql = "SELECT event_date, title, description 
        FROM tblevents 
        WHERE category = 'news-today' AND post_category = 'internal' OR post_category = 'both'
        AND DATE(event_date) = ? 
        ORDER BY event_date DESC 
        LIMIT 1";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $today);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode($row);
} else {
    echo json_encode(["title" => "No Event", "event_date" => "", "description" => "No news available."]);
}

$stmt->close();
$conn->close();
