<?php
include '../dbconnect/conn.php';

$search = $_POST['search'] ?? '';
$searchParam = "%$search%"; // Properly format the search string

$foldersql = "SELECT * FROM folders WHERE id2 = '0' AND foldername LIKE ?";
$stmt = $conn->prepare($foldersql);
$stmt->bind_param("s", $searchParam); // Use the correctly formatted search string
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
?>
    <div class="button-wrapper">
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
