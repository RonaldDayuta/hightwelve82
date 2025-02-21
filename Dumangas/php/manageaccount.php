<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; // Composer autoload for PHPMailer
include '../dbconnect/conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
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
        $stmt = $conn->prepare("UPDATE tblaccounts SET Email=?, Username=?, Password=?, Profile=? WHERE ID=?");
        $stmt->bind_param("ssssi", $email, $username, $hashedPassword, $profilePath, $id);
    } elseif (!empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE tblaccounts SET Email=?, Username=?, Password=? WHERE ID=?");
        $stmt->bind_param("sssi", $email, $username, $hashedPassword, $id);
    } elseif ($profilePath) {
        $stmt = $conn->prepare("UPDATE tblaccounts SET Email=?, Username=?, Profile=? WHERE ID=?");
        $stmt->bind_param("sssi", $email, $username, $profilePath, $id);
    } else {
        $stmt = $conn->prepare("UPDATE tblaccounts SET Email=?, Username=? WHERE ID=?");
        $stmt->bind_param("ssi", $email, $username, $id);
    }

    if ($stmt->execute()) {
        // Prepare email content
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Change to your SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'ronaldthird.dayuta@gmail.com'; // SMTP email
            $mail->Password = 'wami xzxh dkic utgz'; // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('ronaldthird.dayuta@gmail.com', 'High Twelve82');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = "Account Update Notification";
            $mail->Body = "
                <h3>Hello, $username</h3>
                <p>Your account details have been updated successfully.</p>
                <h4>🔹 Updated Information:</h4>
                <ul>
                    <li><strong>Email:</strong> $email</li>
                    <li><strong>Username:</strong> $username</li>
                    <li><strong>Password:</strong> $plainPassword</li>
                    " . ($profilePath ? "<li><strong>Profile Picture:</strong> ✅ Updated</li>" : "") . "
                </ul>
                <p><strong>Note:</strong> If you did not request this update, please contact support immediately.</p>
                <p>Best regards,<br><strong>High Twelve82</strong></p>
            ";

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
?>
