<?php
include('../dbconnect/conn.php'); // Include database connection

$response = ["success" => false];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["officerName"];
    $position = $_POST["officerPosition"];
    $posDesc = $_POST["positionDescription"];

    // Image upload handling
    $targetDir = "../officerimage/";
    $imageName = basename($_FILES["officerimage"]["name"]);
    $targetFilePath = $targetDir . $imageName;
    $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
    $allowedTypes = ["jpg", "jpeg", "png", "gif"];
    $maxFileSize = 20 * 1024 * 1024; // 20MB limit

    // Check if file is a valid image
    if (!in_array($imageFileType, $allowedTypes)) {
        echo json_encode(["success" => false, "message" => "Invalid file type! Only JPG, JPEG, PNG, and GIF are allowed."]);
        exit();
    }

    // Check file size (limit to 20MB)
    if ($_FILES["officerimage"]["size"] > $maxFileSize) {
        echo json_encode(["success" => false, "message" => "Image size exceeds 20MB limit!"]);
        exit();
    }

    if (move_uploaded_file($_FILES["officerimage"]["tmp_name"], $targetFilePath)) {
        // Insert into database
        $stmt = $conn->prepare("INSERT INTO tblofficers (Name, Position, PosDecs, Image) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $position, $posDesc, $targetFilePath);

        if ($stmt->execute()) {
            $response["success"] = true;
        }

        $stmt->close();
    }

    $conn->close();
}

echo json_encode($response);
