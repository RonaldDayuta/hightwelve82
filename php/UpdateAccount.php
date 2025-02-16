<?php
require '../dbconnect/conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['update-id'];
    $email = $_POST['update-email'];
    $username = $_POST['update-username'];
    $position = $_POST['update-position'];
    $status = $_POST['update-status'];

    $sql = "UPDATE tblaccounts SET Email=?, Username=?, WebPosition=?, Status=? WHERE ID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $email, $username, $position, $status, $id);

    if ($stmt->execute()) {
        echo json_encode(array('success' => 'Updated', 'message' => 'Updated Successfully'));
    } else {
        echo json_encode(array('error' => 'Error', 'message' => 'Updated UnSuccessfully'));
    }
}
$conn->close();
