<?php
    include "../dbconnect/conn.php";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $id = $_POST['id'];

        $sql = "DELETE FROM tblpastmaster WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        
        if($stmt->execute()){
            echo json_encode(["success" => true, "message" => "Add Success"]);
        } else {
            echo json_encode(["success" => false, "message" => "Add Failed"]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Invalid Request"]);
    }
?>