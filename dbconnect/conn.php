<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "dbhightwelve82";

/* Create connection */
$conn = mysqli_connect($servername, $username, $password, $db);

/* Check connection */
if (!$conn) {
    die(json_encode(["success" => false, "message" => "Database connection failed: " . mysqli_connect_error()]));
}
?>
