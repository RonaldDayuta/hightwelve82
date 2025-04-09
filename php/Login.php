<?php
session_start();
include('../dbconnect/conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_regenerate_id(true);

    $identifier = trim($_POST['login-email']); // Pwedeng Email o Username
    $password = trim($_POST['login-password']);

    // Query para hanapin ang user gamit ang Email o Username
    $stmt = $conn->prepare('SELECT * FROM tblaccounts WHERE BINARY Email = ? OR BINARY Username = ?');
    $stmt->bind_param("ss", $identifier, $identifier);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    if ($row) {
        $stored_password = $row['Password']; // Database password
        $position = $row['WebPosition'];
        $status = strtolower($row['Status']); // 'active', 'inactive', or 'suspend'

        // Check account status
        if ($status !== 'active') {
            echo json_encode(['success' => false, 'message' => 'Your account is ' . ucfirst($status) . '. Please contact the administrator.']);
            exit;
        }

        // DEBUG: I-print ang password values
        error_log("Entered Password: " . $password);
        error_log("Stored Password (Hashed): " . $stored_password);

        if (password_verify($password, $stored_password)) {
            if ($position == 'Admin') {
                $_SESSION['admin_first-name'] = strtoupper($row['first_name']);
                $_SESSION['admin_middle-name'] = strtoupper($row['middle_name']);
                $_SESSION['admin_last-name'] = strtoupper($row['last_name']);
                $_SESSION['admin_suffix'] = strtoupper($row['suffix']);
                $_SESSION['admin_username'] = $row['Username'];
                $_SESSION['admin_image'] = $row['Profile'];
                $_SESSION['admin_email'] = $row['Email'];
                $_SESSION['admin_id'] = $row['ID'];
                $_SESSION['admin_pos'] = $row['WebPosition'];
            } else {
                $_SESSION['user_first-name'] = $row['first_name'];
                $_SESSION['user_middle-name'] = $row['middle_name'];
                $_SESSION['user_last-name'] = $row['last_name'];
                $_SESSION['user_suffix'] = $row['suffix'];
                $_SESSION['user_username'] = $row['Username'];
                $_SESSION['user_image'] = $row['Profile'];
                $_SESSION['user_email'] = $row['Email'];
                $_SESSION['user_id'] = $row['ID'];
                $_SESSION['user_pos'] = $row['WebPosition'];
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
