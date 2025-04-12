<?php
// Include the database connection
include('../dbconnect/conn.php');

// Check if form data is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $about = $_POST['about'];
    $history = $_POST['history'];

    // Check if fields are empty
    if (empty($about) || empty($history)) {
        echo 'All fields are required.';
    } else {
        // Prepare SQL query for inserting new content into the database using prepared statements
        $query = "INSERT INTO tblcontent (about, history) VALUES (?, ?)";

        // Initialize prepared statement
        if ($stmt = mysqli_prepare($conn, $query)) {
            // Bind parameters to the prepared statement
            mysqli_stmt_bind_param($stmt, 'ss', $about, $history); // 'ss' indicates two string parameters

            // Execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                echo 'success'; // If successful, return success
            } else {
                echo 'Failed to insert data: ' . mysqli_error($conn); // If an error occurs, return error message
            }

            // Close the prepared statement
            mysqli_stmt_close($stmt);
        } else {
            echo 'Failed to prepare the SQL statement: ' . mysqli_error($conn);
        }
    }
}
?>
