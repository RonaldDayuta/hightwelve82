<?php
require '../dbconnect/conn.php';

header('Content-Type: application/json'); // Ensure JSON response

$events = [];
$result = $conn->query("SELECT * FROM tblevents");

while ($row = $result->fetch_assoc()) {
    $events[] = [
        "id" => $row["id"],
        "event_date" => $row["event_date"],
        "title" => htmlspecialchars($row["title"]), // Prevent special char issues
        "description" => htmlspecialchars($row["description"]),
        "category" => $row["category"],
        "image" => $row["image"]
    ];
}

echo json_encode($events);
?>
