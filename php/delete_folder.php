<?php
// delete_folder.php

include '../dbconnect/conn.php'; // adjust based on your setup

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the folder ID from AJAX
    $id = $_POST['id'];

    // Sanitize input (basic)
    $id = intval($id);

    // Run deletion query
    $sql = "DELETE FROM folders WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        echo 'success';
    } else {
        http_response_code(500); // server error
        echo 'error';
    }
} else {
    http_response_code(405); // method not allowed
    echo 'Invalid request';
}
?>
