<?php
include('../dbconnect/conn.php'); // Include database connection

if (isset($_FILES['officerimage'])) {
    $fileName = $_FILES['officerimage']['name'];
    $fileSize = $_FILES['officerimage']['size'];
    $fileTmpName = $_FILES['officerimage']['tmp_name'];
    $fileType = $_FILES['officerimage']['type'];
    $maxSize = 20 * 1024 * 1024; // 20MB in bytes

    if ($fileSize > $maxSize) {
        echo json_encode(['success' => false, 'message' => 'File size should not exceed 20MB.']);
        exit;
    }

    $uploadPath = "../Officerimage/" . basename($fileName);

    if (move_uploaded_file($fileTmpName, $uploadPath)) {
        $officerName = $_POST['officerName'];
        $officerPosition = $_POST['officerPosition'];
        $positionDescription = $_POST['positionDescription'];
        $sql = "INSERT INTO tblofficers (Name, Position, PosDecs, Image) VALUES ('$officerName', '$officerPosition', '$positionDescription', '$uploadPath')";

        if ($conn->query($sql) === TRUE) {
            echo json_encode(['success' => true, 'message' => 'Officer added successfully!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error: ' . $sql . '<br>' . $conn->error]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'An error occurred while uploading the file.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'No file uploaded.']);
}

$conn->close();
