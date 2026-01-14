<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = "server189.web-hosting.com"; 
        $mail->SMTPAuth = true;
        $mail->Username = "hello@ivyleagueindia.com"; 
        $mail->Password = "Ivyleagueindia@123";
        $mail->SMTPSecure = "tls";
        $mail->Port = 587;

        $mail->SMTPOptions = [
          'ssl' => [
            'verify_peer' => true,
            'verify_peer_name' => true,
            'allow_self_signed' => false
          ]
        ];
        $mail->setFrom("hello@ivyleagueindia.com", "Ivy League India Website");
        $mail->addAddress("hello@ivyleagueindia.com");
        $mail->addReplyTo($email, $name);

        $mail->isHTML(true);
        $mail->Subject = "New Inquiry From Website";

        $mail->Body = "
            <h2>Newsletter Form Submission</h2>
            <p><strong>Email:</strong> $email</p>
        ";

        $mail->send();
        echo "success";

    } catch (Exception $e) {
        error_log("Mail Error: " . $mail->ErrorInfo);
        echo "error";
    }
}
?>
