<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; // Gumamit ng Composer autoload
include '../dbconnect/conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    $check_stmt = $conn->prepare("SELECT ID FROM tblaccounts WHERE Email = ?");
    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        echo json_encode(["success" => false, "message" => "Email is already registered!"]);
        $check_stmt->close();
        exit();
    }
    $check_stmt->close();

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
    $stmt = $conn->prepare("INSERT INTO tblaccounts (Email, username, Password, WebPosition, Profile) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $email, $username, $hashed_password, $position, $image_path);

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

            $mail->setFrom('ronaldthird.dayuta@gmail.com', 'High Twelve82');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Account Registration Successful';
            $mail->Body    = "<h3>Welcome!</h3><p>Your account has been successfully created.</p>
                              <p><b>Email:</b> $email</p>
                              <p><b>Username:</b> $username</p>
                              <p><b>Password:</b> $password</p> <!-- Plaintext password -->
                              <p>Login <a href='your-website-url.com/login'>here</a>.</p>";

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
