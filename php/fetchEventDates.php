<?php
include '../dbconnect/conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $month = $_POST['month'];
    $year = $_POST['year'];

    // Fetch all event dates for the given month and year
    $query = "SELECT DISTINCT event_date FROM tblevents WHERE YEAR(event_date) = ? AND MONTH(event_date) = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $year, $month);
    $stmt->execute();
    $result = $stmt->get_result();

    $eventDates = [];

    while ($row = $result->fetch_assoc()) {
        $eventDates[] = $row['event_date'];
    }

    echo json_encode($eventDates); // Return JSON array of event dates
} else {
    echo json_encode([]); // Return an empty array if the request is invalid
}
