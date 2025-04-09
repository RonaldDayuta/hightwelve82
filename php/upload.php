<?php
include '../dbconnect/conn.php';

if (isset($_FILES['file'])) {
    $folderid = $_POST['folderid'];
    $fileid = $_POST['fileid'];
    $filename = basename($_FILES["file"]["name"]);
    $targetDir = "../PDFFiles/";
    $targetFile = $targetDir . $filename;
    $uploadOk = 1;

    // Validate file type (PDF only)
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    if ($fileType != "pdf") {
        echo "Only PDF files are allowed.";
        $uploadOk = 0;
    }

    // Upload file
    if ($uploadOk && move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
        // Save file info to database
        $stmt = $conn->prepare("INSERT INTO pdffile (folderid, fileid, name, path) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiss", $folderid, $fileid, $filename, $targetFile);

        if ($stmt->execute()) {
            echo "File uploaded and saved successfully.";
        } else {
            echo "Database error: " . $stmt->error;
        }
    } else {
        echo "Failed to upload the file.";
    }
}
?>
