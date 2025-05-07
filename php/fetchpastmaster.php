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
                    <tr>
                        <td><?= $row['date'] ?></td>
                        <td><?= $row['name'] ?></td>
                        <td>
                            <span class="material-icons-outlined btn-update" id="editpastmaster" data-bs-toggle="modal" data-bs-target="#editPastMasterModal" data-id="<?= $row['id']; ?>">
                                edit
                            </span>
                            <span class="material-icons-outlined btn-delete" id="deletepastmaster" data-id="<?= $row['id']; ?>">
                                delete
                            </span>
                        </td>
                    </tr>
                <?php
            }
       } else {
        echo "<span>No Past master found<span>";
       }

    } else {
        echo json_encode(["success" => false, "message" => "Invalid Request"]);
    }
?>