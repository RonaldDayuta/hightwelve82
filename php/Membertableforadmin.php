<?php
// Include your database connection (update the path if necessary)
include '../dbconnect/conn.php';

// Query to get the latest 2 meetings
$sql = "SELECT Username, Profile FROM tblaccounts";
$result = $conn->query($sql);

$members = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $members[] = $row; // Add each meeting to the array
    }
}

// Return JSON response
echo json_encode($members);
$conn->close();
