<?php
include '../dbconnect/conn.php';

$folderid = isset($_GET["id"]) ? intval($_GET["id"]) : 0;

$sql = "SELECT * FROM pdffile WHERE folderid=? ORDER BY name ASC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $folderid);  // Bind as integer
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        ?>
        <tr>
            <td>
                <div class="td-content">
                    <div class="name">
                        <?= ($row['name']); ?>
                    </div>
                    <div class="button-wrapper">
                        <span id="viewpdffile" data-file="<?= ($row['path']); ?>" class="material-icons-outlined">visibility</span>
                        <span id="downloadpdffile" data-id="<?= ($row['fileid']); ?>" class="material-icons-outlined">file_download</span>               
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
