<?php
require '../dbconnect/conn.php'; // Database connection file
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; // Include PHPMailer

header('Content-Type: application/json'); // Ensure JSON response
ob_start(); // Start output buffering

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $event_date = isset($_POST['event-date']) ? trim($_POST['event-date']) : '';
    $title = isset($_POST['event-title']) ? trim($_POST['event-title']) : '';
    $description = isset($_POST['event-description']) ? trim($_POST['event-description']) : '';
    $category = isset($_POST['event-category']) ? trim($_POST['event-category']) : '';
    $post_category = isset($_POST['post-category']) ? trim($_POST['post-category']) : '';
    $image_path  = ''; // Default value

    $errors = [];

    if (empty($event_date)) {
        $errors[] = "Event date is required.";
    }
    if (empty($title)) {
        $errors[] = "Event title is required.";
    }
    if (empty($description)) {
        $errors[] = "Event description is required.";
    }
    if (empty($category)) {
        $errors[] = "Event category is required.";
    }
    if (empty($post_category)) {
        $errors[] = "Event post category is required.";
    }

    if (!empty($errors)) {
        echo json_encode(["status" => "error", "message" => $errors]);
        exit();
    }

    // Image upload handling
    if (isset($_FILES['event-image']) && $_FILES['event-image']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "../uploads/"; // Ensure this directory exists
        $image_name = basename($_FILES["event-image"]["name"]);
        $image_ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
        $image_size = $_FILES["event-image"]["size"];
        $unique_name = uniqid("event_", true) . "." . $image_ext;
        $image_path = $target_dir . $unique_name;

        // Allowed file types
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        $max_size = 20 * 1024 * 1024; // 20MB limit

        // Check file type
        if (!in_array($image_ext, $allowed_types)) {
            echo json_encode(["status" => "error", "message" => "Invalid file type! Only JPG, JPEG, PNG, and GIF are allowed."]);
            exit();
        }

        // Check file size
        if ($image_size > $max_size) {
            echo json_encode(["status" => "error", "message" => "Image size exceeds 20MB limit!"]);
            exit();
        }

        // Move uploaded file
        if (!move_uploaded_file($_FILES["event-image"]["tmp_name"], $image_path)) {
            echo json_encode(["status" => "error", "message" => "Error uploading image."]);
            exit();
        }
    }

    // Prepare and execute query for inserting event
    $stmt = $conn->prepare("INSERT INTO tblevents (event_date, title, description, category, post_category, image) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $event_date, $title, $description, $category, $post_category, $image_path);

    if ($stmt->execute()) {
        // Fetch all email addresses from tblaccounts
        $accountsql = "SELECT Email FROM tblaccounts";
        $stmtEmails = $conn->prepare($accountsql);
        $stmtEmails->execute();
        $resultEmails = $stmtEmails->get_result();

        // PHPMailer setup
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';  // Set your SMTP server
            $mail->SMTPAuth   = true;
            $mail->Username   = 'ronaldthird.dayuta@gmail.com'; // SMTP username
            $mail->Password   = 'wami xzxh dkic utgz';   // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            //Recipients
            $mail->setFrom('ronaldthird.dayuta@gmail.com', 'Event Manager');

            // Loop through the result of email addresses and send an email to each
            while ($row = $resultEmails->fetch_assoc()) {
                $mail->addAddress($row['Email']); // Add recipient email

                // Content
                $mail->isHTML(true);
                $mail->Subject = 'New Event Added: ' . $title;
                $mail->Body    = "A new event has been added:<br><br>
                                  <strong>Title:</strong> $title<br>
                                  <strong>Date:</strong> $event_date<br>
                                  <strong>Description:</strong> $description<br>
                                  <strong>Category:</strong> $category<br>";

                // Send the email
                $mail->send();

                // Clear recipients for next email
                $mail->clearAddresses();
            }

            // Send success response
            echo json_encode(["status" => "success", "message" => "Event added successfully. Emails sent."]);
        } catch (Exception $e) {
            echo json_encode(["status" => "error", "message" => "Error sending email: {$mail->ErrorInfo}"]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Error adding event: " . $stmt->error]);
    }

    $stmt->close();
    $stmtEmails->close();
    $conn->close();
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
}
