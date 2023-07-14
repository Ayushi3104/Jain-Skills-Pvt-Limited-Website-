
<?php

//Created by Harsh Kamde

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

// Ensure the form is submitted
if (isset($_POST["submit"])) {
    // Validate form fields
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $subject = trim($_POST["subject"]);
    $mobile = trim($_POST["mobile"]);
    $message = trim($_POST["message"]);
    
    // Validate name field
    if (empty($name)) {
        echo "Name is required";
        exit;
    }
    
    // Validate email field
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Valid email is required";
        exit;
    }
    
    // Validate subject field
    if (empty($subject)) {
        echo "Subject is required";
        exit;
    }
    
    // Validate mobile field
    if (empty($mobile)) {
        echo "Mobile number is required";
        exit;
    }
    
    // Validate message field
    if (empty($message)) {
        echo "Message is required";
        exit;
    }
    
    // Configuring SMTP settings, currently my account as smtp
    $smtpHost = 'smtp.gmail.com';
    $smtpPort = 465;
    $smtpUsername = 'harshkamde4321@gmail.com';
    $smtpPassword = 'peonsggbklofaszx';
    
    // Preparing the email content, *Email of the receiver
    $to = 'archanakamde2708@gmail.com';
    $subject = 'New Contact Form Submission';
    $emailContent = 'Name: '.$name.'<br>';
    $emailContent .= 'Email: '.$email.'<br>';
    $emailContent .= 'Subject: '.$subject.'<br>';
    $emailContent .= 'Mobile: '.$mobile.'<br>';
    $emailContent .= 'Message: '.$message.'<br>';
    

    $mail->isSMTP();
    $mail->Host = $smtpHost;
    $mail->Port = $smtpPort;
    $mail->SMTPAuth = true;
    $mail->Username = $smtpUsername;
    $mail->Password = $smtpPassword;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    
    $mail->isHTML(true);
    $mail->setFrom($email, $name);
    $mail->addAddress($to);
    $mail->Subject = $subject;
    $mail->Body = $emailContent;
    
    if (!$mail->send()) {
        echo 'Error sending email: ' . $mail->ErrorInfo;
    } else {
        // echo "<script>alert('Email sent Successfully')</script>";
        echo 'Your response has been sent';
        echo '<a href="../index.html"> <br>Goto HomePage</a>';
        // header('Location: ../index.html');
    }
}

//Created by Harsh Kamde

?>
