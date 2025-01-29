<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

class Contact {
    static function sendMail($data) {
        
        $firstName = isset($data['first_name']) ? htmlspecialchars($data['first_name']) : '';
        $lastName = isset($data['last_name']) ? htmlspecialchars($data['last_name']) : '';
        $subject = isset($data['subject']) ? htmlspecialchars($data['subject']) : '';
        $email = isset($data['email']) ? trim(filter_var($data['email'], FILTER_SANITIZE_EMAIL)) : '';
        $message = isset($data['message']) ? htmlspecialchars($data['message']) : '';

        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            die('Invalid email format');
        }

        $mail = new PHPMailer(true);

        try {
            // Server Information
            $mail->isSMTP();
            $mail->SMTPAuth = true;

            $mail->Host = 'smtp.gmail.com';
            $mail->Username = 'sysdevproj69@gmail.com';
            $mail->Password = 'wmjcogrprrikolhh';

            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Recipient Information
            $mail->setFrom($email, "$firstName "." $lastName");
            $mail->addAddress('sysdevproj69@gmail.com');
            $mail->Subject = $subject;
            $mail->Body = $message;

            $mail->isHTML(true);
            $mail->send();

            return true;
        } catch (Exception $e) {
            die("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        }
    }
}

?>