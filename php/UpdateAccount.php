<?php
require '../dbconnect/conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $email = $_POST['account-email'];
    $username = $_POST['account-username'];
    $position = $_POST['account-position'];
    $status = $_POST['account-status'];

    $sql = "UPDATE tblaccounts SET Email=?, Username=?, WebPosition=?, Status=? WHERE ID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $email, $username, $position, $status, $id);

    if ($stmt->execute()) {
        echo "Success";
    } else {
        echo "Error: " . $conn->error;
    }
}
$conn->close();
?>
