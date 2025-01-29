<?php
    require 'vendor/autoload.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;  
    use Dotenv\Dotenv;

    // Load the environment variables
    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    $conn=mysqli_connect("localhost", "root","","php-db");

    function sendEmail($receiverEmail, $subject, $body) {
        $mail = new PHPMailer(true);
        
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = $_ENV['GMAIL_USERNAME'];
            $mail->Password = $_ENV['GMAIL_PASSWORD'];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;

            $mail->setFrom($_ENV['GMAIL_USERNAME'], 'PHP TEST');
            $mail->addAddress($receiverEmail);
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $body;
            $mail->AltBody = strip_tags($body);

            
            $mail->send();
            return "Email successfully sent to $receiverEmail";
        } catch (Exception $e) {
            return "Email sending failed. Error: {$mail->ErrorInfo}";
        }
    }
?>