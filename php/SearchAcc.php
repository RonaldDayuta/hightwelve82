<?php
include "../dbconnect/conn.php"; // Database connection

if (isset($_POST['search']) && !empty($_POST['search'])) {
    $searchText = $_POST['search'];
    $searchPattern = "%$searchText%"; // Allows partial matching

    $query = "SELECT * FROM tblaccounts 
          WHERE is_hidden = 0 AND (Email LIKE ? OR Username LIKE ?)";

    $stmt = $conn->prepare($query);

    if (!$stmt) {
        die("Query error: " . $conn->error);
    }

    $stmt->bind_param("ss", $searchPattern, $searchPattern);
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
        echo "<p>No Account found.</p>";
    }
} else {
    echo "<p>Please enter a search term.</p>";
}
?>