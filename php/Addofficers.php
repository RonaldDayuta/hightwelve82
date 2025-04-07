<?php
include('../dbconnect/conn.php'); // Include database connection

if (isset($_FILES['officerimage'])) {
    $fileExt = pathinfo($_FILES['officerimage']['name'], PATHINFO_EXTENSION);
    $uniqueFileName = uniqid("officer_", true) . "." . $fileExt;
    $fileSize = $_FILES['officerimage']['size'];
    $fileTmpName = $_FILES['officerimage']['tmp_name'];
    $fileType = $_FILES['officerimage']['type'];
    $maxSize = 20 * 1024 * 1024;

    if ($fileSize > $maxSize) {
        echo json_encode(['success' => false, 'message' => 'File size should not exceed 20MB.']);
        exit;
    }

    $uploadPath = "../Officerimage/" . $uniqueFileName;

    if (move_uploaded_file($fileTmpName, $uploadPath)) {
        $officerName = $_POST['officerName'];
        $officerPositionWord = $_POST['officerPositionWord'];
        $officerPositionNumber = $_POST['officerPositionNumber'];
        $positionDescription = $_POST['positionDescription'];

        $checkSql = "SELECT * FROM tblofficers WHERE PositionNumber = ?";
        $checkStmt = $conn->prepare($checkSql);
        $checkStmt->bind_param("i", $officerPositionNumber);
        $checkStmt->execute();
        $result = $checkStmt->get_result();

        if ($result->num_rows > 0) {
            echo json_encode(['success' => false, 'message' => 'This position is already taken.']);
        } else {
            $sql = "INSERT INTO tblofficers (Name, Position, PosDecs, PositionNumber, Image) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssds", $officerName, $officerPositionWord, $positionDescription, $officerPositionNumber, $uploadPath);

            if ($stmt->execute()) {
                echo json_encode(['success' => true, 'message' => 'Officer added successfully!']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Database error: ' . $conn->error]);
            }
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'An error occurred while uploading the file.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'No file uploaded.']);
}

$conn->close();
