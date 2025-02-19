<?php
include '../dbconnect/conn.php'; // Database connection

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Prepare the SQL statement to fetch account by ID
    $sqlstmt = "SELECT * FROM tblaccounts WHERE ID = ?";
    $stmt = $conn->prepare($sqlstmt);

    if ($stmt) {
        // Bind the parameter AFTER preparing the statement
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // You can include the hashed password in the response as-is
            // This would be the hashed version stored in the database
            $row['HashedPassword'] = $row['Password'];

            // Optionally, you can remove the password from the response if you want to avoid returning sensitive data
            // unset($row['Password']);  // Uncomment this line to exclude the password field from the response

            // Return account data including hashed password in JSON format
            echo json_encode(array('status' => 'success', 'data' => $row));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'No account found with this ID'));
        }

        $stmt->close();
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Database query failed'));
    }

    $conn->close();
} else {
    echo json_encode(array('status' => 'error', 'message' => 'ID not provided'));
}
