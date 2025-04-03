<?php
require '../dbconnect/conn.php'; // Database connection file
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; // Include PHPMailer

header('Content-Type: application/json'); // Ensure JSON response

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $event_date = isset($_POST['event-date']) ? trim($_POST['event-date']) : '';
    $title = isset($_POST['event-title']) ? trim($_POST['event-title']) : '';
    $description = isset($_POST['event-description']) ? trim($_POST['event-description']) : '';
    $category = isset($_POST['event-category']) ? trim($_POST['event-category']) : '';
    $post_category = isset($_POST['post-category']) ? trim($_POST['post-category']) : '';
    $priority_category = isset($_POST['priority-category']) ? trim($_POST['priority-category']) : '';
    $image_path  = ''; // Default value

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
    $stmt = $conn->prepare("INSERT INTO tblevents (event_date, title, description, category, post_category, priority_category, image) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $event_date, $title, $description, $category, $post_category, $priority_category, $image_path);

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
            $mail->Password   = 'iyjx wbok nmzv kdez';   // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            //Recipients
            $mail->setFrom('ronaldthird.dayuta@gmail.com', 'High Twelve Lodge No. 82');

            // Loop through the result of email addresses and send an email to each
            while ($row = $resultEmails->fetch_assoc()) {
                $mail->addAddress($row['Email']); // Add recipient email

                // Content
                $mail->isHTML(true);
                $mail->Subject = 'New Event Added: ' . $title;
                // Attach the image (make sure the path is correct)
                $mail->AddEmbeddedImage('../Information/Lodge Logo.png', 'logo_cid');
                $mail->Body = '
                    <div style="max-width: 600px; margin: auto; border-radius: 10px; overflow: hidden; 
                                box-shadow: 0px 4px 10px rgba(0,0,0,0.1); font-family: Arial, sans-serif;">
                        
                        <!-- Banner Header with Embedded Logo -->
                        <div style="background-color: #007BFF; color: white; padding: 20px; text-align: center;">
                            <img src="cid:logo_cid" alt="Company Logo" style="max-width: 120px; margin-bottom: 10px;">
                            <h2 style="margin: 0;">New Event Announcement</h2>
                        </div>

                        <!-- Event Details -->
                        <div style="padding: 20px; background-color: #f9f9f9;">
                            <p><strong>Title:</strong> ' . htmlspecialchars($title) . '</p>
                            <p><strong>Date:</strong> ' . htmlspecialchars($event_date) . '</p>
                            <p><strong>Description:</strong><br>' . nl2br(htmlspecialchars($description)) . '</p>
                        </div>

                        <!-- Footer -->
                        <div style="background-color: #007BFF; color: white; text-align: center; padding: 10px;">
                            <p style="margin: 0;">&copy; 2025 High Twelve Lodge No.82</p>
                        </div>
                    </div>';
                // Send the email
                $mail->send();
                // Clear recipients for next email
                $mail->clearAddresses();
            }

            // Send success response
            echo json_encode(["status" => "success", "message" => "Event added successfully. Email sent."]);
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
