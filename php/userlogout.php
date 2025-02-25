<?php
session_start();
include('../dbconnect/conn.php'); // Include database connection

if (isset($_SESSION['user_id'])) {
    // Get the employee ID before unsetting session variables
    $user_id = $_SESSION['user_id'];

    // Unset the user session variables
    unset($_SESSION['user_username']);
    unset($_SESSION['user_image']);
    unset($_SESSION['user_email']);
    unset($_SESSION['user_id']);

    header("Location: ../Webpage/index.php");
    exit();
} else {
    // If the user is not logged in, redirect to login
    header("Location: ../Webpage/index.php");
    exit();
}
