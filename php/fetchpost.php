<?php
include '../dbconnect/conn.php';

$query = "SELECT * FROM cms ORDER BY date DESC";
$result = mysqli_query($conn, $query);

$posts = [];

while ($row = mysqli_fetch_assoc($result)) {
    // Decode JSON to get multiple image URLs
    $row['post_image'] = json_decode($row['post_image'], true);
    $posts[] = $row;
}

echo json_encode($posts);
