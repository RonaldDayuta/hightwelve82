<?php
    include "../dbconnect/conn.php";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $name = $_POST['name'];
        $date = $_POST['date'];

        $sql = "INSERT INTO tblpastmaster (date, name) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $date, $name);

        if($stmt->execute()){
            echo json_encode(["success" => true, "message" => "Add Success"]);
        } else{
            echo json_encode(["success" => false, "message" => "Add Failed"]);
        }

    } else {
        echo json_encode(["success" => false, "message" => "Invalid Request"]);
    }
?>