<?php
session_start();
include('../dbconnect/conn.php'); // Include database connection

if (isset($_SESSION['admin_id'])) {
    // Get the employee ID before unsetting session variables
    $admin_id = $_SESSION['admin_id'];

    // Unset the Admin session variables
    unset($_SESSION['admin_username']);
    unset($_SESSION['admin_image']);
    unset($_SESSION['admin_email']);
    unset($_SESSION['admin_id']);

    //header("Location: ../Webpage/index.php");
    header("Location: ../access.php");
    exit();
} else {
    // If the user is not logged in, redirect to login
    //header("Location: ../Webpage/index.php");
    header("Location: ../access.php");
    exit();
}
