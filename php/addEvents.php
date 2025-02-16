<?php
require '../dbconnect/conn.php'; // Database connection file

header('Content-Type: application/json'); // Ensure JSON response
ob_start(); // Start output buffering

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $event_date  = isset($_POST['event-date']) ? trim($_POST['event-date']) : '';
    $title       = isset($_POST['event-title']) ? trim($_POST['event-title']) : '';
    $description = isset($_POST['event-description']) ? trim($_POST['event-description']) : '';
    $category    = isset($_POST['event-category']) ? trim($_POST['event-category']) : '';
    $image_path  = ''; // Default na walang laman

    if (empty($event_date) || empty($title) || empty($description) || empty($category)) {
        echo json_encode(["status" => "error", "message" => "All fields are required."]);
        exit();
    }

    // Check if file is uploaded
    if (isset($_FILES['event-image']) && $_FILES['event-image']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "../uploads/"; // Make sure this directory exists!
        $image_name = basename($_FILES["event-image"]["name"]);
        $image_path = $target_dir . $image_name;

        // Move uploaded file
        if (!move_uploaded_file($_FILES["event-image"]["tmp_name"], $image_path)) {
            echo json_encode(["status" => "error", "message" => "Error uploading image."]);
            exit();
        }
    }

    // Prepare and execute query
    $stmt = $conn->prepare("INSERT INTO tblevents (event_date, title, description, category, image) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $event_date, $title, $description, $category, $image_path);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Event added successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error adding event: " . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
}
?>
