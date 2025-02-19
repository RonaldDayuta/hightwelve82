<?php
include('../dbconnect/conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $profile_img = mysqli_real_escape_string($conn, $_POST['profile_img']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $imagePath = "";

    $upload_dir = "../post/";

    if (!empty($_FILES['image']['name'])) {
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $image_name = uniqid("post_", true) . "." . $image_ext;
        $image_path = $upload_dir . $image_name;

        if (!move_uploaded_file($image_tmp, $image_path)) {
            echo json_encode(["success" => false, "message" => "Error uploading file"]);
            exit();
        }
    }

    // Insert into database
    $sql = "INSERT INTO cms (Username, profile, description, post_image) 
            VALUES ('$username', '$profile_img', '$description', '$image_path')";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(["success" => true, "message" => "Posted successfully!"]);
    } else {
        echo json_encode(["success" => false, "message" => "Database error: " . mysqli_error($conn)]);
    }
}
