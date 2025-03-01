<?php
include('../dbconnect/conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    date_default_timezone_set("Asia/Manila"); // Set timezone to Philippine Time
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $profile_img = mysqli_real_escape_string($conn, $_POST['profile_img']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $post_time = date("Y-m-d H:i:s"); // Get current date and time in PHT

    $upload_dir = "../post/";
    $image_paths = [];
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif']; // Allowed file types
    $max_file_size = 20 * 1024 * 1024; // 20MB per image
    $max_total_size = 100 * 1024 * 1024; // 100MB total for all images

    $total_uploaded_size = 0;

    if (!empty($_FILES['images']['name'][0])) {
        foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
            $image_ext = strtolower(pathinfo($_FILES['images']['name'][$key], PATHINFO_EXTENSION));
            $image_size = $_FILES['images']['size'][$key]; // Get file size
            $image_name = uniqid("post_", true) . "." . $image_ext;
            $image_path = $upload_dir . $image_name;

            // **Check file extension**
            if (!in_array($image_ext, $allowed_extensions)) {
                echo json_encode(["success" => false, "message" => "Invalid file type! Only JPG, JPEG, PNG, and GIF are allowed."]);
                exit();
            }

            // **Check file size (limit to 20MB per image)**
            if ($image_size > $max_file_size) {
                echo json_encode(["success" => false, "message" => "One of the images exceeds the 20MB limit!"]);
                exit();
            }

            // **Check total size limit (100MB)**
            $total_uploaded_size += $image_size;
            if ($total_uploaded_size > $max_total_size) {
                echo json_encode(["success" => false, "message" => "Total upload size exceeds 100MB!"]);
                exit();
            }

            // Move uploaded file if valid
            if (move_uploaded_file($tmp_name, $image_path)) {
                $image_paths[] = $image_path;
            }
        }
    }

    // Store multiple images as a JSON string in the database
    $image_json = json_encode($image_paths);

    $sql = "INSERT INTO cms (Username, profile, description, post_image, date) 
            VALUES ('$username', '$profile_img', '$description', '$image_json', '$post_time')";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(["success" => true, "message" => "Posted successfully!", "timestamp" => $post_time]);
    } else {
        echo json_encode(["success" => false, "message" => "Database error: " . mysqli_error($conn)]);
    }
}
?>
