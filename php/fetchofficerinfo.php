<?php
include('../dbconnect/conn.php');

$response = ["success" => false];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["officerID"])) {
    $officerID = $_POST["officerID"];

    $stmt = $conn->prepare("SELECT ID, Name, Position, PosDecs, Image FROM tblofficers WHERE ID = ?");
    $stmt->bind_param("i", $officerID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $response["success"] = true;
        $response["data"] = $result->fetch_assoc();
    }

    $stmt->close();
}

$conn->close();
echo json_encode($response);
