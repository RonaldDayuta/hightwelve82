<?php
session_start();
include('conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_regenerate_id(true);
    include('conn.php');

    $Email = $_POST['login-email'];
    $Password = $_POST['login-password'];


    $query = "SELECT * FROM accounts WHERE Email = '$Email' AND Password = '$Password'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if ($row) {

        $email = $row['Email'];
        $password = $row['Password'];
        $position = $row['WebPosition'];
        $profile = $row['Profile'];
        $username = $row['Username'];
        $id = $row['ID'];

        if ($Email === $email && $Password === $password) {
            if ($position == 'Admin') {
                $_SESSION['admin_username'] = $username;
                $_SESSION['admin_image'] = $profile;
                $_SESSION['admin_email'] = $email;
                $_SESSION['admin_id'] = $id;
            }

            echo json_encode(array(
                'success' => true,
                'message' => 'Login successful',
                'position' => $position,
            ));
        } else {
            echo json_encode(array('success' => false, 'message' => 'Invalid Email and Password'));
        }
    } else {
        $check_email_query = "SELECT * FROM accounts WHERE Email = '$Email'";
        $check_email_result = mysqli_query($conn, $check_email_query);

        if (mysqli_num_rows($check_email_result) > 0) {
            echo json_encode(array('email' => true, 'message' => 'Please check your password'));
        } else {
            echo json_encode(array('success' => false, 'message' => 'Please Check Your Email'));
        }
    }
} else {
    echo json_encode(array('success' => false, 'message' => 'Invalid request method.'));
}
