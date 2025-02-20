<?php
include '../dbconnect/conn.php';

$response = ["success" => false];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $officerID = $_POST["officerID"];
    $name = $_POST["officerName"];
    $position = $_POST["officerPosition"];
    $posDesc = $_POST["positionDescription"];

    // Check if a new image is uploaded
    if (!empty($_FILES["officerImage"]["name"])) {
        $targetDir = "../officerimage/";
        $imageName = basename($_FILES["officerImage"]["name"]);
        $targetFilePath = $targetDir . $imageName;
        $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
        $allowedTypes = ["jpg", "jpeg", "png", "gif"];
        $imageSize = $_FILES["officerImage"]["size"]; // Get image size in bytes (B)

        // **20MB Limit (20 * 1024 * 1024 = 20971520 bytes)**
        if ($imageSize > 20 * 1024 * 1024) {
            echo json_encode(["success" => false, "message" => "Image size exceeds 20MB limit!"]);
            exit();
        }

        if (in_array($imageFileType, $allowedTypes)) {
            if (move_uploaded_file($_FILES["officerImage"]["tmp_name"], $targetFilePath)) {
                $stmt = $conn->prepare("UPDATE tblofficers SET Name = ?, Position = ?, PosDecs = ?, Image = ? WHERE ID = ?");
                $stmt->bind_param("ssssi", $name, $position, $posDesc, $targetFilePath, $officerID);
            } else {
                echo json_encode(["success" => false, "message" => "Failed to upload image."]);
                exit();
            }
        } else {
            echo json_encode(["success" => false, "message" => "Invalid image format! Only JPG, JPEG, PNG, and GIF are allowed."]);
            exit();
        }
    } else {
        // If no new image, keep the old one
        $stmt = $conn->prepare("UPDATE tblofficers SET Name = ?, Position = ?, PosDecs = ? WHERE ID = ?");
        $stmt->bind_param("sssi", $name, $position, $posDesc, $officerID);
    }

    if ($stmt->execute()) {
        $response["success"] = true;
    }

    $stmt->close();
}

$conn->close();
echo json_encode($response);
