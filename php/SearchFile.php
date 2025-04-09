<?php
include '../dbconnect/conn.php';

$search = $_POST['search'] ?? '';
$searchParam = "%$search%";

$sql = "SELECT * FROM pdffile WHERE name LIKE ? ORDER BY name ASC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $searchParam);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
?>
        <tr>
            <td>
                <div class="td-content">
                    <div class="name">
                        <?= htmlspecialchars($row['name']); ?>
                    </div>
                    <div class="button-wrapper">
                        <span id="viewpdffile" data-file="<?= htmlspecialchars($row['path']); ?>" class="material-icons-outlined">visibility</span>
                        <span id="downloadpdffile" data-id="<?= htmlspecialchars($row['fileid']); ?>" class="material-icons-outlined">file_download</span>
                        <span id="deletepdffile" data-id="<?= htmlspecialchars($row['fileid']); ?>" class="material-icons-outlined" style="color: #ff0060;">delete</span>
                    </div>
                </div>
            </td>
        </tr>
<?php
    }
} else {
    echo "<tr><td colspan='6'>No files found</td></tr>";
}
?>
