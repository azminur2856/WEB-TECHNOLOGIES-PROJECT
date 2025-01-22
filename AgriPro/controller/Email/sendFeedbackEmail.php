<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../../vendor/autoload.php';

    function sendFeedbackEmail($email, $feedback)
    {
        try {
            $mail = new PHPMailer(true);

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = ''; // Add your email (gmail)
            $mail->Password = ''; // application password (not gmail password)
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('', 'AgriPro'); // Add your email (gmail)
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Feedback Provided';
            $mail->Body = "<p>Dear User,</p><p>Your feedback has been updated:</p><p><strong>{$feedback}</strong></p><p>Thank you.</p>";

            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
?>