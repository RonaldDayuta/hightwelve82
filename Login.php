<?php
session_start();
include('conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_regenerate_id(true);
    include('conn.php');

    $emID = $_POST['signin_employee'];
    $username = $_POST['signin_email'];
    $password = $_POST['signin_password'];
    $eh = $_POST['signin_username'];

    $query = "SELECT * FROM accounts WHERE Email = '$username' AND Password = '$password' AND EmployeesID = '$emID'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $update_query = "UPDATE accounts SET Status = 'Online' WHERE EmployeesID = '$emID'";
        mysqli_query($conn, $update_query);

        $employeeid = $row['EmployeesID'];
        $user = $row['Username'];
        $pass = $row['Password'];
        $img = $row['Image'];
        $email = $row['Email'];
        $position = $row['Position'];

        if ($username === $email && $password === $pass && $emID === $employeeid) {
            if ($position == 'Admin') {
                $_SESSION['admin_username'] = $user;
                $_SESSION['admin_image'] = $img;
                $_SESSION['admin_email'] = $email;
                $_SESSION['admin_id'] = $employeeid;
            } elseif ($position == 'Project Manager') {
                $_SESSION['pm_username'] = $user;
                $_SESSION['pm_image'] = $img;
                $_SESSION['pm_email'] = $email;
                $_SESSION['pm_id'] = $employeeid;
            } elseif ($position == 'Employee') {
                $_SESSION['em_username'] = $user;
                $_SESSION['em_image'] = $img;
                $_SESSION['em_email'] = $email;
                $_SESSION['em_id'] = $employeeid;
            } else {
                echo json_encode(array('success' => false, 'message' => 'Unauthorized role'));
                exit;
            }

            if ($position == 'Admin' || $position == 'Project Manager') {
                $insert_time_query = "INSERT INTO admin_pm_time_log (user_id, position, time_in) VALUES ('$employeeid', '$position', NOW())";
                mysqli_query($conn, $insert_time_query);
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
        $check_email_query = "SELECT * FROM accounts WHERE Email = '$username' AND EmployeesID = '$emID'";
        $check_email_result = mysqli_query($conn, $check_email_query);

        if (mysqli_num_rows($check_email_result) > 0) {
            echo json_encode(array('email' => true, 'message' => 'Please check your password'));
        } else {
            echo json_encode(array('success' => false, 'message' => 'Please Check Your email or EmployeesID'));
        }
    }
} else {
    echo json_encode(array('success' => false, 'message' => 'Invalid request method.'));
}
