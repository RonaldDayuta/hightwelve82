<?php
    include "../dbconnect/conn.php";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $name = $_POST['name'];
        $date = $_POST['date'];
        $id = $_POST['id'];

        $sql = "UPDATE tblpastmaster SET date = ?, name = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssi', $date, $name, $id);
        
        if($stmt->execute()){
            echo json_encode(["success" => true, "message" => "Update Success"]);
        } else {
            echo json_encode(["success" => false, "message" => "Update Failed"]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Invalid Request"]);
    }
?> 