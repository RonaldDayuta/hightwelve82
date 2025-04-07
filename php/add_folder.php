<?php
include '../dbconnect/conn.php';

$folderId = $_POST['folderId'];
$folderName = $_POST['folderName'];

// Set Philippine timezone
date_default_timezone_set('Asia/Manila');
$dateAdded = date('Y-m-d H:i:s');

$sql = "INSERT INTO folders (id, foldername, dateadded) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $folderId, $folderName, $dateAdded);

if ($stmt->execute()) {
    echo "success";
} else {
    echo "error";
}

$stmt->close();
$conn->close();
?>
