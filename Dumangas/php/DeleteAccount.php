<?php
require '../dbconnect/conn.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Fetch the user's email before deleting the account
    $sql = "SELECT Email, Username FROM tblaccounts WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $email = $user['Email'];
        $username = $user['Username'];

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
                $mail->Password   = 'wami xzxh dkic utgz';    // Replace with your email password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = 587;

                // Recipients
                $mail->setFrom('ronaldthird.dayuta@gmail.com', 'High Twelve82');
                $mail->addAddress($email, $username); // Send email to the user

                // Content
                $mail->isHTML(true);
                $mail->Subject = 'Account Deleted';
                $mail->Body    = "Dear $username,<br><br>
                                  Your account has been successfully deleted.<br><br>
                                  If you did not request this change, please contact support immediately.<br><br>
                                  Thank you for using our services.";

                // Send email
                $mail->send();
                echo json_encode(array('success' => 'Delete', 'message' => 'Delete Successful and email sent'));
            } catch (Exception $e) {
                echo json_encode(array('success' => 'Delete', 'message' => 'Delete Successful but email failed: ' . $mail->ErrorInfo));
            }
        } else {
            echo json_encode(array('error' => 'Error', 'message' => 'Delete Unsuccessful') . $conn->error);
        }
    } else {
        echo json_encode(array('error' => 'Error', 'message' => 'User not found'));
    }
}
$conn->close();
