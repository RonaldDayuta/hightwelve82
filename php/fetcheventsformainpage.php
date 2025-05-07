<?php
include "../dbconnect/conn.php"; // Database connection

// Get today's date
$today = date("Y-m-d");

// Get the date 5 days from today
$nextFiveDays = date("Y-m-d", strtotime("+30 days"));

// SQL Query: Get events from today to the next 5 days
$query = "SELECT event_date, title, description, image FROM tblevents 
          WHERE category = 'events' AND (post_category = 'external' OR post_category = 'both')
          AND event_date BETWEEN ? AND ? 
          ORDER BY event_date ASC";

$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $today, $nextFiveDays);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Convert newlines to <br>
        $fullDescription = nl2br(htmlspecialchars($row['description']));
        
        // Create short description (first 100 chars)
        $shortDescription = strlen($fullDescription) > 100 ? substr($fullDescription, 0, 100) . "..." : $fullDescription;
?>
        <div class="events-card">
            <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="" />
            <div class="event-description">
                <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                <span><?php echo htmlspecialchars($row['event_date']); ?></span>
                <p class="event-text" data-full="<?php echo htmlspecialchars($fullDescription, ENT_QUOTES, 'UTF-8'); ?>">
                    <?php echo $shortDescription; ?>
                    <?php if (strlen($fullDescription) > 100) { ?>
                        <span class="see-more-btn1" style="cursor: pointer; color: #6c9bcf;">See More</span>
                    <?php } ?>
                </p>
            </div>
        </div>
<?php
    }
} else {
    echo "<p>No upcoming events found.</p>";
}
?>
