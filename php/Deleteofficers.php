<?php
include '../dbconnect/conn.php';

$response = ["success" => false];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["officerID"])) {
    $officerID = $_POST["officerID"];

    // Get the officer's image before deleting
    $stmt = $conn->prepare("SELECT Image FROM tblofficers WHERE ID = ?");
    $stmt->bind_param("i", $officerID);
    $stmt->execute();
    $result = $stmt->get_result();
    $imageFile = "";

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $imageFile = $row["Image"];
    }

    // Delete the officer from the database
    $stmt = $conn->prepare("DELETE FROM tblofficers WHERE ID = ?");
    $stmt->bind_param("i", $officerID);

    if ($stmt->execute()) {
        $response["success"] = true;

        // Delete the officer's image file if it exists
        if (!empty($imageFile) && file_exists($imageFile)) {
            unlink($imageFile);
        }
    }

    $stmt->close();
}

$conn->close();
echo json_encode($response);
