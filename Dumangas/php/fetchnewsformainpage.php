<?php
include "../dbconnect/conn.php"; // Database connection

// Get today's date
$today = date("Y-m-d");

// Get the date 5 days from today
$nextFiveDays = date("Y-m-d", strtotime("+5 days"));

// SQL Query: Get events from today to the next 5 days
$query = "SELECT event_date, title, description, image FROM tblevents 
          WHERE category = 'news-today' 
          AND event_date BETWEEN ? AND ? 
          ORDER BY event_date ASC";

$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $today, $nextFiveDays);
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
    echo "<p>No upcoming News found.</p>";
}
?>