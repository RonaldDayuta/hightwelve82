<?php
include '../dbconnect/conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $officerID = $_POST["officerID"];
    $name = $_POST["officerName"];
    $positionNumber = $_POST["officerPositionNumber"]; // e.g., 1
    $positionWord = $_POST["officerPositionWord"];     // e.g., Worshipful Master
    $posDesc = $_POST["positionDescription"];

    // Check if a new image is uploaded
    if (!empty($_FILES["officerImage"]["name"])) {
        $fileExt = pathinfo($_FILES["officerImage"]["name"], PATHINFO_EXTENSION);
        $uniqueFileName = uniqid("officer_", true) . "." . $fileExt;
        $fileSize = $_FILES['officerImage']['size'];
        $fileTmpName = $_FILES['officerImage']['tmp_name'];
        $fileType = $_FILES['officerImage']['type'];
        $maxSize = 20 * 1024 * 1024; // 20MB

        if ($fileSize > $maxSize) {
            echo json_encode(["success" => false, "message" => "Image size exceeds 20MB limit!"]);
            exit();
        }

        $uploadPath = "../Officerimage/" . $uniqueFileName;

        if (move_uploaded_file($fileTmpName, $uploadPath)) {
            // With image update
            $stmt = $conn->prepare("UPDATE tblofficers SET Name = ?, PositionNumber = ?, Position = ?, PosDecs = ?, Image = ? WHERE ID = ?");
            $stmt->bind_param("sisssi", $name, $positionNumber, $positionWord, $posDesc, $uploadPath, $officerID);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to upload image."]);
            exit();
        }
    } else {
        // Without image update
        $stmt = $conn->prepare("UPDATE tblofficers SET Name = ?, PositionNumber = ?, Position = ?, PosDecs = ? WHERE ID = ?");
        $stmt->bind_param("sissi", $name, $positionNumber, $positionWord, $posDesc, $officerID);
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
