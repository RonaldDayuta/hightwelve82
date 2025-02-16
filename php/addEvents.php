<?php
require '../dbconnect/conn.php'; // Database connection file

header('Content-Type: application/json'); // Ensure JSON response

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $event_date = $_POST['event_date'] ?? '';
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $category = $_POST['category'] ?? '';
    $image_path = '';

    if (empty($event_date) || empty($title) || empty($description) || empty($category)) {
        echo json_encode(["status" => "error", "message" => "All fields are required."]);
        exit();
    }

    // Check if file is uploaded
    if (!empty($_FILES['image']['name'])) {
        $target_dir = "../uploads/"; // Make sure this directory exists!
        $image_path = $target_dir . basename($_FILES["image"]["name"]);

        if (!move_uploaded_file($_FILES["image"]["tmp_name"], $image_path)) {
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
