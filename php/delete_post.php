<?php
include '../dbconnect/conn.php'; // Database connection

header("Content-Type: application/json"); // Set JSON response header

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $post_id = $_POST['post_id'];
    $image_paths = json_decode($_POST['images'], true);
    $response = ["success" => false, "message" => ""];

    // Retrieve images from database (if not provided in the request)
    if (empty($image_paths)) {
        $query = "SELECT post_image FROM cms WHERE ID = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $post_id);
        $stmt->execute();
        $stmt->bind_result($image_json);
        $stmt->fetch();
        $stmt->close();

        $image_paths = json_decode($image_json, true);
    }

    // Delete images from the server
    if (!empty($image_paths)) {
        foreach ($image_paths as $image_path) {
            if (file_exists($image_path)) {
                unlink($image_path); // Delete image
            }
        }
    }

    // Delete post from database
    $sql = "DELETE FROM cms WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $post_id);

    if ($stmt->execute()) {
        $response["success"] = true;
        $response["message"] = "Post deleted successfully!";
    } else {
        $response["message"] = "Failed to delete post.";
    }

    $stmt->close();
    $conn->close();

    echo json_encode($response);
}
