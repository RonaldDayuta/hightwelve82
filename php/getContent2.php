<?php
// Include the database connection
include('../dbconnect/conn.php');

// Prepare the SQL query to fetch the content
$query = "SELECT about, history FROM tblcontent ORDER BY id DESC LIMIT 1"; // Adjust if you want latest entry
$result = mysqli_query($conn, $query);

// Check if the query was successful
if ($result) {
    $row = mysqli_fetch_assoc($result);
    
    // Apply formatting to preserve line breaks and sanitize output
    $about = $row['about'];
    
    // Return the data as JSON
    echo json_encode(['about' => $about]);
} else {
    // Log the error message if the query fails
    $error_message = mysqli_error($conn);
    echo json_encode(['error' => 'Failed to fetch data', 'details' => $error_message]);
}

mysqli_close($conn);
?>
