<?php
include '../dbconnect/conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $officerID = $_POST["officerID"];
    $name = $_POST["officerName"];
    $position = $_POST["officerPosition"];
    $posDesc = $_POST["positionDescription"];

    // Check if a new image is uploaded
    if (!empty($_FILES["officerImage"]["name"])) {
        $fileExt = pathinfo($_FILES["officerImage"]["name"], PATHINFO_EXTENSION);
        $uniqueFileName = uniqid("officer_", true) . "." . $fileExt; // Generate a unique filename
        $fileSize = $_FILES['officerImage']['size'];
        $fileTmpName = $_FILES['officerImage']['tmp_name'];
        $fileType = $_FILES['officerImage']['type']; // Get image size in bytes (B)
        $maxSize = 20 * 1024 * 1024; // 20MB in bytes

        // 20MB Limit (20 * 1024 * 1024 = 20971520 bytes)
        if ($fileSize > $maxSize) {
            echo json_encode(["success" => false, "message" => "Image size exceeds 20MB limit!"]);
            exit();
        }

        $uploadPath = "../Officerimage/" . $uniqueFileName;

        if (move_uploaded_file($fileTmpName, $uploadPath)) {
            $stmt = $conn->prepare("UPDATE tblofficers SET Name = ?, Position = ?, PosDecs = ?, Image = ? WHERE ID = ?");
            $stmt->bind_param("ssssi", $name, $position, $posDesc, $uploadPath, $officerID);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to upload image."]);
            exit();
        }
    } else {
        // If no new image, keep the old one
        $stmt = $conn->prepare("UPDATE tblofficers SET Name = ?, Position = ?, PosDecs = ? WHERE ID = ?");
        $stmt->bind_param("sssi", $name, $position, $posDesc, $officerID);
    }

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Update Successful"]);
    } else {
        echo json_encode(["success" => false, "message" => "Error: " . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "Invalid request."]);
}

$conn->close();
