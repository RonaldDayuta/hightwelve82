<?php
include 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $accountsql = "SELECT Username, Email, Password, WebPosition, Status FROM tblaccounts";
    $stmt = $conn->prepare($accountsql);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
?>
            <tr>
                <td><?= $row['Email']; ?></td>
                <td><?= openssl_decrypt($row['Password'], "AES-128-ECB", 'hightwelve82'); ?></td>
                <td><?= $row['WebPosition']; ?></td>
                <td><?= $row['Status']; ?></td>
                <td class="actionsbutton"><span class="material-icons-outlined btnupdate">
                        update
                    </span>
                    <span class="material-icons-outlined btndelete">
                        delete
                    </span>
                </td>
            </tr>
<?php
        }
    } else {
        echo "<tr><td colspan='5'>0 results</td></tr>";
    }
} else {
    echo "Invalid request";
}
