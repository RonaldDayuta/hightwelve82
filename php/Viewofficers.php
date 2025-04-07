<?php
include '../dbconnect/conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $officersSql = "SELECT ID, Name, Position, PosDecs FROM tblofficers ORDER BY PositionNumber ASC";
    $stmt = $conn->prepare($officersSql);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
?>
            <tr>
                <td><?= htmlspecialchars($row['Name']); ?></td>
                <td><?= htmlspecialchars($row['Position']); ?></td>
                <td><?= htmlspecialchars($row['PosDecs']); ?></td>
                <td>
                    <span class="material-icons-outlined btn-update" id="officer-update" data-id="<?= $row['ID']; ?>">
                        edit
                    </span>
                    <span class="material-icons-outlined btn-delete" id="officer-delete" data-id="<?= $row['ID']; ?>">
                        delete
                    </span>
                </td>
            </tr>
<?php
        }
    } else {
        echo "<tr><td colspan='5'>No officers found</td></tr>";
    }
} else {
    echo "Invalid request";
}
?>