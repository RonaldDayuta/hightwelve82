<?php
require '../dbconnect/conn.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the values from the form
    $id = $_POST['update-id'];
    $email = $_POST['update-email'];
    $username = $_POST['update-username'];
    $position = $_POST['update-position'];
    $status = $_POST['update-status'];
    $password = $_POST['update-password']; // Get password input

    // If the password field is not empty, hash it before updating
    if (!empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE tblaccounts SET Email=?, Username=?, WebPosition=?, Status=?, Password=? WHERE ID=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $email, $username, $position, $status, $hashedPassword, $id);
    } else {
        // If no password is provided, update without changing the password
        $sql = "UPDATE tblaccounts SET Email=?, Username=?, WebPosition=?, Status=? WHERE ID=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $email, $username, $position, $status, $id);
    }

    // Execute the query
    if ($stmt->execute()) {
        // Send email notification
        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com'; // Change this to your SMTP server
            $mail->SMTPAuth   = true;
            $mail->Username   = 'ronaldthird.dayuta@gmail.com'; // Your email
            $mail->Password   = 'wami xzxh dkic utgz';    // Your email password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Recipients
            $mail->setFrom('ronaldthird.dayuta@gmail.com', 'High Twelve82');
            $mail->addAddress($email, $username); // Send email to updated account

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Account Updated';
            $mail->Body    = "Dear $username,<br><br>
                              Your account details have been successfully updated.<br><br>
                              <b>Updated Information:</b><br>
                              Email: $email<br>
                              Username: $username<br>
                              Position: $position<br>
                              Status: $status<br><br>
                              If you did not request this change, please contact support immediately.";

            $mail->send();
            echo json_encode(array('success' => 'Updated', 'message' => 'Updated Successfully and email sent'));
        } catch (Exception $e) {
            echo json_encode(array('success' => 'Updated', 'message' => 'Updated Successfully but email failed: ' . $mail->ErrorInfo));
        }
    } else {
        echo json_encode(array('error' => 'Error', 'message' => 'Update Failed'));
    }
}
$conn->close();
