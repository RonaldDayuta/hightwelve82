<?php
include '../dbconnect/conn.php'; // Database connection

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Prepare the SQL statement
    $sqlstmt = "SELECT * FROM tblaccounts WHERE ID = ?";
    $stmt = $conn->prepare($sqlstmt);

    if ($stmt) {
        // Bind the parameter AFTER preparing the statement
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Decrypt the password in PHP (not in SQL)
            $decrypted_password = openssl_decrypt(
                $row['Password'],     // Encrypted password from DB
                "AES-128-ECB",        // Encryption method
                'hightwelve82'        // Secret key
            );

            // Add decrypted password to response
            $row['DecryptedPassword'] = $decrypted_password;

            // Return account data in JSON format
            echo json_encode(array('status' => 'success', 'data' => $row));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'No Account found with this ID'));
        }

        $stmt->close();
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Database query failed'));
    }

    $conn->close();
} else {
    echo json_encode(array('status' => 'error', 'message' => 'ID not provided'));
}
