<?php
session_start();
include('conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_regenerate_id(true);
    include('conn.php');

    $Email = $_POST['login-email'];
    $Password = $_POST['login-password'];

    $stmt = $conn->prepare('SELECT * FROM accounts WHERE Email = ?');
    $stmt->bind_param("s", $Email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row) {

        $email = $row['Email'];
        $password = openssl_decrypt($row['Password'], "AES-128-ECB", 'hightwelve82');
        $position = $row['WebPosition'];
        $profile = $row['Profile'];
        $username = $row['Username'];
        $id = $row['ID'];

        if ($Password === $password) {
            if ($position == 'Admin') {
                $_SESSION['admin_username'] = $username;
                $_SESSION['admin_image'] = $profile;
                $_SESSION['admin_email'] = $email;
                $_SESSION['admin_password'] = $password;
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
        echo json_encode(array('success' => false, 'message' => 'Invalid Email'));
    }
} else {
    echo json_encode(array('success' => false, 'message' => 'Invalid request method.'));
}
