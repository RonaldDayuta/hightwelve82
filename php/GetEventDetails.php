<?php
require '../dbconnect/conn.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['event_id'])) {
    $event_id = $_POST['event_id'];

    $stmt = $conn->prepare("SELECT id, event_date, title, description, category, post_category FROM tblevents WHERE id = ?");
    $stmt->bind_param("i", $event_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $event = $result->fetch_assoc();
        echo json_encode(["status" => "success", "data" => $event]);
    } else {
        echo json_encode(["status" => "error", "message" => "Event not found"]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
}
