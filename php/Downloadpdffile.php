<?php
include('../dbconnect/conn.php'); // Your database connection

if (isset($_GET['id'])) {
    $fileId = intval($_GET['id']); // Sanitize the file ID input

    // Fetch the file details from the database
    $stmt = $conn->prepare("SELECT path FROM pdffile WHERE fileid = ?");
    $stmt->bind_param("i", $fileId); // Bind the file ID
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $file = $result->fetch_assoc();
        $filePath = $file['path'];

        $fullPath = $filePath; // Full path to the file

        // Check if the file exists
        if (file_exists($fullPath)) {
            // Get the file's MIME type
            $mimeType = mime_content_type($fullPath);
            $fileName = basename($fullPath); // Extract the file name

            // Set headers to force download
            header("Content-Type: $mimeType");
            header("Content-Disposition: attachment; filename=\"$fileName\"");
            header("Content-Length: " . filesize($fullPath));

            // Read the file
            readfile($fullPath);
            exit;
        } else {
            echo "File does not exist at the path: $fullPath";
        }
    } else {
        echo "File not found in the database for ID: $fileId";
    }
} else {
    echo "No file ID provided.";
}
?>