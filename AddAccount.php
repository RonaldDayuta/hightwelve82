<?php
include('conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['account-email'];
    $password = $_POST['account-password'];
    $confirm_password = $_POST['account-copassword'];
    $position = $_POST['account-position'];

    if ($password !== $confirm_password) {
        echo json_encode(["success" => false, "message" => "Passwords do not match!"]);
        exit();
    }

    $encrypted_password = openssl_encrypt($password, "AES-128-ECB", 'hightwelve82');

    $upload_dir = "ProfileUpload/";
    $image_path = "img/logo.png";

    if (!empty($_FILES['account-image']['name'])) {
        $image_tmp = $_FILES['account-image']['tmp_name'];
        $image_ext = pathinfo($_FILES['account-image']['name'], PATHINFO_EXTENSION);
        $image_name = uniqid("profile_", true) . "." . $image_ext;
        $image_path = $upload_dir . $image_name;

        if (!move_uploaded_file($image_tmp, $image_path)) {
            echo json_encode(["success" => false, "message" => "Failed to upload image"]);
            exit();
        }
    }

    $stmt = $conn->prepare("INSERT INTO accounts (Email, Password, WebPosition, Profile) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $email, $encrypted_password, $position, $image_path);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Account added successfully!"]);
    } else {
        echo json_encode(["success" => false, "message" => "Database error!"]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["success" => false, "message" => "Invalid request"]);
}
