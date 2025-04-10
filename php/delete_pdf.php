<?php
// delete_folder.php

include '../dbconnect/conn.php'; // adjust based on your setup

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['fileid']); // Sanitize

    // Step 1: Get the file name/path from DB
    $query = "SELECT path FROM pdffile WHERE fileid = $id";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $filePath = $row['path']; // Adjust path as needed

        // Step 2: Delete file from folder
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        // Step 3: Delete record from DB
        $deleteSql = "DELETE FROM pdffile WHERE fileid = $id";
        if (mysqli_query($conn, $deleteSql)) {
            echo 'success';
        } else {
            http_response_code(500);
            echo 'Failed to delete record from database';
        }
    } else {
        http_response_code(404);
        echo 'File not found in database';
    }
} else {
    http_response_code(405);
    echo 'Invalid request method';
}
?>
