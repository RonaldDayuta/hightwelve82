<?php
session_start();
include('../dbconnect/conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_regenerate_id(true);

    $identifier = trim($_POST['login-email']); // Pwedeng Email o Username
    $password = trim($_POST['login-password']);

    // Query para hanapin ang user gamit ang Email o Username
    $stmt = $conn->prepare('SELECT * FROM tblaccounts WHERE Email = ? OR Username = ?');
    $stmt->bind_param("ss", $identifier, $identifier);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    if ($row) {
        $stored_password = $row['Password']; // Database password
        $position = $row['WebPosition'];

        // DEBUG: I-print ang password values
        error_log("Entered Password: " . $password);
        error_log("Stored Password (Hashed): " . $stored_password);

        if (password_verify($password, $stored_password)) {
            if ($position == 'Admin') {
                $_SESSION['admin_username'] = $row['Username'];
                $_SESSION['admin_image'] = $row['Profile'];
                $_SESSION['admin_email'] = $row['Email'];
                $_SESSION['admin_id'] = $row['ID'];
            } else {
                $_SESSION['user_username'] = $row['Username'];
                $_SESSION['user_image'] = $row['Profile'];
                $_SESSION['user_email'] = $row['Email'];
                $_SESSION['user_id'] = $row['ID'];
            }
            echo json_encode(['success' => true, 'message' => 'Login successful', 'position' => $row['WebPosition']]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid Password or Username']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid Email or Username']);
    }

    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
