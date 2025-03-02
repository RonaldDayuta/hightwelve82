<?php
include "../dbconnect/conn.php"; // Database connection

$searchQuery = isset($_GET['search']) ? $_GET['search'] : "";
$searchPattern = "%" . $searchQuery . "%"; // Wildcard for partial match

$query = "SELECT * FROM tblaccounts 
          WHERE is_hidden = 0 
          AND (Username LIKE ? 
               OR first_name LIKE ? 
               OR middle_name LIKE ? 
               OR last_name LIKE ? 
               OR suffix LIKE ?)";

$stmt = $conn->prepare($query);
$stmt->bind_param("sssss", $searchPattern, $searchPattern, $searchPattern, $searchPattern, $searchPattern);
$stmt->execute();
$result = $stmt->get_result();

$members = [];
while ($row = $result->fetch_assoc()) {
    $members[] = $row;
}

echo json_encode($members); // Return JSON response

$stmt->close();
$conn->close();
