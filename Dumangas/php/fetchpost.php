<?php
include '../dbconnect/conn.php';

$query = "SELECT * FROM cms ORDER BY date desc";
$result = mysqli_query($conn, $query);

$posts = [];

while ($row = mysqli_fetch_assoc($result)) {
    $posts[] = $row;
}

echo json_encode($posts);
