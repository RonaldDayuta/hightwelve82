<?php
require '../dbconnect/conn.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the values from the form
    $id = $_POST['update-id'];
    $first_name = trim($_POST['update-first-name']);
    $middle_name = trim($_POST['update-middle-name']);
    $last_name = trim($_POST['update-last-name']);
    $suffix = trim($_POST['update-suffix']);
    $email = $_POST['update-email'];
    $username = $_POST['update-username'];
    $position = $_POST['update-position'];
    $status = $_POST['update-status'];
    $password = $_POST['update-password']; // Get password input

    // If the password field is not empty, hash it before updating
    if (!empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE tblaccounts SET first_name=?, middle_name=?, last_name=?, suffix=?, Email=?, Username=?, WebPosition=?, Status=?, Password=? WHERE ID=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssssi", $first_name, $middle_name, $last_name, $suffix, $email, $username, $position, $status, $hashedPassword, $id);
    } else {
        // If no password is provided, update without changing the password
        $sql = "UPDATE tblaccounts SET Email=?, Username=?, WebPosition=?, Status=? WHERE ID=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssi",$first_name, $middle_name, $last_name, $suffix, $email, $username, $position, $status, $id);
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
            $mail->setFrom('ronaldthird.dayuta@gmail.com', 'High Twelve Lodge No.82');
            $mail->addAddress($email, $username); // Send email to updated account

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Account Updated';
            $mail->AddEmbeddedImage('../Information/Lodge Logo.png', 'logo_cid');
            $mail->Body = '
                <div style="max-width: 600px; margin: auto; border-radius: 10px; overflow: hidden; 
                            box-shadow: 0px 4px 10px rgba(0,0,0,0.1); font-family: Arial, sans-serif;">
                    
                    <!-- Banner Header with Logo -->
                    <div style="background-color: #007BFF; color: white; padding: 20px; text-align: center;">
                        <img src="cid:logo_cid" alt="Company Logo" style="max-width: 100px; margin-bottom: 10px;">
                        <h2 style="margin: 0;">Account Update Notification</h2>
                    </div>

                    <!-- Updated Account Details -->
                    <div style="padding: 20px; background-color: #f9f9f9;">
                        <h3 style="color: #007BFF; text-align: center;">Hello, ' . htmlspecialchars($username) . '!</h3>
                        <p style="text-align: center;">Your account details have been successfully updated.</p>

                        <div style="background-color: white; padding: 15px; border-radius: 5px; box-shadow: 0px 2px 5px rgba(0,0,0,0.1);">
                            <p><b>First Name:</b> ' . htmlspecialchars($first_name) . '</p>
                            <p><b>Middle Name:</b> ' . htmlspecialchars($middle_name) . '</p>
                            <p><b>Last Name:</b> ' . htmlspecialchars($last_name) . '</p>
                            <p><b>Suffix:</b> ' . htmlspecialchars($suffix) . '</p>
                            <p><b>Email:</b> ' . htmlspecialchars($email) . '</p>
                            <p><b>Username:</b> ' . htmlspecialchars($username) . '</p>
                            <p><b>Position:</b> ' . htmlspecialchars($position) . '</p>
                            <p><b>Status:</b> ' . htmlspecialchars($status) . '</p>
                        </div>

                        <p style="color: red; text-align: center; margin-top: 20px;">
                            If you did not request this change, please <a href="mailto:support@yourwebsite.com" style="color: red; text-decoration: none;">contact support</a> immediately.
                        </p>
                    </div>

                    <!-- Footer -->
                    <div style="background-color: #007BFF; color: white; text-align: center; padding: 10px;">
                        <p style="margin: 0;">&copy; 2025 High Twelve Lodge No.82</p>
                    </div>
                </div>';
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
