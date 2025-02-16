<?php
require '../dbconnect/conn.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM tblaccounts WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Deleted";
    } else {
        echo "Error: " . $conn->error;
    }
}
$conn->close();
?>
