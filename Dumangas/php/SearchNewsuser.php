<?php
include "../dbconnect/conn.php"; // Database connection

if (isset($_POST['search']) && !empty($_POST['search'])) {
    $searchText = $_POST['search'];
    $searchPattern = "%$searchText%"; // Allows partial matching

    $query = "SELECT event_date, title, description, image FROM tblevents 
              WHERE category = 'news-today' AND (post_category = 'internal' OR post_category = 'both')
              AND (event_date LIKE ? OR title LIKE ?) 
              ORDER BY event_date ASC";

    $stmt = $conn->prepare($query);

    if (!$stmt) {
        die("Query error: " . $conn->error);
    }

    $stmt->bind_param("ss", $searchPattern, $searchPattern); // Bind for both event_date and title
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
?>
            <div class="events-view-cards">
                <span><?php echo htmlspecialchars($row['title']); ?></span>
                <span><?php echo htmlspecialchars($row['event_date']); ?></span>
                <p><?php echo htmlspecialchars($row['description']); ?></p>
                <img src="<?php echo htmlspecialchars($row['image']); ?>">
            </div>
<?php
        }
    } else {
        echo "<p>No News found.</p>";
    }
} else {
    echo "<p>Please enter a search term.</p>";
}
?>