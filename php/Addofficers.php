<?php
include('../dbconnect/conn.php'); // Include database connection

if (isset($_FILES['officerimage'])) {
    $fileExt = pathinfo($_FILES['officerimage']['name'], PATHINFO_EXTENSION);
    $uniqueFileName = uniqid("officer_", true) . "." . $fileExt; // Generate unique filename
    $fileSize = $_FILES['officerimage']['size'];
    $fileTmpName = $_FILES['officerimage']['tmp_name'];
    $fileType = $_FILES['officerimage']['type'];
    $maxSize = 20 * 1024 * 1024; // 20MB in bytes

    // Check if the file size exceeds the maximum size
    if ($fileSize > $maxSize) {
        echo json_encode(['success' => false, 'message' => 'File size should not exceed 20MB.']);
        exit;
    }

    $uploadPath = "../Officerimage/" . $uniqueFileName;

    // Try to upload the file
    if (move_uploaded_file($fileTmpName, $uploadPath)) {
        // Get form data
        $officerName = $conn->real_escape_string($_POST['officerName']);
        $officerPosition = $conn->real_escape_string($_POST['officerPosition']);
        $positionNumber = isset($_POST['positionNumber']) ? (int)$_POST['positionNumber'] : 0; // Get position number from the form
        $positionDescription = $conn->real_escape_string($_POST['positionDescription']);

        // Insert the officer data into the database
        $sql = "INSERT INTO tblofficers (Name, Position, PosDecs, PositionNumber, Image)
                VALUES ('$officerName', '$officerPosition', '$positionDescription', '$positionNumber', '$uploadPath')";

        if ($conn->query($sql) === TRUE) {
            echo json_encode(['success' => true, 'message' => 'Officer added successfully!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Database error: ' . $conn->error]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'An error occurred while uploading the file.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'No file uploaded.']);
}

$conn->close();
