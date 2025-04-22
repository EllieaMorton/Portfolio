<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Adjust the path if needed

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
    
    // Create the PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();  // Send using SMTP
        $mail->Host = 'smtp-mail.outlook.com';  // Set the SMTP server for Outlook
        $mail->SMTPAuth = true;
        $mail->Username = 'eam0103@auburn.edu';  // Your Outlook email address
        $mail->Password = '13802Khilani!';  // Your Outlook email password (use app password if you have 2-factor authentication enabled)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;  // The port for Outlook SMTP

        //Recipients
        $mail->setFrom('eam0103@auburn.edu', 'Ellie Morton');
        $mail->addAddress('eam0103@auburn.edu');  // Send to the same Outlook email address

        // Content
        $mail->isHTML(false);  // Set email format to plain text
        $mail->Subject = "New Contact Form Submission from $name";
        $mail->Body    = "You have received a new message from the contact form on your website.\n\n";
        $mail->Body   .= "Name: $name\n";
        $mail->Body   .= "Email: $email\n";
        $mail->Body   .= "Message:\n$message\n";

        // Send the email
        $mail->send();
        echo "<script>alert('Message sent successfully!'); window.location = 'contact.html';</script>";
    } catch (Exception $e) {
        echo "<script>alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}'); window.location = 'contact.html';</script>";
    }
}
?>
