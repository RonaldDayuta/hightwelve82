<?php
include '../dbconnect/conn.php';

$folderid = isset($_GET["id"]) ? intval($_GET["id"]) : 0;

$sql = "SELECT * FROM pdffile WHERE folderid=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $folderid);  // Bind as integer
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        ?>
        <tr class="space">
            <td>
                <div class="td-content">
                    <?= ($row['name']); ?>
                    <div class="button-wrapper">
                        <!-- 3-dot icon -->
                        <span data-id="<?= ($row['fileid']); ?>" class="material-icons-outlined dots">more_horiz</span>

                        <!-- Custom menu (hidden by default) -->
                        <div class="dot-menus">
                            <div id="viewpdffile" data-file="<?= ($row['path']); ?>" class="menu-items">View</div>
                            <div id="downloadpdffile" data-id="<?= ($row['fileid']); ?>" class="menu-items">Download</div>
                            <div id="deletepdffile" data-id="<?= ($row['fileid']); ?>" class="menu-items">Delete</div>
                        </div>
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
