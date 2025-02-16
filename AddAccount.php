<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

include('conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['account-email'];
    $password = $_POST['account-password'];
    $confirm_password = $_POST['account-copassword'];
    $position = $_POST['account-position'];

    if ($password !== $confirm_password) {
        echo json_encode(["success" => false, "message" => "Passwords do not match!"]);
        exit();
    }

    $encrypted_password = openssl_encrypt($password, "AES-128-ECB", 'hightwelve82');

    $upload_dir = "ProfileUpload/";
    $image_path = "img/logo.png";

    if (!empty($_FILES['account-image']['name'])) {
        $image_tmp = $_FILES['account-image']['tmp_name'];
        $image_ext = pathinfo($_FILES['account-image']['name'], PATHINFO_EXTENSION);
        $image_name = uniqid("profile_", true) . "." . $image_ext;
        $image_path = $upload_dir . $image_name;

        if (!move_uploaded_file($image_tmp, $image_path)) {
            echo json_encode(["success" => false, "message" => "Failed to upload image"]);
            exit();
        }
    }

    $stmt = $conn->prepare("INSERT INTO tblaccounts (Email, Password, WebPosition, Profile) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $email, $encrypted_password, $position, $image_path);

    if ($stmt->execute()) {
        // Send email confirmation
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Palitan ng SMTP host ng email provider mo
            $mail->SMTPAuth = true;
            $mail->Username = 'ronaldthird.dayuta@gmail.com'; // Palitan ng email mo
            $mail->Password = 'wami xzxh dkic utgz'; // Palitan ng app password mo (huwag ilagay ang real password mo)
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('ronaldthird.dayuta@gmail.com', 'High Twelve82');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Account Registration Successful';
            $mail->Body    = "<h3>Welcome!</h3><p>Your account has been successfully created.</p>
                              <p><b>Email:</b> $email</p>
                              <p><b>Password:</b> $password</p>
                              <p>Login <a href='your-website-url.com/login'>here</a>.</p>";

            $mail->send();
            echo json_encode(["success" => true, "message" => "Account added successfully and email sent!"]);
        } catch (Exception $e) {
            echo json_encode(["success" => false, "message" => "Account created but email not sent. Error: {$mail->ErrorInfo}"]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Database error!"]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["success" => false, "message" => "Invalid request"]);
}
?>