<?php
require '../dbconnect/conn.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Fetch user details before deleting the account
    $sql = "SELECT Email, Username, Profile FROM tblaccounts WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $email = $user['Email'];
        $username = $user['Username'];
        $imageFile = $user['Profile'];

        // Delete the image file if it exists
        if (!empty($imageFile) && file_exists($imageFile)) {
            unlink($imageFile);
        }

        // Proceed with deletion
        $deleteSql = "DELETE FROM tblaccounts WHERE ID = ?";
        $deleteStmt = $conn->prepare($deleteSql);
        $deleteStmt->bind_param("i", $id);

        if ($deleteStmt->execute()) {
            // Send email notification
            $mail = new PHPMailer(true);
            try {
                // Server settings
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com'; // Replace with your SMTP server
                $mail->SMTPAuth   = true;
                $mail->Username   = 'ronaldthird.dayuta@gmail.com'; // Replace with your email
                $mail->Password   = 'iyjx wbok nmzv kdez';    // Replace with your email password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = 587;

                // Recipients
                $mail->setFrom('ronaldthird.dayuta@gmail.com', 'High Twelve Masonic Lodge No.82');
                $mail->addAddress($email, $username); // Send email to the user

                // Content
                $mail->isHTML(true);
                $mail->Subject = 'Account Deleted';
                $mail->AddEmbeddedImage('../Information/Lodge Logo.png', 'logo_cid');
                $mail->Body = '
                    <div style="max-width: 600px; margin: auto; border-radius: 10px; overflow: hidden; 
                                box-shadow: 0px 4px 10px rgba(0,0,0,0.1); font-family: Arial, sans-serif;">
                        
                        <!-- Banner Header with Logo -->
                        <div style="background-color: #DC3545; color: white; padding: 20px; text-align: center;">
                            <img src="cid:logo_cid" alt="Company Logo" style="max-width: 100px; margin-bottom: 10px;">
                            <h2 style="margin: 0;">Account Deletion Notice</h2>
                        </div>

                        <!-- Deletion Confirmation Message -->
                        <div style="padding: 20px; background-color: #f9f9f9; text-align: center;">
                            <h3 style="color: #DC3545;">Dear ' . htmlspecialchars($username) . ',</h3>
                            <p>Your account has been successfully <b>deleted</b>.</p>

                            <p style="color: red; font-weight: bold;">If you did not request this change, please <a href="mailto:support@yourwebsite.com" style="color: red; text-decoration: none;">contact support</a> immediately.</p>

                            <p style="margin-top: 20px;">Thank you for using our services.</p>
                        </div>

                        <!-- Footer -->
                        <div style="background-color: #DC3545; color: white; text-align: center; padding: 10px;">
                            <p style="margin: 0;">&copy; 2025 High Twelve Masonic Lodge No.82</p>
                        </div>
                    </div>';
                $mail->send();
                // Send email
                $mail->send();
                echo json_encode(array('success' => 'Delete', 'message' => 'Account deleted successfully, and email sent.'));
            } catch (Exception $e) {
                echo json_encode(array('success' => 'Delete', 'message' => 'Account deleted, but email failed: ' . $mail->ErrorInfo));
            }
        } else {
            echo json_encode(array('error' => 'Error', 'message' => 'Account deletion failed.') . $conn->error);
        }
    } else {
        echo json_encode(array('error' => 'Error', 'message' => 'User not found'));
    }
}
$conn->close();
