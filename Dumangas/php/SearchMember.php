<?php
include "../dbconnect/conn.php"; // Database connection

$searchQuery = isset($_GET['search']) ? $_GET['search'] : "";
$searchPattern = "%" . $searchQuery . "%"; // Wildcard for partial match

$query = "SELECT Profile, Username FROM tblaccounts 
          WHERE Username LIKE ? OR Email LIKE ?";

$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $searchPattern, $searchPattern);
$stmt->execute();
$result = $stmt->get_result();

$members = [];
while ($row = $result->fetch_assoc()) {
    $members[] = $row;
}

echo json_encode($members); // Return JSON response

$stmt->close();
$conn->close();
