<?php
require '../dbconnect/conn.php';

$events = [];
$result = $conn->query("SELECT * FROM tblevents");

while ($row = $result->fetch_assoc()) {
    $events[] = $row;
}

echo json_encode($events);
?>
