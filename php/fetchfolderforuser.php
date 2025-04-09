<?php
include '../dbconnect/conn.php';
    $foldersql = "SELECT * FROM folders WHERE id2 = '0' ORDER BY foldername ASC";
    $stmt = $conn->prepare($foldersql);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
?>      
               <div class="button-wrapper">
                    <!-- Folder Button -->
                    <button data-id="<?= $row['id']; ?>" data-name="<?= $row['foldername']; ?>" class="openfolder">
                        <span class="material-icons-outlined">source</span>
                        <?= $row['foldername']; ?>
                    </button>
                </div>
<?php
        }
    }
?>