<?php
include '../dbconnect/conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $selectedDate = $_POST['selectedDate'];

    $accountsql = "SELECT * FROM tblevents WHERE event_date = '$selectedDate'"; // Ensure ID is selected
    $stmt = $conn->prepare($accountsql);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
?>
            <tr>
                <td><?= $row['event_date']; ?></td>
                <td><?= $row['title']; ?></td>
                <td><?= $row['description']; ?></td>
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