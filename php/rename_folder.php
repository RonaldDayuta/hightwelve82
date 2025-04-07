<?php
// rename_folder.php

include '../dbconnect/conn.php'; // Update this line as needed

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $foldername = trim($_POST['foldername']);

    if (!empty($foldername)) {
        $stmt = $conn->prepare("UPDATE folders SET foldername = ? WHERE id = ?");
        $stmt->bind_param("si", $foldername, $id);

        if ($stmt->execute()) {
            echo 'success';
        } else {
            http_response_code(500);
            echo 'error';
        }
        $stmt->close();
    } else {
        http_response_code(400); // Bad request
        echo 'Folder name is empty';
    }
} else {
    http_response_code(405); // Method not allowed
    echo 'Invalid request';
}
?>
