<?php
include('../dbconnect/conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $profile_img = mysqli_real_escape_string($conn, $_POST['profile_img']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    $upload_dir = "../post/";
    $image_paths = [];

    if (!empty($_FILES['images']['name'][0])) {
        foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
            $image_ext = strtolower(pathinfo($_FILES['images']['name'][$key], PATHINFO_EXTENSION));
            $image_name = uniqid("post_", true) . "." . $image_ext;
            $image_path = $upload_dir . $image_name;

            if (move_uploaded_file($tmp_name, $image_path)) {
                $image_paths[] = $image_path;
            }
        }
    }

    // Store multiple images as a JSON string in the database
    $image_json = json_encode($image_paths);

    $sql = "INSERT INTO cms (Username, profile, description, post_image) 
            VALUES ('$username', '$profile_img', '$description', '$image_json')";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(["success" => true, "message" => "Posted successfully!"]);
    } else {
        echo json_encode(["success" => false, "message" => "Database error: " . mysqli_error($conn)]);
    }
}
