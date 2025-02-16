<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "dbhightwelve82";

try {
    // Create a PDO instance
    $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
    
    // Set error mode to exception for better debugging
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Connected successfully"; 
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
