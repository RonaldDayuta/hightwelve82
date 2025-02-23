<?php
include '../dbconnect/conn.php'; // Database connection

header("Content-Type: application/json"); // Set JSON response header

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $post_id = $_POST['post_id'];
    $description = $_POST['description'];
    $response = ["success" => false, "message" => ""];

    // Handle image upload if new images are provided
    if (!empty($_FILES['images']['name'][0])) {
        $image_paths = [];
        $total_size = 0;
        $max_file_size = 20 * 1024 * 1024; // 20MB per file
        $max_total_size = 100 * 1024 * 1024; // 100MB total

        foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
            $file_size = $_FILES['images']['size'][$key];
            $original_name = pathinfo($_FILES['images']['name'][$key], PATHINFO_FILENAME);
            $extension = pathinfo($_FILES['images']['name'][$key], PATHINFO_EXTENSION);

            // Generate a unique filename using timestamp + random string
            $unique_id = uniqid() . "-" . time();
            $new_filename = $original_name . "_" . $unique_id . "." . $extension;
            $target_path = "../post/" . $new_filename;

            $total_size += $file_size;
            if ($file_size > $max_file_size) {
                $response["message"] = "Each image must be under 20MB!";
                echo json_encode($response);
                exit;
            }
            if ($total_size > $max_total_size) {
                $response["message"] = "Total image size must be under 100MB!";
                echo json_encode($response);
                exit;
            }

            if (move_uploaded_file($tmp_name, $target_path)) {
                $image_paths[] = $target_path;
            }
        }

        $image_json = json_encode($image_paths);

        $sql = "UPDATE cms SET description = ?, post_image = ? WHERE ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $description, $image_json, $post_id);
    } else {
        // If no new image, update only the description
        $sql = "UPDATE cms SET description = ? WHERE ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $description, $post_id);
    }

    if ($stmt->execute()) {
        $response["success"] = true;
        $response["message"] = "Post updated successfully!";
    } else {
        $response["message"] = "Failed to update post.";
    }

    $stmt->close();
    $conn->close();

    echo json_encode($response);
}
