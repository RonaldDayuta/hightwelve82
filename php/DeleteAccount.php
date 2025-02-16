<?php
require '../dbconnect/conn.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM tblaccounts WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo json_encode(array('success' => 'Delete', 'message' => 'Delete Successful'));
    } else {
        echo json_encode(array('error' => 'Error', 'message' => 'Delete UnSuccessful')) . $conn->error;
    }
}
$conn->close();
