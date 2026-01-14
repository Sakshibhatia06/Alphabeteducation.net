<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name     = htmlspecialchars(trim($_POST['name']));
    $country  = htmlspecialchars(trim($_POST['country']));
    $email    = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $phone    = htmlspecialchars(trim($_POST['phone']));
    $message  = htmlspecialchars(trim($_POST['message']));

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
            <h2>Contact Form Submission</h2>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Country:</strong> $country</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Phone:</strong> $phone</p>
            <p><strong>Message:</strong> $message</p>
        ";

        $mail->send();
        echo "success";

    } catch (Exception $e) {
        error_log("Mail Error: " . $mail->ErrorInfo);
        echo "error";
    }
}
?>
