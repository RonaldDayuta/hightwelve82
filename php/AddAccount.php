<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; // Gumamit ng Composer autoload
include '../dbconnect/conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = trim($_POST['first-name']);
    $middle_name = trim($_POST['middle-name']);
    $last_name = trim($_POST['last-name']);
    $suffix = trim($_POST['suffix']);
    $email = trim($_POST['account-email']);
    $username = trim($_POST['account-username']);
    $password = trim($_POST['account-password']);
    $confirm_password = trim($_POST['account-copassword']);
    $position = trim($_POST['account-position']);

    // Check kung magkatugma ang password
    if ($password !== $confirm_password) {
        echo json_encode(["success" => false, "message" => "Passwords do not match!"]);
        exit();
    }

    $check_stmt = $conn->prepare("SELECT Email, username FROM tblaccounts WHERE Email = ? OR username = ?");
    $check_stmt->bind_param("ss", $email, $username);
    $check_stmt->execute();
    $check_stmt->store_result();
    $check_stmt->bind_result($existing_email, $existing_username);

    $email_exists = false;
    $username_exists = false;

    while ($check_stmt->fetch()) {
        if ($existing_email === $email) {
            $email_exists = true;
        }
        if ($existing_username === $username) {
            $username_exists = true;
        }
    }

    $check_stmt->close();

    // Construct the appropriate error message
    if ($email_exists && $username_exists) {
        echo json_encode(["success" => false, "message" => "Email and Username are already in use!"]);
        exit();
    } elseif ($email_exists) {
        echo json_encode(["success" => false, "message" => "Email is already registered!"]);
        exit();
    } elseif ($username_exists) {
        echo json_encode(["success" => false, "message" => "Username is already in use!"]);
        exit();
    }

    // Hash ang password bago i-store sa database
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Default profile image
    $upload_dir = "../ProfileUpload/";
    $image_path = "../img/logo.png";

    // Handle file upload kung meron
    if (!empty($_FILES['account-image']['name'])) {
        $image_tmp = $_FILES['account-image']['tmp_name'];
        $image_ext = strtolower(pathinfo($_FILES['account-image']['name'], PATHINFO_EXTENSION));
        $image_size = $_FILES['account-image']['size']; // Get image size in bytes
        $image_name = uniqid("profile_", true) . "." . $image_ext;
        $image_path = $upload_dir . $image_name;

        // Allowed extensions
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];

        // **Check file size (limit to 20MB = 20 * 1024 * 1024 bytes)**
        if ($image_size > 20 * 1024 * 1024) {
            echo json_encode(["success" => false, "message" => "Image size exceeds 20MB limit!"]);
            exit();
        }

        // **Check file type**
        if (!in_array($image_ext, $allowed_extensions)) {
            echo json_encode(["success" => false, "message" => "Invalid image format! Only JPG, PNG, and GIF are allowed."]);
            exit();
        }

        // Move uploaded file
        if (!move_uploaded_file($image_tmp, $image_path)) {
            echo json_encode(["success" => false, "message" => "Failed to upload image"]);
            exit();
        }
    }

    // Ipasok sa database
    $stmt = $conn->prepare("INSERT INTO tblaccounts (first_name, middle_name, last_name, suffix, Email, username, Password, WebPosition, Profile) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssss", $first_name, $middle_name, $last_name, $suffix, $email, $username, $hashed_password, $position, $image_path);

    if ($stmt->execute()) {
        // Send email confirmation
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'ronaldthird.dayuta@gmail.com'; // Palitan ng email mo
            $mail->Password = 'wami xzxh dkic utgz'; // Gumamit ng app password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('ronaldthird.dayuta@gmail.com', 'High Twelve Lodge No.82');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Account Registration Successful';
            // Attach the logo (Ensure the correct file path)
            $mail->AddEmbeddedImage('../Information/Lodge Logo.png', 'logo_cid');
            $mail->Body = '
                <div style="max-width: 600px; margin: auto; border-radius: 10px; overflow: hidden; 
                            box-shadow: 0px 4px 10px rgba(0,0,0,0.1); font-family: Arial, sans-serif;">
                    
                    <!-- Banner Header with Logo -->
                    <div style="background-color: #007BFF; color: white; padding: 20px; text-align: center;">
                        <img src="cid:logo_cid" alt="Company Logo" style="max-width: 100px; margin-bottom: 10px;">
                        <h2 style="margin: 0;">Welcome to Our Platform!</h2>
                    </div>

                    <!-- Account Details -->
                    <div style="padding: 20px; background-color: #f9f9f9;">
                        <h3 style="color: #007BFF; text-align: center;">Your Account is Ready!</h3>
                        <p style="text-align: center;">Thank you for joining us. Below are your account details:</p>

                        <table style="width: 100%; border-collapse: collapse;">
                            <tr>
                                <td style="padding: 10px; font-weight: bold;">First Name:</td>
                                <td style="padding: 10px;">' . htmlspecialchars($first_name) . '</td>
                            </tr>
                            <tr>
                                <td style="padding: 10px; font-weight: bold;">Middle Name:</td>
                                <td style="padding: 10px;">' . htmlspecialchars($middle_name) . '</td>
                            </tr>
                            <tr>
                                <td style="padding: 10px; font-weight: bold;">Last Name:</td>
                                <td style="padding: 10px;">' . htmlspecialchars($last_name) . '</td>
                            </tr>
                            <tr>
                                <td style="padding: 10px; font-weight: bold;">Suffix:</td>
                                <td style="padding: 10px;">' . htmlspecialchars($suffix) . '</td>
                            </tr>
                            <tr>
                                <td style="padding: 10px; font-weight: bold;">Email:</td>
                                <td style="padding: 10px;">' . htmlspecialchars($email) . '</td>
                            </tr>
                            <tr>
                                <td style="padding: 10px; font-weight: bold;">Username:</td>
                                <td style="padding: 10px;">' . htmlspecialchars($username) . '</td>
                            </tr>
                            <tr>
                                <td style="padding: 10px; font-weight: bold;">Password:</td>
                                <td style="padding: 10px;">' . htmlspecialchars($password) . '</td>
                            </tr>
                        </table>

                        <p style="text-align: center; margin-top: 20px;">
                            <a href="https://your-website-url.com/login" 
                            style="background-color: #007BFF; color: white; padding: 10px 20px; text-decoration: none; 
                                    border-radius: 5px; display: inline-block;">Login Now</a>
                        </p>
                    </div>

                    <!-- Footer -->
                    <div style="background-color: #007BFF; color: white; text-align: center; padding: 10px;">
                        <p style="margin: 0;">&copy; 2025 High Twelve Lodge No.82</p>
                    </div>
                </div>';
            $mail->send();
            echo json_encode(["success" => true, "message" => "Account added successfully!"]);
        } catch (Exception $e) {
            echo json_encode(["success" => false, "message" => "Account created but email not sent. Error: " . $mail->ErrorInfo]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Database error!"]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["success" => false, "message" => "Invalid request"]);
}