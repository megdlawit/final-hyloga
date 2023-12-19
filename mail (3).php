<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $from = $_POST['from'];
    $phone =$_POST['phone'];
    $name = $_POST['name'];
    $message = $_POST['message'];

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'mail.hayloga.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'info@hayloga.com';              // SMTP username
        $mail->Password   = '0710034103haylo';                 // SMTP password
        $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       =  587;                                    // TCP port to connect to, use 587 for TLS connections

        //Recipients
        $mail->setFrom($from);
        $mail->addAddress('info@hayloga.com');               // Add a recipient
        

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
       
        $mail->Body    = "Name: $name<br>Phone: $phone:<br> Message:$message";
        
        

        // Send the email
        $mail->send();
        echo '<script>alert("Message has been sent");</script>';
        die();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
