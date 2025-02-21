<?php
include('../dbconnect/conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE tblaccounts SET Email=?, Username=?, Password=? WHERE ID=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $email, $username, $hashedPassword, $id);
    } else if (!empty($_FILES["image"]["name"])) {
        $fileName = $_FILES['image']['name'];
        $fileSize = $_FILES['image']['size'];
        $fileTmpName = $_FILES['image']['tmp_name'];
        $fileType = $_FILES['image']['type']; // Get image size in bytes (B)
        $maxSize = 20 * 1024 * 1024; // 20MB in bytes

        if ($fileSize > $maxSize) {
            echo json_encode(["success" => false, "message" => "Image size exceeds 20MB limit!"]);
            exit();
        }

        $uploadPath = "../ProfileUpload/" . basename($fileName);
        if (move_uploaded_file($fileTmpName, $uploadPath)) {
            $stmt = $conn->prepare("UPDATE tblaccounts SET Email=?, Username=?, Profile=? WHERE ID=?");
            $stmt->bind_param("sssi", $email, $username, $uploadPath, $id);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to upload image."]);
            exit();
        }
    } else if (!empty($password && $_FILES["image"]["name"])) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $fileName = $_FILES['image']['name'];
        $fileSize = $_FILES['image']['size'];
        $fileTmpName = $_FILES['image']['tmp_name'];
        $fileType = $_FILES['image']['type']; // Get image size in bytes (B)
        $maxSize = 20 * 1024 * 1024; // 20MB in bytes

        if ($fileSize > $maxSize) {
            echo json_encode(["success" => false, "message" => "Image size exceeds 20MB limit!"]);
            exit();
        }

        $uploadPath = "../ProfileUpload/" . basename($fileName);
        if (move_uploaded_file($fileTmpName, $uploadPath)) {
            $stmt = $conn->prepare("UPDATE tblaccounts SET Email=?, Username=?, Password=?, Profile=? WHERE ID=?");
            $stmt->bind_param("ssssi", $email, $username, $hashedPassword, $uploadPath, $id);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to upload image."]);
            exit();
        }
    } else {
        $stmt = $conn->prepare("UPDATE tblaccounts SET Email=?, Username=? WHERE ID=?");
        $stmt->bind_param("ssi", $email, $username, $id);
    }

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Your Account will LOGOUT to see the changes"]);
    } else {
        echo json_encode(["success" => false, "message" => "Error: " . $stmt->error]);
    }
}
$conn->close();
