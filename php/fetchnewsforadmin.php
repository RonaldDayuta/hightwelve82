<?php
include '../dbconnect/conn.php';

date_default_timezone_set('Asia/Manila'); // Set timezone

$sql = "SELECT * FROM tblevents 
        WHERE event_date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 2 DAY) 
        AND category = 'news-today' 
        ORDER BY event_date ASC"; // Para nakaayos by date

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $events = [];
    while ($row = $result->fetch_assoc()) {
        $events[] = $row;
    }
    echo json_encode($events);
} else {
    echo json_encode([]); // Empty array if walang events
}

$conn->close();
?>
