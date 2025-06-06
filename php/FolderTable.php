<?php
include '../dbconnect/conn.php';

$foldersql = "SELECT * FROM folders WHERE id2 = '0'";
$stmt = $conn->prepare($foldersql);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
?>
        <div class="button-wrapper">
            <span class="material-icons-outlined dot">more_horiz</span>
            <div data-id="<?= $row['id']; ?>" class="dot-menu">
                <div id="folderrename" data-id="<?= $row['id']; ?>" class="menu-item rename-btn">Rename</div>
                <div id="folderdelete" data-id="<?= $row['id']; ?>" class="menu-item delete-btn">Delete</div>
            </div>
            <button data-id="<?= $row['id']; ?>" data-name="<?= $row['foldername']; ?>" class="openfolder">
                <span class="material-icons-outlined">source</span>
                <?= $row['foldername']; ?>
            </button>
        </div>
<?php
    }
} else {
    echo "<p>No folders found.</p>";
}
?>
