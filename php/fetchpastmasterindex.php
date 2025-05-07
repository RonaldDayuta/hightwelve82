<?php
    include "../dbconnect/conn.php";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
       
       $sql = "SELECT * FROM tblpastmaster ORDER BY date ASC";
       $stmt = $conn->prepare($sql);
       $stmt->execute();
       $result = $stmt->get_result();
       
       if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                ?>
                    <div class="list">
                        <h3><?= $row['name'] ?></h3>
                        <h3><?= $row['date'] ?></h3>
                    </div>
                <?php
            }
       } else {
        echo "<span>No Past master found<span>";
       }

    } else {
        echo json_encode(["success" => false, "message" => "Invalid Request"]);
    }
?>