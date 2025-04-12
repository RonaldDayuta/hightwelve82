<?php
// Include the database connection
include('../dbconnect/conn.php');

// Prepare the SQL query to fetch the content
$query = "SELECT about, history FROM tblcontent LIMIT 1"; // Adjust query based on your needs
$result = mysqli_query($conn, $query);

// Check if the query was successful
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $about = $row['about'];
    $history = $row['history'];
    
    // Return the data as JSON
    echo json_encode(['about' => $about, 'history' => $history]);
} else {
    // Log the error message if the query fails
    $error_message = mysqli_error($conn);
    echo json_encode(['error' => 'Failed to fetch data', 'details' => $error_message]);
}

mysqli_close($conn);
?>
