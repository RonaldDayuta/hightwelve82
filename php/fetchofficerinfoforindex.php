<?php
require '../dbconnect/conn.php';

$sql = "SELECT ID, Name, Position, Image FROM tblofficers";
$result = $conn->query($sql);

$officers = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $officers[] = [
            'id' => $row['ID'],
            'name' => $row['Name'],
            'position' => $row['Position'],
            'image' => $row['Image']
        ];
    }
}

echo json_encode($officers);
$conn->close();
