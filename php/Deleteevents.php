<?php
include '../dbconnect/conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $eventID = $_POST["id"];

    if (!empty($eventID)) {
        // Fetch the image path before deletion
        $stmt = $conn->prepare("SELECT image FROM tblevents WHERE id = ?");
        $stmt->bind_param("i", $eventID);
        $stmt->execute();
        $stmt->bind_result($imagePath);
        $stmt->fetch();
        $stmt->close();

        // Delete the image file if it exists
        if (!empty($imagePath) && file_exists($imagePath)) {
            unlink($imagePath); // Delete the image from server
        }

        // Now delete the event record from database
        $stmt = $conn->prepare("DELETE FROM tblevents WHERE id = ?");
        $stmt->bind_param("i", $eventID);

        if ($stmt->execute()) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "message" => "Database error!"]);
        }

        $stmt->close();
    } else {
        echo json_encode(["success" => false, "message" => "Invalid Event ID!"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request"]);
}

$conn->close();
