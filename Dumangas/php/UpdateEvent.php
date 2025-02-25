<?php
require '../dbconnect/conn.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $event_id = $_POST['event-id'];
    $event_date = trim($_POST['event-date']);
    $title = trim($_POST['event-title']);
    $description = trim($_POST['event-description']);
    $category = trim($_POST['event-category']);
    $post_category = trim($_POST['post-category']);

    // Check if a new image is uploaded
    if (isset($_FILES['event-image']) && $_FILES['event-image']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "../uploads/";
        $image_ext = strtolower(pathinfo($_FILES["event-image"]["name"], PATHINFO_EXTENSION));
        $unique_name = uniqid("event_", true) . "." . $image_ext;
        $image_path = $target_dir . $unique_name;
        move_uploaded_file($_FILES["event-image"]["tmp_name"], $image_path);

        $stmt = $conn->prepare("UPDATE tblevents SET event_date=?, title=?, description=?, category=?, post_category=?, image=? WHERE id=?");
        $stmt->bind_param("ssssssi", $event_date, $title, $description, $category, $post_category, $image_path, $event_id);
    } else {
        $stmt = $conn->prepare("UPDATE tblevents SET event_date=?, title=?, description=?, category=?, post_category=? WHERE id=?");
        $stmt->bind_param("sssssi", $event_date, $title, $description, $category, $post_category, $event_id);
    }

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Event updated successfully."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error updating event."]);
    }
}
