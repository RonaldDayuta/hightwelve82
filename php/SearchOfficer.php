<?php
include "../dbconnect/conn.php"; // Database connection

if (isset($_POST['search']) && !empty($_POST['search'])) {
    $searchText = $_POST['search'];
    $searchPattern = "%$searchText%"; // Allows partial matching

    $query = "SELECT * FROM tblofficers
              WHERE Name LIKE ? OR Position LIKE ?";

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
        echo "<p>No Officer found.</p>";
    }
} else {
    echo "<p>Please enter a search term.</p>";
}
?>