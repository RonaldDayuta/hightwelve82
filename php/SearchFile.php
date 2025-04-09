<?php
include '../dbconnect/conn.php';

$search = $_GET['search'] ?? '';
$searchParam = '%' . $search . '%'; // Properly format the search string

$foldersql = "SELECT * FROM  WHERE id2 = '0' AND foldername LIKE ?";
$stmt = $conn->prepare($foldersql);
$stmt->bind_param("s", $searchParam); // Use the correctly formatted search string
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
            <?= htmlspecialchars($row['foldername']); ?>
        </button>
    </div>
<?php
    }
} else {
    echo "<p>No folders found.</p>";
}
?>
