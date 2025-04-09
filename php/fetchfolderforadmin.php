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
                    <!-- 3-dot icon -->
                    <span class="material-icons-outlined dot">more_horiz</span>

                    <!-- Custom menu (hidden by default) -->
                    <div data-id="<?= $row['id']; ?>" class="dot-menu">
                        <div id="folderrename" data-id="<?= $row['id']; ?>" class="menu-item rename-btn">Rename</div>
                        <div id="folderdelete" data-id="<?= $row['id']; ?>" class="menu-item delete-btn">Delete</div>
                    </div>

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