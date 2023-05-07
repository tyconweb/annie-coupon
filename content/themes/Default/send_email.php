<?php
require 'vendor/autoload.php'; // Require the PHPMailer library

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Create a new PHPMailer object
    $mail = new PHPMailer(true);

    try {
        // Configure the SMTP settings (replace with your own)
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = '000@gmail'; 
        $mail->Password = 'your_email_password'; 

      
        $mail->setFrom($email, $name);
        $mail->addReplyTo($email, $name);

        // Set the recipient email address
        $mail->addAddress('info@anniediscount.co.uk');

        // Set the email subject and body
        $mail->Subject = 'Contact Form Submission';
        $mail->Body = "Name: " . $name . "\n";
        $mail->Body .= "Email: " . $email . "\n";
        $mail->Body .= "Message: " . $message . "\n";

        // Send the email
        $mail->send();
        echo "Email sent successfully.";
    } catch (Exception $e) {
        echo "Failed to send email. Error: " . $mail->ErrorInfo;
    }
}
?>
