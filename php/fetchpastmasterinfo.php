<?php
    include "../dbconnect/conn.php";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $id = $_POST["id"];    

        $sql = "SELECT * FROM tblpastmaster WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($result->num_rows > 0){
             $row = $result->fetch_assoc();
                 
             echo json_encode(["success" => true, "data" => $row]);
        } else {
            echo json_encode(["success" => false, "message" => "Not Found"]);
        }
 
     } else {
         echo json_encode(["success" => false, "message" => "Invalid Request"]);
     }
?>