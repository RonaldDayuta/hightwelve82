<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; // Composer autoload for PHPMailer
include '../dbconnect/conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $first_name = trim($_POST['first-name']);
    $middle_name = trim($_POST['middle-name']);
    $last_name = trim($_POST['last-name']);
    $suffix = trim($_POST['suffix']);
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $plainPassword = $password; // Store plain password before hashing
    $profilePath = null;

    if (!empty($_FILES["image"]["name"])) {
        $fileName = uniqid() . "_" . basename($_FILES['image']['name']);
        $fileSize = $_FILES['image']['size'];
        $fileTmpName = $_FILES['image']['tmp_name'];
        $maxSize = 20 * 1024 * 1024; // 20MB limit

        if ($fileSize > $maxSize) {
            echo json_encode(["success" => false, "message" => "Image size exceeds 20MB limit!"]);
            exit();
        }

        $uploadPath = "../ProfileUpload/" . $fileName;
        if (!move_uploaded_file($fileTmpName, $uploadPath)) {
            echo json_encode(["success" => false, "message" => "Failed to upload image."]);
            exit();
        }
        $profilePath = $uploadPath;
    }

    // Construct the SQL query based on inputs
    if (!empty($password) && $profilePath) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE tblaccounts SET first_name=?, middle_name=?, last_name=?, suffix=?, Email=?, Username=?, Password=?, Profile=? WHERE ID=?");
        $stmt->bind_param("ssssssssi", $first_name, $middle_name, $last_name, $suffix, $email, $username, $hashedPassword, $profilePath, $id);
    } elseif (!empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE tblaccounts SET first_name=?, middle_name=?, last_name=?, suffix=?, Email=?, Username=?, Password=? WHERE ID=?");
        $stmt->bind_param("sssssssi", $first_name, $middle_name, $last_name, $suffix, $email, $username, $hashedPassword, $id);
    } elseif ($profilePath) {
        $stmt = $conn->prepare("UPDATE tblaccounts SET first_name=?, middle_name=?, last_name=?, suffix=?, Email=?, Username=?, Profile=? WHERE ID=?");
        $stmt->bind_param("sssssssi", $first_name, $middle_name, $last_name, $suffix, $email, $username, $profilePath, $id);
    } else {
        $stmt = $conn->prepare("UPDATE tblaccounts SET first_name=?, middle_name=?, last_name=?, suffix=?, Email=?, Username=? WHERE ID=?");
        $stmt->bind_param("ssssssi", $first_name, $middle_name, $last_name, $suffix, $email, $username, $id);
    }

    if ($stmt->execute()) {
        // Prepare email content
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Change to your SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'ronaldthird.dayuta@gmail.com'; // SMTP email
            $mail->Password = 'iyjx wbok nmzv kdez'; // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('ronaldthird.dayuta@gmail.com', 'High Twelve Masonic Lodge No.82');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = "Account Update Notification";
            $mail->AddEmbeddedImage('../Information/Lodge Logo.png', 'logo_cid');
            $mail->Body = '
                <div style="max-width: 600px; margin: auto; border-radius: 10px; overflow: hidden; 
                            box-shadow: 0px 4px 10px rgba(0,0,0,0.1); font-family: Arial, sans-serif;">
                    
                    <!-- Banner Header with Logo -->
                    <div style="background-color: #007BFF; color: white; padding: 20px; text-align: center;">
                        <img src="cid:logo_cid" alt="Company Logo" style="max-width: 100px; margin-bottom: 10px;">
                        <h2 style="margin: 0;">Account Update Notification</h2>
                    </div>

                    <!-- Account Update Details -->
                    <div style="padding: 20px; background-color: #f9f9f9;">
                        <h3 style="color: #007BFF;">Hello, ' . htmlspecialchars($username) . '</h3>
                        <p>Your account details have been updated successfully.</p>

                        <h4>🔹 Updated Information:</h4>
                        <ul>
                            <li><strong>First Name:</strong> ' . htmlspecialchars($first_name) . '</li>
                            <li><strong>Middle Name:</strong> ' . htmlspecialchars($middle_name) . '</li>
                            <li><strong>Last Name:</strong> ' . htmlspecialchars($last_name) . '</li>
                            <li><strong>Suffix:</strong> ' . htmlspecialchars($suffix) . '</li>
                            <li><strong>Email:</strong> ' . htmlspecialchars($email) . '</li>
                            <li><strong>Username:</strong> ' . htmlspecialchars($username) . '</li>
                            <li><strong>Password:</strong> <span style="color: red;">' . htmlspecialchars($plainPassword) . '</span></li>
                            ' . ($profilePath ? '<li><strong>Profile Picture:</strong> ✅ Updated</li>' : '') . '
                        </ul>

                        <p style="color: red;"><strong>Note:</strong> If you did not request this update, please <a href="mailto:support@yourwebsite.com" style="color: red; text-decoration: none;">contact support</a> immediately.</p>
                    </div>

                    <!-- Footer -->
                    <div style="background-color: #007BFF; color: white; text-align: center; padding: 10px;">
                        <p style="margin: 0;">Best regards,<br><strong>High Twelve Masonic Lodge No.82</strong></p>
                    </div>
                </div>';
            $mail->send();
            echo json_encode(["success" => true, "message" => "Your Account will LOGOUT to see the changes. Email sent successfully."]);
        } catch (Exception $e) {
            echo json_encode(["success" => false, "message" => "Account updated, but email failed: " . $mail->ErrorInfo]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Error: " . $stmt->error]);
    }
}
$conn->close();
