<?php
include '../dbconnect/conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $accountsql = "SELECT ID, Email, Username, Password, WebPosition, Status FROM tblaccounts";
    $stmt = $conn->prepare($accountsql);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
?>
            <tr>
                <td><?= htmlspecialchars($row['Email']); ?></td>
                <td><?= htmlspecialchars($row['Username']); ?></td>
                <td><?= htmlspecialchars($row['WebPosition']); ?></td>
                <td><?= htmlspecialchars($row['Status']); ?></td>
                <td class="actionsbutton">
                    <span class="material-icons-outlined btn-update" id="account-update" data-id="<?= $row['ID']; ?>">
                        edit</span>
                    <span class="material-icons-outlined btn-delete" id="account-delete" data-id="<?= $row['ID']; ?>">
                        delete
                    </span>
                </td>
            </tr>
<?php
        }
    } else {
        echo "<tr><td colspan='6'>0 results</td></tr>";
    }
} else {
    echo "Invalid request";
}
?>