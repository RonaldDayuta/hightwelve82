<?php
session_start();
include('../dbconnect/conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_regenerate_id(true);

    $identifier = $_POST['login-email']; // This will now accept email or username
    $Password = $_POST['login-password'];

    // Modify SQL query to check both Email and Username
    $stmt = $conn->prepare('SELECT * FROM tblaccounts WHERE Email = ? OR Username = ?');
    $stmt->bind_param("ss", $identifier, $identifier);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        $stored_password = openssl_decrypt($row['Password'], "AES-128-ECB", 'hightwelve82');
        $position = $row['WebPosition'];
        $profile = $row['Profile'];
        $username = $row['Username'];
        $email = $row['Email'];
        $id = $row['ID'];

        if ($Password === $stored_password) {
            if ($position == 'Admin') {
                $_SESSION['admin_username'] = $username;
                $_SESSION['admin_image'] = $profile;
                $_SESSION['admin_email'] = $email;
                $_SESSION['admin_password'] = $stored_password;
                $_SESSION['admin_id'] = $id;
            }

            echo json_encode(array(
                'success' => true,
                'message' => 'Login successful',
                'position' => $position,
            ));
        } else {
            echo json_encode(array('success' => false, 'message' => 'Invalid Password'));
        }
    } else {
        echo json_encode(array('success' => false, 'message' => 'Invalid Email or Username'));
    }
} else {
    echo json_encode(array('success' => false, 'message' => 'Invalid request method.'));
}
?>